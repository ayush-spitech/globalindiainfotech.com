<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Faculty_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('faculty');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('faculty_id');
		$this->form_validation->set_rules('faculty_name',lang('Faculty Name'),"required");
		$this->form_validation->set_rules('designation',lang('Faculty Designation'),"required");
		$this->form_validation->set_rules('qualification',lang('Faculty Qualification'),"required");
		
		if($this->form_validation->run()==TRUE){									
			$faculty_name=$this->input->post('faculty_name',TRUE);
			$designation=$this->input->post('designation',TRUE);	
			$qualification=$this->input->post('qualification',TRUE);
			$status=$this->input->post('status',TRUE);

			$thumbnail='';
			$row=parent::getRecord('*',array("faculty_id"=>$editId));
			if (isset($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['name'] != "") {
				$thumbnail = upload_media('thumbnail', 'jpg|jpeg|png|gif|bmp');
				if(isset($thumbnail['error'])){
					$thumbnail='';
					$response['is_error']=1;
					$response['msg']=$thumbnail['error'];
				}else{
					$thumbnail = $thumbnail['file_name'];
				}				
            	//======(Checking Image)========================
				if (!empty($row) && trim($row->thumbnail)!="") {
					remove_media($row->thumbnail);
				}
			} else {				
				if (!empty($row) && trim($row->thumbnail)!="") {
					$thumbnail = $row->thumbnail;
				}
			}			
			
			
			
			
			if($thumbnail!=''){
				$aInput=array(	
					"thumbnail"=>$thumbnail,
					"faculty_name"=>filterValue($faculty_name),
					"designation"=>filterValue($designation),	
					"qualification"=>filterValue($qualification),
					"status"=>filterValue($status)
				);
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'faculty_id'); 
				$response['msg']=$lastId;
			}else{
				$response['is_error']=1;
				$response['msg']='Faculty Photo is required';
			}				
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'faculty as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('faculty_name',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("sequence_no",'asc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'faculty as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("sequence_no",'asc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}


}
?>