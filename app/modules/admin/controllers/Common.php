<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Common_model','oMainModel');
	}

	function load_state()
	{
		$country_id=$_POST['country_id'];
		$this->oMainModel->setTable('state');	
		$aState=$this->oMainModel->getRecords('state_id,state_name',array("country_id"=>$country_id),array("sort"=>"state_name","order"=>"asc"));
		echo json_encode($aState);
	}

	function load_city()
	{		
		$state_id=$_POST['state_id'];	
		$this->oMainModel->setTable('city');		
		$aCity=$this->oMainModel->getRecords('city_id,city_name',array("state_id"=>$state_id),array("sort"=>"city_name","order"=>"asc"));  
		echo json_encode($aCity);  
		
	}

	 function row_sorting() {
	 	$module_id=$_POST['module_id'];
	 	$response=array();
        $module_details = get_row('modules', array("module_id" => $module_id));
        if (isset($module_details->module_table) && isset($_POST['sequences'])) {
            $sequences = explode('&', $_POST['sequences']);
            $array = array();
            foreach ($sequences as $item) {
                $item = explode('=', $item);
                $item = explode('_', $item[1]);
                $array[] = $item[1];
            }
            foreach ($array as $key => $value) {
                $key = $key + 1;
                $this->db->update(tbl_prefix() . $module_details->module_table, array("sequence_no" => $key), array($module_details->module_table_pk => $value));
                //debug('qry');
            }           
        }
        $response['csrf_token_name'] = $this->security->get_csrf_token_name();
		$response['csrf_hash'] = $this->security->get_csrf_hash();
		echo json_encode($response);
    }

}

/* End of file Common.php */
/* Location: ./app/controllers/Common.php */ ?>