<?php

namespace App;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * FormFactory
 * @author Jan Pospisil
 */

class FormFactory {
    use Nette\SmartObject;

    public function create(){
    	$form = new Nette\Application\UI\Form();
    	return $form;
    }

}
