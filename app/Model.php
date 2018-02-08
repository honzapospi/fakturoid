<?php
namespace App\Model;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Model
 * @author Jan Pospisil
 */

class Model {
    use Nette\SmartObject;

    private $context;

    public function __construct(Nette\Database\Context $context) {
    	$this->context = $context;
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
}

class InvalidValueException extends \Exception {

}
