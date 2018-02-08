<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App\InvoiceModule;

use App\BasePresenter;
use Nette\Application\BadRequestException,
	Nette\Application\ForbiddenRequestException;

/**
 * IvoicePresenter
 * @author Jan Pospisil
 */

class InvoicePresenter extends BasePresenter {

	private $invoiceFormControl;

	public function __construct(InvoiceFormControl $invoiceFormControl) {
		$this->invoiceFormControl = $invoiceFormControl;
	}

	public function actionEdit($id){

	}

	public function renderCreate(){
		$this->template->title = 'Create invoice';
	}


	/**
	* @return Nette\Application\UI\Control
	*/
	protected function createComponentInvoiceForm(){
	    $control = $this->invoiceFormControl->create();
	    $control->onSuccess[] = function (){
	        $this->flashMessage('Invoice created');
	        $this->redirect(':Invoice:List:default');
	    };
	    return $control;
	}

}
