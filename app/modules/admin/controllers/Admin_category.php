<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_category extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_category');
		$this->load->model('Category_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Category");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Category');
		$this->load->view('category-index',$data);
		hide_message();
	}

	function add($editId=0) {
		$data['msg']='';
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Category saved successfully');
				redirect($this->moduleUrl);
			}else{
				$data['msg']=$response['msg'];			
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("category_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Category");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_category'=>'Category',''=>'Manage');
		$this->load->view('category-form',$data);
	} 	

	function delete($delete_id){
		if($delete_id>0){
			$this->oMainModel->delete('category',array("category_id"=>$delete_id)); 
			set_message('Category deleted successfully');
		}
		redirect($this->moduleUrl);         
	}
}
?>