<?php

class Admin_MenuController extends Sunny_Controller_AdminAction
{
	protected $_auth;
	
	public function init()
 	{
   		$this->_auth = Zend_Auth::getInstance()->getStorage()->read();
	}
	
	public function indexAction()
	{
		
	}
	
	public function editAction()
	{
		
	}
	
	public function renderAction()
	{
		
		$mapper = new Menu_Model_Mapper_ZfMenu();
		$mapper->zfMenuAdmin($this->_auth->zf_roles_id);
		
		$this->view->container = Zend_Registry::get('zf_nav_container');
	}
	
}