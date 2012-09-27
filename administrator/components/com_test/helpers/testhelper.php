<?php
// запрещаем доступ извне
defined('_JEXEC') or die;
//Класс помощника вида
class testHelper
{
	//метод получения доступов пользователя
	public static function getActions( $section, $recordId = 0 )
	{
		//получаем объект текущего пользователя
		$user = JFactory::getUser();
		//Создаем новый экземпляр класа JObject
		$result = new JObject;
		//Если поле текущая запись не пустое
		if ( empty( $recordId ) ) {
			$assetName = 'com_test';
		} else {
			$assetName = 'com_test.' . $section . '.' . (int)$recordId;
		}
		//Список возможныъ дейсвий в системе
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit',
			'core.edit.own', 'core.edit.state', 'core.delete'
		);
		//перебираем все действия и устанавливаем в объект result true если
		//действие доступно и false если недоступно
		foreach ( $actions as $action ) {
			$result->set( $action, $user->authorise( $action, $assetName ) );
		}
		//возвращаем результат
		return $result;
	}
}