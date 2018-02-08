<?php
namespace App\InvoiceModule;
use Nette;
use RestServer\Check;
use RestServer\IController;
use RestServer\IParameters;
use RestServer\Response;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * CreateInvoiceController
 * @author Jan Pospisil
 */

class CreateInvoiceController implements IController {
    use Nette\SmartObject;

	public function run(IParameters $parameters, Response $response) {
		$invoiceNumber = $parameters->post('invoice_number', TRUE, [Check::SCALAR]);
		$price = $parameters->post('price', TRUE, [Check::INT]);
		$response->setStatusCode(201);
		$response->data = [
			'status' => 'ok'
		];
	}
}
