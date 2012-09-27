<?php
// No direct access
defined( '_JEXEC' ) or die;
$listOrder = $this->state->get( 'list.ordering' );
$listDirn = $this->state->get( 'list.direction' );
$saveOrder = $listOrder == 'ordering';
?>
<form action="<?php echo JRoute::_( 'index.php?option=com_test&view=testlist' ); ?>" method="post" name="adminForm" id="adminForm">
   <fieldset id="filter-bar">
      <div class="filter-search fltlft">
	 <label class="filter-search-lbl" for="filter_search"><?php echo JText::_( 'JSEARCH_FILTER_LABEL' ); ?></label>
	 <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape( $this->state->get( 'filter.search' ) ); ?>" title="<?php echo JText::_( 'FILTER_SEARCH_DESC' ); ?>" />
	 <button type="submit" class="btn"><?php echo JText::_( 'JSEARCH_FILTER_SUBMIT' ); ?></button>
	 <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_( 'JSEARCH_FILTER_CLEAR' ); ?></button>
      </div>
      <div class="filter-select fltrt">
	 <select name="filter_published" class="inputbox" onchange="this.form.submit()">
	    <option value=""><?php echo JText::_( 'JOPTION_SELECT_PUBLISHED' ); ?></option>
	    <?php echo JHtml::_( 'select.options', JHtml::_( 'jgrid.publishedOptions', array( 'archived' => false, 'trash' => false ) ), 'value', 'text', $this->state->get( 'filter.published' ), true ); ?>
	 </select>
      </div>
   </fieldset>
   <div class="clr"></div>
   <table class="adminlist">
      <thead>
	 <tr>
	    <th width="1%"><input type="checkbox" name="checkall-toggle" value="" onclick="checkAll(this)" /></th>
	    <th><?php echo JHtml::_( 'grid.sort', 'JGLOBAL_TITLE', 'title', $listDirn, $listOrder ); ?></th>
	    <th width="5%"><?php echo JHtml::_( 'grid.sort', 'JPUBLISHED', 'state', $listDirn, $listOrder ); ?></th>
	    <th width="10%">
	       <?php
	       echo JHtml::_( 'grid.sort', 'JGRID_HEADING_ORDERING', 'ordering', $listDirn, $listOrder );
	       if ( $saveOrder ) {
		  echo JHtml::_( 'grid.order', $this->items, 'filesave.png', 'testlist.saveorder' );
	       }
	       ?>
	    </th>
	    <th width="10%"><?php echo JHtml::_( 'grid.sort', 'JGRID_HEADING_CREATED_BY', 'created_by', $listDirn, $listOrder ); ?></th>
	    <th width="5%"><?php echo JHtml::_( 'grid.sort', 'JDATE', 'created', $listDirn, $listOrder ); ?></th>
	    <th width="1%" class="nowrap"><?php echo JHtml::_( 'grid.sort', 'JGRID_HEADING_ID', 'id', $listDirn, $listOrder ); ?></th>
	 </tr>
      </thead>
      <tfoot>
	 <tr>
	    <td colspan="15">
	       <?php echo $this->pagination->getListFooter(); ?>
	    </td>
	 </tr>
      </tfoot>
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
   	    <td class="center"><?php echo JHtml::_( 'grid.id', $i, $item->id ); ?></td>
   	    <td>
		  <?php if ( $canEdit || $canEditOwn ) : ?>
      	       <a href="<?php echo JRoute::_( 'index.php?option=com_test&task=testedit.edit&id=' . $item->id ); ?>"><?php echo $this->escape( $item->title ); ?></a>
		  <?php else: ?>
		     <?php echo $this->escape( $item->title ); ?>
		  <?php endif; ?>
   	       <p class="smallsub"><?php echo JText::sprintf( 'JGLOBAL_LIST_ALIAS', $this->escape( $item->alias ) ); ?></p>
   	    </td>
   	    <td class="center">
		  <?php echo JHtml::_( 'jgrid.published', $item->state, $i, 'testlist.', $canChange, 'cb' ); ?>
   	    </td>
   	    <td class="order">
		  <?php if ( $canChange ): ?>
		     <?php if ( $saveOrder ): ?>
			<?php if ( $listDirn == 'asc' ): ?>
	    	       <span><?php echo $this->pagination->orderUpIcon( $i, $n, 'testlist.orderup', 'JLIB_HTML_MOVE_UP', $ordering ); ?></span>
	    	       <span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'testlist.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering ); ?></span>
			<?php elseif ( $listDirn == 'desc' ) : ?>
	    	       <span><?php echo $this->pagination->orderUpIcon( $i, $n, 'testlist.orderup', 'JLIB_HTML_MOVE_UP', $ordering ); ?></span>
	    	       <span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'testlist.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering ); ?></span>
			<?php endif; ?>			
		     <?php endif; ?>
		     <?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
      	       <input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
		  <?php else : ?>
		     <?php echo $item->ordering; ?>
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
   <input type="hidden" name="task" value="" />
   <input type="hidden" name="boxchecked" value="0" />
   <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
   <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
   <?php echo JHtml::_( 'form.token' ); ?>
</form>