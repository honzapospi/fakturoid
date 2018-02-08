<?php

namespace App\UserModule;


final class AuthPresenter extends \App\BasePresenter {

	private $createAccountFormControl;

	public function __construct(CreateAccountFormControl $control) {
		$this->createAccountFormControl = $control;
	}


	public function actionLogout(){
		$this->user->logout(TRUE);
		$this->flashMessage('Logout successful.');
		$this->redirect('login');
	}


	/**
	* @return \Nette\Application\UI\Control
	*/
	protected function createComponentCreateAccountForm(){
	    $control = $this->createAccountFormControl->create();
	    return $control;
	}

}
