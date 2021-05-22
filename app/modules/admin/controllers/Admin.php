<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('UserModel','oMainModel');		
	}
	
	function index()
	{
		if(isset($_SESSION['aUser']) && $_SESSION['aUser']->user_id>0){
			redirect(base_url().'admin_dashboard/');
		}		
		if(isset($_POST['submitform'])){
			$lastId=$this->oMainModel->login();			
			if(is_object($lastId) && !empty($lastId)){
				$_SESSION['aUser']=$lastId;	
				$language=$this->input->post('language');
				update_config(array('language'=>$language));
				redirect(base_url().'admin_dashboard/');			
			}else if($lastId=="Invalid"){
				set_message(lang('Invalid login details'),'e');
				redirect(admin_url());
			}else if($lastId=="Inactive"){
				set_message(lang('Your account is not active. Please contact administrator'),'e');
				redirect(admin_url());
			}else{
				set_message($lastId,'e');
				redirect(admin_url());
			}
		}
		$data['aLanguage']=$this->common_model->get_languages();
		$data['title']=lang("Log in");
		$this->load->view('login',$data);		
		hide_message();
	}
	
	function logout(){
		session_destroy();
		header('location:'.admin_url());
	}

	function forgot_password(){
		if(isset($_SESSION['aUser']) && $_SESSION['aUser']->user_id>0){
			redirect(base_url().'admin_dashboard/');
		}
		if(isset($_POST['submitform'])){
			$lastId=$this->oMainModel->forgotPassword();
			if($lastId>0){
				set_message("Your new password is sent to your email id & mobile number.");
				redirect(admin_url().'/forgot_password/');
			}
		}
		$data['title']=lang('Password Reset');
		$this->load->view('forgot-password',$data);		
		hide_message();
	}
}