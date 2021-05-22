<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_order extends MY_Controller {
	function __construct() {        
		parent::__construct();
		checkAdminLogin();
		parent::setModuleUrl('admin_order');
		$this->load->model('OrderModel','oMainModel');
		$this->load->model('Mcustomer','oCustomerModel');
		
	}

	function index() {       
		$strSelect='t1.*,t4.title as event_name,t5.first_name,t5.last_name,t5.mobile,t6.category as ticket_name';
        $data['aGrid']=$this->oMainModel->getList($strSelect);	
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']="Order Listing";
		$data['menu']='customer';
		$this->load->view('order-index',$data);
		hide_message();
	}

	function add($editId=0) {
		if(isset($_POST['submitform'])){           
			$lastId=$this->oMainModel->add();
			if($lastId>0){
				set_message('Order created successfully');
				redirect($this->moduleUrl);
			}			
		}   
		
		$aContentInfo=$this->oMainModel->getOrderDetails(array("t1.order_id"=>$editId));

		$data['aCustomer']=$this->oCustomerModel->getCustomerList('customer_id,first_name,last_name,mobile',array("status"=>1),array("sort"=>"first_name","order"=>"asc"));		
		
		$aJoin=array();
		$aJoin[]=array('ticket_category as t2','t1.category_id=t2.category_id','LEFT');
		$aJoin[]=array('event as t3','t1.event_id=t3.event_id','LEFT');
		$this->oMainModel->setJoin($aJoin);
		$this->oMainModel->setTable('ticket');
		$data['aTicket']=$this->oMainModel->getRecords('t1.ticket_id,t2.category,t3.title as event_name',array("t1.status"=>1),array("sort"=>"ticket_id","order"=>"desc"));

		$data['aContentInfo']=$aContentInfo;
		$ticket_details='';
		if(isset($aContentInfo->ticket_id)){
			$ticket_details=$aContentInfo->ticket_details;		
		}
		$data['ticket_details']=$ticket_details;

		$data['moduleUrl']=$this->moduleUrl;
		$data['title']="Order Manage";
		$data['menu']='customer';
		$this->load->view('order-form',$data);
	} 	

	function view($editId=0) {
		$aContentInfo=$this->oMainModel->getOrderDetails(array("t1.order_id"=>$editId));
		//debug($aContentInfo);
		$data['aContentInfo']=$aContentInfo;
		$data['moduleUrl']=$this->moduleUrl;
		$data['title']="Order View";
		$data['menu']='customer';
		$this->load->view('order-view',$data);
	} 	

	function export(){

	}

	function delete(){
		$rowId=$_POST['rowId'];
		$this->db->delete(tbl_prefix().'order_item',array("order_id"=>$rowId));
		$this->db->delete(tbl_prefix().'order',array("order_id"=>$rowId));		
	}

    //------------Ajax Methods----------	
	function getList(){
		$this->oMainModel->setTable('order');
		$aResult=$this->oMainModel->getList("t1.*,t2.first_name,t2.last_name,t2.mobile");
		echo json_encode($aResult);
	}

	function getTicketDetails($ticket_id){		
		$aResult=$this->oMainModel->getTicketDetails($ticket_id);		
		$aResult=unserialize($aResult);
		if(is_array($aResult)){
			echo implode(",", $aResult);
		}else{
			echo '';
		}
		
	}
	

}
?>