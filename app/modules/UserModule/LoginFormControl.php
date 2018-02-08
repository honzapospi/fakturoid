<?php
namespace App\UserModule;
use App\FormFactory;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * LoginFormControl
 * @author Jan Pospisil
 */

class LoginFormControl {
    use Nette\SmartObject;

    private $formFactory;
    private $user;

    public function __construct(FormFactory $formFactory, Nette\Security\User $user) {
    	$this->formFactory = $formFactory;
    	$this->user = $user;
    }

    public function create(){
    	$form = $this->formFactory->create();
    	$form->addText('email', 'email')->setRequired();
    	$form->addPassword('password', 'Password')->setRequired();
    	$form->addSubmit('formasubmit', 'Login');
    	$form->onSuccess[] = [$this, 'formSubmitted'];
    	return $form;
    }

    public function formSubmitted(Nette\Application\UI\Form $form, Nette\Utils\ArrayHash $values){
    	try{
		    $this->user->login($values->email, $values->password);
	    } catch (Nette\Security\AuthenticationException $e){
    		return $form->addError($e->getMessage());
	    }
    }

}
