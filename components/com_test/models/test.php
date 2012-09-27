<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.modelitem' );

/**
 * Model for edit/create current element
 * @author Aleks.Denezh
 */
class testModeltest extends JModelItem {

	/**
	 * current id
	 * @var integer
	 */
	private $input;

	/**
	 * Class constructor
	 */
	public function __construct($config = array()) {
		parent::__construct($config);
		$this->input = & JFactory::getApplication()->input;
	}

	/**
	 * get curretn item
	 * @return object
	 */

	public function getItem() {
		$table = $this->getTable( 'test' );
		$table->load( $this->input->get( 'id' ) );
		return $table;
	}

}