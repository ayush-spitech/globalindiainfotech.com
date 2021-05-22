<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('cms');
	}

	function add(){	
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('cms_id');		
		$this->form_validation->set_rules('page_name','Page Name','required');
		$this->form_validation->set_rules('page_title','Page Title','required');
		if($this->form_validation->run()==TRUE){
			$page_name=$this->input->post('page_name',TRUE);
			$menu=$this->input->post('menu',TRUE);
			$page_title=$this->input->post('page_title',TRUE);
			$page_content=$this->input->post('long_content',TRUE);
			$status=$this->input->post('status',TRUE);
			$meta_keywords=$this->input->post('meta_keywords',TRUE);
			$meta_description=$this->input->post('meta_description',TRUE);
			$meta_robots=$this->input->post('meta_robots',TRUE);
			$aInput=array(											
				"page_name"=>filterValue($page_name),
				"menu"=>filterValue($menu),				
				"page_title"=>filterValue($page_title),
				"page_content"=>filterValue($page_content),
				"status"=>$status,
				"meta_keywords"=>$meta_keywords,
				"meta_description"=>$meta_description,
				"meta_robots"=>$meta_robots
			);				
			$_POST['rowId']=$editId;
			$lastId=parent::save('cms',$aInput,'cms_id'); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'cms as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('page_title',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('record_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("cms_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();
		//debug('qry');		
		$res=parent::customPagination($res);
		return $res;	
	}

}
?>