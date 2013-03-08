<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html>
<head>
<?php $this->headTitle('')->setSeparator(' | '); ?>
<?
	$this->headMeta()->appendName('keywords', 'OBS, optimal, shmaliy')
                     ->appendName('title', 'OBS')
                     ->appendName('description', 'OBS, description')
                     ->appendName('robots', 'index, follow')
                     ->appendName('revisit', 'after 1 days')
					 ->appendHttpEquiv('Content-Type', 'text/html; charset=windows-1251')
                     ->appendName('document-state', 'dynamic');					 					 					 		
?>
<?php echo $this->headMeta();?>
<?php echo $this->headTitle(); ?>
<?php echo $this->headScript(); ?>
<?php echo $this->headLink(); ?>
<link rel="stylesheet/less" type="text/css" href="/theme/css/admin.less">
<?php
	$this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
	$this->headScript()->appendFile('/js/less.min.js');
	echo $this->headScript();
?>
<script>
	function smartColumns() { //функция, подсчитывающая ширину колонок

	  //сброс ширины строки до 100% после изменения размера экрана
	  var display = $('.header-resize').width();
	  var logo = $('.logo').width();
	  var logout = $('.log-out').width();

	  console.log(display);
	  
	  $(".main-menu").css({ 'width' : display - logo - logout-5 + 'px'});
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
	    	<div class="main-menu"><?php echo $this->action('render', 'menu', 'admin'); ?></div>
	    	<a class="log-out" href="/logout"></a>
	    	<div class="clear"></div>
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
		    
			$auth = Zend_Auth::getInstance()->getStorage()->read();
			
			echo '<pre>';
			print_r($auth);
			echo '</pre>';
	
		    if (Zend_Auth::getInstance()->hasIdentity()) : ?>
		    	<a href="/default/auth/logout">Свалить</a>
		    <?php endif ?>

			<?php echo $this->layout()->content;?>
		<div class="push2"></div>
	</div>
	<div class="footer">
		<div class="footer-resize">
			
		</div>
	</div>
</body>
</html>