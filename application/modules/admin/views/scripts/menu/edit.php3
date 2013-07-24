<div class="main-field">
	<?php echo $this->form; ?>
</div>
<div class="controls">
	<div class="wrapper">
		<ul>
			<li><a href="#" class="apply"><span>Применить</span></a></li>
			<li><a href="#" class="save"><span>Сохранить</span></a></li>
			<li><a href="/<?php echo $this->m; ?>/<?php echo $this->c; ?>" class="cancel"><span>Отменить</span></a></li>
		</ul>
		<div class="clear"></div>
	
	</div>
	
</div>

<div id="image-load-container" style="display:none;">
	<?php echo $this->action('load-menu-image', 'files', 'default'); ?>
</div>
<div class="clear"></div>

<script>
	function replaceImageController() {
		var imageHtml = $('#image-load-container').html();

		$('#image > .form-composite-element-img').html(imageHtml);
	}

	replaceImageController();
	
</script>