<?php

function buildDirectory ($path,$array) {
	
	// Delare return array.
	
	$returnArray = $array;
	
	// Begin...
	
	if (is_dir($path)) { // Check the path is a directory.
		
		// Focus on the directory.
		
		chdir($path);
		
		 // Get the handle of the directory and then...
		
		if ($handle = opendir('.')) {
			
			// Scan through all items in the directory (includes files and folders).
			
	    	while (($item = readdir($handle)) !== false) { 
				
				if ($item[0]!=".") { // Ignore invisible items.
					
					if (!is_dir($item)) { // Item is a file.
						
						// Find the position of '|'
						
						$divPos = strpos($item,"|");
						
						// Get the file order number as a number.
						
						//if (is_string(substr($item, 0, $divPos))) { // Order number is a string. // Doesn't seem to be needed...
							
							$itemOrderNumber = substr($item, 0, $divPos);
							
						//};
						
						// Get the file name parts.
						
						$fileName = substr($item, ($divPos+1));
						
						$fileNameParts = splitFileName ($fileName);
						
						// Add file to $returnArray.
						
						$returnArray[$itemOrderNumber] = array (
							
							"type"			=>	"file",
							"order"			=>	$itemOrderNumber,
							"name"			=>	$fileNameParts["name"],
							"nameSpaced"	=>	str_replace(" ", "&nbsp;", $fileNameParts["name"]),
							"ext"			=>	$fileNameParts["ext"],
							"path"			=>	$path.$item,
							"folderRef"		=>	false
							
						);
						
						// Check to see if file refers to a folder
						
						if (is_dir($path.$itemOrderNumber."F|".$fileNameParts["name"]."/")) {
							
							$returnArray[$itemOrderNumber]["folderRef"] = true;
							
							$returnArray[$itemOrderNumber]["folderPath"] = $path.$itemOrderNumber."F|".$fileNameParts["name"]."/";
							
							$returnArray[$itemOrderNumber]["folderContents"] = buildDirectory($path.$itemOrderNumber."F|".$fileNameParts["name"]."/",array());
							
							// Focus back on the directory.
							
							chdir($path);
							
						};
						
					};					
				};
				
			};
			
			// Close the directory handle
			
			closedir($handle);
			
			// Reset current working dirrectory
			
			chdir(D__SITE_PATH);
		};
		
	};
	
	return($returnArray);
	
};

?>