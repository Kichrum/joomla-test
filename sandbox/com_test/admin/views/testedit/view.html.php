<?php
// запрещаем доступ извне
defined( '_JEXEC' ) or die;
//Подключаем класс JView
jimport( 'joomla.application.component.view' );

/**
 * Класс TestViewTestedit
 */
class TestViewTestedit extends JView
{
	//форма
	protected $form;
	//запись
	protected $item;
	//Пользователь
	protected $user;

	/**
	 * Отображение текущего вида
	 */
	public function display( $tpl = null )
	{
		//получаем форму из метода getForm модели testedit.php
		$this->form = $this->get( 'Form' );
		//получаем запись из метода getItem модели testedit.php
		$this->item = $this->get( 'Item' );
		//Получения объекта текущего пользователя
		$this->user = & JFactory::getUser();

		//Если есть каике то ощибки то не отображаем вид и выводим ошибки
		if ( count( $errors = $this->get( 'Errors' ) ) ) {
			JError::raiseError( 500, implode( '\n', $errors ) );
			return false;
		}
		//Подключаем помощник вида testHelper из папки helpers/testhelper.php
		$this->loadHelper( 'testHelper' );
		//Получаем список действий которые может выполнять пользователь
		$this->canDo = testHelper::getActions( 'testedit' );
		//выводим панель инструментов
		$this->_setToolBar();
		parent::display( $tpl );
	}

	/**
	 * Метод для вывода панели инструментов
	 */
	protected function _setToolBar()
	{
		//блокируем меню
		JRequest::setVar( 'hidemainmenu', true );
		//подключаем JS скрипты для подсказок
		JHTML::_( 'behavior.tooltip' );
		//подключаем JS скрипт для того что бы пользователь оставался на сайте
		JHTML::_( 'behavior.keepalive' );
		//Подключаем JS скрипты для валидации формы
		JHTML::_( 'behavior.formvalidation' );
		//Проверям или запись новая
		$isNew = ( $this->item->id == 0 );
		//Получаем списки доступов для текущей записи
		$canDo = testHelper::getActions( 'testedite', $this->item->id );

		//Выводим название компонента
		JToolBarHelper::title( JText::_( 'COM_{BOG}' ) . ': <small>[ ' . ( $isNew ? JText::_( 'JTOOLBAR_NEW' ) : JText::_( 'JTOOLBAR_EDIT' ) ) . ']</small>' );
		// Проверяем или пользователь может создавать записи
		if ( $isNew && ( count( $this->user->getAuthorisedCategories( 'com_test', 'core.create' ) ) > 0 ) ) {
			//выводим кнопку применить
			JToolBarHelper::apply( 'testedit.apply' );
			//Ввыводим кнопке сохранить
			JToolBarHelper::save( 'testedit.save' );
			//Выводим кнопку сохранить и создать
			JToolBarHelper::save2new( 'testedit.save2new' );
			//Выводим кнопку закрыть
			JToolBarHelper::cancel( 'testedit.cancel' );
		} else {
			//Если нет доступа то проверяем отдельные дейстивя
			//Если пользователь может редактировать только свои или может редактировать
			if ( $canDo->get( 'core.edit' ) || ( $canDo->get( 'core.edit.own' ) && $this->item->created_by == $this->user->get( 'id' ) ) ) {
				//выводим кнопку применить
				JToolBarHelper::apply( 'testedit.apply' );
				//Ввыводим кнопке сохранить
				JToolBarHelper::save( 'testedit.save' );
				// если пользователь может создавать
				if ( $canDo->get( 'core.create' ) ) {
					//Выводим кнопку сохранить и создать
					JToolBarHelper::save2new( 'testedit.save2new' );
				}
			}
			// если пользователь может создавать
			if ( $canDo->get( 'core.create' ) ) {
				//Выводим кнопку сохранить и создать
				JToolBarHelper::save2copy( 'testedit.save2copy' );
			}
			//выводим кнопку закрыть
			JToolBarHelper::cancel( 'testedit.cancel', 'JTOOLBAR_CLOSE' );
		}
	}
}