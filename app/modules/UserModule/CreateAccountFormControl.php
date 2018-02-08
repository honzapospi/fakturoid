<?php
namespace App\UserModule;
use App\FormFactory;
use App\Model\InvalidValueException;
use App\Model\Model;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * LoginFormControl
 * @author Jan Pospisil
 */

class CreateAccountFormControl {
    use Nette\SmartObject;

    private $formFactory;
    private $model;

    public function __construct(FormFactory $formFactory, Model $model) {
    	$this->formFactory = $formFactory;
    	$this->model = $model;
    }

    public function create(){
    	$form = $this->formFactory->create();
    	$form->addText('username', 'Username')
	    ->setRequired('Username is required.')
	    ->addRule(Nette\Application\UI\Form::EMAIL, 'Username mus tb email.')
	    ->setEmptyValue('@');
    	$form->addPassword('password', 'Password')
		    ->setRequired('Password is required')
		    ->addRule(Nette\Application\UI\Form::MIN_LENGTH, 'Minimal password length is %d', 5);
    	$form->addPassword('password_control', 'Password again')
		    ->setRequired('Password again is required')
	        ->addRule(Nette\Application\UI\Form::EQUAL, 'Password do not match.', $form['password'])
	        ->setOmitted();
    	$form->addSubmit('formsubmitted', 'Create account');
    	$form->onSuccess[] = [$this, 'formSubmitted'];
    	return $form;
    }

    public function formSubmitted(Nette\Application\UI\Form $form, Nette\Utils\ArrayHash $values){
    	try{
		    $this->model->createAccount($values->username, $values->password);
	    } catch (InvalidValueException $e){
			return $form->addError($e->getMessage());
	    }
		$form->getPresenter()->flashMessage('Account has been created.');
	    $form->getPresenter()->redirect('Auth:login');
    }



}
