<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_download extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_download');
		parent::setModuleId(23);
		$this->load->model('Download_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Download");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Download');
		$this->load->view('download-index',$data);
		hide_message();
	}

	function add($editId=0) {

		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('File saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("download_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Download");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Download');
		$this->load->view('download-form',$data);
	} 	

	
}
?>