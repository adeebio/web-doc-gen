<?php

function splitFileName ($filename) {
	
	$ext = substr($filename, (strrpos($filename, ".")+1));
	
	$name = substr($filename, 0, strrpos($filename, "."));
	
	return array(
	
		"name"	=>	$name,
		"ext"	=>	$ext,
	
	);
	
};

?>