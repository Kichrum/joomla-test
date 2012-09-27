<?php
// No direct access
defined( '_JEXEC' ) or die;
$listOrder = $this->state->get( 'list.ordering' );
$listDirn = $this->state->get( 'list.direction' );
$saveOrder = $listOrder == 'ordering';
?>
   <div class="clr"></div>
   <table class="adminlist">
      <thead>
	 <tr>
	    <th>Title</th>
	    <th width="10%">Author</th>
	    <th width="5%">Time</th>
	    <th width="1%" class="nowrap">ID</th>
	 </tr>
      </thead>
      <tbody>
	 <?php
	 $n = sizeof( $this->items );
	 foreach ( $this->items as $i => $item ) {
	    $item->max_ordering = 0;
	    $ordering = ($listOrder == 'ordering');
	    $canEdit = $this->user->authorise( 'core.edit', 'com_test.testedit.' . $item->id );
	    $canEditOwn = $this->user->authorise( 'core.edit.own', 'com_test.testedit.' . $item->id ) && $item->created_by_id == $this->user->id;
	    $canChange = $this->user->authorise( 'core.edit.state', 'com_test.testedit.' . $item->id );
	    ?>
   	 <tr class="row<?php echo $i % 2; ?>">
   	    <td>
		  <?php if ( $canEdit || $canEditOwn ) : ?>
      	       <a href="<?php echo JRoute::_( 'index.php?option=com_test&task=test&id=' . $item->id ); ?>"><?php echo $this->escape( $item->title ); ?></a>
		  <?php else: ?>
		     <?php echo $this->escape( $item->title ); ?>
		  <?php endif; ?>
   	    </td>
   	    <td class="center"><?php echo $item->created_by; ?></td>
   	    <td><?php echo JHTML::_( 'date', $item->created, JText::_( 'DATE_FORMAT_LC4' ) ); ?></td>
   	    <td><?php echo $item->id; ?></td>
   	 </tr>
	    <?php
	 }
	 ?>
      </tbody>
   </table>
