<?php

class Menu_Model_Mapper_ZfMenu extends Sunny_DataMapper_MapperAbstract
{
	
	public function makeZfNavContainerAdmin($array, $alias = null, $parent = 0, $level = 0)
	{
		$_tree = array();
		$level++;
		
		foreach ($array as &$item) { 
			if ($item['zf_menu_id'] == $parent && ($item['alias'] == $alias || $parent > 0)) { 
				$pages = $this->makeZfNavContainerAdmin($array, null, $item['id'], $level);
				
				$class='zf_menu_' . $level;
				
				$_tree[] = array(
						'label'   	=> $item['title'],
						'uri' 	  	=> $item['href'],
						'class'		=> $class,
						'pages'		=> $pages,
						'active'	=> $_SERVER['REQUEST_URI'] == $item['href'],
						'img'		=> $item['img']
				);
			}
		}
		
		return $_tree;
	}
	
	public function zfMenuAdmin($role = 1)
	{
		$select = $this->getDbTable()->select();
		$select->setIntegrityCheck(false);
		
		$select->from(
				array('menu' => 'zf_menu')
		);
		
		$select->where('menu.published = ?', 'YES');
		$select->where('menu.zf_roles_id = ?', $role);
		
		$select->order('menu.ordering');
		
		$list = $this->getDbTable()->fetchAll($select, null);
		
// 		echo '<pre>';
// 		var_export($this->makeZfNavContainer($list, 'admin-main'));
// 		echo '</pre>';
		
		$container = $this->makeZfNavContainerAdmin($list, 'admin-main');
		$container = new Zend_Navigation($container);
		Zend_Registry::set('zf_nav_container', $container);
		
// 		echo '<pre>';
// 		print_r($container);
// 		echo '</pre>';
		
		return $container;
		
	}
	
	
	public function makeNavContainer($array, $alias = null, $parent = 0, $level = 0)
	{
		
		$catsMapper = new Content_Model_Mapper_Cmscategories();
		$contMapper = new Content_Model_Mapper_Cmscontent();
		
		$_tree = array();
		$level++;
		
		$current = $_SERVER['REQUEST_URI'];
		
		foreach ($array as &$item) {
			if ($item['parent_id'] == $parent) {
				
				$link = trim($item['link'], '/');
				

				$pages = $this->makeNavContainer($array, null, $item['id'], $level);
				
				if (!strstr($link, '.html') && !preg_match('[0-9]+', $link) && $link != '')
				{
					
					$rcontents = $contMapper->getContentList($item['link']);
					
						
					if (!empty($rcontents)) {
						foreach ($rcontents as $ritem) {
							array_push($pages, $ritem);
						}
					}
					
					$cats = $catsMapper->makeCatsTree($link);
					if (!empty($cats)) {
						foreach ($cats as &$cat) {
							
							$contents = $contMapper->getContentList($cat['uri']);
							
							if (!empty($contents)) {
								$cat['pages'] = $contents;
							}
							
							array_push($pages, $cat);
						}
					}
				}
				
				$class='mainmenu_' . $level;
				
				$_tree[] = array(
						'label'   	=> $item['title'],
						'uri' 	  	=> $item['link'],
						'class'		=> $class,
						'pages'		=> $pages,
						'active'	=> $_SERVER['REQUEST_URI'] == $item['link']
				);
			}
		}
		
		return $_tree;
	}
	
	public function mainMenu($alias = null)
	{
		$select = $this->getDbTable()->select();
		$select->setIntegrityCheck(false);
		
		$select->from(
			array('menu' => 'cmsmenu')		
		);
		
		$select->where('menu.published = 1');
		
		$select->order('menu.ordering');
		
		$list = $this->getDbTable()->fetchAll($select, null);
		
// 		echo '<pre>';
// 		var_export($list);
// 		echo '</pre>';
		
// 		echo '<pre>';
// 		var_export($this->makeNavContainer($list, $alias));
// 		echo '</pre>';
		
		$container = $this->makeNavContainer($list, $alias);
		$container = new Zend_Navigation($container);
		Zend_Registry::set('nav_container', $container);
		
		return $container;
	}
	
}