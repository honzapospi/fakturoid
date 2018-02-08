<?php

namespace App\InvoiceModule;
use App\FormFactory;
use App\Model\Model;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * InvoiceFormControl
 * @author Jan Pospisil
 */

class InvoiceFormControl {
    use Nette\SmartObject;

    private $formFactory;
    private $model;
    private $user;

    public function __construct(FormFactory $formFactory, Model $model, Nette\Security\User $user) {
    	$this->formFactory = $formFactory;
    	$this->model = $model;
    	$this->user = $user;
    }

    public function create(){
    	$form = $this->formFactory->create();
    	$form->addText('number', 'Number')
		    ->setAttribute('placeholder', 'Invoice number')
		    ->setRequired();
    	$companyList = [];
    	foreach($this->model->getCompanies($this->user->id) as $compny){
    		$companyList[$compny->id] = $compny->name;
	    }
		$form->addSelect('company_id', 'Company', $companyList)->setRequired()->setPrompt('Please select');
    	$form->addText('price', 'price')
		    ->setAttribute('type', 'number')
		    ->setRequired()
	        ->addRule(Nette\Application\UI\Form::INTEGER, 'Price must be number.');
    	$form->addText('created', 'Created')
	    ->setAttribute('class', 'datepicker');
    	$form->addTextArea('description', 'Description');
    	$form->addUpload('invoice', 'Invoice');
    	$form->addSubmit('formsubmit', 'Create');
    	$form->onSuccess[] = [$this, 'formSubmitted'];
    	return $form;
    }

    public function formSubmitted(Nette\Application\UI\Form $form, Nette\Utils\ArrayHash $values){
    	try{
    		$created = \DateTime::createFromFormat('d/m/Y', $values->created);
	    } catch (\Exception $e){
    		return $form->addError('Invalid date of created.');
	    }

    	try {
		    $this->model->addInvoice($values->number, $values->price, $created, $values->description, $this->user, $values->company_id, $values->invoice->name ? $values->invoice : null);
	    } catch (\Exception $e){
    		return $form->addError('Sorry something is wrong. Ty again later.');
	    }

    }

}
