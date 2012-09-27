<?php

// Запрет доступа извне
defined( '_JEXEC' ) or die;

//Подключаем класс с контроллером
jimport( 'joomla.application.component.controller' );

//Инициализируем контроллер по умолчанию
$controller = JController::getInstance( 'test' );

//выполнить задачу в контроллере
$controller->execute( JFactory::getApplication()->input->getCmd( 'task', '' ) );

//Перенаправляет вывод в браузер
$controller->redirect();