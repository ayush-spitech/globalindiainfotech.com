<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Topper_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('topper');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('topper_id');
		$this->form_validation->set_rules('topper_name',lang('Topper Name'),"required");
		$this->form_validation->set_rules('standard',lang('Topper Class'),"required");
		$this->form_validation->set_rules('percentage',lang('Topper Percentage'));
		
		if($this->form_validation->run()==TRUE){									
			$topper_name=$this->input->post('topper_name',TRUE);
			$standard=$this->input->post('standard',TRUE);	
			$percentage=$this->input->post('percentage',TRUE);
			$status=$this->input->post('status',TRUE);

			$thumbnail='';
			$row=parent::getRecord('*',array("topper_id"=>$editId));
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
					"topper_name"=>filterValue($topper_name),
					"standard"=>filterValue($standard),	
					"percentage"=>filterValue($percentage),
					"status"=>filterValue($status)
				);
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'topper_id'); 
				$response['msg']=$lastId;
			}else{
				$response['is_error']=1;
				$response['msg']='Topper Photo is required';
			}				
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'topper as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('topper_name',$_GET['search_key']);			
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
		$this->db->from(tbl_prefix().'topper as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("sequence_no",'asc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}


}
?>