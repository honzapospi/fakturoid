<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace Rest;
use App\InvoiceModule\CreateInvoiceController;
use App\InvoiceModule\InvoiceListController;
use RestServer\IRouteListFactory;
use RestServer\Route;
use RestServer\RouteList;

/**
 * RouteListFactory
 * @author Jan Pospisil
 */

class RouteListFactory extends \Nette\Object implements IRouteListFactory {

	public function create() {
		$routeList = new RouteList();
		$routeList->add(new Route('/invoice/list/<id>', Route::GET, InvoiceListController::class));
		$routeList->add(new Route('/invoice', Route::POST, CreateInvoiceController::class));
		return $routeList;
	}
}