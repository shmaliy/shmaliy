<?php

class Default_Form_FormLogin extends Sunny_Form
{
	
	
	public function init()
	{
		// указываем имя формы
        $this->setName('login');
         
        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение является обязательным и не может быть пустым';
         
        // создаём текстовый элемент
        $username = new Zend_Form_Element_Text('username');
         
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $username->setLabel('Логин:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Введите текст…')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
                 
        // создаём элемент формы для пароля
        $password = new Zend_Form_Element_Password('password');
         
        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $password->setLabel('Пароль:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Введите текст…')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
         
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('login');
        $submit->setValue('Войти в систему')
        		->setAttrib('class', 'btn')
        		->setLabel();
         
        // добавляем элементы в форму
        $this->addElements(array($username, $password, $submit));
         
        // указываем метод передачи данных
        $this->setMethod('post');
		
		// Decorators
		$this->addElementPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setElementDecorators(array('CompositeElementDiv'));
		
		$this->addDisplayGroupPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDisplayGroupDecorators(array('CompositeGroupDiv'));
		
		$this->addPrefixPath('Sunny_Form_Decorator', 'Sunny/Form/Decorator/', 'decorator');
		$this->setDecorators(array('CompositeFormDiv'));
		
// 		$this->getElement('media_id')->setDecorators(array('FileSelectorDiv'));
// 		$this->getElement('file_ids')->setDecorators(array('FileSelectorDiv'));
		//$this->getElement('frontend_date')->setDecorators(array('CalendarText'));
	}
}