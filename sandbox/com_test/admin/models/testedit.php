<?php

// запрещаем доступ извне
defined( '_JEXEC' ) or die;
// подключаем класс JModelAdmin
jimport( 'joomla.application.component.modeladmin' );

/**
 * Модель
 */
class TestModelTestedit extends JModelAdmin {

	/**
	 * Загрузка формы
	 */
	public function getForm( $data = array( ), $loadData = true ) {
		//загружаем форму их xml Файла который должен лежать в папке forms и доджен называться testedit.php
		$form = $this->loadForm( 'com_test.testedit', 'testedit', array( 'control' => 'jform', 'load_data' => $loadData ) );
		if ( empty( $form ) ) {
			return false;
		}
		//Получаем объект текущего пользователя
		$user = & JFactory::getUser();
		//Проверяем или пользователь может изменять состояние текущего материала
		if ( !$user->authorise( 'core.edit.state', $this->option . '.testedit.' . $this->getState( 'testedit.id' ) ) ) {
			//и если пользователь не может то блокирум поле изменение состония
			$form->setFieldAttribute( 'published', 'disabled', 'true' );
			$form->setFieldAttribute( 'published', 'filter', 'unset' );
		}
		//возвращаем форму
		return $form;
	}

	/**
	 * Получение значения текущей записи
	 */
	public function getItem( $id = null ) {
		//Если запись с текущим идентификатором загруженна
		if ( $item = parent::getItem( $id ) ) {
			//то объеденяем introtext и fulltext в поле text
			$item->text = trim( $item->fulltext ) != '' ? $item->introtext . '<hr id="system-readmore" />' . $item->fulltext : $item->introtext;
		}
		//возвращаем запись
		return $item;
	}

	/**
	 * Загрузка экземпляра таблицы TableTest
	 */
	public function getTable( $type = 'Test', $prefix = 'Table', $config = array( ) ) {
		return JTable::getInstance( $type, $prefix, $config );
	}

	/**
	 * Метод для установки данных в форму
	 */
	protected function loadFormData() {
		//получаем данные из пользовательского состояния
		//это необходимо в случае если форма отправленна и не все данные коректно установлены!
		//что бы данные не пропали то иы их таким способом получаем и возвращаем в форму
		$data = JFactory::getApplication()->getUserState( 'com_test.edit.testedit.data', array() );
		if ( empty( $data ) ) {
			$data = $this->getItem();
		}
		return $data;
	}

}