<?php
/**
 * There is a name of fields to edit
 * 
 * title_uk
 * title_ru
 * title_en
 * x
 * y
 * z
 * published 
 * 
 */

class Contents_Form_ContactsMapsEdit extends Sunny_Form
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
		$main = array('title_uk');		

		$this->addElement('text', 'title_uk', array(
			'label' => 'Название (Укр)',
			'required' => true
		));
		
		$main[] = 'title_ru';
		$this->addElement('text', 'title_ru', array(
			'label' => 'Название (Рус)',
			'required' => true
		));
		
		$main[] = 'title_en';
		$this->addElement('text', 'title_en', array(
			'label' => 'Название (Англ)',
			'required' => true
		));
		
		$main[] = 'x';
		$this->addElement('text', 'x', array(
			'label' => 'Широта',
			'required' => true
		));
		
		$main[] = 'y';
		$this->addElement('text', 'y', array(
			'label' => 'Долгота',
			'required' => true
		));
		
		$main[] = 'z';
		$this->addElement('text', 'z', array(
			'label' => 'Приближение',
			'required' => true
		));
		
		$this->addDisplayGroup($main, 'main', array('legend' => 'Основная информация'));
		
		/*  System  */
		$system = array('published');
		
		$this->addElement('checkbox', 'published', array(
			'label' => 'Опубликовать'
		));
		
		$this->addDisplayGroup($system, 'system', array('legend' => 'Системная информация'));
		
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