<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.controller' );

/**
 * Контроллер по умолчанию
 */
class TestController extends JController
{

	/**
	 * метод для отображения вида по умолчанию
	 */
	function display( $cachable = true )
	{
		$this->default_view = 'test';
		parent::display( $cachable );
	}

}