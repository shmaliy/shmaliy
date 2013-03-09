<table class="table table-hover greed table-bordered">
	<thead>
		<tr>
			<td>#</td>
			<td></td>
			<td>Название</td>
			<td>Картинка</td>
			<td>Ссылка</td>
			<td>Роль</td>
			<td>Родитель</td>
			<td>Опубликована</td>
			<td>Дата создания</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->content as $item) : ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td>
				<input type="checkbox" name="menu-item[]" id="item-<?php echo $item['id'];?>" /> 
			</td>
			<td><a href="<?php echo $this->url(array('action' => 'edit', 'controller' => 'menu', 'module' => 'admin', 'id' => $item['id']));?>"><?php echo $item['title'];?></a></td>
			<td>
				<?php if (!empty($item['img'])) : ?>
					<img src="<?php echo $item['img'];?>" class="img-polaroid">
				<?php endif;?>
			</td>
			<td><?php echo $item['href'];?></td>
			<td><?php echo $item['zf_roles_title'];?></td>
			<td><?php echo ($item['zf_menu_title'] != NULL) ? $item['zf_menu_title'] : 'Нет'; ?></td>
			<td>Опубликована</td>
			<td><?php echo date("h:i:m d m Y", $item['created_ts']); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>	
</table>
