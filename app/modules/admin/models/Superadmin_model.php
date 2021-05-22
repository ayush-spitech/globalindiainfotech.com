<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Superadmin_model extends MY_Model {

	function __construct(){
		parent::__construct();
		
	}

	
	/*----------------Modules------------*/
	function get_module_details($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*,t2.title as group_name';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'modules as t1');
		$this->db->join(tbl_prefix().'module_group as t2','t1.group_id=t2.group_id','LEFT');				
		$this->db->where($aWhere);
		$res=$this->db->get()->row();
		return $res;		
	}


	function get_module_list($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*,t2.title as group_name';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'modules as t1');
		$this->db->join(tbl_prefix().'module_group as t2','t1.group_id=t2.group_id','LEFT');				
		$this->db->where($aWhere);
		if(isset($_GET['search'])){
			if(isset($_GET['from_date']) && $_GET['from_date']!=''){
				$this->db->where('DATE(t1.created_date) >=',date('Y-m-d',strtotime($_GET['from_date'])));
			}
			if(isset($_GET['to_date']) && $_GET['to_date']!=''){
				$this->db->where('DATE(t1.created_date) <=',date('Y-m-d',strtotime($_GET['to_date'])));
			}
			$this->db->like('t1.title',$_GET['search_key']);
			$this->db->or_like('t1.url',$_GET['search_key']);	
			$this->db->or_like('t2.title',$_GET['search_key']);
		}		
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("group_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	function modules_add(){		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('module_id');
		$this->form_validation->set_rules('group_id',lang('Module Group'),'required');
		$this->form_validation->set_rules('title',lang('Module title'),'required');
		$this->form_validation->set_rules('url',lang('Module URL'),'required');
		$this->form_validation->set_rules('icon',lang('Module Icon'),'required');
		if($this->form_validation->run()==TRUE){
			$group_id=$this->input->post('group_id',TRUE);
			$title=$this->input->post('title',TRUE);
			$url=$this->input->post('url',TRUE);			
			$icon=$this->input->post('icon',TRUE);	
			$status=$this->input->post('status',TRUE);							
			$aInput=array(				
				"icon"=>filterValue($icon),	
				"group_id"=>filterValue($group_id),
				"title"=>filterValue($title),
				"status"=>filterValue($status),
				"url"=>filterValue($url)				
			);
			$_POST['rowId']=$editId;
			parent::setTable('modules');
			$lastId=parent::save($this->tbl_name,$aInput,'module_id',1); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}

	/*-----------Language----------------*/
	function get_language_list(){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'language as t1');
		$this->db->where('status','1');
		$res=$this->db->get()->result();
		return $res;
	}
	/*----------------Message Template------------*/
	function get_message_template_details($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'message_templates as t1');				
		$this->db->where($aWhere);
		$res=$this->db->get()->row();
		return $res;		
	}


	function get_message_template_list($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'message_templates as t1');					
		$this->db->where($aWhere);
		if(isset($_GET['search'])){
			if(isset($_GET['from_date']) && $_GET['from_date']!=''){
				$this->db->where('DATE(t1.created_date) >=',date('Y-m-d',strtotime($_GET['from_date'])));
			}
			if(isset($_GET['to_date']) && $_GET['to_date']!=''){
				$this->db->where('DATE(t1.created_date) <=',date('Y-m-d',strtotime($_GET['to_date'])));
			}
			$this->db->like('t1.template',trim($_GET['search_key']));
			$this->db->or_like('t1.subject',trim($_GET['search_key']));	
			$this->db->or_like('t1.from_name',trim($_GET['search_key']));
			$this->db->or_like('t1.from_email',trim($_GET['search_key']));
		}		
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	function message_template_add(){		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('id');
		$this->form_validation->set_rules('template',lang('Template Name'),'required');
		$this->form_validation->set_rules('from_name',lang('From Name'),'required');
		$this->form_validation->set_rules('subject',lang('Subject'),'required');
		$this->form_validation->set_rules('from_email',lang('From Email'),'required');
		if($this->form_validation->run()==TRUE){
			$template=$this->input->post('template',TRUE);
			$subject=$this->input->post('subject',TRUE);
			$from_name=$this->input->post('from_name',TRUE);			
			$from_email=$this->input->post('from_email',TRUE);		
			$message=$this->input->post('message');						
			$aInput=array(				
				"template"=>filterValue($template),	
				"subject"=>filterValue($subject),
				"from_name"=>filterValue($from_name),
				"from_email"=>filterValue($from_email),
				"cc"=>filterValue($cc),
				"bcc"=>filterValue($bcc),
				"message"=>$message				
			);
			$_POST['rowId']=$editId;
			parent::setTable('message_templates');
			$lastId=parent::save($this->tbl_name,$aInput,'id',1); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}

	/*------------General Settings---------------*/
	function save_settings(){
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');

		$site_logo='';		
		if (isset($_FILES['site_logo']['name']) && $_FILES['site_logo']['name'] != "") {
			$site_logo = upload_media('site_logo', 'jpg|jpeg|png|gif|bmp');
			if(isset($site_logo['error'])){
				$site_logo='';
				$response['is_error']=1;
				$response['msg']=$site_logo['error'];
			}else{
				$site_logo = $site_logo['file_name'];
			}				
            	//======(Checking Image)========================
			if (isset($_POST['old_site_logo']) && $_POST['old_site_logo']!='') {
				remove_media($_POST['old_site_logo']);
			}
		} else {				
			$site_logo =$_POST['old_site_logo'];
		}

		$site_favicon='';		
		if (isset($_FILES['site_favicon']['name']) && $_FILES['site_favicon']['name'] != "") {
			$site_favicon = upload_media('site_favicon', 'jpg|jpeg|png|gif|bmp');
			if(isset($site_favicon['error'])){
				$site_favicon='';
				$response['is_error']=1;
				$response['msg']=$site_favicon['error'];
			}else{
				$site_favicon = $site_favicon['file_name'];
			}				
            	//======(Checking Image)========================
			if (isset($_POST['old_site_favicon']) && $_POST['old_site_favicon']!='') {
				remove_media($_POST['old_site_favicon']);
			}
		} else {				
			$site_favicon =$_POST['old_site_favicon'];
		}

		$aInput=array(
			"record_limit" =>$_POST['record_limit'],
			"expiry_date" =>$_POST['expiry_date'],
			"reg_date" =>$_POST['reg_date'],
			"financial_year" =>$_POST['financial_year'],			
			"language" =>$_POST['language'],
			"is_multilingual" =>$_POST['is_multilingual'],			
			"site_name" =>$_POST['site_name'],
			"site_url" =>$_POST['site_url'],
			"site_email" =>$_POST['site_email'],
			"site_address" =>$_POST['site_address'],
			"site_contact" =>$_POST['site_contact'],
			"smtp_server" =>$_POST['smtp_server'],
			"smtp_user" =>$_POST['smtp_user'],
			"smtp_port" =>$_POST['smtp_port'],
			"smtp_pass" =>$_POST['smtp_pass'],
			"date_format" =>$_POST['date_format'],
			"site_logo" =>$site_logo,
			"site_favicon" =>$site_favicon,
			"google_analytics_code" =>$_POST['google_analytics_code'], 
			"bulk_sms_url" =>$_POST['bulk_sms_url'], 
			"bulk_sms_sender_id" =>$_POST['bulk_sms_sender_id'], 
			"bulk_sms_username" =>$_POST['bulk_sms_username'], 
			"bulk_sms_pass" =>$_POST['bulk_sms_pass'], 
			"bulk_sms_param1" =>$_POST['bulk_sms_param1'], 
			"bulk_sms_param2" =>$_POST['bulk_sms_param2'], 
			"bulk_sms_param3" =>$_POST['bulk_sms_param3'], 
			"bulk_sms_param4" =>$_POST['bulk_sms_param4'],
			"bulk_sms_param_value1" =>$_POST['bulk_sms_param_value1'], 
			"bulk_sms_param_value2" =>$_POST['bulk_sms_param_value2'], 
			"bulk_sms_param_value3" =>$_POST['bulk_sms_param_value3'], 
			"bulk_sms_param_value4" =>$_POST['bulk_sms_param_value4'],
			"decimal_seperator" =>$_POST['decimal_seperator'], 
			"thousand_seperator" =>$_POST['thousand_seperator'], 
			"currency" =>$_POST['currency'], 
			"currency_placement" =>$_POST['currency_placement'], 
			"decimal_places" =>$_POST['decimal_places'], 
			"version" =>$_POST['version'],
			"facebook" =>$_POST['facebook'], 
			"twitter" =>$_POST['twitter'], 
			"google_plus" =>$_POST['google_plus'], 
			"linkdin" =>$_POST['linkdin'], 
			"youtube" =>$_POST['youtube'],
			"is_underconstruction" =>$_POST['is_underconstruction'],
			"is_suspended" =>$_POST['is_suspended']
						
		);
		foreach($aInput as $key=>$value){
			$this->db->update(tbl_prefix().'config',array("value"=>$value),array("name"=>$key));
		}
		return $response;
	}
}
?>