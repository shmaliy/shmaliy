<?php

class FilesController extends Sunny_Controller_AdminAction
{

	public function init()
 	{
 		$this->_auth = Zend_Auth::getInstance()->getStorage()->read();
 		$context = $this->_helper->AjaxContext();
 		$context->addActionContext('upload', 'json');
 		$context->initContext('json');
 		 
 		$this->view->m = 'admin';
 		$this->view->c = 'files';
	}
    
	public function indexAction()
    {
    
    }

    public function loadMenuImageAction()
    {
    
    }
    
    public function uploadAction()
    {
    	$this->_helper->layout()->disableLayout();
//     	$this->_helper->viewRenderer->setNoRender(true);
    	$request = $this->getRequest();
    	
    	$this->view->request = $request;
    	
    	
    }
}