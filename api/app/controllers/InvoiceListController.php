<?php
namespace App\InvoiceModule;
use Nette;
use RestServer\Check;
use RestServer\IController;
use RestServer\IParameters;
use RestServer\Response;
use RestServer\Validator;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * InvoiceListController
 * @author Jan Pospisil
 */

class InvoiceListController implements IController {
    use Nette\SmartObject;

    private $context;

    public function __construct(Nette\Database\Context $context) {
    	$this->context = $context;
    }

	public function run(IParameters $parameters, Response $response) {
    	$userId = $parameters->path('id', TRUE, [Check::INT]);
    	$data = [];
		foreach($this->context->table('invoice')->where('user_id', $userId) as $invoice){
			$row = $invoice->toArray();
			unset($row['company_id']);
			$row['company'] = $invoice->company->toArray();
			$data[] = $row;
		}
		$response->data = $data;
	}


}
