<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $tbl_name='';	
	private $aJoin=array(); // array("sTableName","sCondition","sType");
	function __construct(){
		parent::__construct();
	}

	function setJoin($aJoinArray){
		$this->aJoin=$aJoinArray;
	}

	function setTable($tbl_name){
		$this->tbl_name=$tbl_name;
	}

	function execute($qry){
		$this->db->trans_start();
		$response=$this->db->query($qry);
		$this->db->trans_complete();
		return $response;
	}
	
	function delete($tbl_name='',$aWhere=array(),$printQry=0){
		$this->db->trans_start();
		$response=$this->db->delete(tbl_prefix().$tbl_name,$aWhere);
		$this->db->trans_complete();
		if($printQry){
			debug($this->db->last_query());
		}
		return $response;
	} 

	function deleteMedia($tbl_name,$img_field_name,$aWhere,$printQry=0){
		$this->db->trans_start();
		$this->setTable($tbl_name);
		$aMedia=$this->getRecord($img_field_name,$aWhere);
		$this->db->trans_complete();
		if($printQry){
			debug($this->db->last_query());
		}
		if(isset($aMedia->$img_field_name) && $aMedia->$img_field_name!=""){
			remove_media($aMedia->$img_field_name);
		}		
	} 

	function getRecord($str_select='*',$aWhere=array(),$printQry=0){	
		$this->db->trans_start();

		if($str_select!=''){
			$this->db->select($str_select);	
		}else{
			$this->db->select('t1.*');
		} 	
		$this->db->from(tbl_prefix().$this->tbl_name.' as t1');
		if(isset($this->aJoin) && is_array($this->aJoin) && !empty($this->aJoin)){
			foreach ($this->aJoin as $value) {
				$this->db->join(tbl_prefix().$value['0'],$value['1'],$value['2']);
			}
		}
		if(is_array($aWhere)){
			$this->db->where($aWhere);	
		}
		$response=$this->db->get()->row();
		$this->db->trans_complete();
		if($printQry){
			debug($this->db->last_query());
		}
		return $response;
	}

	function getRecords($str_select='*',$aWhere=array(),$aFilter=array(),$printQry=0){
		$this->db->trans_start();
		if($str_select!=''){
			$this->db->select($str_select);	
		}else{
			$this->db->select('t1.*');
		} 	
		$this->db->from(tbl_prefix().$this->tbl_name.' as t1');
		if(isset($this->aJoin) && is_array($this->aJoin) && !empty($this->aJoin)){
			foreach ($this->aJoin as $value) {
				$this->db->join(tbl_prefix().$value['0'],$value['1'],$value['2']);
			}
		}
		if(is_array($aWhere)){
			$this->db->where($aWhere);	
		}
		if(isset($aFilter['sort']) && isset($aFilter['order'])){
			$this->db->order_by($aFilter['sort'],$aFilter['order']);
		}

		if(isset($aFilter['limit']) && isset($aFilter['offset'])){			
			if ($aFilter['offset'] > 0) {
				$aFilter['offset'] = ($aFilter['offset'] - 1) * $aFilter['limit'];
			}
			$this->db->limit($aFilter['limit'],$aFilter['offset']);
		}

		$response=$this->db->get()->result();
		$this->db->trans_complete();
		if($printQry){
			debug($this->db->last_query());
		}
		return $response;
	}

	function getRecordsPagination($str_select='*',$aWhere=array(),$aFilter=array(),$printQry=0){		
		$aFilter['offset']=0;
		if($this->uri->segment(3)){
			$aFilter['offset']=$this->uri->segment(3);			
		}
		if(!isset($aFilter['limit'])){
			$aFilter['limit']=config_item('recrod_limit');
		}

		$res=$this->getRecords($str_select,$aWhere,$aFilter,$printQry);	
		$response=new StdClass();
		$response->rows=$res;
		$response->pages=$this->getPagination();
		
		return $response;
	}

/*
pagination with query;
*/
function customPagination($res){
	$response=new StdClass();
	$response->rows=$res;
	$response->pages=$this->getPagination();
	//debug($response->pages); 
	return $response;
}

function getPagination(){	

	$module_url=$this->moduleUrl.'index/';
	$tbl_name=$this->tbl_name;   

	$limit=config_item('recrod_limit');  

	$num_results=$this->db->count_all_results(tbl_prefix().$tbl_name);

	$config = array();
	$config['base_url'] = $module_url;
	$config['total_rows'] =$num_results;
	$config['per_page'] = $limit;
        //which uri segment indicates pagination number
	$config['uri_segment'] = 3;
	$config['use_page_numbers'] = TRUE;
        //max links on a page will be shown
	$config['num_links'] = 5;
        //various pagination configuration
	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = false;
	$config['last_link'] = false;
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['prev_link'] = '&laquo';
	$config['prev_tag_open'] = '<li class="prev">';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = '&raquo';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';

	$this->load->library('pagination');
	$this->pagination->initialize($config);

	$pagination= $this->pagination->create_links();
	$pagination='<div class="row">
	<div class="col-md-12 text-right">'.$pagination.'</div></div>';
	//debug('');
	return  $pagination;
}



