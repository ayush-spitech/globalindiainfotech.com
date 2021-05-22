<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');


function file_write($file_path,$str_content){
	if(file_exists($file_path)){
		chmod($file_path,0777);
		$myfile = fopen($file_path, "w");
		fwrite($myfile, $str_content);
		fclose($myfile);
		return true;
	}else{
		return false;
	}
}