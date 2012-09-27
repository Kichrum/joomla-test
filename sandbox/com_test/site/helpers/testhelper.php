<?php

// No direct access
defined( '_JEXEC' ) or die;

class testHelper {

   public function setDocument( $title = '', $basepath, $metadesc = '', $metakey = '' ) {
      $doc = & JFactory::getDocument();
      $doc->addScript( $basepath . '/components/com_test/assest/scripts/test.js' );
      $doc->addStyleSheet( $basepath . '/components/com_test/assest/styles/test.css' );
      $app = JFactory::getApplication();
      if ( empty( $title ) ) {
	 $title = $app->getCfg( 'sitename' );
      } elseif ( $app->getCfg( 'sitename_pagetitles', 0 ) == 1 ) {
	 $title = JText::sprintf( 'JPAGETITLE', $app->getCfg( 'sitename' ), $title );
      } elseif ( $app->getCfg( 'sitename_pagetitles', 0 ) == 2 ) {
	 $title = JText::sprintf( 'JPAGETITLE', $title, $app->getCfg( 'sitename' ) );
      }
      $doc->setTitle( $title );
      if ( trim( $metadesc ) ) {
	 $doc->setDescription( $metadesc );
      }
      if ( trim( $metakey ) ) {
	 $doc->setMetaData( 'keywords', $metakey );
      }
   }

}