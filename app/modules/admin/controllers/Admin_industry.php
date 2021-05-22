<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_industry extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_industry');
		parent::setModuleId(28);
		$this->load->model('Industry_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Industry");
		$data['menu']='modules';
		$data['moduleId']=$this->moduleId;
		$data['breadcrumb']=array(''=>'Industry');
		$this->load->view('industry-index',$data);
		hide_message();
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Industry saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("industry_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Industry");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Industry');
		$this->load->view('industry-form',$data);
	} 	

	
}
?>