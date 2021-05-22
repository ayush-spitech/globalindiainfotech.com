<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends MY_Model {

	function __construct(){
		parent::__construct();		
	}	

	function get_languages(){
		parent::setTable('language');
		$res=parent::getRecords('t1.*',array('status'=>'1'));
		return $res;
	}

}