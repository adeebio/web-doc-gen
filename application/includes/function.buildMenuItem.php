<?php

function buildMenuItem ($folderArray) {
	
	$returnString = "";
	
	foreach ($folderArray["folderContents"] as $value) {
		
		if ($value["folderRef"]==true) { // Folder.
			
			$returnString = $returnString . template ("item.menuFolder",array(
				
				"title" => $value["nameSpaced"],
				
				"body" => buildMenuItem($value),
				
				"path" => $value["path"]
				
			));
			
		} else { // File.
			
			$returnString = $returnString . template ("item.menuFile",array(
				
				"title" => $value["nameSpaced"],
				
				"path" => $value["path"]
				
			));
			
		};
		
	};
	
	return $returnString;
	
};

?>