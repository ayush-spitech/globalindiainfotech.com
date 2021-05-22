<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('service');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('service_id');
		$this->form_validation->set_rules('caption',lang('Image Caption'),"required");
		if($this->form_validation->run()==TRUE){									
			$caption=$this->input->post('caption',TRUE);	
			$short_description=$this->input->post('short_description',TRUE);					
			$status=$this->input->post('status',TRUE);

			$image='';
			$row=parent::getRecord('*',array("service_id"=>$editId));
			if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
				$image = upload_media('image', 'jpg|jpeg|png|gif|bmp');
				if(isset($image['error'])){
					$image='';
					$response['is_error']=1;
					$response['msg']=$image['error'];
				}else{
					$image = $image['file_name'];
				}				
            	//======(Checking Image)========================
				if (!empty($row) && trim($row->image)!="") {
					remove_media($row->image);
				}
			} else {				
				if (!empty($row) && trim($row->image)!="") {
					$image = $row->image;
				}
			}			
			if($image!=''){
				$aInput=array(	
					"image"=>$image,
					"caption"=>filterValue($caption),
					"short_description"=>filterValue($short_description),			
					"status"=>filterValue($status)
				);
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'service_id'); 
				$response['msg']=$lastId;
			}else{
				$response['is_error']=1;
				$response['msg']='Service Image is required';
			}				
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'service as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('caption',$_GET['search_key']);			
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
		$this->db->from(tbl_prefix().'service as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("sequence_no",'asc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}
}
?>