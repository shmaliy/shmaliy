<?php

class Contents_Form_GalleryOfVideosEdit extends Sunny_Form
{

	protected $_contentsCategoriesMultiOptions = array();
	
	protected $_typeOfRelation = 'gallery_of_videos';
	
	public function getTypeOfRelation()
	{
		return $this->_typeOfRelation;
	}
	
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
		$this->setName(strtolower('contents'));
		$this->setMethod(self::METHOD_POST);
		$this->setAttrib('onsubmit', 'return false;'); // Force send only with ajax
		$this->setAttrib('class', 'via_ajax');         // Force send only with ajax
		
		/*  Externals  */		
		$this->addElement('hidden', 'id');
		$this->addElement('hidden', 'contents_groups_id', array('value' => $this->_contentsGroupsId));
		$this->addElement('hidden', 'image');
		$this->addElement('hidden', 'event');
		$this->addElement('hidden', 'sheduled', array('value' => 0)); // В данной версии надо не забывать про необходимые значения
		$this->addElement('hidden', 'pages');
		$this->addElement('hidden', 'files');
		$this->addElement('hidden', 'photoalbums');
		$this->addElement('hidden', 'videolists');
		$this->addElement('hidden', 'videos'); // в данной версии пока не реализовано хранилище
		
		/*  Main  */
		$main = array('contents_categories_id');
		$this->addElement('select', 'contents_categories_id', array(
			'label' => 'Родитель',
			'multiOptions' => $this->_contentsCategoriesMultiOptions
		));
		
		$main[] = 'languages_alias';
		$this->addElement('select', 'languages_alias', array(
					'label' => 'Язык'
		));
		
		$main[] = 'contents_id';
		$this->addElement('select', 'contents_id', array(
					'label' => 'Галерея-оригинал'
		));
		
		$main[] = 'title';
		$this->addElement('text', 'title', array(
			'label' => 'Заголовок',
			'required' => true
		));
		
		$main[] = 'alias';
		$this->addElement('text', 'alias', array(
			'label' => 'Псевдоним (ЧПУ)'
		));
		
		$main[] = 'frontend_date';
		$this->addElement('text', 'frontend_date', array(
			'label' => 'Дата для отображения'
		));
		
		$main[] = 'tizer';
		$this->addElement('textarea', 'tizer', array(
			'label' => 'Текст тизера'
		));
		
		$main[] = 'description';
		$this->addElement('textarea', 'description', array(
			'label' => 'Полный текст'
		));
		
		$this->addDisplayGroup($main, 'main', array('legend' => 'Основная информация'));
		
		/*  Media  */
		$media = array('media_id');
		$this->addElement('button', 'media_id', array(
			'label'          => 'Главное изображение',
			'buttonLabel'    => 'Выбрать',
			'selectorMode'  => 'image',
			'selectMultiple' => false,
			'onClick' => "uiDialogOpen('Выбор главного изображения', {action:'select-image', controller:'admin-index', module:'media', format:'html', 'field':'media_id', 'selector-mode': 'image', 'select-multiple':false});"
		));
		
		$media[] = 'video_ids';
		$this->addElement('button', 'video_ids', array(
			'label' => 'Видеофайлы',
			'buttonLabel' => 'Выбрать',
			'selectorMode'  => 'video',
			'selectMultiple' => true,
			'onClick' => "uiDialogOpen('Выбор видеофайлов', {action:'select-video', controller:'admin-index', module:'media', format:'html', 'field':'video_ids', 'selector-mode': 'image', 'select-multiple':true});"
		));
		
		$media[] = 'file_ids';
		$this->addElement('button', 'file_ids', array(
			'label' => 'Прикрепленные файлы',
			'buttonLabel' => 'Выбрать',
			'selectorMode'  => 'file',
			'selectMultiple' => true,
			'onClick' => "uiDialogOpen('Выбор файлов', {action:'select-file', controller:'admin-index', module:'media', format:'html', 'field':'file_ids', 'selector-mode': 'file', 'select-multiple':true});"
		));
				
		$this->addDisplayGroup($media, 'media', array('legend' => 'Медиа'));
		
				
		/*  SEO  */
		$seo = array('seo');
		
		$seo[] = 'seo_title';
		$this->addElement('text', 'seo_title', array(
			'label' => 'SEO заголовок'
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
		$system = array('system');
		
		$system[] = 'name_bc';
		$this->addElement('text', 'name_bc', array(
			'label' => 'Название для хлебных крошек'
		));
		
		$system[] = 'published';
		$this->addElement('checkbox', 'published', array(
			'label' => 'Опубликовано'
		));
		
		$system[] = 'publicate_on_index';
		$this->addElement('checkbox', 'publicate_on_index', array(
			'label' => 'Размещать на главной'
		));
		
		$system[] = 'enable_comments';
		$this->addElement('checkbox', 'enable_comments', array(
			'label' => 'Разрешить комментарии'
		));
		
		$system[] = 'admin_comment';
		$this->addElement('textarea', 'admin_comment', array(
			'label' => 'Комментарий администратора'
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
		
		$feeds[] = 'enable_calendar';
		$this->addElement('checkbox', 'enable_calendar', array(
			'label' => 'Включать в электронный календарь'
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
		
		$this->getElement('media_id')->setDecorators(array('FileSelectorDiv'));
		$this->getElement('video_ids')->setDecorators(array('FileSelectorDiv'));
		$this->getElement('file_ids')->setDecorators(array('FileSelectorDiv'));
	}
}