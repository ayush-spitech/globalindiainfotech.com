<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_feedback extends MY_Controller {

  function __construct() {        
    parent::__construct();
    checkAdminLogin();
    parent::setModuleUrl('admin_feedback');
    $this->load->model('Feedback_model','oMainModel');
  }

  function index() {
    $str_select='t1.*';
    $data['aGrid']=$this->oMainModel->get_list($str_select);   
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']=lang("Feedback");
    $data['menu']='modules';
    $data['breadcrumb']=array(''=>'Feedback');
    $this->load->view('feedback-index',$data);
    hide_message();
  }

  function add($editId=0) { 

    if(isset($_POST['submitform'])){           
      $response=$this->oMainModel->add();
      if($response['is_error']==0){
        set_message('Feedback saved successfully');
        redirect($this->moduleUrl);
      }else{
        set_message($response['msg'],'e');        
      }     
    }               
    $data['aContentInfo']=$this->oMainModel->getRecord('*',array("feedback_id"=>$editId));
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']=lang("Feedback");
    $data['menu']='modules';
    $data['breadcrumb']=array('admin_feedback'=>'Feedback',''=>'Manage Feedback');
    $this->load->view('feedback-form',$data);
  } 

  function delete($delete_id){
    if($delete_id>0){
      $this->oMainModel->delete('feedback',array("feedback_id"=>$delete_id)); 
      set_message('Feedback deleted successfully');
    }
    redirect($this->moduleUrl);         
  }

}
?>