<?php
namespace App;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * Parameters
 * @author Jan Pospisil
 */

class Parameters {
    use Nette\SmartObject;

    private $params;

    public function __construct(Nette\DI\Container $container) {
    	$this->params = $container->parameters;
    }

    public function __get($name){
    	return $this->params[$name];
    }

}
