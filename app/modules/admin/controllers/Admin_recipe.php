<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_recipe extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_recipe');
		parent::setModuleId(18);
		$this->load->model('Recipe_model','oMainModel');
		
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Recipe");
		$data['menu']='modules';
		$data['moduleId']=$this->moduleId;
		$data['breadcrumb']=array(''=>'Recipe');
		$this->load->view('recipe-index',$data);
		hide_message();
		
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Recipe saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}  
		 
		//debug($_FILES);
		 		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("recipe_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;
        $data['aCategory']=$this->oMainModel->get_category_list('t1.*');
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Recipe");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_recipe'=>'Recipe',''=>'Manage');
		$this->load->view('recipe-form',$data);
	} 	

	
}
?>