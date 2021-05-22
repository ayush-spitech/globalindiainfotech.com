<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_career extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_career');
		$this->load->model('Career_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Career");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Career');
		$this->load->view('career-index',$data);
		hide_message();
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Career saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("career_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Career");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Career');
		$this->load->view('career-form',$data);
	} 	

	
}
?>