<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
This helper file contains all the methods whose walue depend upon the app settings done from admin panel and stored into the database.
*/
function config_date($date){
    $ci=& get_instance();
    $response='';    
    if($date!='' && $date!='0000-00-00'){
        $response=date(config_item('date_format'),strtotime($date));
    }
    return $response;
}

function config_money($amount){
    $response='0'; 
    if($amount!='' && $amount>0){
        $place=2;
        if(config_item('decimal_places')>0){
            $place=config_item('decimal_places');
        }
        $response=@number_format($amount,$place,config_item('decimal_seperator'),config_item('thousand_seperator')) or die('Decimal Places, Decimal seperator, Thousand seperator is not configured in app settings.');       
    }
    $currency=config_item('currency');
    if($currency=='Rs.'){
        $currency='<i class="fa fa-rupee black"></i>';
    }    
    if(config_item('currency_placement')=='before'){
    	$response=$currency.' '.$response;
    }else  if(config_item('currency_placement')=='after'){
    	$response=$response.' '.$currency;
    }
    return $response;
}