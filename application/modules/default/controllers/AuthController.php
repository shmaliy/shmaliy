<?php
class AuthController extends Sunny_Controller_AdminAction
{
	/**
	 * Prepare controller to work with ajax
	 *
	 * (non-PHPdoc)
	 * @see Sunny_Controller_Action::init()
	 */
	public function init()
	{
		$this->_helper->layout->setLayout('login-layout');
		parent::init();

		// Add actions wich can work with ajax
		$context = $this->_helper->AjaxContext();
		//$context->addActionContext('config', 'json');
		$context->initContext('json');
	}
	
	public function indexAction()
	{
		$this->_helper->redirector('login', 'auth', 'default');
	}
	
	public function loginAction()
	{
// 		return;
		// проверяем, авторизирован ли пользователь
		if (Zend_Auth::getInstance()->hasIdentity()) {
			// если да, то делаем редирект, чтобы исключить многократную авторизацию
			$this->_helper->redirector('index', 'admin-index', 'default');
		}
		
		// создаём форму и передаём её во view
		$form = new Default_Form_FormLogin();
		$this->view->form = $form;
		// Если к нам идёт Post запрос
		if ($this->getRequest()->isPost()) {
			// Принимаем его
			$formData = $this->getRequest()->getPost();
		
			// Если форма заполнена верно
			if ($form->isValid($formData)) {
				// Получаем адаптер подключения к базе данных
				$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
				//$authAdapter = new Default_Model_DbTable_ZfUsers();
		
				// указываем таблицу, где необходимо искать данные о пользователях
				// колонку, где искать имена пользователей,
				// а также колонку, где хранятся пароли
				$authAdapter->setTableName('zf_users')
				->setIdentityColumn('username')
				->setCredentialColumn('password');
		
				// получаем введённые данные
				$username = $this->getRequest()->getPost('username');
				$password = md5($this->getRequest()->getPost('password'));
		
				// подставляем полученные данные из формы
				$authAdapter->setIdentity($username)
				->setCredential($password);
		
				// получаем экземпляр Zend_Auth
				$auth = Zend_Auth::getInstance();
		
				// делаем попытку авторизировать пользователя
				$result = $auth->authenticate($authAdapter);
		
				// если авторизация прошла успешно
				if ($result->isValid()) {
					// используем адаптер для извлечения оставшихся данных о пользователе
					$identity = $authAdapter->getResultRowObject();
		
					// получаем доступ к хранилищу данных Zend
					$authStorage = $auth->getStorage();
		
					// помещаем туда информацию о пользователе,
					// чтобы иметь к ним доступ при конфигурировании Acl
					$authStorage->write($authAdapter->getResultRowObject(array(
				        'id',
						'username',
				        'zf_roles_id',
				    )));
		
					// Используем библиотечный helper для редиректа
					// на controller = index, action = index
					$this->_helper->redirector('index', 'index', 'admin');
				} else {
					$this->view->errMessage = 'Вы ввели неверное имя пользователя или неверный пароль';
				}
			}
		}
	}
	
	public function logoutAction()
	{
		// уничтожаем информацию об авторизации пользователя
		Zend_Auth::getInstance()->clearIdentity();
	
		// и отправляем его на главную
		$this->_helper->redirector('login', 'auth', 'default');
	}
	
}