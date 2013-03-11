<?php
$map = array_map(
	create_function('$a', 'return $a->getLabel();'),
	$this->pages
);

$map = array_reverse($map);

foreach ($map as $page) {
	$this->headTitle($page);
}


