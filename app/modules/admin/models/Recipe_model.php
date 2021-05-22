<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Recipe_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('recipe');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('recipe_id');
		$this->form_validation->set_rules('title',lang('Recipe Title'),"required");
		$this->form_validation->set_rules('category_id',lang('Recipe Category'),"required");
		$this->form_validation->set_rules('description',lang('Recipe Description'),"required");
		$this->form_validation->set_rules('ingredients',lang('Recipe Ingredients'),"required");
		$this->form_validation->set_rules('method',lang('Recipe Method'),"required");
		if($this->form_validation->run()==TRUE){									
			$title=$this->input->post('title',TRUE);
			$category_id=$this->input->post('category_id',TRUE);
			$cuisine=$this->input->post('cuisine',TRUE);
			$recipe_type=$this->input->post('recipe_type',TRUE);
			$description=$this->input->post('description',TRUE);	
			$ingredients=$this->input->post('ingredients',TRUE);
			$method=$this->input->post('method',TRUE);
			$tips=$this->input->post('tips',TRUE);					
			$status=$this->input->post('status',TRUE);

			$thumbnail='';
			$row=parent::getRecord('*',array("recipe_id"=>$editId));
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
			
			$featured_image='';
			$row=parent::getRecord('*',array("recipe_id"=>$editId));
			if (isset($_FILES['featured_image']['name']) && $_FILES['featured_image']['name'] != "") {
				$featured_image = upload_media('featured_image', 'jpg|jpeg|png|gif|bmp');
				if(isset($featured_image['error'])){
					$featured_image='';
					$response['is_error']=1;
					$response['msg']=$featured_image['error'];
				}else{
					$featured_image = $featured_image['file_name'];
				}				
            	//======(Checking Image)========================
				if (!empty($row) && trim($row->featured_image)!="") {
					remove_media($row->featured_image);
				}
			} else {				
				if (!empty($row) && trim($row->featured_image)!="") {
					$featured_image = $row->featured_image;
				}
			}			
			
			
			if($thumbnail!='' && $featured_image!=''){
				$aInput=array(	
					"thumbnail"=>$thumbnail,
					"featured_image"=>$featured_image,
					"title"=>filterValue($title),
					"category_id"=>filterValue($category_id),
					"cuisine"=>filterValue($cuisine),
					"recipe_type"=>filterValue($recipe_type),
					"description"=>filterValue($description),	
					"ingredients"=>filterValue($ingredients),
					"method"=>filterValue($method),
					"tips"=>filterValue($tips),
					"status"=>filterValue($status)
				);
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'recipe_id'); 
				$response['msg']=$lastId;
			}else{
				$response['is_error']=1;
				$response['msg']='Recipe Images are required';
			}				
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'recipe as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('title',$_GET['search_key']);			
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
		$this->db->from(tbl_prefix().'recipe as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("sequence_no",'asc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}
//---------------recipe category dropdowns------------
	function get_category_list(){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'category as t1');
		//$this->db->where('status','1');
		$res=$this->db->get()->result();
		return $res;
	}

}
?>