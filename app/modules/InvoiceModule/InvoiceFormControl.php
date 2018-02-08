<?php

namespace App\InvoiceModule;
use App\FormFactory;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * InvoiceFormControl
 * @author Jan Pospisil
 */

class InvoiceFormControl {
    use Nette\SmartObject;

    private $formFactory;

    public function __construct(FormFactory $formFactory) {
    	$this->formFactory = $formFactory;
    }

    public function create(){
    	$form = $this->formFactory->create();
    	$form->addText('number', 'Number')
		    ->setAttribute('placeholder', 'Invoice number')
		    ->setRequired();
    	$form->addText('price', 'price')
		    ->setAttribute('type', 'number')
		    ->setRequired()
	        ->addRule(Nette\Application\UI\Form::INTEGER, 'Price must be number.');
    	$form->addText('created', 'Created')
	    ->setAttribute('class', 'datepicker');
    	$form->addTextArea('description', 'Description');
    	$form->addUpload('invoice', 'Invoice');
    	$form->addSubmit('formsubmit', 'Create');
    	$form->onSuccess[] = [$this, 'fromSubmitted'];
    	return $form;
    }

    public function formSubmitted(Nette\Application\UI\Form $form, Nette\Utils\ArrayHash $values){
	    dumpe($values);
    }

}
