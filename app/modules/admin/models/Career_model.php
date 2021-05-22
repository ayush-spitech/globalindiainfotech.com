<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Career_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('career');
	}

	function add(){			
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('career_id');
		$this->form_validation->set_rules('job_title',lang('Job Title'),"required");
		$this->form_validation->set_rules('posts',lang('Posts'),"required");
		if($this->form_validation->run()==TRUE){									
			$job_title=$this->input->post('job_title',TRUE);	
			$job_description=$this->input->post('job_description',TRUE);					
			$status=$this->input->post('status',TRUE);
			$posts=$this->input->post('posts',TRUE);	
			
			$aInput=array(	
				"posts"=>filterValue($posts),
				"job_title"=>filterValue($job_title),
				"job_description"=>filterValue($job_description),			
				"status"=>filterValue($status)
			);
			$_POST['rowId']=$editId;			
			$lastId=parent::save($this->tbl_name,$aInput,'career_id'); 
			$response['msg']=$lastId;

		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'career as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('job_title',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("career_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'career as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("career_id",'desc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}
}
?>