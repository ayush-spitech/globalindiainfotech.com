<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_cms extends MY_Controller {

  function __construct() {        
    parent::__construct();
    checkAdminLogin();
    parent::setModuleUrl('admin_cms');
    $this->load->model('Cms_model','oMainModel');
  }

  function index() {
    $str_select='t1.*';
    $data['aGrid']=$this->oMainModel->get_list($str_select);
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']=lang("CMS");
    $data['menu']='modules';
    $data['breadcrumb']=array(''=>'CMS');
    $this->load->view('cms-index',$data);
    hide_message();
  }

  function add($editId=0) {   
   if(isset($_POST['submitform'])){           
    $response=$this->oMainModel->add();
    if($response['is_error']==0){
      set_message('CMS saved successfully');
      redirect($this->moduleUrl);
    }else{
      set_message($response['msg'],'e');        
    }     
  }              
  $data['aContentInfo']=$this->oMainModel->getRecord('*',array("cms_id"=>$editId));

  $data['moduleUrl']=$this->moduleUrl;
  $data['title']=lang("CMS");
  $data['menu']='modules';
  $data['breadcrumb']=array(''=>'CMS');
  $this->load->view('cms-form',$data);
} 

function delete($delete_id=0){
  $this->db->delete(tbl_prefix().'cms',array('cms_id'=>$delete_id));
   set_message('CMS deleted successfully');
      redirect($this->moduleUrl);
}



}
?>