<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

public  $moduleUrl='',$moduleId='0';
    function __construct() {
        parent::__construct();       
        if(session_status()==PHP_SESSION_NONE){
            session_start();
        }
        
        //$this->load->model('MY_Model','oMyModel');
    }

    function setModuleUrl($arg){
     $this->moduleUrl=base_url().$arg.'/';
    }

    function getModuleUrl(){
      return $this->moduleUrl;	
    }

    function setModuleId($arg){
     $this->moduleId=$arg;
    }

    function getModuleId(){
      return $this->moduleId;  
    }

    function index() {
        
    }

    function setTable($tbl_name){
      $this->oMainModel->setTable($tbl_name);   
    }
}
        
 ?>