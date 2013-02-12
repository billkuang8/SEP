<?php

class File_functions extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function line_number_trim($filename) {
		$lines = 0;
		if (file_exists($filename)) {
			$data = file($filename);
			for ($count = 0; $count < count($data); $count++) {
				$line = $data[$count];
				if (trim($line) != '') {
					$lines++;
				}
			}
			return $lines;
		} else {
			return 0;
		}
	}
	
	function line_number($filename) {
		$lines = 0;
		if (file_exists($filename)) {
			$data = file($filename);
			for ($count = 0; $count < count($data); $count++) {
				$line = $data[$count];
				if ($line != '') {
					$lines++;
				}
			}
			return $lines;
		} else {
			return 0;
		}
	}
	
	function cutline($filename,$line_no=-1) { 

		$strip_return=FALSE; 
	
		$data=file($filename); 
		$pipe=fopen($filename,'w'); 
		$size=count($data); 
	
		if($line_no==-1) { 
			$skip=$size-1; 
		} else {
			$skip=$line_no-1; 
		}
		
		for($line=0;$line<$size;$line++) { 
			if($line!=$skip) {
				fputs($pipe,$data[$line]); 
			} else {
				fputs($pipe,"        
"); 
				$strip_return=TRUE; 
			}
		}
		return $strip_return; 
	} 

	
	function load_file($filename) {
		if(file_exists($filename) && filesize($filename) > 0){  
			$handle = fopen($filename, "r");  
			$contents = fread($handle, filesize($filename));  
			fclose($handle);  
			return $contents; 
		} else {
			return '';
		}
	}
	
	function last_line($filename) {
		if (file_exists($filename) && filesize($filename) > 0) {
			$data = file($filename);
			if ($this->line_number_trim($filename) > 0) {
				$end = 1;
				$line = $data[count($data)-$end];
				while (trim($line) == '') {
					$end++;
					$line = $data[count($data)-$end];
				}
				return $line;
			} else {
				return '<span style="margin-left: 20px;">Thread Empty.</span>';
			}
		} else {
			return '<span style="margin-left: 20px;">Thread Empty.</span>';
		}
	}
	
	function sort_file($filename) {
		$data = file($filename);
		sort($data);
		$handle = fopen($filename, 'w');
		for ($i = 0; $i < count($data); $i++) {
			fwrite($handle, $data[$i]);
		}
		fclose($handle);
	}
	
	function is_allowed($filename) {
		$allowed = array('jpg', 'jpeg', 'tif', 'png', 'gif', 'docx', 'doc', 'ppt', 'pptx', 'xls', 'xlsx', 'bmp', 'tiff', 'tif', 'pdf', 'zip', 'rar');
		$filename_rev = strrev($filename);
		$position = strpos($filename_rev, '.');
		$extension = strrev(substr($filename_rev, 0, $position));
		$return = FALSE;
		
		for ($index = 0; $index < count($allowed); $index++) {
			if (strtolower($extension) == $allowed[$index]) {
				$return = TRUE;
				break;
			}
		}
		
		return $return;
	}
}

?>