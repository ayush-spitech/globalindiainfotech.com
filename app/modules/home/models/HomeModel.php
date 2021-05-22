<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class HomeModel extends MY_Model {

	function __construct(){
		parent::__construct();		
	}


	function save_enquiry(){
		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('mobile','Mobile Number','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('service','Service','required');
		
					
		if($this->form_validation->run()==TRUE){									
			$name=$this->input->post('name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);
			$service=$this->input->post('service',TRUE);
			$message=$this->input->post('message',TRUE);

			$aInput=array(										
				//"subject"=>$subject,
				"name"=>filterValue($name),				
				"mobile"=>filterValue($mobile),
				"email"=>filterValue($email),
				"service"=>filterValue($service),
				"message"=>filterValue($message),
				'created_date'=>date('Y-m-d H:i:s')
			);			
			$this->db->insert(tbl_prefix().'enquiry',$aInput);
			$response['msg']=$this->db->insert_id();
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
function save_feedback(){
		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('mobile','Mobile Number','required');
		$this->form_validation->set_rules('email','Email','required');
		
		
					
		if($this->form_validation->run()==TRUE){									
			$name=$this->input->post('name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);
			$subject=$this->input->post('subject',TRUE);
			$message=$this->input->post('message',TRUE);					
			$aInput=array(										
				"subject"=>$subject,
				"name"=>filterValue($name),				
				"mobile"=>filterValue($mobile),
				"email"=>filterValue($email),
				"message"=>filterValue($message),
				'created_date'=>date('Y-m-d H:i:s')
			);			
			$this->db->insert(tbl_prefix().'feedback',$aInput);
			$response['msg']=$this->db->insert_id();
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	


	function job_apply(){			
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$this->form_validation->set_rules('name','Name','required');		
		$this->form_validation->set_rules('mobile','Mobile',"required");
		$this->form_validation->set_rules('email','Email',"required");						
		if($this->form_validation->run()==TRUE){									
			$name=$this->input->post('name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);
			$job_id=$this->input->post('job_id',TRUE);	
			
			$resume='';			
			if (isset($_FILES['resumejob_'.$job_id]['name']) && $_FILES['resumejob_'.$job_id]['name'] != "") {
				$image = upload_media('resumejob_'.$job_id, 'pdf');
				if(isset($image['error'])){
					$resume='';
					$response['is_error']=1;
					$response['msg']=$image['error'];
				}else{
					$resume = $image['file_name'];
				}
			}else{
				$response['is_error']=1;
				$response['msg']='Resume is required';
			}
			$aInput=array(
				"name"=>filterValue($name),				
				"mobile"=>filterValue($mobile),
				"email"=>filterValue($email),
				"job_id"=>filterValue($job_id),				
				"resume"=>$resume,
				"status"=>'0',
				'created_date'=>date('Y-m-d H:i:s')
			);	
			if($response['is_error']==0){
				$this->db->insert(tbl_prefix().'job_application',$aInput);
				$response['msg']=$this->db->insert_id();
			}
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}
	function get_location($search_text){
		$this->db->select('t1.country_name,t2.state_name,t3.city_id,t3.city_name');
		$this->db->from(tbl_prefix().'country as t1');
		$this->db->from(tbl_prefix().'state as t2','t1.country_id=t2.country_id');
		$this->db->from(tbl_prefix().'city as t3','t2.state_id=t3.state_id');
		$this->db->like('t1.country_name',$search_text);
		$this->db->or_like('t2.state_name',$search_text);
		$this->db->or_like('t3.city_name',$search_text);
		$res=$this->db->get()->result();
		debug('qry');
		return $res;
	}
	
	function send_message($customer_id,$booking_id){
		$aCustomer=get_row('customer',array('customer_id'=>$customer_id));
		$aBooking=get_row('booking',array('booking_id'=>$booking_id));

		//---customer msg---
		$customer_msg='Dear '.$aCustomer->first_name.', Thanks for choosing our subjects, Your booking is done successfully. Please find the booking id #: '.$aBooking->booking_code;
		send_sms($aCustomer->contact,$customer_msg);

		//---admin msg---
		$msg='Congratulations! You have new room booking with booking id #: '.$aBooking->booking_code;
		send_sms(config_item('site_contact'),$msg);	
		return $aBooking->booking_code;
	}	
	
function gallery_image_list1($aWhere = array(),$limit)
    {
        $this->db->select('a.*,b.title,b.status');
        $this->db->from(tbl_prefix() . 'gallery_image as a');
        $this->db->join(tbl_prefix() . 'gallery as b','a.gallery_id=b.gallery_id');
        $this->db->where($aWhere);
        $this->db->limit($limit);
        $results = $this->db->get()->result();
        return $results;
}
	


function get_recipe_of_the_day(){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'recipe as t1');		
		$this->db->where('t1.recipe_type',1);	
		$this->db->where('t1.status',1);
		$this->db->order_by('recipe_id','desc');
		$this->db->limit(1);	
		$query =$this->db->get();			
		$res = $query->row();		
		return $res;
	}
	
	function get_recipe_random_list($limit=4){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'recipe as t1');		
		$this->db->where('t1.status',1);	
		$this->db->order_by('rand()');
		$this->db->limit($limit);	
		$res=$this->db->get()->result();		
		return $res;
	}
	//-----------Get All Recipe List-------------
   function get_recipe_list($aWhere=array()){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'recipe as t1');		
		$this->db->where('t1.status',1);
		$this->db->where($aWhere);
		$this->db->order_by('recipe_id','desc');
		$res=$this->db->get()->result();		
		return $res;
	}
	//-----------Get Latest Recipe List-------------
  function get_latest_recipe_list(){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'recipe as t1');		
		$this->db->where('t1.recipe_type',0);	
		$this->db->where('t1.status',1);
		$this->db->order_by('recipe_id','desc');
		$this->db->limit(10);	
		$res=$this->db->get()->result();		
		return $res;
	}
//--------------Get Category List---------------
	function get_category_list(){
		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'category as t1');
		//$this->db->where('status','1');
		$res=$this->db->get()->result();
		return $res;
	}	
	
}
?>