<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_gallery extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_gallery');
		$this->load->model('Gallery_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	    
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Gallery");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Gallery');
		$this->load->view('gallery-index',$data);
		hide_message();
	}

	function add($editId=0) {
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Gallery saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}        
		$this->oMainModel->setTable('gallery');
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("gallery_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Gallery");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_gallery'=>'Gallery',""=>"Manage Gallery");
		$this->load->view('gallery-form',$data);
	} 

	function add_image($gallery_id=0) {
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add_image();
			if($response['is_error']==0){
				set_message('Gallery image saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}     
		$this->oMainModel->setTable('gallery');
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("gallery_id"=>$gallery_id));		
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Gallery");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_gallery'=>'Gallery',""=>"Add Gallery Image");
		$this->load->view('gallery-image-form',$data);
	} 

	function delete(){
		if(isset($_POST['rowId'])){
			$this->oMainModel->delete('gallery',array("gallery_id"=>$_POST['rowId']));      
		}      
	}

    //------------Ajax Methods----------

	function deleteImg(){
		$image_id=$_POST['rowId'];
		$this->oMainModel->deleteMedia('gallery_image','image',array('image_id'=>$image_id));
		$this->oMainModel->delete('gallery_image',array('image_id'=>$image_id));
	} 

}
?>