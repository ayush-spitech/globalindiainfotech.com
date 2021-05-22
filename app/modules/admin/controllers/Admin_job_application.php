<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_job_application extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_job_application');
		$this->load->model('Application_model','oMainModel');
	}

	function index() {		
		$data['aGrid']=$this->oMainModel->get_list();			 
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Job Application");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Job Application');
		$this->load->view('job-app-index',$data);
		hide_message();
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Job Application saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}    		
		$aContentInfo=$this->oMainModel->application_details('',array("application_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Career");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_job_application'=>'Job Application',);
		$this->load->view('job-app-form',$data);
	} 	

	
}
?>