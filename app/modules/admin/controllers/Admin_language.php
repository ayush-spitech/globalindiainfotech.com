<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_language extends MY_Controller {

	function __construct(){
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_language');
		$this->load->model('Language_model','oMainModel');		
	}
	
	function update_label(){
		$label_id=$_POST['label_id'];
		$label=$_POST['label'];
		$this->db->update(tbl_prefix().'label',array('label'=>$label),array('label_id'=>$label_id));
	}
	
	function set_default_language(){
		$language=$_POST['language'];
		update_config(array('language'=>$language));
		hide_message();
	}

	function index(){
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add_label();
			if($response['is_error']==0){
				set_message('Language saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}
		parent::setTable('label');
		$data['aGrid']=$this->oMainModel->get_label_list();		
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Label");
		$data['menu']='config';
		$data['breadcrumb']=array('admin_language'=>'Language',''=>'Label');
		$this->load->view('label-form',$data);
		hide_message();
	}

	function add($language_id){		
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Language saved successfully');
				redirect($this->moduleUrl.'add/'.$language_id);
			}else{
				set_message($response['msg'],'e');				
			}			
		}
		$data['aGrid']=$this->oMainModel->get_list(array("language_id"=>$language_id));
		$data['language_id']=$language_id;
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Label Value");
		$data['menu']='config';
		$data['breadcrumb']=array('admin_language'=>'Language',''=>'Label Value');
		$this->load->view('label-value-form',$data);
		hide_message();
	}
	
}
