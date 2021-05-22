<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_media extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_media');
		$this->load->model('Media_model','oMainModel');
	}

	function index() {
		$str_select='t1.*';
		$data['aGrid']=$this->oMainModel->get_list($str_select);	    
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Media");
		$data['menu']='modules';
		$data['breadcrumb']=array(''=>'Media');
		$this->load->view('media-index',$data);
		hide_message();
	}

	function add($editId=0) {
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add();
			if($response['is_error']==0){
				set_message('Media saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}        
		$this->oMainModel->setTable('media');
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("media_id"=>$editId));
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Media");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_media'=>'Media',""=>"Manage Media");
		$this->load->view('media-form',$data);
	} 

	function add_image($media_id=0) {
		if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->add_image();
			if($response['is_error']==0){
				set_message('Media image saved successfully');
				redirect($this->moduleUrl);
			}else{
				set_message($response['msg'],'e');				
			}			
		}     
		$this->oMainModel->setTable('media');
		$aContentInfo=$this->oMainModel->getRecord('t1.*',array("media_id"=>$media_id));		
		$data['aContentInfo']=$aContentInfo;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']=lang("Media");
		$data['menu']='modules';
		$data['breadcrumb']=array('admin_media'=>'Media',""=>"Add Media Image");
		$this->load->view('media-image-form',$data);
	} 

	function delete(){
		if(isset($_POST['rowId'])){
			$this->oMainModel->delete('media',array("media_id"=>$_POST['rowId']));      
		}      
	}

    //------------Ajax Methods----------

	function deleteImg(){
		$image_id=$_POST['rowId'];
		$this->oMainModel->deleteMedia('media_image','image',array('image_id'=>$image_id));
		$this->oMainModel->delete('media_image',array('image_id'=>$image_id));
	} 

}
?>