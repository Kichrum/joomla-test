<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.controller' );

/**
 * Default Controller *
 */
class TestController extends JController
{

	/**
	 *
	 * @param Boolean $cachable
	 */
	function display( $cachable = false )
	{
		$this->default_view = 'testlist';
		$this->addSubmenu( JFactory::getApplication()->input->getCmd( 'view', '' ) );
		parent::display( $cachable );
	}

	/**
	 *
	 * @param String $vName
	 */
	function addSubmenu( $vName )
	{
		JSubMenuHelper::addEntry( JText::_( 'TEST_SUBMENU' ), 'index.php?option=com_test&view=testlist', $vName == 'testlist' );
	}
}