<?php

// запрещаем доступ извне
defined( '_JEXEC' ) or die;
//Подключаем класс JControllerForm
jimport( 'joomla.application.component.controllerform' );

/**
 * Класс контроллера Testedit
 */
class TestControllerTestedit extends JControllerForm
{

	/**
	 * Конструктор класса
	 */
	function __construct( $config = array() )
	{
		//устанавливаем вид на который будет переходить
		//после нажатия на кнопку "Сохранить и закрыть"
		$this->view_list = 'testlist';
		parent::__construct( $config );
	}

	/**
	 * Переопределения доступа для определения возможности
	 * редактирования записи для пользвателя
	 */
	protected function allowEdit( $data = array(), $key = 'id' )
	{
		// инициализируем переменные
		$recordId = ( int )isset( $data[$key] ) ? $data[$key] : 0;
		//получение объекта текущего пользователя
		$user = JFactory::getUser();
		//Получаем идентификатор пользователя
		$userId = $user->get( 'id' );
		// Сначала проверяем общий доступ на редактирование и если
		//пользователь может редактировать то возвращаем истину
		if ( $user->authorise( 'core.edit', 'com_test.testedit.' . $recordId ) ) {
			return true;
		}
		// Проверяем или материал создал пользлватель
		if ( $user->authorise( 'core.edit.own', 'com_test.testedit.' . $recordId ) ) {
			$ownerId = ( int )isset( $data['created_by'] ) ? $data['created_by'] : 0;
			if ( empty( $ownerId ) && $recordId ) {
				$record = $this->getModel()->getItem( $recordId );
				if ( empty( $record ) ) {
					return false;
				}
				$ownerId = $record->created_by;
			}
			if ( $ownerId == $userId ) {
				return true;
			}
		}
		return parent::allowEdit( $data, $key );
	}
}