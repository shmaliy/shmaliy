<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<?php 
	$nav = Zend_Registry::get('zf_nav_container');
// 	echo '<pre>';
// 	var_export($nav->toArray());
// 	echo '</pre>';
 					
	$found = $nav->findOneBy('active', true);
					
	//print_r($found);
 									
	$auth = Zend_Auth::getInstance()->getStorage()->read();
	
?>
<html>
<head>
<?php $this->headTitle('Управление сайтом')->setSeparator(' | '); ?>

<?
	$this->headMeta()->appendName('keywords', 'OBS, optimal, shmaliy')
                     ->appendName('title', 'OBS')
                     ->appendName('description', 'OBS, description')
                     ->appendName('robots', 'index, follow')
                     ->appendName('revisit', 'after 1 days')
					 ->appendHttpEquiv('Content-Type', 'text/html; charset=windows-1251')
                     ->appendName('document-state', 'dynamic');					 					 					 		
?>

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
<link rel="stylesheet/less" type="text/css" href="/theme/css/admin.less">
<link href="/theme/css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
	$this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
	$this->headScript()->appendFile('/js/less.min.js');
	echo $this->headScript();
?>
<script src="/js/bootstrap.min.js"></script>
<script>
	function smartColumns() { //функция, подсчитывающая ширину колонок

	  //сброс ширины строки до 100% после изменения размера экрана
	  var display = $('.header-resize').width();
	  var logo = $('.logo').width();
	  var logout = $('.log-out').width();

	  //console.log(display);
	  
	  $(".main-menu").css({ 'width' : display - logo - logout-5 + 'px'});
	  $(".main-field").css({ 'width' : display - 35 - 120 + 'px'});
	}

	$(document).ready(function(){
		smartColumns(); //запускаем функцию после загрузки страницы
	});
	

	$(window).resize(function () { //запускаем функцию после каждого изменения размера экрана
	  smartColumns();
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
				<?php 
  					if (is_object($found)) {
						echo $title;
					}
				?>
			</h1>
			<div class="breadcrubmbs">
				<?php echo $this->navigation($nav)->breadcrumbs()->setMinDepth(1)->setSeparator(' &rarr;' . PHP_EOL); ?>
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