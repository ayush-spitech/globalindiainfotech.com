<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Application_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('job_application');
	}


	function application_details($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*,t2.job_title';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'job_application as t1');	
		$this->db->join(tbl_prefix().'career as t2','t1.job_id=t2.career_id','LEFT');
		$res=$this->db->get()->row();
		return $res;
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('application_id');
		$this->form_validation->set_rules('caption',lang('Image Caption'),"required");
		if($this->form_validation->run()==TRUE){									
			$caption=$this->input->post('caption',TRUE);	
			$short_description=$this->input->post('short_description',TRUE);					
			$status=$this->input->post('status',TRUE);
			$aInput=array(	
				"image"=>$image,
				"caption"=>filterValue($caption),
				"short_description"=>filterValue($short_description),			
				"status"=>filterValue($status)
			);
			$_POST['rowId']=$editId;			
			$lastId=parent::save($this->tbl_name,$aInput,'application_id'); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '',$aWhere=array()){
		if($str_select==''){
			$str_select='t1.*,t2.job_title';
		}
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'job_application as t1');	
		$this->db->join(tbl_prefix().'career as t2','t1.job_id=t2.career_id','LEFT');			
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('caption',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("application_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'job_application as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("application_id",'desc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}
}
?>