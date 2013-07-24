<?php

class Admin_Form_MenuitemEdit extends Sunny_Form
{
	public function init()
	{
		$this->setName(strtolower('menuitem_edit'));
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
		$this->setAttrib('class', 'via_ajax admin-form cf');         // Force send only with ajax
		
		/*  Externals  */
		
		$this->addElement('hidden', 'id');
		$this->addElement('hidden', 'contents_groups_id');
// 		$this->addElement('hidden', 'zf_menu_id', array('value' => 0));
		
		/*  Main  */
		$main = array('title');
		
		$this->addElement('text', 'title', array(
			'label' => 'Название пункта меню',
			'required' => true
		));
		
		$main[] = 'zf_menu_id';
		$this->addElement('select', 'zf_menu_id', array(
					'label' => 'Родительский пункт меню'
		));
		
		$main[] = 'alias';
		$this->addElement('text', 'alias', array(
				'label' => 'Псевдоним'
		));
		
		$main[] = 'href';
		$this->addElement('text', 'href', array(
				'label' => 'Ссылка'
		));

		$main[] = 'published';
		$this->addElement('checkbox', 'published', array(
				'label' => 'Опубликована',
				'value' => 1
		));
		
		$this->addDisplayGroup($main, 'main', array('legend' => 'Основная информация'));
		
		
		$img = array('img');

		$this->addElement('text', 'img', array(
				'label' => 'Загрузить изображение'
		));

		/**
		 * Сюда выбор картинки и загрузку новой
		 */
		
		$this->addDisplayGroup($img, 'image', array('legend' => 'Изображение'));
		
		
		$access = array('zf_roles_id');
		
		$this->addElement('select', 'zf_roles_id', array(
				'label' => 'Доступ для групп'
		));
		
		/**
		 * Сюда мультиселект доступности для отдельных пользователей
		 */
		
		$this->addDisplayGroup($access, 'access', array('legend' => 'Права доступа'));
		
// 		Submit
// 		$this->addElement('submit', 'submit', array(
// 			'ignore' => true,
// 			'label' => '',
// 			'value' => 'Сохранить'
// 		));
		
		// Decorators
		$this->addElementPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setElementDecorators(array('CompositeElementDiv'));
		
		$this->addDisplayGroupPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDisplayGroupDecorators(array('CompositeGroupDiv'));
		
		$this->addPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDecorators(array('CompositeFormDiv'));
		
// 		$this->getElement('img')->setDecorators(array('FileSelectorDiv'));
// 		$this->getElement('file_ids')->setDecorators(array('FileSelectorDiv'));
// 		$this->getElement('frontend_date')->setDecorators(array('CalendarText'));
	}
}