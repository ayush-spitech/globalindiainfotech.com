<?php
if (!function_exists('filterValue')) {

    function filterValue($value,$format='') {
        $value=trim($value);
        if($format=='date'){
          $value=date('Y-m-d',strtotime($value));
      }
      return $value;
  }
}

if (!function_exists('get_payment_status')) {
    function get_payment_status($status) {
        if($status=="0"){
            return "Not Paid";
        }else if($status=="1"){
            return "Paid";
        }else if($status=="2"){
            return "Partial";
        }
    }
}


if (!function_exists('preventUrlDirectAccess')) {

    function preventUrlDirectAccess($page_name) {
        $aThankUPage = array(
            "thank-you-company-registration",
            "thank-you",
            "thank-you-job",
            "thank-you-registration"
        );
        if (in_array($page_name, $aThankUPage)) { // check for direct access
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from(tbl_prefix() . 'links');
            $ci->db->where("links", $page_name);
            $row = $ci->db->get()->row();
            if (!empty($row)) {
                $ci->db->delete(tbl_prefix() . 'links', array("id" => $row->id));
                return 1;
            } else {
                return 0;
            }
        } else {
            return 1; // allow all other pages by default
        }
    }
}


if (!function_exists('getFormatedDate')) {

    function getFormatedDate($date, $format = '') {
        if ($format == '') {
            $format = 'd-M-Y';
        }
        if ($date != "" && $date != "0000-00-00" && $date != "Null" && $date != "null") {
            $date = date($format, strtotime($date));
        } else {
            $date = '';
        }
        return $date;
    }

}


if (!function_exists('checkAdminLogin')) {

    function checkAdminLogin() {      
        if (isset($_SESSION['aUser']) && isset($_SESSION['aUser']->user_id) && $_SESSION['aUser']->user_id>0) {

        }else{
           header("location:".base_url().'admin/');
           exit;
       }
   }

}

if (!function_exists('set_message')) {

    function set_message($msg, $type = 's') {
        $ci = & get_instance();
        switch ($type) {
            case "s":
            $div_class='bg-success';
            $icon_class='glyphicon-check';                
            break;
            case "i":
            $div_class='bg-primary';
            $icon_class='glyphicon-info-sign';                
            break;
            case "e":
            $div_class='bg-danger';
            $icon_class='glyphicon-exclamation-sign';                
            break;
            case "w":
            $div_class='bg-warning';
            $icon_class='glyphicon-warning-sign';                
            break;
            default:
            $div_class='bg-primary';
            $icon_class='glyphicon-info-sign';               
            break;
        }       

        $str_msg='<div id="appMessageContainer" class="alert '.$div_class.'" role="alert" style="display:inline-flex">';
        $str_msg.='<span class="glyphicon '.$icon_class.'"></span>';
        $str_msg.='&nbsp;'.lang($msg).'&nbsp;';
        $str_msg.='<a class="msg-btn pull-right" onclick="removeMessage()" title="Close"><span class="glyphicon glyphicon-remove"></span></a>';
        $str_msg.='</div>';
        $ci->session->set_userdata('msg',$str_msg);
    }

}

if (!function_exists('show_message')) {

    function show_message() {
        $ci = & get_instance();
        echo $ci->session->userdata('msg');
    }

}

if (!function_exists('hide_message')) {

    function hide_message() {
        $ci = & get_instance();
        $ci->session->unset_userdata('msg');
    }

}


if (!function_exists('calcutateAge')) {

    function calcutateAge($dob) {
        $dob = date("Y-m-d", strtotime($dob));
        $dobObject = new DateTime($dob);
        $nowObject = new DateTime();
        $diff = $dobObject->diff($nowObject);
        return $diff->y;
    }

}

if (!function_exists('getRow')) {

    function getRow($tbl_name, $aWhere = array()) {
        $ci = & get_instance();        
        $ci->db->select('*');
        $ci->db->from(tbl_prefix() . $tbl_name);
        $ci->db->where($aWhere);
        $res = $ci->db->get()->row();
        return $res;
    }
}

if (!function_exists('getUser')) {

    function getUser($user_id) {
        $ci = & get_instance();        
        $ci->db->select('*');
        $ci->db->from(tbl_prefix() .'user');
        $ci->db->where('user_id',$user_id);
        $res = $ci->db->get()->row();
        return $res;
    }
}

if (!function_exists('debug')) {

    function debug($arg,$is_die=1) {
        echo "<pre>";
        if ($arg == "qry") {
            $ci = & get_instance();
            echo $ci->db->last_query();
        } else {
            if (is_array($arg) || is_object($arg)) {
                print_r($arg);
            } else {
                echo $arg;
            }
        }
        if($is_die){
             echo exit;
         }       
    }

}
if (!function_exists('selected')) {

    function selected($left, $right) {
        if ($left == $right) {
            echo 'selected="selected"';
        }
    }

}
if (!function_exists('checked')) {

    function checked($left, $right) {
        if ($left == $right) {
            echo 'checked="checked"';
        }
    }

}
if (!function_exists('get_active')) {

    function get_active($left, $right) {
        if ($left == $right) {
            echo 'active';
        }
    }

}