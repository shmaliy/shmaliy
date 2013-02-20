<?php
class AdminIndexController extends Sunny_Controller_AdminAction
{
	/**
	 * Prepare controller to work with ajax
	 *
	 * (non-PHPdoc)
	 * @see Sunny_Controller_Action::init()
	 */
	public function init()
	{
		$this->_helper->layout->setLayout('admin-layout');
		parent::init();

		// Add actions wich can work with ajax
		$context = $this->_helper->AjaxContext();
		$context->addActionContext('config', 'json');
		$context->initContext('json');
	}
	
	public function indexAction()
	{
		
	}
	
}