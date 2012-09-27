<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.modellist' );

/**
 * Model to see the current entries
 * @author Aleks.Denezh
 */
class testModeltestlist extends JModelList {

   /**
    * Class constructor
    * @param Array $config
    */
   public function __construct( $config = array( ) ) {
      if ( empty( $config[ 'filter_fields' ] ) ) {
	 $config[ 'filter_fields' ] = array( 'title', 'state', 'ordering', 'created_by', 'created', 'id' );
      }
      parent::__construct( $config );
   }

   /**
    * Method to create a filter on the fields
    * @param String $ordering
    * @param String $direction
    */
   protected function populateState( $ordering = null, $direction = null ) {
      if ( $layout = JRequest::getVar( 'layout' ) ) {
	 $this->context .= '.' . $layout;
      }
      $search = $this->getUserStateFromRequest( $this->context . '.filter.search', 'filter_search' );
      $this->setState( 'filter.search', $search );
      $published = $this->getUserStateFromRequest( $this->context . '.filter.published', 'filter_published', '' );
      $this->setState( 'filter.published', $published );
      parent::populateState( 'title', 'asc' );
   }

   /**
    * Method to get the ID for filtering
    * @param Int $id
    * @return Int
    */
   protected function getStoreId( $id = '' ) {
      $id .= ':' . $this->getState( 'filter.search' );
      $id .= ':' . $this->getState( 'filter.published' );
      $id .= ':' . $this->getState( 'filter.author_id' );
      return parent::getStoreId( $id );
   }

   /**
    * Method for receiving a request to view records
    * @return Object Query
    */
   protected function getListQuery() {
      $query = $this->_db->getQuery( true );
      $query->select( '`t1`.`id`, `t1`.`title`, `t1`.`alias`, `t1`.`published` as `state`, `t1`.`created`, `t1`.`ordering`, `t1`.`hits`' );
      $query->select( '`u`.`username` as `created_by`, `u`.`id` as `created_by_id`' );
      $query->join( 'LEFT', '`#__users` AS `u` ON `u`.`id` = `t1`.`created_by`' );
      $query->from( '#__test as `t1`' );
      $published = $this->getState( 'filter.published' );
      if ( is_numeric( $published ) ) {
	 $query->where( '`t1`.`published`=' . intval( $published ) );
      }
      $search = $this->getState( 'filter.search' );
      if ( !empty( $search ) ) {
	 $search = $this->_db->Quote( '%' . $this->_db->getEscaped( $search, true ) . '%' );
	 $query->where( '(`t1`.`title` LIKE ' . $search . ' OR `t1`.`alias` LIKE ' . $search . ')' );
      }
      $orderCol = $this->state->get( 'list.ordering' );
      $orderDirn = $this->state->get( 'list.direction' );
      $query->order( $this->_db->getEscaped( $orderCol . ' ' . $orderDirn ) );
      return $query;
   }

}