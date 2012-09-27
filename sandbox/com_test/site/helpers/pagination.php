<?php

/**
 * @version		1.0
 * @package		Joomla.Framework
 * @subpackage	HTML
 * @license		GNU/GPL
 * @author		Aleksandr Denezh
 */
// Check to ensure this file is within the rest of the framework
defined( 'JPATH_BASE' ) or die();

//pagination class
class JNewPagination extends JObject {
   /*
    * Total number of pages
    * @asses private
    * @var int
    */

   private $pages = 0;
   /*
    * Current page
    * @asses private
    * @var int
    */
   private $current = 0;
   /*
    * Page array
    * @asses private
    * @var int
    */
   private $links = array( );
   /*
    * Limit rows per page
    * @asses private
    * @var int
    */
   private $limit = 0;

   /**
    * Constructor
    *
    * @param	int		total number of rows
    * @param	int		current position record
    * @param	int		number of records displayed per page
    */
   function __construct( $count, $limitstart, $limit ) {
      $this->current = $limitstart / $limit;
      $this->pages = ceil( $count / $limit );
      $this->limit = $limit;
      for ( $i = 0; $i < $this->pages; $i++ ) {
	 if ( $this->current == $i ) {
	    $this->links[ ] = '<li><span class="pagenav">' . ($i + 1) . '</span></li>';
	 } else {
	    $this->links[ ] = '<li><a href="' . JRoute::_( "&limitstart=" . ($i * $limit) ) . '" class="pagenav">' . ($i + 1) . '</a></li>';
	 }
      }
   }

   /**
    * Conclusion pagination
    * @access	public
    */
   function getPagesLinks() {
      echo '<ul class="pagination">';
      if ( $this->pages <= 5 ) {
	 echo $this->getPrevious();
	 echo implode( " ", $this->links );
	 echo $this->getLast();
      } else {
	 echo $this->getPrevious();
	 if ( $this->current < 2 ) {
	    echo implode( " ", array_slice( $this->links, 0, 3 + ($this->current) ) );
	    echo $this->getSeparator();
	    echo $this->getLastPage();
	 } else {
	    if ( ($this->pages - $this->current) > 4 ) {
	       echo $this->getFirstPage();
	       if ( $this->current >= 4 )
		  echo $this->getSeparator();
	       if ( $this->current != 2 ) {
		  echo implode( " ", array_slice( $this->links, $this->current - 2, 5 ) );
	       } else {
		  echo implode( " ", array_slice( $this->links, $this->current - 1, 4 ) );
	       }
	       echo $this->getSeparator();
	       echo $this->getLastPage();
	    } else {
	       echo $this->getFirstPage();
	       echo $this->getSeparator();
	       if ( ($this->pages - $this->current) < 2 )
		  echo implode( " ", array_slice( $this->links, $this->pages - 3, 5 ) );
	       else
		  echo implode( " ", array_slice( $this->links, $this->current - 2, 5 ) );
	       if ( ($this->pages - $this->current) == 4 )
		  echo $this->getLastPage();
	    }
	 }
	 echo $this->getLast();
      }
      echo '</ul>';
   }

   /**
    * Conclusion function output arrows from previous page
    * @access	private
    * @return	string reference to previous page
    */
   private function getPrevious() {
      if ( $this->current != 0 ) {
	 return '<li><a href="' . JRoute::_( "&limitstart=" . (($this->current - 1) * $this->limit) ) . '" class="pagenav">←</a></li>';
      } else {
	 return '<li><span class="pagenav">←</span></li>';
      }
   }

   /**
    * Conclusion function output arrows from nexn page
    * @access	private
    * @return	string reference to nexn page
    */
   private function getLast() {
      if ( $this->current != ($this->pages - 1) ) {
	 return '<li><a href="' . JRoute::_( "&limitstart=" . (($this->current + 1) * $this->limit) ) . '" class="pagenav">→</a></li>';
      } else {
	 return '<li><span class="pagenav">→</span><li>';
      }
   }

   /**
    * Conclusion output function delimiter
    * @access	private
    * @return	string string delimiter
    */
   private function getSeparator() {
      return '<li><span class="pagenav">...</span><li>';
   }

   /**
    * Conclusion output lines with reference to the first page
    * @access	private
    * @return	string line with reference
    */
   private function getFirstPage() {
      return '<li><a href="' . JRoute::_( "&limitstart=0" ) . '" class="pagenav">1</a><li>';
   }

   /**
    * Conclusion output lines with reference to the last page
    * @access	private
    * @return	string line with reference
    */
   private function getLastPage() {
      return '<li><a href="' . JRoute::_( "&limitstart=" . (($this->pages - 1) * $this->limit) ) . '" class="pagenav">' . $this->pages . '</a><li>';
   }

}

?>