function archieveData($tbl_name,$pk,$row_id,$aOldData,$aNewData){
	$aArchiveData=array();
	$aExcludedFields=array('password');
	if(is_array($aOldData) && is_array($aNewData)){
		foreach ($aNewData as $key => $value) {
			if(isset($aOldData[$key])){
				if($aOldData[$key]!=$aNewData[$key] && !in_array($key,$aExcludedFields)){
                    //----keep new data into archieve array--------						
					$aTemp=new stdClass();
					$aTemp->field_name=$key;
					$aTemp->field_value_old=$aOldData[$key];
					$aTemp->field_value_new=$value;
					$aArchiveData['aData']=$aTemp;
				}
			}
		}
			//-----inserting into archieve table----------
		if(!empty($aArchiveData)){
			foreach ($aArchiveData as $key => $value) {
				$aTemp=array();
				$aTemp['field_name']=$value->field_name;
				$aTemp['field_value_old']=$value->field_value_old;
				$aTemp['field_value_new']=$value->field_value_new;
				$aTemp['table_name']=$tbl_name;
				$aTemp['row_id']=$row_id;
				$aTemp['date']=date('Y-m-d H:i:s');
				$aTemp['created_by']=$_SESSION['aUser']->user_id;
				$this->db->trans_start();
				$this->db->insert(tbl_prefix().'data_archieve',$aTemp);
				$this->db->trans_complete();
			}						
		}

	}else{
		debug("Method archieveData() Requires both argument in array format in ".__FILE__.__LINE__);
	}       
}	

function save($tbl_name='',$aData,$pk="id",$isArchive=0,$printQry=0){
	$response='';
	$this->db->trans_start();
	if(isset($_POST['rowId']) && $_POST['rowId']>0){
           //----update record--------			
		if($isArchive){
			$this->setTable($tbl_name);
			$aOldData=$this->getRecord('*',array($pk=>$_POST['rowId']));
			$aOldData=(array)$aOldData;
			$aNewData=$aData;				
			$this->archieveData($tbl_name,$pk,$_POST['rowId'],$aOldData,$aNewData);
		}
		$aData['edited_date']=date('Y-m-d h:i:s');
		$aData['edited_by']=$_SESSION['aUser']->user_id;
		$this->db->update(tbl_prefix().$tbl_name,$aData,array($pk=>$_POST['rowId']));			
		$response=$_POST['rowId'];		
	}else{
			//-----insert record------
		$aData['created_date']=date('Y-m-d H:i:s');
		$aData['created_by']=$_SESSION['aUser']->user_id;
		$this->db->insert(tbl_prefix().$tbl_name,$aData);
		$response=$this->db->insert_id();		
		$this->update_sequence($tbl_name,array($pk=>$response));
	}       
	
	$this->db->trans_complete();
	if($printQry){
		debug($this->db->last_query());
	}		
	return $response;
}

 /**
 *
 * @function name : getExportList
 * @param : $str_select=selected columns name, $Filter=array("sort"=><order by column name>,"order"=><asc or desc>,"limit"=><number of 	records>,"offset"=><starting row position of records>)
 * @return : records returned from database
 * @author : S.P.Soni
 **/

 function getExportList($str_select = 't1.*',$aWhere=array(),$aFilter=array()){
 	if($str_select!=''){
 		$this->db->select($str_select);	
 	}else{
 		$this->db->select('t1.*');
 	} 	
 	$this->db->from(tbl_prefix().$this->tbl_name.' as t1');
 	if(isset($this->aJoin) && is_array($this->aJoin) && !empty($this->aJoin)){
 		foreach ($this->aJoin as $value) {
 			$this->db->join(tbl_prefix().$value['0'],$value['1'],$value['2']);
 		}
 	}
 	if(isset($aWhere) && is_array($aWhere) && !empty($aWhere)){
 		$i=0;
 		foreach ($aWhere as $key => $value) {
 			if($i==0){
 				$this->db->like($key,$value);		
 			}else{
 				$this->db->or_like($key,$value);		
 			}
 			$i++;
 		}
 	}
 	if(isset($aFilter['sort']) && isset($aFilter['order'])){
 		$this->db->order_by($sort,$order);
 	}
 	if(isset($aFilter['limit']) && isset($aFilter['offset'])){
 		$this->db->limit($aFilter['limit'],$aFilter['offset']);
 	}
 	$results = $this->db->get()->result();
 	return $results;
 }

 /**
 *
 * @function name : update_sequence
 * @description : Updates the sequence number of record having id table_record_id
 * @param : tbl_name : Table Name
 * @param : where_condition :Array of where condition
 * @return : none
 * @author : S.P.Soni
 **/

 function update_sequence($tbl_name,$where_condition){
 	$next_sequence_no=1;
 	$this->db->trans_start();
 	$this->db->select_max('sequence_no');
 	$this->db->from(tbl_prefix().$tbl_name);
 	$res=$this->db->get()->row();
 	if(isset($res->sequence_no) && $res->sequence_no>0){
      $next_sequence_no=$res->sequence_no+1;
 	}
 	$this->db->update(tbl_prefix().$tbl_name,array("sequence_no"=>$next_sequence_no),$where_condition);
 	$this->db->trans_complete();
 }


}

?>