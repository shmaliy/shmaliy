<?php 
	echo $this->doctype('XHTML1_TRANSITIONAL'); 
	$menu = new Menu_Model_Mapper_ZfMenu();
	$near = $menu->getMostNear(Zend_Registry::get('zf_nav_container'));
	$auth = Zend_Auth::getInstance()->getStorage()->read();
	echo $this->navigation(Zend_Registry::get('zf_nav_container'))->breadcrumbs()->setMinDepth(1)->setPartial(array('make-title.php3', 'admin'));
?>
<html>
<head>
<?php $this->headTitle('Управление сайтом pht: Shmaliy')->setSeparator(' | '); ?>

<?
	$this->headMeta()->appendName('keywords', 'OBS, optimal, shmaliy')
                     ->appendName('title', 'OBS')
                     ->appendName('description', 'OBS, description')
                     ->appendName('robots', 'index, follow')
                     ->appendName('revisit', 'after 1 days')
					 ->appendHttpEquiv('Content-Type', 'text/html; charset=windows-1251')
                     ->appendName('document-state', 'dynamic');					 					 					 		
?>
<?php $this->headScript()->appendFile("/js/swfupload/swfupload.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/swfupload.queue.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/fileprogress.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/handlers.js"); ?>

<?php 
if (is_object($found)) {
 	$title = $found->getLabel();
// 	$this->headTitle($title);
// 	echo $this->headTitle();
}
?>

<?php echo $this->headMeta();?>
<?php echo $this->headTitle(); ?>
<?php echo $this->headScript(); ?>
<?php echo $this->headLink(); ?>
<link href="/theme/css/swf.css" rel="stylesheet" media="screen">
<link rel="stylesheet/less" type="text/css" href="/theme/css/admin.less">
<link href="/theme/css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
	$this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
	$this->headScript()->appendFile('/js/admin-adaptive.js');
	$this->headScript()->appendFile('/js/less.min.js');
	echo $this->headScript();
?>
<script src="/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		smartColumns(); //запускаем функцию после загрузки страницы
		formResize(); //запускаем функцию после загрузки страницы
	});
	

	$(window).resize(function () { //запускаем функцию после каждого изменения размера экрана
		smartColumns();
		formResize();
	});
</script>

</head>
<body>
	<div class="header">
	    <div class="header-resize">
	    	<a class="logo" href="/admin"></a>
	    	<div class="main-menu">
	    		<?php echo $this->action('render', 'menu', 'admin'); ?>
	    			
	    	</div>
	    	<a class="log-out" href="/default/auth/logout">
	    		<span>Выйти</span>
	    	</a>
	    	<div class="clear"></div>
	    </div>
	</div>
	<div class="body">
		<div class="push1"></div>
		<div class="body-info">
			<h1>
				<?php echo $near; ?>
			</h1>
			<div class="breadcrubmbs">
				<?php
					echo $this->navigation(Zend_Registry::get('zf_nav_container'))->breadcrumbs()->setMinDepth(1)->setSeparator(' &rarr; ' . PHP_EOL)->renderStraight(); 
				?>
			</div>	
		</div>
		<?php echo $this->layout()->content; ?>
		<div class="push2"></div>
	</div>
	<div class="footer">
		<div class="footer-resize">
			&copy pht: Shmaliy 2013
		</div>
	</div>
</body>
</html>