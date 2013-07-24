<!DOCTYPE html>
<?php //echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php $this->headTitle('Online catalogue')->setSeparator(' | '); ?>

<?php //$this->headLink()->appendStylesheet('/theme/css/style.css');
//       $this->headLink()->appendStylesheet('/theme/css/style.less')
// 					   ->headLink(array('rel' => 'favicon', 'href' => '/favicon.png'), 'PREPEND'); ?>
<?
	$this->headMeta()->appendName('keywords', '')
                     ->appendName('description', '')
                     ->appendName('robots', 'index, follow')
                     ->appendName('revisit', 'after 1 days')
					 ->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8')
                     ->appendName('document-state', 'dynamic');					 					 					 		
?>
<?php $this->headScript()->appendFile("/js/swfupload/swfupload.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/swfupload.queue.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/fileprogress.js"); ?>
<?php $this->headScript()->appendFile("/js/swfupload/js/handlers.js"); ?>

<?php echo $this->headMeta();?>
<?php echo $this->headTitle(); ?>
<?php echo $this->headLink(); ?>
<link rel="stylesheet/less" type="text/css" href="/theme/css/style.less">
<?php
	$this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
	$this->headScript()->appendFile('/js/swfupload/swfupload.js');
	$this->headScript()->appendFile('/js/less.min.js');
	echo $this->headScript();
?>
<link href="/theme/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="/theme/css/swf.css" rel="stylesheet" media="screen">
<script src="/js/bootstrap.min.js"></script>
<script>
var parser = new(less.Parser)({
    paths: ['/theme/css'], // указывает пути поиска для директив @import
    filename: 'style.less' // указывает имя файла, для улучшения сообщений об ошибках
});
</script>

</head>
<body>
<div class="header">
    <div class="header-resize">
    	<div class="main-menu"><?php echo $this->action('index', 'index', 'menu'); ?></div>
    </div>
</div>
<div class="body">
	<div class="push1"></div>
	
	 
	
	<?php
	    // Применяем уже знакомый метод для проверки авторизации пользователя
	    /*if (Zend_Auth::getInstance()->hasIdentity()) {
	        $url = $this->url(array('module'=> 'default', 'controller'=>'auth', 'action'=>'logout'));
	        // если пользователь авторизирован, показываем ему кнопку "Выход"
	        echo "<a href=\"{$url}\">Выход</a>";
	    }*/
	    
	    if (Zend_Auth::getInstance()->hasIdentity()) : ?>
	    	<a href="/default/auth/logout">Свалить</a>
	    <?php endif ?>
	    
	
	
	<?php //echo $this->Seo();?>
	<?php if ($_SERVER['REQUEST_URI'] != '/' && $_SERVER['REQUEST_URI'] != '') : ?>
	<div class="breadcrumbs">
		<?php
	        echo $this->navigation(Zend_Registry::get('NAVIGATION'))
	           	      ->breadcrumbs()->setMinDepth(1)->setSeparator(' &rarr;' . PHP_EOL);
  			?>
	</div>
	<?php endif; ?>
	
	<?php echo $this->layout()->content;?>
		
    <div class="push2"></div>    
</div>
<div class="footer">
	<div class="footer-resize">
		
	</div>
</div>

<script>
$(document).ready(function () {
	$('li > a.hidden').parent().css('display', 'none');
});
</script>

</body>
</html>