<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct() {        
		parent::__construct();		
		parent::setModuleUrl('home');
		$this->load->model('HomeModel','oMainModel');
			
		$this->load->models(array(
		    'admin/Enquiry_model',
			'admin/Feedback_model',
			'admin/Banner_model',
			'admin/Gallery_model',
			'admin/Media_model',
			'admin/News_model',
			'admin/Facility_model',
			'admin/Faculty_model',
			'admin/Topper_model',
			'admin/Course_model',
			'admin/Service_model',
			'admin/Support_model',
			'admin/Industry_model',
			'admin/Download_model'	
		
		));			
	}

	function _remap($method)
	{		
		$pages=array('index','videos','curriculum','about','contact','vision-mission','founders-message','solution','quality-policy','facilities','directors-message','gallery','sitemap','facilities','fee-structure','terms-conditions','privacy-policy','faculty','toppers','disclaimer','download','course','enquiry','downloads','news-media','academic-calendar','faculty','examination','admission-procedure','code-of-conduct','scholarship','management','admission','admission-process','placement','departments','events','syllabus','feedback','imp-links','edu-links','videos','events','service','support','industry');
		if(config_item('is_suspended')=="1"){
			suspended();
		}else if(config_item('is_underconstruction')=="1"){
			underconstruction();
		}else if(in_array($method,$pages)){
			$this->cms_page($method);
		}else{
			page_not_found();			
		}	
	}  	

	function cms_page($page_name){		
		$view_name=$page_name;
		$data['aNews']=$this->News_model->get_list_home();
		$data['aCourse']=$this->Course_model->get_list_home();
		$data['aService']=$this->Service_model->get_list_home();
		$data['aSupport']=$this->Support_model->get_list_home();
		$data['aIndustry']=$this->Industry_model->get_list_home();
		
		switch ($page_name) {
			case "index":
			$view_name='index';
			$str_select='t1.image,t1.caption,t1.short_description';
			$data['aBanner']=$this->Banner_model->get_list_home($str_select,array("t1.status"=>'1'));
		    //$data['aGallery']=$this->Gallery_model->get_list_home();
			$data['aGalleryImages'] = $this->oMainModel->gallery_image_list1(array('b.status' => '1'),'8');
			
			$data['aFacility']=$this->Facility_model->get_list_home();
			$data['aTopper']=$this->Topper_model->get_list_home();
			break;
			
			/*case "facilities":
			$view_name='facilities';					
			$data['aFacility']=$this->Facility_model->get_list_home();
			break;*/
			
			case "faculty":
			$view_name='faculty';					
			$data['aFaculty']=$this->Faculty_model->get_list_home();	
			break;
			
			case "toppers":
			$view_name='toppers';					
			$data['aTopper']=$this->Topper_model->get_list_home();
			break;
			
		    case "gallery":
			$view_name='gallery';					
			$data['aGallery']=$this->Gallery_model->get_list_home();		
			break;
			
			case "events":
			$view_name='events';					
			$data['aMedia']=$this->Media_model->get_list_home();		
			break;
			
			case "course":
			$view_name='course';
			$course_id=1;
			if(isset($_GET['course'])){
				$course_id=base64_decode($_GET['course']);
			}						
			$data['aCourseDetails']=get_row('course',array("course_id"=>$course_id));			
			break;

			case "service":
			$view_name='service';
			//$course_id=1;
			if(isset($_GET['service'])){
				$service_id=base64_decode($_GET['service']);
			}						
			$data['aServiceDetails']=get_row('service',array("service_id"=>$service_id));			
			break;

			case "industry":
			$view_name='industry';
			//$course_id=1;
			if(isset($_GET['industry'])){
				$industry_id=base64_decode($_GET['industry']);
			}						
			$data['aIndustryDetails']=get_row('industry',array("industry_id"=>$industry_id));			
			break;

			case "support":
			$view_name='support';
			$support_id=1;
			if(isset($_GET['support'])){
				$support_id=base64_decode($_GET['support']);
			}						
			$data['aSupportDetails']=get_row('support',array("support_id"=>$support_id));			
			break;
			
			case "downloads":
			$view_name='downloads';					
			$data['aDownload']=$this->Download_model->get_list_home();		
			break;
			
			case "contact":
			$view_name='contact';
			$this->save_enquiry();		
			break;	
				
			
			case "enquiry":
			$view_name='enquiry';
			$this->save_enquiry();	
			break;
			
			case "feedback":
			$view_name='feedback';
			$this->save_feedback();	
			break;	
	

			
		}
		$cms_pages=array('about','vision-mission','founders-message','solution','facilities','directors-message','fee-structure','terms-conditions','privacy-policy','disclaimer','academic-calendar','examination','admission-procedure','code-of-conduct','scholarship','management','quality-policy','admission-process','placement','departments','syllabus','imp-links','edu-links','videos');			
		if(in_array($page_name,$cms_pages)){
			$view_name='cms';
			//$menu='about';
		}
		
		parent::setTable('cms');
		$cms=$this->oMainModel->getRecord('t1.*',array('page_name'=>$page_name));
		$data['cms']=$cms;
		$data['menu']=$cms->menu;
		$this->load->view($view_name,$data);
	}	


function save_enquiry() {
	
       if($_POST['submit']) {
		  echo "Hello";
            $res=$this->oMainModel->save_enquiry();
         if($res['is_error']==0) {
             set_message('Thanks for submitting enquiry, we will contact you soon.');
         } else {
            set_message($response['msg'],'e');
         }
       redirect(base_url()."contact/");
		
       }
   }
function save_feedback() {
	
       if($_POST['submit']) {
		  echo "Hello";
            $res=$this->oMainModel->save_feedback();
         if($res['is_error']==0) {
             set_message('Thanks for submitting enquiry, we will contact you soon.');
         } else {
            set_message($response['msg'],'e');
         }
       redirect(base_url()."feedback/");
		
       }
   }
}
?>