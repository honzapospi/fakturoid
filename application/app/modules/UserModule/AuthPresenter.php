<?php

namespace App\UserModule;


final class AuthPresenter extends \App\BasePresenter {

	private $loginFormControl;

	public function __construct(LoginFormControl $loginFormControl) {
		$this->loginFormControl = $loginFormControl;
	}

	public function actionLogin(){
		if($this->user->isLoggedIn()){
			$this->redirect(':Invoice:List:default');
		}
	}


	public function actionLogout(){
		$this->user->logout(TRUE);
		$this->flashMessage('Logout successful.');
		$this->redirect('login');
	}


	/**
	* @return \Nette\Application\UI\Control
	*/
	protected function createComponentLoginForm(){
	    $control = $this->loginFormControl->create();
	    $control->onSuccess[] = function (){
	        $this->flashMessage('Login successful');
	        $this->redirect(':Invoice:List:default');
	    };
	    return $control;
	}

}
