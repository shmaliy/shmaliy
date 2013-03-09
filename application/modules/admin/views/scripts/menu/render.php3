<?php $partial = array('admin-menu-partial.php3', 'default'); ?>

<? echo $this->navigation(Zend_Registry::get('zf_nav_container'))->setMinDepth(1)->menu()->setPartial($partial); ?>

<div class="clear"></div>
