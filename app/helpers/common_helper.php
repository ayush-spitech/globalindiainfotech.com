<?php 
//-------------other--------------------
function get_media($media_name,$is_thumbnail=true){
    $image='default/no-image.png';
    $path=config_item('media_path').$media_name;   
    if(!is_dir($path) && file_exists($path)){
        $image=$media_name;
    }
    $response='<img src="'.base_url().'media/'.$image.'"/>';    
    if($is_thumbnail){
        $response='<img height="60" width="60" src="'.base_url().'media/'.$image.'"/>';
    }
    echo $response;
}

function random_string($length = 16)
{
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$password = substr(str_shuffle($chars), 0, $length);
	return $password;
}

function send_sms($MobileNo, $Message)
{
    if (SMS_SERVICE == 1) {
        $request = "";
        if (!empty($MobileNo) && $MobileNo != "0" && !empty($Message)) {

            //=======UNCOMMENT HERE================
            $MobileNo1 = $MobileNo;
            $param["user"] = config_item('bulk_sms_username');
            $param["pass"] =  config_item('bulk_sms_pass');
            $param["sender"] =  config_item('bulk_sms_sender_id');
            $param["phone"] = $MobileNo1;
            $param["text"] = $Message;
            for($i=1;$i<=4;$i++) {
                $param1=config_item('bulk_sms_param'.$i);
                $value=config_item('bulk_sms_param_value'.$i);
                if($param1!='' && $value!=''){
                     $param[$param1]=$value;  
                 }               
            }
            //$param["priority"] = "ndnd";  // dnd   or ndnd
            //$param["sender"] = "BCREVT";
            //$param["stype"] = "normal";
            //$url = "http://sendsms.spitechwebservices.com/api/sendmsg.php";
            $url=config_item('bulk_sms_url');
            foreach ($param as $key => $val) {
                $request.= $key . "=" . urlencode($val);
                $request.= "&";
            }
            $request = substr($request, 0, strlen($request) - 1);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_URL, $url); //set the url
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //return as a variable
            curl_setopt($ch, CURLOPT_POST, 1); //set POST method
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
            $response = curl_exec($ch); //run the whole process and return the response
            curl_close($ch); //close the curl handle
            echo $url.'?'.$request;
            return $response;
        }
    }
}
/*
  @name : upload_media : uploads media files like doc,pdf,images etc.
  @param : $file_control_name : Name of html file control name used for browsing  file
  @param : $upload_path : destination folder path
  @param : $max_size : maximum allowed size of file in kb.
  @param : $allowed_types :allowed file types like jpg|jpeg|png|pdf|docx|doc
 */

  function upload_media($file_control_name = 'thumbnail', $allowed_types = 'jpg|jpeg|png|gif|bmp|pdf|docx|doc', $upload_path = '', $max_size = '200000')
  {
    $ci = & get_instance();
    $image_data = array();
    if ($upload_path == "") {
        $upload_path = './media/';
    }
    //debug($allowed_types);
    $config['upload_path'] = $upload_path;
    $config['allowed_types'] = $allowed_types;
    $config['overwrite'] = false;
    $config['max_size'] = $max_size;
    $ci->load->library('upload', $config);
    $thumbnail = "";
    if (!$ci->upload->do_upload($file_control_name)) {
        $image_data = array('error' => $ci->upload->display_errors());      
    } else {
        $image_data = $ci->upload->data();
    }
    return $image_data;
}

function upload_multiple_file($files = 'images', $prefix = '', $upload_path = './media/', $max_size = '200000', $allowed_types = 'jpg|jpeg|png|gif|bmp|pdf|docx|doc')
{
    $ci = & get_instance();
    $config = array(
        'upload_path' => $upload_path,
        'allowed_types' => $allowed_types,
        'overwrite' => false,
        'max_size' => $max_size
    );

    $ci->load->library('upload', $config);
    $images = array();
    foreach ($files['name'] as $key => $image) {
        $_FILES['images[]']['name'] = $files['name'][$key];
        $_FILES['images[]']['type'] = $files['type'][$key];
        $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
        $_FILES['images[]']['error'] = $files['error'][$key];
        $_FILES['images[]']['size'] = $files['size'][$key];
        $prefix=date('Ymdhis');
        $fileName = $prefix .'_' . $image;
        $images[] = $fileName;
        $config['file_name'] = $fileName;
        $ci->upload->initialize($config);

        if ($ci->upload->do_upload('images[]')) {
            $ci->upload->data();
        } else {
            return false;
        }
    }
    return $images;
}

/*
  @name : remove_media : delete media files like doc,pdf,images etc.
  @param : $file_name : file name.
  @param : $dir : destination folder.
 */

  function remove_media($file_name, $dir = '')
  {
    if($dir==''){
        $dir=config_item('media_path');
    }
    $complete_path = $dir . $file_name;
    if(!is_dir($complete_path && file_exists($complete_path))){
        chmod($complete_path,0777);
        unlink($complete_path);
    }
    
}
if(!function_exists('show_image')){
    function show_image($img_name,$attribute=array(),$show_path=0){
        $path=config_item('media_path').$img_name;
        if($show_path==1){
            echo $path;  
        }        
        if(!file_exists($path) || is_dir($path)){
            $img_name='default/no-image.jpg';
        }
        $src=config_item('media_url'). $img_name;
        $atrbts ='';
        if (isset($attribute) && is_array($attribute) && !empty($attribute)) {
            foreach ($attribute as $key => $value) {
                if($value!=''){
                   $atrbts.=$key.'="'.$value .'" ';
               }               
           }
       }      
       $img = '<img src="' . $src .'" '.$atrbts .'/>';
       echo $img;
   }
}

?>