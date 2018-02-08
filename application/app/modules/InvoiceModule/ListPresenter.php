<?php
namespace App\InvoiceModule;
use App\BasePresenter;
use App\Model\Model;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * ListPresenter
 * @author Jan Pospisil
 */

class ListPresenter extends BasePresenter {

	private $list;
	private $model;

	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function actionDefault(){
		$this->list = $this->model->getInvoiceList(10);
	}

	public function renderDefault(){
		$this->template->invoices = $this->list;
		$this->template->title = 'List';
	}

}
