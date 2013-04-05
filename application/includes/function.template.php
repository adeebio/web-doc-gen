<?php

function template ($templateName,$tags) {
	
	// Load the requested template.
	
	ob_start();
	include ("application/templates/".$templateName.".php");
	$return = ob_get_contents();
	ob_end_clean();
	
	return($return);
	
};

?>