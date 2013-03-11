<?php

require 'Core/Application/Bootstrap/Abstract.php';

class Bootstrap extends Core_Application_Bootstrap_Abstract
{	
    
	const MULTIDB_REGISTRY_KEY = 'multidb';
	
	public function run()
    {
        try {
	    	$this->setConfig();	        
	    	$this->setLoader();	    	
	    	$this->setModules(); // merge config with modules config           
	    	$this->setView();
			$this->setPlugins();
			$this->_setAcl();
	        $this->_setDatabases();	 
	        $router = $this->setRouter();	    	
            $front = Zend_Controller_Front::getInstance();            
            $front->setRouter($router);            
            //$front->registerPlugin(new Ext_Controller_Plugin_ModuleBootstrap, 1);
            Zend_Registry::set('interface', $this->_options['interface']);
            $this->_setNavigation();
            
        } catch (Exception $e) {
        	echo $e->getMessage();
        }
        //Zend_Registry::set('lang', 'default');
    	parent::run();
    }
    
	public function _setNavigation()
	{
		
		
		$mapper = new Menu_Model_Mapper_Cmsmenu();
		$mapper->mainMenu('mainmenu');
	}
	
	public function setPlugins()
	{
		$front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Custom_Controller_Plugin_IEStopper(array('ieversion' => 7)));
        //$front->addControllerDirectory('../application/controllers');
        
