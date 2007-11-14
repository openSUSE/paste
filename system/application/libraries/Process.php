<?php

include_once('geshi/geshi.php');

Class Process {
	
	function syntax($source, $lang) {
		$source = $source;
		$language = $lang;	
			
		$geshi =& new Geshi($source, $lang);
		$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
		$geshi->set_header_type(GESHI_HEADER_DIV);
	
		return $geshi->parse_code();
	}
}

?>