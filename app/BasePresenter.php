<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App;

use Nette\Application\BadRequestException,
	Nette\Application\ForbiddenRequestException;
use Nette\Application\UI\Presenter;

/**
 * BasePresenter
 * @author Jan Pospisil
 */

abstract class BasePresenter extends Presenter {

	public function formatTemplateFiles(){
		$presenter = strtr($this->getName(), [':' => '/']);
		$dir = dirname($this->getReflection()->getFileName());
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);
		//dumpe($presenter);
		return [
			"$dir/templates/$presenter/$this->view.latte",
			"$dir/templates/$presenter.$this->view.latte",
		];
	}

}
