<?php
class AppConfig{	

	protected $ci;
	public function __construct() {
		$this->ci=&get_instance();
	}

	public function loadApplicationConfig(){	

		$config=$this->ci->db->select('*')->from(tbl_prefix().'config')->get()->result();
		//debug($config);
		if(isset($config) && is_array($config) && !empty($config)){			
			foreach ($config as $key => $value) {
				$this->ci->config->set_item($value->name,$value->value);
			}
		}	
		load_language();
	}
}
?>