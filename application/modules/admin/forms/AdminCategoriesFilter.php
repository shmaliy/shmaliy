<?php

class Contents_Form_AdminCategoriesFilter extends Sunny_Form
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
	}
}