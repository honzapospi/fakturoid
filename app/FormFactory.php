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
    	$renderer = $form->getRenderer();
	    $renderer->wrappers['controls']['container'] = NULL;
	    $renderer->wrappers['pair']['container'] = 'div class=form-group';
	    $renderer->wrappers['pair']['.error'] = 'has-error';
	    $renderer->wrappers['control']['container'] = 'div class=col-sm-9';
	    $renderer->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
	    $renderer->wrappers['control']['description'] = 'span class=help-block';
	    $renderer->wrappers['control']['errorcontainer'] = 'span class=help-block';
	    $form->getElementPrototype()->class('form-horizontal');

	    $form->onRender[] = function ($form) {
		    foreach ($form->getControls() as $control) {
			    $type = $control->getOption('type');
			    if ($type === 'button') {
				    $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				    $usedPrimary = TRUE;

			    } elseif (in_array($type, ['text', 'textarea', 'select'], TRUE)) {
				    $control->getControlPrototype()->addClass('form-control');

			    } elseif (in_array($type, ['checkbox', 'radio'], TRUE)) {
				    $control->getSeparatorPrototype()->setName('div')->addClass($type);
			    }
		    }
	    };

	    return $form;
    }

}
