<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('gallery');
	}

	function add(){	
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('gallery_id');					

		$this->form_validation->set_rules('title',lang('Title'),"required");	

		if($this->form_validation->run()==TRUE){									
			$title=$this->input->post('title',TRUE);			
			$status=$this->input->post('status',TRUE);

			$row=parent::getRecord('*',array("gallery_id"=>$editId));
			$aInput=array(	
				"title"=>filterValue($title),			
				"status"=>filterValue($status)
			);	

			$_POST['rowId']=$editId;			
			$lastId=parent::save($this->tbl_name,$aInput,'gallery_id');
			$response['msg']=$lastId; 
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'gallery as t1');		
		$this->db->where($aWhere);		
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('title',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("gallery_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		foreach ($res as $key => $value) {
			$this->db->select('image_id,image,title');
			$this->db->from(tbl_prefix().'gallery_image');
			$this->db->where('gallery_id',$value->gallery_id);
			$this->db->order_by('image_id','desc');
			$res[$key]->aImage=$this->db->get()->result();
		}
		$res=parent::customPagination($res);
		return $res;	
	}

	function add_image(){
		$gallery_id=$this->input->post('gallery_id');
		$title=$this->input->post('title');
		$image='';
		if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
			$image = upload_media('image', 'jpg|jpeg|png|gif|bmp');
			$image = $image['file_name'];            	
		}		
		$aInput=array(	
			"gallery_id"=>$gallery_id,			
			"image"=>$image,
			"title"=>$title
		);					
		$lastId=parent::save('gallery_image',$aInput,'image_id');     
		return $lastId;
	}

	function getGalleryImages($aWhere=array()){
		parent::setTable('gallery_image');
		$res=parent::getRecords('image,image_id,title',$aWhere);
		return $res;
	}
	

	//---------------------Front Controller-------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'gallery as t1');			
		$this->db->where($aWhere);		
		//$this->db->order_by('title','asc');	
		$this->db->order_by('gallery_id','desc');			
		$res=$this->db->get()->result();		
		foreach ($res as $key => $value) {
			$this->db->select('image_id,image,title');
			$this->db->from(tbl_prefix().'gallery_image');
			$this->db->where('gallery_id',$value->gallery_id);
			$this->db->order_by('image_id','desc');
			$res[$key]->aImage=$this->db->get()->result();
		}		
		return $res;	
	}

}
?>