<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial_model extends MY_Model {
	
	function __construct(){
		parent::__construct();
		parent::setTable('testimonial');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('testimonial_id');
		$this->form_validation->set_rules('message','Message','required');
		$this->form_validation->set_rules('name','Name','required');
		if($this->form_validation->run()==TRUE){

			$name=$this->input->post('name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);
			$message=$this->input->post('message',TRUE);

			$image_name='';
			$row=parent::getRecord('*',array("testimonial_id"=>$editId));
			if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
				$image = upload_media('image', 'jpg|jpeg|png|gif|bmp');			
				if(isset($image['error'])){					
					$response['is_error']=1;
					$response['msg']=$image['error'];					
				}else{
					$image_name = $image['file_name'];
				}				
            	//======(Checking Image)========================
				if (!empty($row) && trim($row->image)!="") {
					remove_media($row->image);
				}
			} else {				
				if (!empty($row) && trim($row->image)!="") {
					$image_name = $row->image;
				}
			}	
			if($response['is_error']==0){
				$aInput=array(
					"image"=>$image_name,										
					"name"=>filterValue($name),				
					"mobile"=>filterValue($mobile),
					"email"=>filterValue($email),
					"message"=>filterValue($message)
				);	
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'testimonial_id',1); 
				$response['msg']=$lastId;	
			}	
			
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'testimonial as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('caption',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("testimonial_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'testimonial as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("testimonial_id",'desc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}

}
?>