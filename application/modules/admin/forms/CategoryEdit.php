<?php

class Contents_Form_CategoryEdit extends Sunny_Form
{
	protected $_contentsCategoriesMultiOptions = array();
	
	public function setContentsCategoriesMultiOptions($options, $exclude = array())
	{
		$this->_contentsCategoriesMultiOptions = array(0 => 'Нет');
		
		if ($options instanceof Sunny_DataMapper_CollectionAbstract) {
			$this->_contentsCategoriesMultiOptions = $this->collectionToMultiOptions($options, $exclude, $this->_contentsCategoriesMultiOptions);
		} else if (is_array($options)) {
			$this->_contentsCategoriesMultiOptions = $options;
		}
	}
	
	public function init()
	{
		$this->setName(strtolower('contents')); // если тут имелась ввиду строка то нафига тогда strtolower()
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
		$this->setAttrib('class', 'via_ajax');         // Force send only with ajax
		
		// New
		$this->addElement('hidden', 'id');
		$this->addElement('hidden', 'contents_groups_id', array('value' => $this->_contentsGroupsId));		
		
		/*  Main  */
		$main = array('contents_categories_id');		
		$this->addElement('select', 'contents_categories_id', array(
			'label' => 'Родитель', 
			'multiOptions' => $this->_contentsCategoriesMultiOptions
		));		
		
		$main[] = 'title';
		$this->addElement('text', 'title', array(
			'label' => 'Заголовок (Укр)',
			'required' => true
		));
		
		$main[] = 'title_ru';
		$this->addElement('text', 'title_ru', array(
			'label' => 'Заголовок (Рус)',
			'required' => true
		));
		
		$main[] = 'title_en';
		$this->addElement('text', 'title_en', array(
			'label' => 'Заголовок (Анг)',
			'required' => true
		));
		
		$main[] = 'alias';
		$this->addElement('text', 'alias', array(
			'label' => 'Псевдоним (ЧПУ)'
		));
		
		$main[] = 'description';
		$this->addElement('textarea', 'description', array(
			'label' => 'Описание (Укр)'
		));
		
		$main[] = 'description_ru';
		$this->addElement('textarea', 'description_ru', array(
			'label' => 'Описание (Рус)'
		));
		
		$main[] = 'description_en';
		$this->addElement('textarea', 'description_en', array(
			'label' => 'Описание (Анг)'
		));
		
		$this->addDisplayGroup($main, 'main', array('legend' => 'Основная информация'));
		
		
		/*  SEO  */		
		$seo = array('seo_title');
		
		$this->addElement('text', 'seo_title', array(
			'label' => 'Заголовок (SEO)'
		));
		
		$seo[] = 'seo_description';
		$this->addElement('textarea', 'seo_description', array(
			'label' => 'SEO описание'
		));
		
		$seo[] = 'seo_keywords';
		$this->addElement('textarea', 'seo_keywords', array(
			'label' => 'SEO ключевые слова'
		));
				
		$this->addDisplayGroup($seo, 'seo', array('legend' => 'SEO'));
		
		
		
		/*  System  */
		
		$system = array('name_bc');
		
		$group1[] = 'name_bc';
		$this->addElement('text', 'name_bc', array(
			'label' => 'Название для хлебных крошек'
		));
		
		$system[] = 'enable_comments';
		$this->addElement('checkbox', 'enable_comments', array(
			'label' => 'Разрешить комментирование'
		));
		
		$system[] = 'published';
		$this->addElement('checkbox', 'published', array(
			'label' => 'Опубликовать'
		));

		$this->addDisplayGroup($system, 'system', array('legend' => 'Системная информация'));
		
		
		/*  Feeds  */
		$feeds = array('feeds');
		
		$feeds[] = 'enable_rss';
		$this->addElement('checkbox', 'enable_rss', array(
			'label' => 'Включать в RSS ленту'
		));
		
		$feeds[] = 'enable_email';
		$this->addElement('checkbox', 'enable_email', array(
			'label' => 'Включать в email рассылку'
		));
		
		$this->addDisplayGroup($feeds, 'feeds', array('legend' => 'Рассылки'));
		
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