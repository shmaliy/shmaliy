<?php echo $this->doctype('XHTML1_TRANSITIONAL'); ?>
<html>
<head>
<?php $this->headTitle('Авторизация'); ?>
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
<link href="/theme/css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
	$this->headScript()->appendFile('/js/jquery-1.8.1.min.js');
	$this->headScript()->appendFile('/js/less.min.js');
	echo $this->headScript();
?>
<script src="/js/bootstrap.min.js"></script>
<script>
	function smartColumns() { //функция, подсчитывающая ширину колонок

	  	var display = $('body').width();
		var displayH = $('html').height();
	 	var wrapperH = $('.form-wrapper').height();

	  	//console.log(wrapperH);
	  	var pTop =  Math.floor(displayH/2) - Math.floor(wrapperH/2);
	  	//console.log(displayH);
	  	
	  
		$("body").css({ 'padding-top' : pTop + 'px', 'height': displayH - pTop + 'px'});
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
	<div class="form-wrapper">
		<div class="form-wrapper-header"><span>Авторизация</span></div>
		<?php echo $this->layout()->content;?>
	</div>
</body>
</html>