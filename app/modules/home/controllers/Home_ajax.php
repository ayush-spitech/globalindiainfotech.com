<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_ajax extends MY_Controller {
	function __construct() {        
		parent::__construct();		
		parent::setModuleUrl('home_ajax');
		$this->load->model('HomeModel','oMainModel');
		$this->load->model('admin/Common_model');		
	}

	function save_enquiry(){		
		$response=$this->oMainModel->save_enquiry();
		if($response['is_error']==0){
			$response['msg']='Thank You for contacting us. We will assist you shortly';
		}
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();
		echo json_encode($response);
	}
	function save_feedback(){		
		$response=$this->oMainModel->save_feedback();
		if($response['is_error']==0){
			$response['msg']='Thank You for your feedback, we will get back to you soon..';
		}
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();
		echo json_encode($response);
	}

	function job_apply(){		
		$response=$this->oMainModel->job_apply();
		if($response['is_error']==0){
			$response['msg']='You have successfully applied for this job. Our HR team will send you updates on your registered email id.';
		}
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();
		echo json_encode($response);
	}


	
	function get_location(){
		$search_text=$_POST['term'];
		$location_object_array=$this->oMainModel->get_location($search_text);
		$response=array("data"=>$location_object_array);
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();		
		echo json_encode($response);
	}

	//------home---------
	function load_state()
	{
		$response=array("data"=>"","csrf_token_name"=>"","csrf_hash"=>"");
		$country_id=$_POST['country_id'];
		$this->oMainModel->setTable('state');	
		$aState=$this->oMainModel->getRecords('state_id,state_name',array("country_id"=>$country_id),array("sort"=>"state_name","order"=>"asc"));

		$response['data']=$aState;
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();	
		echo json_encode($response);
	}

	function load_city()
	{		
		$response=array("data"=>"","csrf_token_name"=>"","csrf_hash"=>"");
		$state_id=$_POST['state_id'];	
		$this->oMainModel->setTable('city');		
		$aCity=$this->oMainModel->getRecords('city_id,city_name',array("state_id"=>$state_id),array("sort"=>"city_name","order"=>"asc"));  

		$response['data']=$aCity;
		$response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();	
		echo json_encode($response);
		
	}

	
}
?>