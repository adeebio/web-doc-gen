<?php

class parser {
	
	/*
	|--------------------------------------------------
	| ARRAY: SPECIAL CHARACTERS
	|--------------------------------------------------
	*/
	
	private $specialCharacters = array (
		
		array ( // New line.
			
			"syntax"				=>		"\\n|",
			"syntaxReplacement"		=>		"<br />"
			
		),
		
		array ( // New line.
			
			"syntax"				=>		"\\nbsp|",
			"syntaxReplacement"		=>		"&nbsp;"
			
		),
		
		array ( // New line.
			
			"syntax"				=>		"\\bull|",
			"syntaxReplacement"		=>		"&bull;"
			
		),
		
	);
	
	/*
	|--------------------------------------------------
	| ARRAY: ELEMENTS
	|--------------------------------------------------
	*/
	
	private $elements = array (
		
		/*
		|--------------------------------------------------
		| MISC
		|--------------------------------------------------
		*/
		
		array ( // Bold.
			
			"syntax"				=>		"\\b{",
			"tagOpen"				=>		"<span class=\"b\">",
			"tagClose"				=>		"</span>"
			
		),
		
		array ( // Italic.
			
			"syntax"				=>		"\\i{",
			"tagOpen"				=>		"<span class=\"i\">",
			"tagClose"				=>		"</span>"
			
		),
		
		array ( // Underlined.
			
			"syntax"				=>		"\\u{",
			"tagOpen"				=>		"<span class=\"u\">",
			"tagClose"				=>		"</span>"
			
		),
		
		/*
		|--------------------------------------------------
		| HEADERS
		|--------------------------------------------------
		*/
		
		array ( // h1.
			
			"syntax"				=>		"\\h1{",
			"tagOpen"				=>		"<div class=\"h1\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h1_pt.
			
			"syntax"				=>		"\\h1_pt{",
			"tagOpen"				=>		"<div class=\"h1_pt\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h1_p.
			
			"syntax"				=>		"\\h1_p{",
			"tagOpen"				=>		"<div class=\"h1_p\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h1_pb.
			
			"syntax"				=>		"\\h1_pb{",
			"tagOpen"				=>		"<div class=\"h1_pb\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h2.
			
			"syntax"				=>		"\\h2{",
			"tagOpen"				=>		"<div class=\"h2\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h2_pt.
			
			"syntax"				=>		"\\h2_pt{",
			"tagOpen"				=>		"<div class=\"h2_pt\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h2_p.
			
			"syntax"				=>		"\\h2_p{",
			"tagOpen"				=>		"<div class=\"h2_p\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h2_pb.
			
			"syntax"				=>		"\\h2_pb{",
			"tagOpen"				=>		"<div class=\"h2_pb\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h3.
			
			"syntax"				=>		"\\h3{",
			"tagOpen"				=>		"<div class=\"h3\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h3_pt.
			
			"syntax"				=>		"\\h3_pt{",
			"tagOpen"				=>		"<div class=\"h3_pt\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h3_p.
			
			"syntax"				=>		"\\h3_p{",
			"tagOpen"				=>		"<div class=\"h3_p\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // h3_pb.
			
			"syntax"				=>		"\\h3_pb{",
			"tagOpen"				=>		"<div class=\"h3_pb\">",
			"tagClose"				=>		"</div>"
			
		),
		
		/*
		|--------------------------------------------------
		| BOXES
		|--------------------------------------------------
		*/
		
		array ( // Grey Box.
			
			"syntax"				=>		"\\boxGrey{",
			"tagOpen"				=>		"<div class=\"boxGrey\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // Red Box.
			
			"syntax"				=>		"\\boxRed{",
			"tagOpen"				=>		"<div class=\"boxRed\">",
			"tagClose"				=>		"</div>"
			
		),
		
		array ( // Green Box.
			
			"syntax"				=>		"\\boxGreen{",
			"tagOpen"				=>		"<div class=\"boxGreen\">",
			"tagClose"				=>		"</div>"
			
		),
		
		/*
		|--------------------------------------------------
		| CODE
		|--------------------------------------------------
		*/
		
		array ( // Code.
			
			"syntax"				=>		"\\code{",
			"tagOpen"				=>		"<pre class=\"code\">",
			"tagClose"				=>		"</pre>"
			
		),
			
	);
	
	/*
	|--------------------------------------------------
	| ARRAY: ELEMENT END TAGS
	|--------------------------------------------------
	*/
	
	private $elementEndTags = array ();
	
	/*
	|--------------------------------------------------
	| PUBLIC FUNCTION parseFile
	|--------------------------------------------------
	*/
	
