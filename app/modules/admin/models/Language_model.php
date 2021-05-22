
<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Language_model extends MY_Model {

	function __construct(){
		parent::__construct();
		parent::setTable('language');
	}


	function get_label_list($str_select = '*',$aWhere=array()){

		$this->db->select($str_select);
		$this->db->from(tbl_prefix().'label as t1');				
		if(isset($_GET['search_key']) && $_GET['search_key']!=''){
			$this->db->like('label',$_GET['search_key']);			
		}
		$offset=0;
		$limit=config_item('recrod_limit');
		if($this->uri->segment(3)){
			$offset=$this->uri->segment(3);			
		}
		$this->db->order_by("label_id",'desc');
		$this->db->limit($limit,$offset);
		$res=$this->db->get()->result();		
		$res=parent::customPagination($res);
		return $res;	
	}

	function add_label(){
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$editId=$this->input->post('label_id');
		$label=$this->input->post('label');

		$row=get_row('label',array('label'=>$label));
		if(empty($row)){
			$this->db->insert(tbl_prefix().'label',array('label'=>$label));
			$last_label_id=$this->db->insert_id();
		}else{
			$last_label_id=$row->label_id;
		}
		$response['msg']=$last_label_id;

		$this->db->select('t1.*');
		$this->db->from(tbl_prefix().'language as t1');	
		$this->db->where('status','1');		
		$result=$this->db->get()->result();	
		if($last_label_id>0){
			foreach ($result as $value) {
				$aWhere=array('language_id'=>$value->language_id,'label_id'=>$last_label_id);
				$row=get_row('label_value',$aWhere);
				if(empty($row)){
					$aInput=array(
						'language_id'=>$value->language_id,
						'label_id'=>$last_label_id,
						'value'=>''
					);
					$this->db->insert(tbl_prefix().'label_value',$aInput);
				}
			}
		}
		
		return $response;	
	}

	function get_list($aWhere=array()){
		$this->db->select('t1.value,t2.label_id,t2.label');
		$this->db->from(tbl_prefix().'label_value as t1');
		$this->db->join(tbl_prefix().'label as t2','t1.label_id=t2.label_id');
		$this->db->where($aWhere);
		$this->db->order_by('t2.label_id','desc');
		$result=$this->db->get()->result();		
		return $result;
	}

	function add(){
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$language_id=$this->input->post('language_id');
		
		$aLabelId=$this->input->post('aLabelId');
		$aLabel=$this->input->post('aLabel');
		$aValue=$this->input->post('aValue');
		foreach ($aLabel as $key => $value) {
			$aWhere=array('language_id'=>$language_id,'label_id'=>$aLabelId[$key]);
			$row=get_row('label_value',$aWhere);
			if(!empty($row)){				
				$this->db->update(tbl_prefix().'label_value',array('value'=>$aValue[$key]),$aWhere);
			}else{
				$lbl_value='';
				if(isset($aValue[$key])){
					$lbl_value=$aValue[$key];
				}
				$aInput=array(
					'language_id'=>$language_id,
					'label_id'=>$aLabel[$key],
					'value'=>$lbl_value
				);
				$this->db->insert(tbl_prefix().'label_value',$aInput);
			}
		}
		$response=$this->save_lang($language_id);
		return $response;
	}

	function save_lang($language_id){	
		$response=array('is_error'=>'0','class'=>'text-success','msg'=>'');
		$aLangugae=get_row('language',array('language_id'=>$language_id));
		$language=$aLangugae->language;
		$this->db->select('t1.*,t2.label');
		$this->db->from(tbl_prefix().'label_value as t1');
		$this->db->join(tbl_prefix().'label as t2','t1.label_id=t2.label_id','LEFT');
		$this->db->where('language_id',$language_id);
		$result=$this->db->get()->result();

		$lang=array();
		$str_content="<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); \n\n";
		foreach ($result as $row){         
			if($row->label!=''){
				$str_content.= '$lang["'.$row->label.'"] = "'.$row->value.'";'."\n";
			}  
		}		
		$file_path='./app/language/'.$language.'/'.$language.'_lang.php';
		$response=file_write($file_path,$str_content);
		if($response){
			$response['msg']='Language saved successfully';
		}else{
			$response['is_error']='0';
			$response['class']='text-danger';
			$response['msg']='Language not saved';
		}		
		return $response;
	}
}
?>	