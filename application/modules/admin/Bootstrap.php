<?php
require_once 'Core/Application/Module/Bootstrap.php';
class Admin_Bootstrap extends Core_Application_Module_Bootstrap
{    
    public function run()
    {
    	try {
    		$this->_getAuth();
    	
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}
    	
    	parent::run();
    }
    
    private function _getAuth()
    {
    	if (Zend_Auth::getInstance()->hasIdentity() != 1) {
    		header("Location: /login"); 
    		
    		$this->_helper->redirector('login', 'auth', 'default');
    		
    	}
    	
    }
}
