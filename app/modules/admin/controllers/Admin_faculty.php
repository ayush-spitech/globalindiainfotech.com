<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_faculty extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_faculty');
		parent::setModuleId(21);
		$this->load->model('Faculty_model','oMainModel');
		
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Faculty");
		$data['menu']='modules';
		$data['moduleId']=$this->moduleId;
		$data['breadcrumb']=array(''=>'Faculty');
		$this->load->view('faculty-index',$data);
		hide_message();
		
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Faculty saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}  
		 
		//debug($_FILES);
		 		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("faculty_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;
        $data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Faculty");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_faculty'=>'Faculty',''=>'Manage');
		$this->load->view('faculty-form',$data);
	} 	

	
}
?>