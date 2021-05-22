<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends MY_Model {
	
	function __construct(){
		parent::__construct();
		parent::setTable('category');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('category_id');
	    $this->form_validation->set_rules('title','Category Title','required');
		if($this->form_validation->run()==TRUE){

			$title=$this->input->post('title',TRUE);			
			

			$aInput=array(														
				"title"=>filterValue($title)
			);	
			//debug($aInput);
			$_POST['rowId']=$editId;			
			$lastId=parent::save($this->tbl_name,$aInput,'category_id',1); 
			$response['msg']=$lastId;

		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'category as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('title',$_GET['search_key']);
		}		
		$this->db->order_by("category_id",'desc');
		$offset=0;
		$limit=config_item('record_limit');		
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);	
			$offset=($offset-1)*$limit;	
		}
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'category as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("category_id",'desc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}

}
?>