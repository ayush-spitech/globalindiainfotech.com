<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Download_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('download');
	}

	function add(){	
		//debug($_FILES);
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('download_id');
		$this->form_validation->set_rules('caption',lang('Title'),"required");
		
		if($this->form_validation->run()==TRUE){									
			$caption=$this->input->post('caption',TRUE);	
			$short_description=$this->input->post('short_description',TRUE);					
			$status=$this->input->post('status',TRUE);

			$attachment='';
			$row=parent::getRecord('*',array("download_id"=>$editId));
			if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
				$attachment = upload_media('attachment', 'pdf|doc|docx');
				
			
				if(isset($attachment['error'])){
					$attachment='';
					$response['is_error']=1;
					$response['msg']=$attachment['error'];
				}else{
					$attachment = $attachment['file_name'];
				}				
            	//======(Checking Image)========================
				if (!empty($row) && trim($row->attachment)!="") {
					remove_media($row->attachment);
				}
			} else {				
				if (!empty($row) && trim($row->attachment)!="") {
					$attachment = $row->attachment;
				}
			}		
			
			
			if($attachment!=''){
				$aInput=array(	
					"attachment"=>$attachment,
					"caption"=>filterValue($caption),
					"short_description"=>filterValue($short_description),			
					"status"=>filterValue($status)
				);
				$_POST['rowId']=$editId;			
				$lastId=parent::save($this->tbl_name,$aInput,'download_id'); 
				$response['msg']=$lastId;
			}else{
				$response['is_error']=1;
				$response['msg']='Attachment is required or File size exceeded';
			}				
		}else{
			$response['is_error']=1;
			$response['msg']=validation_errors();
		}           
		return $response;
	}	
	

	function get_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'download as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('caption',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("download_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

//---------------front controller methods------------
	function get_list_home($str_select = '*',$aWhere=array()){
		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'download as t1');	
		$this->db->where($aWhere);
		$this->db->order_by("download_id",'desc');		
		$aResponse=$this->db->get()->result();
		return $aResponse;	
	}
}
?>