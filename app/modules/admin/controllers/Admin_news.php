<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_news extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_news');
		$this->load->model('News_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	        
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("News");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'News');
		$this->load->view('news-index',$data);
		hide_message();
	}

	function add($editId=0) {
		$data['msg']='';
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('News saved successfully');
				redirect($this->moduleUrl);
			}else{
				$data['msg']=$response['msg'];			
			}			
		}    		
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("news_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("News");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_news'=>'News',''=>'Manage');
		$this->load->view('news-form',$data);
	} 	

	function delete($delete_id){
		if($delete_id>0){
			$this->oMainModel->delete('news',array("news_id"=>$delete_id)); 
			set_message('News deleted successfully');
		}
		redirect($this->moduleUrl);         
	}
}
?>