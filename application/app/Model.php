<?php
namespace App\Model;
use JP\RestClient\Rest;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Model
 * @author Jan Pospisil
 */

class Model {
    use Nette\SmartObject;

    private $context;
    private $rest;

    public function __construct(Nette\Database\Context $context, Rest $rest) {
    	$this->context = $context;
    	$this->rest = $rest;
    }

    public function createAccount($email, $password){
    	if(!Nette\Utils\Validators::isEmail($email)){
    		throw new InvalidValueException('Email is not valid address.');
	    }
		$this->context->table('user')->insert([
			'email' => $email,
			'password' => md5($password)
		]);
    }

    public function getUser($username){
    	return $this->context->table('user')->where('email', $username)->fetch();
    }

    public function addInvoice(string $number, int $price, \DateTime $created, string $description, Nette\Security\User $user, int $companyId, Nette\Http\FileUpload $invoice = null){
    	$entry = [
    		'invoice_number' => $number,
		    'price' => $price,
		    'created' => $created,
		    'description' => $description,
		    'user_id' => $user->id,
		    'company_id' => $companyId
	    ];
    	$this->context->table('invoice')->insert($entry);
    }

    public function getCompanies($id){
    	return $this->context->table('company')->where('user_id', $id);
    }


    public function getInvoiceList($id): Nette\Utils\ArrayHash {
    	return $this->rest->request('/invoice/list/' . $id)->body->data;
    }

}

class InvalidValueException extends \Exception {

}
