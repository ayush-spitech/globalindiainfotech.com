<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends MY_Controller {

  function __construct() {        
    parent::__construct();
    checkAdminLogin();
    parent::setModuleUrl('admin_user');
    $this->load->model('UserModel','oMainModel');
  }




   

  function index() {
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']="User";
    $data['menu']='config';
    $this->load->view('user-index',$data);
    hide_message();
  }

  function permission($user_id=0) {
    $this->oMainModel->insert_permission($user_id);
    if ($this->input->post('submit'))
    {
      $user_id = $this->input->post('user_id');
      $this->oMainModel->set_user_permission($user_id);
      set_message('User permission saved successfully');
      redirect($this->moduleUrl);
    }
    
    $this->oMainModel->setTable('user');
    $data['aContentInfo']=$this->oMainModel->getRecord('*',array("user_id"=>$user_id));
    $data['aUserMenu'] = $this->oMainModel->get_permissions($user_id);
    $data['user_id'] = $user_id;
    if (empty($data['aContentInfo'])) {
      redirect($this->moduleUrl);
    }
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']="User";
    $data['menu']='config';
    $this->load->view('user-permission',$data);
    hide_message();
  }

  function add($editId=0) {
   if(isset($_POST['submitform'])){           
      $response=$this->oMainModel->add();
      if($response['is_error']==0){
        set_message('User saved successfully');
        redirect($this->moduleUrl);
      }else{
        set_message($response['msg'],'e');        
      }     
    }         
    $data['aContentInfo']=$this->oMainModel->getRecord('*',array("user_id"=>$editId));
    $this->oMainModel->setTable('user_role');
    $data['aRole']=$this->oMainModel->getRecords('*',array("role_id >"=>1));

    $data['moduleUrl']=$this->moduleUrl;
    $data['title']="User";
    $data['menu']='admin';
    $this->load->view('user-form',$data);
  } 

  function delete(){
    if(isset($_POST['rowId'])){
      $this->oMainModel->delete('user',array("domain_id"=>$_POST['rowId']));      
    }      
  }

  function export(){
    $aResult=$this->oMainModel->export();
    export_domain($aResult,'User List','User List');
  }




    //------------Ajax Methods----------
  function getList(){
    $aResult=$this->oMainModel->getList();
    echo json_encode($aResult);
  }
  function ajaxAdd(){       
    if(isset($_POST['submitform'])){            
      $lastId=$this->oMainModel->add();
      if($lastId>0){
        set_message('User details saved successfully');
      }
      echo $lastId; 
    }    
  }

  function ajaxProfile(){       
    if(isset($_POST['submitform'])){            
      $lastId=$this->oMainModel->profile();
      if($lastId>0){
        set_message('Profile saved successfully');
      }
      echo $lastId; 
    }    
  }

  function ajaxChangePass(){       
    if(isset($_POST['submitform'])){            
      $lastId=$this->oMainModel->changePass();
      if($lastId>0){
        set_message('Password changed successfully');
      }
      echo $lastId; 
    }    
  }

}
?>