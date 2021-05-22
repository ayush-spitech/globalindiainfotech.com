<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_customer extends MY_Controller {

    function __construct() {        
        parent::__construct();
        checkAdminLogin();
        parent::setModuleUrl('admin_customer');
        $this->load->model('Customer_model','oMainModel');
    }

    function index() {
        $str_select='t1.*,t2.country_name,t3.state_name,t4.city_name';
        $data['aGrid']=$this->oMainModel->get_list($str_select);
        $data['moduleUrl']=$this->moduleUrl;
        $data['title']=lang("Members");
        $data['menu']='members';
        $data['breadcrumb']=array(''=>'Members');
        $this->load->view('customer-index',$data);
        hide_message();
    }

    function add($editId=0) {
        if(isset($_POST['submitform'])){           
            $response=$this->oMainModel->add();
            if($response['is_error']==0){
                set_message('Members saved successfully');
                redirect($this->moduleUrl);
            }else{
                set_message($response['msg'],'e');              
            }           
        }   
        $aContentInfo=$this->oMainModel->get_customer_details(array("customer_id"=>$editId));
      
        $this->oMainModel->setTable('country');
        $data['aCountry']=$this->oMainModel->getRecords('country_id,country_name','',array("sort"=>"country_name","order"=>"asc"));  
        if(isset($aContentInfo) && !empty($aContentInfo)){       
            $country_id=$aContentInfo->country_id;
            $state_id=$aContentInfo->state_id;
            $this->oMainModel->setTable('state');
            $data['aState']=$this->oMainModel->getRecords('state_id,state_name',array("country_id"=>$country_id),array("sort"=>"state_name","order"=>"asc"));
            $this->oMainModel->setTable('city');
            $data['aCity']=$this->oMainModel->getRecords('city_id,city_name',array("state_id"=>$state_id),array("sort"=>"city_name","order"=>"asc"));    
        } 
        $data['aContentInfo']=$aContentInfo;
        $data['moduleUrl']=$this->moduleUrl;
        $data['title']="Members";
        $data['menu']='members';
        $data['breadcrumb']=array('admin_customer'=>'Members List',''=>'Members');
        $this->load->view('customer-form',$data);
    }
  

}

?>