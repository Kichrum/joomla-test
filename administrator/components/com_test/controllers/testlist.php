<?php

// No direct access
defined( '_JEXEC' ) or die;
jimport( 'joomla.application.component.controlleradmin' );

/**
 * Controller for list current element
 * @author Aleks.Denezh
 */
class testControllertestlist extends JControllerAdmin {

   /**
    * Class constructor
    * @param array $config 
    */
   function __construct( $config=array( ) ) {
      parent::__construct( $config );
   }

   /**
    * Method to get current model
    * @param String $name (model name)
    * @param String $prefix (model prefox)
    * @param Array $config
    * @return model for current element
    */
   public function getModel( $name = 'testedit', $prefix = 'testModel', $config = array( 'ignore_request' => true ) ) {
      return parent::getModel( $name, $prefix, $config );
   }

}