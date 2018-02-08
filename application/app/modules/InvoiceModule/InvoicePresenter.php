<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App\InvoiceModule;

use App\BasePresenter;
use App\Model\Model;
use Nette\Application\BadRequestException,
	Nette\Application\ForbiddenRequestException;
use Tracy\Debugger;

/**
 * IvoicePresenter
 * @author Jan Pospisil
 */

class InvoicePresenter extends BasePresenter {

	private $invoiceFormControl;
	private $invoice;
	private $model;

	public function __construct(InvoiceFormControl $invoiceFormControl, Model $model) {
		$this->invoiceFormControl = $invoiceFormControl;
		$this->model = $model;
	}

	protected function startup() {
		parent::startup();
		if(!$this->user->isLoggedIn()){
			throw new ForbiddenRequestException();
		}
	}

	public function actionEdit($id){
		$this->invoice = $this->model->getInvoice($id);
		if(!$this->invoice)
			throw new BadRequestException();
		if($this->invoice->user_id != $this->user->id)
			throw new ForbiddenRequestException();
	}

	public function renderEdit(){
		$this->setView('create');
		$this->template->title = 'Edit invoice number ';
	}

	public function renderCreate(){
		$this->template->title = 'Create invoice';
	}


	/**
	* @return Nette\Application\UI\Control
	*/
	protected function createComponentInvoiceForm(){
	    $control = $this->invoiceFormControl->create($this->invoice);
	    $control->onSuccess[] = function (){
	        $this->flashMessage($this->invoice ?  'Saved' : 'Invoice created');
	        $this->redirect(':Invoice:List:default');
	    };
	    return $control;
	}

}
