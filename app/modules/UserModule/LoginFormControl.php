<?php
namespace App\UserModule;
use App\FormFactory;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * LoginFormControl
 * @author Jan Pospisil
 */

class LoginFormControl {
    use Nette\SmartObject;

    private $formFactory;

    public function __construct(FormFactory $formFactory) {
    	$this->formFactory = $formFactory;
    }

}
