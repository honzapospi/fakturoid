<?php

/**
 * Copyright (c) Jan Pospisil (http://www.jan-pospisil.cz)
 */

namespace App\Layout;

/**
 * IMenuControlFactory
 * @author Jan Pospisil
 */

interface IMenuControlFactory  {
	
	/**
	 * @return MenuControl
	 */
	public function create();
	
}
