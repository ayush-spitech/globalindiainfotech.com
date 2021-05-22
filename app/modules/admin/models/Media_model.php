<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('media');
	}

	function add(){	
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('media_id');					

		$this->form_validation->set_rules('title',lang('Title'),"required");	

		if($this->form_validation->run()==TRUE){									
			$title=$this->input->post('title',TRUE);			
			$status=$this->input->post('status',TRUE);

			$row=parent::getRecord('*',array("media_id"=>$editId));
			$aInput=array(	
				"title"=>filterValue($title),			
				"status"=>filterValue($status)
			);	

			$_POST['rowId']=$editId;			
			$lastId=parent::save($this->tbl_name,$aInput,'media_id');
			$response['msg']=$lastId; 
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'media as t1');		
		$this->db->where($aWhere);		
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('title',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("media_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		foreach ($res as $key => $value) {
			$this->db->select('image_id,image,title');
			$this->db->from(tbl_prefix().'media_image');
			$this->db->where('media_id',$value->media_id);
			$this->db->order_by('image_id','desc');
			$res[$key]->aImage=$this->db->get()->result();
		}
		$res=parent::customPagination($res);
		return $res;	
	}

	function add_image(){
		$media_id=$this->input->post('media_id');
		$title=$this->input->post('title');
		$image='';
		if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
			$image = upload_media('image', 'jpg|jpeg|png|gif|bmp');
			$image = $image['file_name'];            	
		}		
		$aInput=array(	
			"media_id"=>$media_id,			
			"image"=>$image,
			"title"=>$title
		);					
		$lastId=parent::save('media_image',$aInput,'image_id');     
		return $lastId;
	}

	function getMediaImages($aWhere=array()){
		parent::setTable('media_image');
		$res=parent::getRecords('image,image_id,title',$aWhere);
		return $res;
	}
	

	//---------------------Front Controller-------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'media as t1');			
		$this->db->where($aWhere);		
		//$this->db->order_by('title','asc');	
		$this->db->order_by('media_id','desc');				
		$res=$this->db->get()->result();		
		foreach ($res as $key => $value) {
			$this->db->select('image_id,image,title');
			$this->db->from(tbl_prefix().'media_image');
			$this->db->where('media_id',$value->media_id);
			$this->db->order_by('image_id','desc');
			$res[$key]->aImage=$this->db->get()->result();
		}		
		return $res;	
	}

}
?>