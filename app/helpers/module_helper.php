<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function update_config($aData){
	$ci = & get_instance();
	//debug($aData);
	foreach ($aData as $key => $value) {
		if(trim($value)!='' && $value!='null'){
			$ci->db->update(tbl_prefix().'config',array('value'=>$value),array('name'=>$key));
		}
		
	}
	
}

function suspended(){
	$ci = & get_instance();
	$data['title']="Account Suspended";	
	$data['menu']="home";
	$ci->load->view('suspended',$data);
}
function page_not_found(){
	$ci = & get_instance();
	$data['title']="Page Not Found";
	$data['menu']="home";
	$ci->load->view('404',$data);
}
function underconstruction(){
	$ci = & get_instance();
	$data['title']="Under Construction";	
	$ci->load->view('underconstruction',$data);
}


function load_language($language=''){
	$ci = & get_instance();
	
	if($language==''){
		$language=config_item('language');		
	}else{
		$ci->session->set_userdata('active_language',$language);
		$language=$ci->session->userdata('active_language');
	}	
	$ci->lang->load($language,$language);  // file,folder
}

function my_menu($user_id = 0)
{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(tbl_prefix() . 'module_group');
	$ci->db->order_by('group_id', 'asc');
	$qry = $ci->db->get();
	$results = $qry->result();
	foreach ($results as $key => $value) {
		$ci->db->select('first.*,second.*');
		$ci->db->from(tbl_prefix() . 'user_permission as first');
		$ci->db->join(tbl_prefix() . 'modules as second', 'first.module_id=second.module_id');
		if ($user_id > 0) {
			$ci->db->where('user_id', $user_id);
		}
		$ci->db->where('view_permission', '1');
		$ci->db->where('second.group_id', $value->group_id);
		$ci->db->where('second.status','1');
		$ci->db->order_by('second.sequence_no', 'asc');
		$qry = $ci->db->get();
		$results[$key]->aModules = $qry->result();
	}
	return $results;
}

function my_all_menu()
{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(tbl_prefix() . 'module_group');
	$ci->db->order_by('sequence_no', 'asc');
	$qry = $ci->db->get();
	$results = $qry->result();
	foreach ($results as $key => $value) {
		$ci->db->select('*');
		$ci->db->from(tbl_prefix() . 'modules');
		$ci->db->where('group_id', $value->group_id);
		$ci->db->where('status','1');
		$ci->db->order_by('sequence_no', 'asc');
		$qry = $ci->db->get();
		$results[$key]->aModules = $qry->result();
	}
	return $results;
}

/*
 * How to use
 * 1)  check_permission(7, 'view', 1);
 *  or
 * 2)if(check_permission(7, 'view')){
 * do something
 * }
 */

function check_permission($module_id = 0, $permission, $is_redirect = 0)
{
	$isAllowed = 0;
	if (isset($_SESSION["aUser"]) && !empty($_SESSION["aUser"])) {
		$isAllowed = 1;
	} else if ($_SESSION["aUser"]->user_id > 1) {
		$row = get_row('user_permission', array('module_id' => $module_id, 'user_id' => $_SESSION["aUser"]->user_id));
		$isAllowed = $row[$permission . '_permission'];
	}
	if ($is_redirect && $isAllowed == 0) {
		if (isset($_SESSION['aUser'])) {
			redirect(base_url() . 'login/logout/');
		}else {
			redirect(base_url());
		}
	} else {
		return $isAllowed;
	}
}

function access_denied()
{
	redirect(base_url());
}
