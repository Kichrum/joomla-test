<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.view' );

/**
 * View to display a list of items
 * @author Aleks.Denezh
 */
class testViewtestlist extends JView
{

	protected $items;
	protected $pagination;
	protected $state;
	protected $user;

	/**
	 * Method to display the current pattern
	 * @param type $tpl
	 */
	public function display( $tpl = null )
	{
		$this->items = $this->get( 'Items' );
		$this->pagination = $this->get( 'Pagination' );
		$this->state = $this->get( 'State' );
		$this->user = & JFactory::getUser();
		$this->loadHelper( 'testHelper' );
		parent::display( $tpl );
	}

	
}