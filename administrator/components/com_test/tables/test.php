<?php

// дапрет доступа
defined( '_JEXEC' ) or die;
jimport( 'joomla.database.table' );

class TableTest extends JTable
{

	/**
	 * Конструктор класса
	 * @param Object $db (database link object)
	 */
	function __construct( &$db )
	{
		parent::__construct( '#__test', 'id', $db );
	}

	/**
	 * имя для записи в таблице #__assets
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_test.testedit.' . ( int )$this->$k;
	}


	protected function _getAssetParentId( $table = null, $id = null )
	{
		$asset = JTable::getInstance( 'Asset' );
		$asset->loadByName( 'com_test' );
		return $asset->id;
	}

	/**
	 * Метод связывающий данные из $_REQUEST с полями таблицы
	 */
	public function bind( $array, $ignore = '' )
	{
		//Если в поле created_by не устрановллено то
		//идентификатор пользователя берем из текущего пользователя
		if ( empty( $array['created_by'] ) ) {
			$user = & JFactory::getUser();
			$array['created_by'] = $user->id;
		}
		//Если нет даты создания записи то устанавливаем дату создания
		if ( empty( $array['created'] ) ) {
			$array['created'] = date( 'Y-m-d H:i:s' );
		}
		//Разбиваем текст из редактора на introtext и fulltext
		if ( isset( $array['text'] ) ) {
			$allText = explode( '<hr id="system-readmore">', $array['text'] );
			$array['introtext'] = trim( $allText[0] );
			$array['fulltext'] = trim( $allText[1] );
		}
		//Устанавливаем ACL для компонента
		if ( isset( $array['rules'] ) && is_array( $array['rules'] ) ) {
			$rules = new JRules( $array['rules'] );
			$this->setRules( $rules );
		}
		//Создаем alias
		$array['alias'] = JApplication::stringURLSafe( $array['alias'] );
		if ( trim( str_replace( '-', '', $array['alias'] ) ) == '' ) {
			$array['alias'] = JApplication::stringURLSafe( $array['title'] );
		}
		return parent::bind( $array, $ignore );
	}

}