<?php

/*
|--------------------------------------------------
| DEFINITIONS
|--------------------------------------------------
*/

define ("D__SITE_PATH",realpath(dirname(__FILE__))."/");

/*
|--------------------------------------------------
| BRING IN APPLICATION FUNCTIONS
|--------------------------------------------------
*/

include("application/includes/class.parser.php"); $parser = new parser;

include("application/includes/function.buildDirectory.php");

include("application/includes/function.buildMenu.php");

include("application/includes/function.buildMenuItem.php");

include("application/includes/function.splitFileName.php");

include("application/includes/function.tag.php");

include("application/includes/function.template.php");

/*
|--------------------------------------------------
| SEE WHAT HAS BEEN REQUESTED AND GO!
|--------------------------------------------------
*/

if (isset($_GET["contentPath"])) { // Content.
	
	if (file_exists($_GET["contentPath"])) {
		
		$parser->parseFile(array("path"=>$_GET["contentPath"]));
		
	} else {
		
		echo "Opps, file not found...";
		
	};
	
} elseif (isset($_GET["initialContent"])) { // Initial content.
	
	$findInitialPage = buildDirectory(D__SITE_PATH."contents/",array());
	
	$parser->parseFile(array("path"=>$findInitialPage[1]["path"]));
	
} else { // The Documentation Application.
	
	include("application/includes/script.index.php");
	
};

?>