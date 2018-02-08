<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace Tests;
use RestServer\IParametrs;

/**
 * Parameters
 * @author Jan Pospisil
 */

class Parameters extends \Nette\Object implements IParametrs {

	public $post;
	public $get;
	public $path;

	public function post($key = NULL) {
		return isset($this->post[$key]) ? $this->post[$key] : null;
	}

	public function get($key = NULL, $acceptPost = TRUE) {
		return isset($this->get[$key]) ? $this->get[$key] : null;
	}

	public function path($key) {
		return isset($this->path[$key]) ? $this->path[$key] : null;
	}
}
