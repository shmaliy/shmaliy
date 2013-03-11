<?php

echo implode(' &rarr; ', array_map(
		create_function('$a', 'return $a->getLabel();'),
	    $this->pages
	)
);