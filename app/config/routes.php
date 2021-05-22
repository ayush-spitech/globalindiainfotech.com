<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$aAdmin=array("admin","admin_dashboard","common","admin_news","admin_career","admin_customer","admin_order","superadmin","admin_user","admin_enquiry","admin_cms","admin_feedback","admin_gallery","admin_banner","admin_testimonial","admin_language","admin_recipe","admin_category","admin_product","admin_job_application","admin_facility","admin_faculty","admin_topper","admin_download","admin_course","admin_media","admin_service","admin_support","admin_industry");

foreach ($aAdmin as $controller) {	
	$route["$controller/(:any)"]="admin/$controller/$1";
	$route["$controller"]="admin/$controller/index/";	
	$route["$controller/(:any)/(:any)"]="admin/$controller/$1/$2";
}

$route["home_ajax/(:any)"]="home/home_ajax/$1";
$route["home_ajax"]="home/home_ajax/index/";	


$str_admin=implode("|",$aAdmin);
$route['^(?!'.$str_admin.').*'] = "home/$0";
