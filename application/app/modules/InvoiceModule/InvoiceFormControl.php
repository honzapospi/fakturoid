<?php

namespace App\InvoiceModule;
use App\FormFactory;
use App\Model\Model;
use Nette;
use Tracy\Debugger;

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
    private $invoice;

    public function __construct(FormFactory $formFactory, Model $model, Nette\Security\User $user) {
    	$this->formFactory = $formFactory;
    	$this->model = $model;
    	$this->user = $user;
    }

    public function create(Nette\Database\Table\ActiveRow $invoice = null){
    	$this->invoice = $invoice;
    	$form = $this->formFactory->create();
    	$form->addText('number', 'Number')
		    ->setAttribute('placeholder', 'Invoice number')
		    ->setRequired()
	        ->setDefaultValue($invoice ? $invoice->invoice_number : null);
    	$companyList = [];
    	foreach($this->model->getCompanies($this->user->id) as $compny){
    		$companyList[$compny->id] = $compny->name;
	    }
		$form->addSelect('company_id', 'Company', $companyList)
			->setRequired()
			->setPrompt('Please select')
			->setDefaultValue($invoice ? $invoice->company_id : null);
    	$form->addText('price', 'price')
		    ->setAttribute('type', 'number')
		    ->setRequired()
	        ->addRule(Nette\Application\UI\Form::INTEGER, 'Price must be number.')
	        ->setDefaultValue($invoice ? $invoice->price : null);
    	$form->addText('created', 'Created')
	    ->setAttribute('class', 'datepicker')
	    ->setDefaultValue($invoice ? $invoice->created->format('d/m/Y') : null);
    	$form->addTextArea('description', 'Description')
	        ->setDefaultValue($invoice ? $invoice->description : null);
    	if($invoice && $invoice->file){
    		$form->addCheckbox('delete_file', 'Delete invoice?');
	    }
    	$form->addUpload('invoice', 'Invoice');
    	$form->addSubmit('formsubmit', $invoice ? 'Save' : 'Create');
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
	    	if($this->invoice){
	    		$this->model->updateInvoice($values->number, $values->price, $created, $values->description, $this->user, $values->company_id, $values->invoice->name ? $values->invoice : null, $this->invoice->file ? $values->delete_file : null, $this->invoice->id);
		    } else {
			    $this->model->addInvoice($values->number, $values->price, $created, $values->description, $this->user, $values->company_id, $values->invoice->name ? $values->invoice : null);
		    }
	    } catch (\Exception $e){
	    	if(Debugger::$productionMode)
    		    return $form->addError('Sorry something is wrong. Ty again later.');
	    	throw $e;
	    }

    }

}
