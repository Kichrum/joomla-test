<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');

class HelloModelHello extends JModelItem {
    protected $msg;
    public function getMsg() {
        if(!isset($this->msg)) {
            $id = JRequest::getInt('id');
            switch($id) {
                case 2:
                    $this->msg = 'Вы выбрали Пока!';
                break;
                default:
                case 1:
                    $this->msg = 'Вы выбрали Привет!';
                break;
            }
        }
        return $this->msg;
    }
}