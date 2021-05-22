<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('customer');
	}


	function get_customer_details($aWhere=array()){
		$str_select='t1.*,t2.country_name,t3.state_name,t4.city_name';
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'customer as t1');	
		$this->db->join(tbl_prefix().'country as t2','t1.country_id=t2.country_id','LEFT');
		$this->db->join(tbl_prefix().'state as t3','t1.state_id=t3.state_id','LEFT');
		$this->db->join(tbl_prefix().'city as t4','t1.city_id=t4.city_id','LEFT');
		$this->db->where($aWhere);
		$res=$this->db->get()->row();		
		return $res;
	}

	

	function add(){		
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('customer_id');
		$this->form_validation->set_rules('staff_id','Staff','required');
		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','Last Name','required');
		$this->form_validation->set_rules('mobile','Mobile',"required|valid_unique_mobile[customer,mobile,customer_id,$editId]");
		$this->form_validation->set_rules('email','Email',"required|valid_unique_email[customer,email,customer_id,$editId]");	
		$this->form_validation->set_rules('country_id','Country','required');
		$this->form_validation->set_rules('state_id','State Id','required');
		$this->form_validation->set_rules('city_id','City Id','required');
		$this->form_validation->set_rules('address','Address','required');		

		if($this->form_validation->run()==TRUE){
			$staff_id=$this->input->post('staff_id',TRUE);
			$first_name=$this->input->post('first_name',TRUE);
			$last_name=$this->input->post('last_name',TRUE);			
			$mobile=$this->input->post('mobile',TRUE);
			$email=$this->input->post('email',TRUE);			
			$country_id=$this->input->post('country_id',TRUE);
			$state_id=$this->input->post('state_id',TRUE);
			$city_id=$this->input->post('city_id',TRUE);
			$address=$this->input->post('address',TRUE);
			$joining_date=$this->input->post('joining_date',TRUE);
			$zip=$this->input->post('zip',TRUE);
			//$status=$this->input->post('status',TRUE);			
			$aInput=array(				
				"staff_id"=>filterValue($staff_id),	
				"first_name"=>filterValue($first_name),
				"last_name"=>filterValue($last_name),
				"email"=>filterValue($email),
				"mobile"=>filterValue($mobile),
				"country_id"=>filterValue($country_id),
				"state_id"=>filterValue($state_id),
				"city_id"=>filterValue($city_id),				
				"address"=>filterValue($address),
				"joining_date"=>filterValue($joining_date,'date'),
				"zip"=>$zip,				
				"status"=>1
			);

			$_POST['rowId']=$editId;
			$lastId=parent::save($this->tbl_name,$aInput,'customer_id',1); 
			$response['msg']=$lastId;
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}



	function get_list($str_select = 't1.*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'customer as t1');	
		$this->db->join(tbl_prefix().'country as t2','t1.country_id=t2.country_id','LEFT');
		$this->db->join(tbl_prefix().'state as t3','t1.state_id=t3.state_id','LEFT');
		$this->db->join(tbl_prefix().'city as t4','t1.city_id=t4.city_id','LEFT');			
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('t1.first_name',$_GET['search_key']);
			$this->db->or_like('t1.last_name',$_GET['search_key']);	
			$this->db->like('t1.mobile',$_GET['search_key']);
			$this->db->like('t1.email',$_GET['search_key']);		
		}
		if(isset($_GET['search'])){
			if(isset($_GET['from_date']) && $_GET['from_date']!=''){
				$this->db->where('DATE(t1.created_date) >=',date('Y-m-d',strtotime($_GET['from_date'])));
			}
			if(isset($_GET['to_date']) && $_GET['to_date']!=''){
				$this->db->where('DATE(t1.created_date) <=',date('Y-m-d',strtotime($_GET['to_date'])));
			}
		}
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('t1.first_name',$_GET['search_key']);
			$this->db->or_like('t1.last_name',$_GET['search_key']);	
			$this->db->or_like('t1.mobile',$_GET['search_key']);
			$this->db->or_like('t1.email',$_GET['search_key']);		
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("customer_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	function export($aWhere=array(),$aFilter=array()){	
		$aJoin=array(
			array('country as t2','t1.country_id=t2.country_id','LEFT'),
			array('state as t3','t1.state_id=t3.state_id','LEFT'),
			array('city as t4','t1.city_id=t4.city_id','LEFT'),
			array('staff as t5','t1.staff_id=t5.staff_id','LEFT')
		);		
		parent::setJoin($aJoin);
		parent::setTable('customer');
		$aResult=parent::getExportList('*',$aWhere,$aFilter);
		return $aResult;
	}

	//-----------home----
	function get_list_home($aWhere=array()){
		$str_select='t1.*,t2.country_name,t3.state_name,t4.city_name';
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'customer as t1');	
		$this->db->join(tbl_prefix().'country as t2','t1.country_id=t2.country_id','LEFT');
		$this->db->join(tbl_prefix().'state as t3','t1.state_id=t3.state_id','LEFT');
		$this->db->join(tbl_prefix().'city as t4','t1.city_id=t4.city_id','LEFT');
		$this->db->where($aWhere);
		$res=$this->db->get()->result();		
		return $res;
	}
	
}

?>