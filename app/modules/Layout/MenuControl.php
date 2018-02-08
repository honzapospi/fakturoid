<?php
namespace App\Layout;
use App\BaseControl;
use Nette;

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 * MenuControl
 * @author Jan Pospisil
 */

class MenuControl extends BaseControl {

	public function render(){

		$this->template->setFile(__DIR__.'/MenuControl.latte');
		$this->template->render();
	}

}
