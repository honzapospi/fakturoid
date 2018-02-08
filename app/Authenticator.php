<?php
namespace App;
use App\Model\Model;
use Nette;
use Nette\Security\AuthenticationException;
use Nette\Security\IIdentity;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Authenticator
 * @author Jan Pospisil
 */

class Authenticator implements Nette\Security\IAuthenticator {
    use Nette\SmartObject;

    private $model;

    public function __construct(Model $model) {
    	$this->model = $model;
    }


	function authenticate(array $credentials) {
		list($username, $password) = $credentials;
		if(!$user = $this->model->getUser($username)){
			throw new AuthenticationException('Username not found');
		}
		if($user->password != md5($password)){
			throw new AuthenticationException('Password invalid.');
		}
		$roles = [];
		return new Nette\Security\Identity($user->id, $roles, ['username' => $user->email]);
	}

}
