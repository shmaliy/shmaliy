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
// 		var_export($this->makeZfNavContainerAdmin($list, 'admin-main'));
// 		echo '</pre>';
		
		$container = $this->makeZfNavContainerAdmin($list, 'admin-main');
		$container = new Zend_Navigation($container);
		Zend_Registry::set('zf_nav_container', $container);
		
// 		echo '<pre>';
// 		print_r($container);
// 		echo '</pre>';
		
		return $container;
		
	}
	
	public function cmsGetMenuItems($parent = null)
	{
		$select = $this->getDbTable()->select();
		$select->setIntegrityCheck(false);
		
		$select->from(
				array('menu' => 'zf_menu')
		);
		
		if (!is_null($parent)) {
			$select->where('menu.zf_menu_id = ?', $parent);
		}
		
		$select->order('menu.ordering');
		
		$select->joinLeft(
			array('roles' => 'zf_roles'),
			"roles.id = menu.zf_roles_id",
			array(
				"zf_roles_title" => "roles.title"		
			)		
		);
		
		$select->joinLeft(
			array('parent_menu' => 'zf_menu'),
			"parent_menu.id = menu.zf_menu_id",
			array(
				"zf_menu_title" => "parent_menu.title"
			)
		);
		
		$select->joinLeft(
			array('users' => 'zf_users'),
			"users.id = menu.zf_users_id",
			array(
				"zf_users_name" => "users.name"
			)
		);
		
		$list = $this->getDbTable()->fetchAll($select, null);
		
		return $list;
	}
	
}