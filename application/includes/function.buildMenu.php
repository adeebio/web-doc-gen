<?php

function buildMenu () {
	
	// Build directory of the 'contents' folder
	
	$contents = buildDirectory(D__SITE_PATH."contents/",array());
	
	// Print items
	
	foreach ($contents as $value) {
		
		if ($value["order"]==1) { $initiallySelected = "initiallySelected"; }
		else { $initiallySelected = ""; };
		
		if ($value["folderRef"]==true) { // Folder.
			
			echo template ("item.menuFolder",array(
				
				"title" => $value["nameSpaced"],
				
				"body" => buildMenuItem($value),
				
				"path" => $value["path"],
				
				"initiallySelected" => $initiallySelected
				
			));
			
		} else { // File.
			
			echo template ("item.menuFile",array(
				
				"title" => $value["nameSpaced"],
				
				"path" => $value["path"],
				
				"initiallySelected" => $initiallySelected
				
			));
			
		};
		
	};
		
};

?>