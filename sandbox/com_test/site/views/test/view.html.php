<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.view' );

/**
 * View for edit current element
 * @author Aleks.Denezh
 */
class testViewtest extends JView {

   protected $item;

   /**
    * Method of display current template
    * @param type $tpl 
    */
   public function display( $tpl = null ) {
      $this->item = $this->get( 'Item' );
      $this->addHelperPath( JPATH_COMPONENT . DS . 'helpers' );
      $this->loadHelper( 'testhelper' );
      testHelper::setDocument( $this->item->title, $this->baseurl, $this->item->metadesc, $this->item->metakey );
      parent::display( $tpl );
   }

}