        $navigation = new Core_Controller_Plugin_Nav(/*$this->getOption('sunny_controller_plugin_auth')*/);
        $front->registerPlugin($navigation);
            
	}
	
    public function setConfig()
    {
        Zend_Registry::set('options', $this->_options);    	
    }
    
    /**
     * 
     */
	public function setLoader()
	{
		$autoLoader = Zend_Loader_Autoloader::getInstance();		
		$autoLoader->setFallbackAutoloader(true);
	}    
    
	/**
     * 
     */
	public function setView()
	{
		// Add custom view helpers paths
		$view = $this->getResource('view');
		$view->addHelperPath('Sunny/View/Helper', 'Sunny_View_Helper');
		$view->addHelperPath('Core/View/Helper', 'Core_View_Helper');
		$view->addHelperPath('Core/Image/View/Helper', 'Core_Image_View_Helper');
		
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setViewSuffix('php3');
				
		$layout = Zend_Layout::getMvcInstance();
		$url = parse_url($_SERVER['REQUEST_URI']);
		$url = $url['path'];
		$url = trim($url, '/');
		$url = explode('/', $url);
		
		
		if ($url[0] == 'admin') {
			if (Zend_Auth::getInstance()->hasIdentity()) {
				$auth = Zend_Auth::getInstance()->getStorage()->read();
								
				Zend_Registry::set('auth_role', $auth->zf_roles_id);
				$menu = new Menu_Model_Mapper_ZfMenu();
				$menu->zfMenuAdmin($auth->zf_roles_id);
				
				$layout->setLayout('admin-layout');
				
			} else {
				header("Location: /login");
			}	
		} else {
			$layout->setLayout('layout');
		}
	}    
	
	protected function _setDatabases()
	{
		$options = Zend_Registry::get('options');
		
		$options = $options['multidb'];
	
		$adapters = array();
		if (!Zend_Registry::isRegistered(self::MULTIDB_REGISTRY_KEY)) {
			Zend_Registry::set(self::MULTIDB_REGISTRY_KEY, $adapters);
		}
		
		// Create adapters
		$haveDefault = false;
		foreach ($options as $adapterName => $params) {
			$params['params']['options']['adapterName'] = $adapterName;
			$default = (bool) (isset($params['default']) && $params['default']);
	
			$params['params']['options']['default'] = $default;
			$db = Zend_Db::factory($params['adapter'], $params['params']);
	
			$haveDefault = (bool) Zend_Db_Table_Abstract::getDefaultAdapter();
			if ($default && false === $haveDefault) {
				Zend_Db_Table_Abstract::setDefaultAdapter($db);
			} else {
				$params['default'] = false;
				echo 1;
			}
	
			$adapters[$adapterName] = $db;
		}
	
		// Store back to registry
		Zend_Registry::set(self::MULTIDB_REGISTRY_KEY, $adapters);
	
	}
	
	
	public function setRouter()
	{
	    $router = new Zend_Controller_Router_Rewrite();
	    //$router->removeDefaultRoutes();

	    $route = new Zend_Controller_Router_Route (
	    	'',
	    	array(
	    		'module' => 'default',
	    	    'controller' => 'index',
	    	    'action'     => 'index',
	    	)
	    );
	    $router->addRoute('index', $route);
	    
	    $route = new Zend_Controller_Router_Route (
	    		'login',
	    		array(
	    				'module' => 'default',
	    				'controller' => 'auth',
	    				'action'     => 'login',
	    		)
	    );
	    $router->addRoute('login', $route);

	    
// 	    $router->addRoute(
// 	    		'dynamic_list',
// 	    		new Zend_Controller_Router_Route_Regex(
//     				'([a-zA-Z\/]+).html',
//     				array(
//     						'module' => 'content',
//     						'controller' => 'index',
//     						'action' => 'dynamic-list',
//     						'path' => '',
//     				),
//     				array(
//     						1 => 'path',
//     				),
//     				'%s'
// 	    ));
	    
// 	    $router->addRoute(
// 	    		'dynamic_item',
// 	    		new Zend_Controller_Router_Route_Regex(
//     				'([a-zA-Z\/]+)/([0-9]+).html',
//     				array(
//     						'module' => 'content',
//     						'controller' => 'index',
//     						'action' => 'dynamic-item',
//     						'path' => '',
//     						'id' => '',
//     				),
//     				array(
//     						1 => 'path',
//     						2 => 'id'
//     				),
//     				'%s/%s'
// 	    ));
	    
// 	    $router->addRoute(
// 	    		'cat_static', 
// 	    		new Zend_Controller_Router_Route_Regex(
// 	    			'([a-zA-Z0-9\/]*)/([a-zA-Z0-9]*).html',
// 		    		array(
// 		    				'module' => 'content',
// 		    				'controller' => 'index',
// 		    				'action' => 'static',
// 		    				'mode' => 'cat',
// 		    				'path' => '',
// 		    				'alias' => ''
// 		    		),
// 		    		array(
// 		    				1 => 'path',
// 		    				2 => 'alias'
// 		    		),
// 	    			'%s/%s'
// 	    ));
	    
// 	    $router->addRoute(
// 	    		'static',
// 	    		new Zend_Controller_Router_Route_Regex(
//     				'([a-zA-Z0-9]*).html',
//     				array(
//     						'module' => 'content',
//     						'controller' => 'index',
//     						'action' => 'static',
//     						'mode' => 'root',
//     						'alias' => ''
//     				),
//     				array(
//     					1 => 'alias'
//     				),
//     				'%s'
//     	));
	    
        
	    return $router;
	}
	
	public function setModules()
	{
	    //$modules = new Ext_Modules_Load();
    	//Zend_Registry::set('modules', $modules->getList());
	}
	
	
	/**
	* Setup custom layout files suffix
	*/
	protected function _setView()
	{
		$options = $this->getOptions();
		
		// Add custom view helpers paths
		$view = $this->getResource('view');
		$view->addHelperPath('Sunny/View/Helper', 'Sunny_View_Helper');
		$view->addHelperPath('Core/View/Helper', 'Core_View_Helper');
		$view->addHelperPath('Core/Image/View/Helper', 'Core_Image_View_Helper');
		
		// Set templates suffix
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
		$viewRenderer->setViewSuffix($options['resources']['layout']['viewSuffix']);
	}
	
	
	protected function _setAcl()
	{
		// Создаём объект Zend_Acl
		$acl = new Zend_Acl();

		// Добавляем ресурсы нашего сайта,
		// другими словами указываем контроллеры и действия

		// указываем, что у нас есть ресурс index
		$acl->addResource('index');
		
		$acl->addResource('admin-index');

		// ресурс add является потомком ресурса index
// 		$acl->addResource('add', 'index');

// 		// ресурс edit является потомком ресурса index
// 		$acl->addResource('edit', 'index');

// 		// ресурс delete является потомком ресурса index
// 		$acl->addResource('delete', 'index');

// 		// указываем, что у нас есть ресурс error
		$acl->addResource('error');

		// указываем, что у нас есть ресурс auth
		$acl->addResource('auth');

		// ресурс login является потомком ресурса auth
		$acl->addResource('login', 'auth');

		// ресурс logout является потомком ресурса auth
		$acl->addResource('logout', 'auth');

		// далее переходим к созданию ролей, которых у нас 2:
		// гость (неавторизированный пользователь)
		$acl->addRole('guest');

		// администратор, который наследует доступ от гостя
		$acl->addRole('admin', 'guest');

		// разрешаем гостю просматривать ресурс index
		$acl->allow('guest', 'index', array());

		// разрешаем гостю просматривать ресурс auth и его подресурсы
		$acl->allow('guest', 'auth', array('index', 'login', 'logout'));

		// даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
		$acl->allow('admin', 'admin-index', array('index', 'add', 'edit', 'delete'));

		// разрешаем администратору просматривать страницу ошибок
		$acl->allow('admin', 'error');

		// получаем экземпляр главного контроллера
		$fc = Zend_Controller_Front::getInstance();

		// регистрируем плагин с названием AccessCheck, в который передаём
		// на ACL и экземпляр Zend_Auth
		
		//$fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
	}
	
	
}

