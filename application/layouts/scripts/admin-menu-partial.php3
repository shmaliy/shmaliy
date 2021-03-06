<?
function isActivePage($page)
{
	return ($page->isActive() /*|| hasActiveInChilds($page)*/ || $page->getHref() == rtrim($_SERVER['REQUEST_URI'], '/')) ? true : false;
}

function hasActiveInChilds($page)
{
	$has = false;
	if (count($page)) {
		foreach ($page as $subpage) {
			if (isActivePage($subpage)) {
				$has = true;
				break;
			}
		}
	}

	return $has;


}



function renderLeftSubMain($page, $level = 0) {
    if (count($page)): ?>
    <ul class="navigation<?php echo ($level != 0) ? '_' . $level : ''; ?>">
    	<?php $level++; ?>
        <?php foreach ($page as $lv1): ?>
        <li id="menu_<?php echo $lv1->getId();?>" onmouseover="$('#menu_<?php echo $lv1->getId();?> > ul').show();" onmouseout="$('#menu_<?php echo $lv1->getId();?> > ul').hide();">
        	<?php $prop = $lv1->getCustomProperties();?>
            <a class="<?php echo (isActivePage($lv1)) ? "active_main" : ""; ?> <?php echo (hasActiveInChilds($lv1)) ? "active_branch" : ""; ?>" href="<?php echo $lv1->getHref(); ?>">
            	<img src="<?php echo $prop['img'];?>">
                <span><?php echo $lv1->getLabel(); ?></span>
                <div class="clear"></div>
            </a>
            <?php renderLeftSubMain($lv1, $level); ?>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif;
}

foreach ($this->container as $page) {
	renderLeftSubMain($page);
}
	
?>
