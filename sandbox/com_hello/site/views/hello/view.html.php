<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class HelloViewHello extends JView {
    protected $msg = null;
    function display($tpl = null) {
        $this->msg = $this->get('Msg');
        parent::display($tpl);
    }
}
