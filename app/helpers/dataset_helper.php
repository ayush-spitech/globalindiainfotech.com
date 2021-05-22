<?php
/*
This helper file will contain data set needed for selection and choice pupose. These will be hardcoded.
*/


function status(){
	$status=array('1'=>lang('Active'),'0'=>lang('Inactive'));
	return  $status;
}
function room_status(){
	$status=array('0'=>lang('Open'),'1'=>lang('Booked'));
	return  $status;
}
function booking_status(){
	$status=array('0'=>lang('New Booking'),'1'=>lang('Booking Confirm'),'2'=>lang('Booking Used'),'3'=>lang('Cancelled'));
	return  $status;
}
function property_status(){
	$status=array('1'=>lang('Active'),'2'=>'Maintenance','0'=>lang('Inactive'));
	return  $status;
}

function get_date_format(){
	$status=array(
		''=>lang('Select Date Format'),
		'm/d/Y'=>date('m/d/Y'),
		'Y/M/d'=>date('Y/M/d'),
		'd/m/Y'=>date('d/m/Y'),		
		'd-m-Y'=>date('d-m-Y'),
		'd-M-Y'=>date('d-M-Y')
	);
	return  $status;
}

function get_room_category(){
	$ci=& get_instance();
	$ci->db->select('t1.*');
	$ci->db->from(tbl_prefix().'room_category as t1');
	$ci->db->where('t1.status',1);
	$aCategory=$ci->db->get()->result();
	$aOption=array();
	if(isset($aCategory) && is_array($aCategory) && !empty($aCategory)){
		foreach ($aCategory as $row) {
			$aOption[$row->category_id]=$row->category;
		}
	}
	return  $aOption;
}
function get_name_title(){
	$data=array(       
		'1'=>lang('Mr'),
		'2'=>lang('Miss'),
		'3'=>lang('Mrs')
	);
	return  $data;
}
function get_id_proof(){
	$data=array(       
		'1'=>lang('Arm License'),
		'2'=>lang('Driving License'),
		'3'=>lang('Adhaar(UID)'),
		'4'=>lang('Election Commission ID Card'),
		'5'=>lang('Driving License'),
		'6'=>lang('Arms Licence'),
		'7'=>lang('Ration Card with Photo, for the person whose photo is affixed')
	);
	return  $data;
}
function get_address_proof(){
	$data=array(       
		'1'=>lang('Arm License'),
		'2'=>lang('Driving License'),
		'3'=>lang('Adhaar(UID)'),
		'4'=>lang('Election Commission ID Card'),
		'5'=>lang('Driving License'),
		'6'=>lang('Arms Licence'),
		'7'=>lang('Ration Card with address'),
		'8'=>lang('Electricity Bill ( not older than last three months)'),
		'9'=>lang('Water Bill (not older than last three months)'),
		'10'=>lang('Telephone Bill of Fixed line (not order than last three months)')
	);
	return  $data;
}
function get_floors(){
	$data=array();
	for($i=1;$i<=10;$i++){
		$data[$i]=lang('Floor').'-'.$i;
	}
	return $data;
}
function get_financial_year(){
	$data=array(""=>lang("Select Financial Year"));
	for($i=date('Y');$i>=2012;$i--){
		$from='01-Apr-'.$i;
		$to='31-Mar-'.($i+1);
		$value=$from.'|'.$to;
		$display=$from.' TO '.$to;
		$data[$value]=$display;
	}
	return $data;
}
