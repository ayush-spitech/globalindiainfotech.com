<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class AppSecurity{

    static  function encrypt($value,$key){ 
        $ci=& get_instance();
         $ci->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => $key,
                    'driver'=>'mcrypt'
            )
        );
      return $ci->encryption->encrypt($value);
    }

    static function decrypt($value,$key){
         $ci=& get_instance();
         $ci->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => $key,
                    'driver'=>'mcrypt'
            )
        ); 
        //debug($value."<br/>".$key);         
      $value=$ci->encryption->decrypt($value);     
      //debug($value."<br/>".$key);   
      return $value;
    }

 }
 ?>