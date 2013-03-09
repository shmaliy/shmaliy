<div class="main-field">
	<?php 
		echo $this->partial('menu-greed.php3', array('content' => $this->content));
	?>
</div>
<div class="controls">
	<div class="wrapper">
		<ul>
			<li><a href="<?php echo $this->url(
											array(
												'module' => $this->m, 
												'controller' => $this->c, 
												'action' => 'edit', 
												'id' => 'new'
											)
							);?>" class="add"><span>Создать</span></a></li>
			<li><a href="#" class="copy"><span>Копировать</span></a></li>
			<li><a href="#" class="move"><span>Переместить</span></a></li>
			<li><a href="#" class="delete"><span>Удалить</span></a></li>
		</ul>
		<div class="clear"></div>
	
	</div>
	
</div>
<div class="clear"></div>