	public function parseFile ( $args = array() ) {
		
		// Declare variables.
		
		$fileAsArray;
		
		// Check if a file path is given and that it exists.
		
		if ( (!isset($args["path"])) || (!file_exists($args["path"])) ) { return false; };
		
		// Import file to an array.
		
		$fileAsArray = file($args["path"]);
		
		// Call the parseArray() function.
		
		return $this->parseArray(array("array"=>$fileAsArray));
		
	}
	
	/*
	|--------------------------------------------------
	| PUBLIC FUNCTION parseArray
	|--------------------------------------------------
	*/
	
	public function parseArray ( $args = array() ) {
		
		// Declare variables.
		
		$givenArray;
		
		// Check if an array is given. If so, copy array over. If not, return false.
		
		if ( isset($args["array"]) ) { $givenArray = $args["array"]; } else { return false; };
		
		/*
		|--------------------------------------------------
		| REPLACEMENTS
		|--------------------------------------------------
		*/
		
		// Remove leading and trailing spaces.
		
		$givenArray = $this->replace_spaces($givenArray);
		
		// Remove empty lines.
		
		$givenArray = $this->replace_emptyLines($givenArray);
		
		// Replace HTML special tags.
		
		$givenArray = $this->replace_HTMLSpecialTags($givenArray);
		
		// Replace special characters.
		
		$givenArray = $this->replace_specialCharacters($givenArray);
		
		// Replace element tags.
		
		$givenArray = $this->replace_arrayTags($givenArray);
		
		/*
		|--------------------------------------------------
		| PRINT ARRAY
		|--------------------------------------------------
		*/
		
		foreach ($givenArray as $key => $value) {
			
			for ($i = 0; $i < strlen($givenArray[$key]); $i++) {
			
				echo $givenArray[$key][$i];
				
			};
			
		};
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_spaces
	|--------------------------------------------------
	*/
	
	private function replace_spaces ($array) {
		
		return $array;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_emptyLines
	|--------------------------------------------------
	*/
	
	private function replace_emptyLines ($array) {
		
		return $array;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_HTMLSpecialTags
	|--------------------------------------------------
	*/
	
	private function replace_HTMLSpecialTags ($array) {
		
		foreach ($array as $key => $value) {
			
			$array[$key] = htmlspecialchars($array[$key]);
			
		};
		
		return $array;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_specialCharacters
	|--------------------------------------------------
	*/
	
	private function replace_specialCharacters ($array) {
		
		// Loop through each special character.
		
		foreach ($this->specialCharacters as $key => $value) {
			
			// Loop through each string element in array and replace all instances of the special character under question.
			
			foreach ($array as $key2 => $value2) {
				
				$array[$key2] = str_replace($this->specialCharacters[$key]["syntax"], $this->specialCharacters[$key]["syntaxReplacement"], $array[$key2]);
				
			};
			
		};
		
		return $array;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_arrayTags
	|--------------------------------------------------
	*/
	
	private function replace_arrayTags ($array) {
		
		foreach ($array as $key => $value) {
			
			$array[$key] = $this->replace_stringTags($array[$key]);
			
		};
		
		return $array;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_stringTags
	|--------------------------------------------------
	*/
	
	private function replace_stringTags ($string) {
		
		for ($i = 0; $i < strlen($string); $i++) {
		
			if ($string[$i]=="\\") {
				
				$string = $this->replace_tagOpen($string, $i);
				
			};
		
			if ($string[$i]=="}") {
				
				$string = $this->replace_tagClose($string, $i);
				
			};
			
		};
		
		return $string;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_tagOpen
	|--------------------------------------------------
	*/
	
	private function replace_tagOpen ($string, $posBS) {
		
		for ($i = 0; $i < count($this->elements); $i++) {
		
			$syntaxLength = strlen($this->elements[$i]["syntax"]);
			
			$stringLeading = substr($string, 0, $posBS);
			
			$stringSyntaxPotential = substr($string, $posBS, $syntaxLength);
			
			$stringTrailing = substr($string, ($posBS+$syntaxLength));
			
			if ($this->elements[$i]["syntax"]==$stringSyntaxPotential) {
				
				array_push($this->elementEndTags, $this->elements[$i]["tagClose"]);
				
				return $stringLeading . $this->elements[$i]["tagOpen"] . $stringTrailing;
				
			};
		
		};
		
		return $string;
		
	}
	
	/*
	|--------------------------------------------------
	| PRIVATE FUNCTION replace_tagClose
	|--------------------------------------------------
	*/
	
	private function replace_tagClose ($string, $posCB) {
		
		$stringLeading = substr($string, 0, $posCB);
		
		$tagClose = array_pop($this->elementEndTags);
		
		$stringTrailing = substr($string, (($posCB+$syntaxLength)+1));
		
		return $stringLeading . $tagClose . $stringTrailing;
		
	}
	
};

?>