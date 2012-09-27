<?php

// No direct access
defined( '_JEXEC' ) or die;
/**
 * Component test
 * @author Aleks.Denezh
 */
jimport( 'joomla.application.component.controller' );

$controller = JController::getInstance( 'test' );
$controller->execute( JRequest::getCmd( 'task' ) );
$controller->redirect();