<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_facility extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_facility');
		parent::setModuleId(20);
		$this->load->model('Facility_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Facility");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Facility');
		$this->load->view('facility-index',$data);
		hide_message();
	}

	function add($editId=0) {
		$data['msg']='';
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Facility saved successfully');
				redirect($this->moduleUrl);
			}else{
				$data['msg']=$response['msg'];			
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("facility_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Facility");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_facility'=>'Facility',''=>'Manage');
		$this->load->view('facility-form',$data);
	} 	

	function delete($delete_id){
		if($delete_id>0){
			$this->oMainModel->delete('facility',array("facility_id"=>$delete_id)); 
			set_message('Facility deleted successfully');
		}
		redirect($this->moduleUrl);         
	}
}
?>