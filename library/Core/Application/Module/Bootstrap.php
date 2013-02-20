<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Core
 * @package    Core_Application
 * @subpackage Core_Application_Module
 * @copyright  Copyright (c) 2005-2012 SunNY Creative Technologies. (http://www.sunny.net.ua)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Bootstrap.php 0.1 2012-12-12 pavlenko $
 */

/**
 * @see Core_Application_Bootstrap_Abstract
 */
require_once "Core/Application/Bootstrap/Abstract.php";

/**
 * Module abstract boostraping class (partialy cloned Zend_Application_Module_Bootstrap)
 * Like in Application bootstrap you can add some resource types for module loader here
 * 
 * @category   Core
 * @package    Core_Application
 * @subpackage Core_Application_Module
 * @copyright  Copyright (c) 2005-2012 SunNY Creative Technologies. (http://www.sunny.net.ua)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Core_Application_Module_Bootstrap extends Core_Application_Bootstrap_Abstract
{
	/**
	 * Set this explicitly to reduce impact of determining module name
	 * @var string
	 */
	protected $_moduleName;
	
	/**
	 * Constructor
	 *
	 * @param  Zend_Application|Zend_Application_Bootstrap_Bootstrapper $application
	 * @return void
	 */
	public function __construct($application)
	{
		$this->setApplication($application);
	
		// Use same plugin loader as parent bootstrap
		if ($application instanceof Zend_Application_Bootstrap_ResourceBootstrapper) {
			$this->setPluginLoader($application->getPluginLoader());
		}
	
		$key = strtolower($this->getModuleName());
		if ($application->hasOption($key)) {
			// Don't run via setOptions() to prevent duplicate initialization
			$this->setOptions($application->getOption($key));
		}
	
		if ($application->hasOption('resourceloader')) {
			$this->setOptions(array(
				'resourceloader' => $application->getOption('resourceloader')
			));
		}
		$this->initResourceLoader();
	
		// ZF-6545: ensure front controller resource is loaded
		if (!$this->hasPluginResource('FrontController')) {
			$this->registerPluginResource('FrontController');
		}
	
		// ZF-6545: prevent recursive registration of modules
		if ($this->hasPluginResource('modules')) {
			$this->unregisterPluginResource('modules');
		}
	}
	
	/**
	 * Ensure resource loader is loaded
	 * Adding custom resource types here
	 *
	 * @return void
	 */
	public function initResourceLoader()
	{
		$this->getResourceLoader()->addResourceTypes(array(
			// Required for new model structure
			'model'   => array(
                'namespace' => 'Model',
                'path'      => 'models',
            ),
			'dbtable' => array(
					'namespace' => 'Model_DbTable',
					'path'      => 'models/DbTable',
			),
			'mappers' => array(
                'namespace' => 'Model_Mapper',
                'path'      => 'models/Mappers',
            ),
			'entities' => array(
                'namespace' => 'Model_Entity',
                'path'      => 'models/Entity',
            ),
			'collections' => array(
				'namespace' => 'Model_Collection',
				'path'      => 'models/Collection',
			),
		));
	}
	
	/**
	 * Get default application namespace
	 *
	 * Proxies to {@link getModuleName()}, and returns the current module
	 * name
	 *
	 * @return string
	 */
	public function getAppNamespace()
	{
		return $this->getModuleName();
	}
	
	/**
	 * Retrieve module name
	 *
	 * @return string
	 */
	public function getModuleName()
	{
		if (empty($this->_moduleName)) {
			$class = get_class($this);
			if (preg_match('/^([a-z][a-z0-9]*)_/i', $class, $matches)) {
				$prefix = $matches[1];
			} else {
				$prefix = $class;
			}
			$this->_moduleName = $prefix;
		}
		return $this->_moduleName;
	}
}