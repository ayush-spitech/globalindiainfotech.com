<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_product extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_product');
		parent::setModuleId(3);
		$this->load->model('Product_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Product");
		$data['menu']='modules';
		$data['moduleId']=$this->moduleId;
		$data['breadcrumb']=array(''=>'Product');
		$this->load->view('product-index',$data);
		hide_message();
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Product saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("product_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Product");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Product');
		$this->load->view('product-form',$data);
	} 	

	
}
?>