<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard extends MY_Controller {

	function __construct() {        
		parent::__construct();
		checkAdminLogin();	
		parent::setModuleUrl('admin_dashboard');
		parent::setModuleId(20);
		$this->load->model('Dashboard_model','oMainModel');	
	}

	function index() {
		$data['title']="Dashboard";
		$data['menu']='dashboard';		
		$this->load->view('dashboard',$data);
	}
	 //--------OTHER METHODS-------------
  function profile($editId=0) {
	  if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->profile();
			if($response['is_error']==0){
				set_message('Profile saved successfully');
				redirect($this->moduleUrl.'profile/');
			}else{
				set_message($response['msg'],'e');				
			}			
		}     
    $editId=$_SESSION['aUser']->user_id;          
    $data['aContentInfo']=$this->oMainModel->getRecord('*',array("user_id"=>$editId));       
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']="Profile";
    $data['menu']='dashboard';
    $this->load->view('profile',$data);
    hide_message();
  }

  function change_password($editId=0) {
	  if(isset($_POST['submitform'])){           
			$response=$this->oMainModel->change_password();
			if($response['is_error']==0){
				set_message('Password Changed successfully');
				redirect($this->moduleUrl.'change_password/');
			}else{
				set_message($response['msg'],'e');				
			}			
		}   
    $data['moduleUrl']=$this->moduleUrl;
    $data['title']="Password";
    $data['menu']='dashboard';
    $this->load->view('change-password',$data);
    hide_message();
  }

}

?>