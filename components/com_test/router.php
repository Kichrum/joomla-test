<?php

// No direct access
defined( '_JEXEC' ) or die;

function testBuildRoute( &$query ) {
   $segments = array( );
   if ( isset( $query[ 'view' ] ) ) {
      $segments[ ] = $query[ 'view' ];
      unset( $query[ 'view' ] );
   }
   if ( isset( $query[ 'task' ] ) ) {
      $segments[ ] = $query[ 'task' ];
      unset( $query[ 'task' ] );
   }
   if ( isset( $query[ 'id' ] ) ) {
      $segments[ ] = $query[ 'id' ];
      unset( $query[ 'id' ] );
   }
   return $segments;
}

function testParseRoute( $segments ) {
   $vars = array( );
   $count = count( $segments );
   if ( $count ) {
      $count--;
      $segment = array_shift( $segments );
      if ( strpos( $segment, ':' ) !== false || is_numeric( $segment ) ) {
	 $variable = explode( ':', $segment );
	 $vars[ 'id' ] = intval( $variable[ 0 ] );
      }
      $vars[ 'view' ] = $segment;
   }
   if ( $count ) {
      $count--;
      $segment = array_shift( $segments );
      if ( strpos( $segment, ':' ) !== false || is_numeric( $segment ) ) {
	 $variable = explode( ':', $segment );
	 $vars[ 'id' ] = intval( $variable[ 0 ] );
      } else {
	 $vars[ 'task' ] = $segment;
      }
   }
   if ( $count ) {
      $count--;
      $segment = array_shift( $segments );
      if ( strpos( $segment, ':' ) !== false || is_numeric( $segment ) ) {
	 $variable = explode( ':', $segment );
	 $vars[ 'id' ] = intval( $variable[ 0 ] );
      }
   }
   return $vars;
}