<?php

class Admin_IndexController extends Sunny_Controller_AdminAction
{

	public function init()
 	{
   
	}
    
	public function indexAction()
    {
    
    }   
    
    public function loginAction()
    {
    	
    }
    
    public function logoutAction()
    {
    	$this->$this->_helper->viewRenderer->setNoRender(true);
    }
}