<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enquiry_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('enquiry');
	}
	

	function add(){		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('enquiry_id');

		$this->form_validation->set_rules('message','Message','required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');	
		$this->form_validation->set_rules('mobile','Mobile','required');
		$this->form_validation->set_rules('service','Service','required');
						
		if($this->form_validation->run()==TRUE){									
			$name=$this->input->post('name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);
			$subject=$this->input->post('subject',TRUE);
			$service=$this->input->post('service',TRUE);	
			$message=$this->input->post('message',TRUE);					
			$aInput=array(										
				"name"=>filterValue($name),				
				"mobile"=>filterValue($mobile),
				"email"=>filterValue($email),
				"subject"=>filterValue($subject),
				"message"=>filterValue($message),
				"service"=>filterValue($service)
			);			
			$_POST['rowId']=$editId;
			$lastId=parent::save($this->tbl_name,$aInput,'enquiry_id'); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'enquiry as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('name',$_GET['search_key']);
			$this->db->or_like('mobile',$_GET['search_key']);
			$this->db->or_like('email',$_GET['search_key']);			
		}
		if(isset($_GET['from_date']) && $_GET['from_date']!=''){
			$this->db->where('DATE(created_date) >=',$_GET['from_date']);			
		}
		if(isset($_GET['to_date']) && $_GET['to_date']!=''){
			$this->db->where('DATE(created_date) <=',$_GET['to_date']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("enquiry_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}
}
?>