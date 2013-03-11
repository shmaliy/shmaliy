<?php

class Contents_Form_GroupEdit extends Sunny_Form
{
	public function init()
	{
		$this->setName(strtolower('contents')); // если тут имелась ввиду строка то нафига тогда strtolower()
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
		$this->setAttrib('class', 'via_ajax');         // Force send only with ajax
		
		// New
		$this->addElement('hidden', 'id');
		
		/*  Main  */
		$main = array('contents_groups_id');		
		$this->addElement('select', 'contents_groups_id', array(
			'label' => 'Родитель'
		));		
		
		$main[] = 'title';
		$this->addElement('text', 'title', array(
			'label' => 'Название группы (Укр)',
			'required' => true
		));
		
		$main[] = 'title_ru';
		$this->addElement('text', 'title_ru', array(
			'label' => 'Название группы (Рус)',
			'required' => true
		));
		
		$main[] = 'title_en';
		$this->addElement('text', 'title_en', array(
			'label' => 'Название группы (Англ)',
			'required' => true
		));
		
		$main[] = 'main_limit';
		$this->addElement('text', 'main_limit', array(
				'label' => 'Кол-во на главной странице',
				'required' => true
		));
		
		$main[] = 'alias';
		$this->addElement('text', 'alias', array(
			'label' => 'Псевдоним',
			'required' => true
		));
		
		$dynamic_values = array(
			'NO' => 'Статический контент',
			'YES' => 'Динамический контент'
		);
		
		$main[] = 'dynamic';
		$this->addElement('select', 'dynamic', array(
			'label' => 'Тип группы', 
			'multiOptions' => $dynamic_values
		));
		
		$admin_menu_values = array(
			'YES' => 'Да',
			'NO' => 'Нет'
		);
		
		$main[] = 'admin_menu';
		$this->addElement('select', 'admin_menu', array(
					'label' => 'Отображать в CMS в меню "Разделы сайта"', 
					'multiOptions' => $admin_menu_values
		));
		
		$main[] = 'published';
		$this->addElement('checkbox', 'published', array(
			'label' => 'Опубликовано'
		));
		
		$this->addDisplayGroup($main, 'main', array('legend' => 'Основная информация'));
		
		// Submit
		/*$this->addElement('submit', 'submit', array(
			'ignore' => true,
			'label' => '',
			'value' => 'Сохранить'
		));*/
		
		// Decorators
		$this->addElementPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setElementDecorators(array('CompositeElementDiv'));
		
		$this->addDisplayGroupPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDisplayGroupDecorators(array('CompositeGroupDiv'));
		
		$this->addPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDecorators(array('CompositeFormDiv'));
	}
}