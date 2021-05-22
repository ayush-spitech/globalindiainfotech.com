<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_testimonial extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_testimonial');
		$this->load->model('Testimonial_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Testimonial");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Testimonial');
		$this->load->view('testimonial-index',$data);
		hide_message();
	}

	function add($editId=0) {
		$data['msg']='';
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Testimonial saved successfully');
				redirect($this->moduleUrl);
			}else{
				$data['msg']=$response['msg'];			
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("testimonial_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Testimonial");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_testimonial'=>'Testimonial',''=>'Manage Testimonial');
		$this->load->view('testimonial-form',$data);
	} 	

	function delete($delete_id){
		if($delete_id>0){
			$this->oMainModel->delete('testimonial',array("testimonial_id"=>$delete_id)); 
			set_message('Testimonial deleted successfully');
		}
		redirect($this->moduleUrl);         
	}
}
?>