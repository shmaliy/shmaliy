<?php

class Admin_MenuController extends Sunny_Controller_AdminAction
{
	protected $_auth;
	protected $_parent = null;
	protected $_page = 1;
	protected $_limit = 20;
	
	public function init()
 	{
   		$this->_auth = Zend_Auth::getInstance()->getStorage()->read();
   		$context = $this->_helper->AjaxContext();
   		$context->addActionContext('index', 'json');
   		$context->addActionContext('publish', 'json');
   		$context->initContext('json');
   		
   		$this->view->m = 'admin';
   		$this->view->c = 'menu';
	}
	
	public function indexAction()
	{
		$mapper = new Menu_Model_Mapper_ZfMenu();
		
		$result = $mapper->cmsGetMenuItems($this->_parent, $this->_page, $this->_limit);
		$this->view->content = $result;
		
// 		echo '<pre>';
// 		var_export($result);
// 		echo '</pre>';
	}
	
	public function editAction()
	{
		
	}
	
	public function renderAction()
	{

	}
	
	public function publishAction()
	{
		$request = $this->getRequest();
		$params = $request->getParams();
		
		$mapper = new Menu_Model_Mapper_ZfMenu();
	}
	
}