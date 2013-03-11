<?php
/**
* There is a name of fields to edit
*
* owner_uk
* owner_ru
* owner_en
* login
* published
*
*/

class Contents_Form_ContactsSkypesEdit extends Sunny_Form
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
		$main = array('owner_uk');		

		$this->addElement('text', 'owner_uk', array(
			'label' => 'Контактное лицо или название отдела (Укр)',
			'required' => true
		));
		
		$main[] = 'owner_ru';
		$this->addElement('text', 'owner_ru', array(
			'label' => 'Контактное лицо или название отдела (Рус)',
			'required' => true
		));
		
		$main[] = 'owner_en';
		$this->addElement('text', 'owner_en', array(
			'label' => 'Контактное лицо или название отдела (Англ)',
			'required' => true
		));
		
		$main[] = 'login';
		$this->addElement('text', 'login', array(
			'label' => 'Аккаунт'
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