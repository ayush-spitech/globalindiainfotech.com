<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation {

	
    /**
    * @param : $db_param='table_name,unique_field_name,table pk,pk_value' // rowId>0 update
    */
    function check_unique($field_value,$db_param='')
	{
		 $aParam=@explode(',',$db_param) or debug("Custome %s validation requires proper parameter");
		 
		 if(count($aParam)==4){
		 	 if($aParam[3]>0){ // checking unique for update
           $aWhere=array($aParam[1]=>$field_value,$aParam[2].' !='=>$aParam[3]);
			 }else{  // checking unique for insert
	           $aWhere=array($aParam[1]=>$field_value);
			 }

			$row=getRow($aParam[0],$aWhere);
			 if(count($row)>0){
	           $this->CI->form_validation->set_message('check_unique', 'This %s is already used.');
		        return FALSE;
			 }else{
			 	 return TRUE;
			 }	    
			}else{
				debug("Custome %s validation requires four parameters('table_name,unique_field_name,table pk,pk_value')");
			}		
	}

/**
    * @param : $db_param='table_name,unique_field_name,table pk,pk_value' // rowId>0 update
    */
	function valid_unique($field_value,$db_param='')
	{
		 $aParam=@explode(',',$db_param) or debug("Custome %s validation requires proper parameter");
		 
						if(count($aParam)==4){
					 	 if($aParam[3]>0){ // checking unique for update
			               $aWhere=array($aParam[1]=>$field_value,$aParam[2].' !='=>$aParam[3]);
						 }else{  // checking unique for insert
				           $aWhere=array($aParam[1]=>$field_value);
						 }

						 $row=getRow($aParam[0],$aWhere);
						 if(count($row)>0){
				           $this->CI->form_validation->set_message('valid_unique', 'This %s is already used.');
					        return FALSE;
						 }else{
						 	 return TRUE;
						 }	    
						}else{
							debug("Custome %s validation requires four parameters('table_name,unique_field_name,table pk,pk_value')");
						}
		 
		 		
	}

	/**
    * @param : $db_param='table_name,unique_field_name,table pk,pk_value' // rowId>0 update
    */
	function valid_unique_mobile($field_value,$db_param='')
	{
		 $aParam=@explode(',',$db_param) or debug("Custome %s validation requires proper parameter");
		 if(preg_match("/^[0-9][0-9]*$/", $field_value) && strlen($field_value)>=10 && strlen($field_value)<=12){
						if(count($aParam)==4){
					 	 if($aParam[3]>0){ // checking unique for update
			               $aWhere=array($aParam[1]=>$field_value,$aParam[2].' !='=>$aParam[3]);
						 }else{  // checking unique for insert
				           $aWhere=array($aParam[1]=>$field_value);
						 }

						 $row=getRow($aParam[0],$aWhere);
						 if(count($row)>0){
				           $this->CI->form_validation->set_message('valid_unique_mobile', 'This %s is already used.');
					        return FALSE;
						 }else{
						 	 return TRUE;
						 }	    
						}else{
							debug("Custome %s validation requires four parameters('table_name,unique_field_name,table pk,pk_value')");
						}
		 }else{
					$this->CI->form_validation->set_message('valid_unique_mobile', 'Please enter valid %s');
					        return FALSE;
		 }
		 		
	}

/**
    * @param : $db_param='table_name,unique_field_name,table pk,pk_value' // rowId>0 update
    */
	function valid_unique_email($field_value,$db_param='')
	{
		 $aParam=@explode(',',$db_param) or debug("Custome email validation requires proper parameter");
		 if(filter_var($field_value, FILTER_VALIDATE_EMAIL)){
						if(count($aParam)==4){
					 	 if($aParam[3]>0){ // checking unique for update
			           $aWhere=array($aParam[1]=>$field_value,$aParam[2].' !='=>$aParam[3]);
						 }else{  // checking unique for insert
				           $aWhere=array($aParam[1]=>$field_value);
						 }

						$row=getRow($aParam[0],$aWhere);
						 if(count($row)>0){
				           $this->CI->form_validation->set_message('valid_unique_email', 'This %s is already used.');
					        return FALSE;
						 }else{
						 	 return TRUE;
						 }	    
						}else{
							debug("Custome email validation requires four parameters('table_name,unique_field_name,table pk,pk_value')");
						}
		 }else{
					$this->CI->form_validation->set_message('valid_unique_email', 'Please enter valid %s');
					        return FALSE;
		 }
		 		
	}


}