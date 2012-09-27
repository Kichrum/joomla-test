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
		$this->_setToolBar();
		parent::display( $tpl );
	}

	/**
	 * Method to display the toolbar
	 */
	protected function _setToolBar()
	{
		JToolBarHelper::title( JText::_( 'COM_TEST' ) );
		$canDo = testHelper::getActions( 'testedit' );

		if ( $canDo->get( 'core.create' ) || ( count( $this->user->getAuthorisedCategories( 'com_test', 'core.create' ) ) ) > 0 ) {
			JToolBarHelper::addNew( 'testedit.add' );
		}

		if ( ( $canDo->get( 'core.edit' ) ) || ( $canDo->get( 'core.edit.own' ) ) ) {
			JToolBarHelper::editList( 'testedit.edit' );
		}

		if ( $canDo->get( 'core.edit.state' ) ) {
			JToolBarHelper::divider();
			JToolBarHelper::publish( 'testlist.publish', 'JTOOLBAR_PUBLISH', true );
			JToolBarHelper::unpublish( 'testlist.unpublish', 'JTOOLBAR_UNPUBLISH', true );
			JToolBarHelper::divider();

			if ( $canDo->get( 'core.delete' ) ) {
				JToolBarHelper::deleteList( 'DELETE_QUERY_STRING', 'testlist.delete', 'JTOOLBAR_DELETE'  );
				JToolBarHelper::divider();
			}

			if ( $canDo->get( 'core.admin' ) ) {
				JToolBarHelper::preferences( 'com_test' );
				JToolBarHelper::divider();
			}
		}

	}
}