<?php
// No direct access
defined( '_JEXEC' ) or die;
$fields = array( 'title', 'alias', 'published' );
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task) {
        if (task == 'testedit.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
        <?php echo $this->form->getField( 'text' )->save(); ?>
            Joomla.submitform(task, document.getElementById('item-form'));
        } else {
            alert('<?php echo $this->escape( JText::_( 'JGLOBAL_VALIDATION_FORM_FAILED' ) ); ?>');
        }
    }
</script>
<form action="<?php echo JRoute::_( 'index.php?option=com_test&id=' . $this->form->getValue( 'id' ) ); ?>" method="post" name="adminForm" id="item-form" class="form-validate" enctype="multipart/form-data">
    <div class="width-60 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_( 'JGLOBAL_EDIT_ITEM' ); ?></legend>
            <ul class="adminformlist">
                <?php foreach ( $fields as $field ): ?>
                <li>
                    <?php echo $this->form->getLabel( $field ); ?>
                    <?php echo $this->form->getInput( $field ); ?>
                </li>
                <?php endforeach; ?>
                <?php if ( $this->canDo->get( 'core.admin' ) ): ?>
                <li><span class="faux-label"><?php echo JText::_( 'JGLOBAL_ACTION_PERMISSIONS_LABEL' ); ?></span>
                    <div class="button2-left"><div class="blank">
                        <button type="button" onclick="document.location.href='#access-rules';">
                            <?php echo JText::_( 'JGLOBAL_PERMISSIONS_ANCHOR' ); ?>
                        </button>
                    </div></div>
                </li>
                <?php endif; ?>
            </ul>
            <div class="clr"></div>
            <div><?php echo $this->form->getLabel( 'text' ); ?></div>
            <div class="clr"></div>
            <div><?php echo $this->form->getInput( 'text' ); ?></div>
        </fieldset>
    </div>
    <div class="width-40 fltrt">
        <?php echo JHtml::_( 'sliders.start', 'content-sliders', array( 'useCookie' => 1 ) ); ?>
        <?php echo JHtml::_( 'sliders.panel', JText::_( 'JGLOBAL_FIELDSET_PUBLISHING' ), 'publishing-details' ); ?>
        <fieldset class="panelform">
            <ul class="adminformlist">
                <li><?php echo $this->form->getLabel( 'created_by' ); ?><?php echo $this->form->getInput( 'created_by' ); ?></li>
                <li><?php echo $this->form->getLabel( 'created' ); ?><?php echo $this->form->getInput( 'created' ); ?></li>
            </ul>
        </fieldset>
        <?php echo JHtml::_( 'sliders.panel', JText::_( 'JGLOBAL_FIELDSET_METADATA_OPTIONS' ), 'publishing-details' ); ?>
        <fieldset class="panelform">
            <?php echo $this->form->getLabel( 'metadesc' ); ?>
            <?php echo $this->form->getInput( 'metadesc' ); ?>
            <?php echo $this->form->getLabel( 'metakey' ); ?>
            <?php echo $this->form->getInput( 'metakey' ); ?>
        </fieldset>
        <?php echo JHtml::_( 'sliders.end' ); ?>
    </div>
    <?php if ( $this->canDo->get( 'core.admin' ) ): ?>
    <div class="width-100 fltlft">
        <?php echo JHtml::_( 'sliders.start', 'permissions-sliders-' . $this->item->id, array( 'useCookie' => 1 ) ); ?>

        <?php echo JHtml::_( 'sliders.panel', JText::_( 'JGLOBAL_ACTION_PERMISSIONS_DESCRIPTION' ), 'access-rules' ); ?>
        <fieldset class="panelform">
            <?php echo $this->form->getLabel( 'rules' ); ?>
            <?php echo $this->form->getInput( 'rules' ); ?>
        </fieldset>

        <?php echo JHtml::_( 'sliders.end' ); ?>
    </div>
    <?php endif; ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="return" value="<?php echo JRequest::getCmd( 'return' ); ?>" />
    <?php echo JHtml::_( 'form.token' ); ?>
</form>