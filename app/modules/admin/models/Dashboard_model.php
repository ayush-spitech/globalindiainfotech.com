<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('user');
	}

	
	function profile(){	
	$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');	
		$editId=$this->input->post('user_id');
		$this->form_validation->set_rules('name','Name','required');
		if($this->form_validation->run()==TRUE){
			$name=$this->input->post('name',TRUE);		
			$aInput=array(		
				"name"=>filterValue($name)
			);			
			$_POST['rowId']=$editId;
			$lastId=parent::save($this->tbl_name,$aInput,'user_id',1); 
		}else{			
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	

	function change_password(){	
	$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');		
		$editId=$_SESSION['aUser']->user_id;
		$this->form_validation->set_rules('password','Old Password','required');
		$this->form_validation->set_rules('new_password','New Password','required');
		$this->form_validation->set_rules('re_password','Re Password','required|matches[new_password]');		
		if($this->form_validation->run()==TRUE){			
			$password=$this->input->post('password',TRUE);		
			$new_password=$this->input->post('new_password',TRUE);		
			$re_password=$this->input->post('re_password',TRUE);	
			parent::setTable('user');	
			$row=parent::getRecord('password',array("user_id"=>$editId,"password"=>md5($password)));
			if(isset($row) && is_object($row) && !empty($row)){
				$aInput=array(		
					"password"=>md5(filterValue($re_password))
				);			
				$_POST['rowId']=$editId;
				$lastId=parent::save($this->tbl_name,$aInput,'user_id'); 
			}else{
				$response['is_error']=1;
			$response['msg']="Please enter correct old passowrd.";
			} 			
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}

	

	

}
?>