<?php
namespace App\UserModule;
use App\BasePresenter;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * RegistrationPresenter
 * @author Jan Pospisil
 */

class RegistrationPresenter extends BasePresenter {


	private $createAccountFormControl;

	public function __construct(CreateAccountFormControl $control) {
		$this->createAccountFormControl = $control;
	}

	/**
	 * @return \Nette\Application\UI\Control
	 */
	protected function createComponentCreateAccountForm(){
		$control = $this->createAccountFormControl->create();
		return $control;
	}

}
