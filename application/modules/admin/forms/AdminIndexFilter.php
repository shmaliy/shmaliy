<?php

class Contents_Form_AdminIndexFilter extends Sunny_Form
{
	public function init()
	{
		$this->setName(strtolower(get_class($this)));
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
		$this->setAttrib('class', 'via_ajax');         // Force send only with ajax
		
		$this->addElement('select', 'contents_categories_id', array(
			'label' => 'Категория',
			'onchange' => '$(this).parents("form").submit();'
		));
		
		$this->addElement('select', 'languages_alias', array(
			'label' => 'Категория',
			'multiOptions' => array('uk' => 'Українська', 'ru' => 'Русский', 'en' => 'English'),
			'onchange' => '$(this).parents("form").submit();'
		));
				
		$this->addElement('submit', 'submit', array(
			'ignore' => true,
			'label' => '',
			'value' => 'Применить фильтр'
		));
	}
}