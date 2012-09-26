<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
$controller = JController::getInstance('Hello');
$controller->execute(JRequest::getCmd('Task'));
$controller->redirect();