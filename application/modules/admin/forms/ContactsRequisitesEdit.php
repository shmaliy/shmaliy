<?php
/**
* There is a name of fields to edit
*
* title_uk
* title_ru
* title_en
* text_uk
* text_ru
* text_en
* published
*
*/

class Contents_Form_ContactsRequisitesEdit extends Sunny_Form
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
		
		$main[] = 'text_uk';
		$this->addElement('textarea', 'text_uk', array(
			'label' => 'Текст реквизитов (Укр)'
		));
		
		$main[] = 'text_ru';
		$this->addElement('textarea', 'text_ru', array(
			'label' => 'Текст реквизитов (Рус)'
		));
		
		$main[] = 'text_en';
		$this->addElement('textarea', 'text_en', array(
			'label' => 'Текст реквизитов (Англ)'
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