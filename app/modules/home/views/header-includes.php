<!doctype html>
<html lang="en">
<head>
<title><?php echo $cms->page_title;?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1">
<?php meta_tags($cms)?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo config_item('media_url').config_item('site_favicon')?>">
<link href="<?php site_assets()?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/css-plugin-collections.css" rel="stylesheet"/>
<link id="menuzord-menu-skins" href="<?php site_assets()?>css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<link href="<?php site_assets()?>css/style-main.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/preloader.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/responsive.css" rel="stylesheet" type="text/css">
<link  href="<?php site_assets()?>js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="<?php site_assets()?>js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="<?php site_assets()?>js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>
<link href="<?php site_assets()?>css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">
<link href="<?php site_assets()?>css/social-media-buttons.css" rel="stylesheet" type="text/css">
<script src="<?php site_assets()?>js/jquery-2.2.4.min.js"></script>
<script src="<?php site_assets()?>js/jquery-ui.min.js"></script>
<script src="<?php site_assets()?>js/bootstrap.min.js"></script>
<script src="<?php site_assets()?>js/jquery-plugin-collection.js"></script>
<script src="<?php site_assets()?>js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php site_assets()?>js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
	var BASE_URL='<?php echo base_url();?>';
	var csrf_token_name='<?php echo $this->security->get_csrf_token_name()?>';
	var csrf_hash='<?php echo $this->security->get_csrf_hash()?>';
</script>
<?php 
$csrf_token_name=$this->security->get_csrf_token_name();
$csrf_hash=$this->security->get_csrf_hash();
?>
<link type="text/css" href="<?php site_assets();?>framework/css/custom.css" rel="stylesheet"  />
<script type="text/javascript" src="<?php site_assets();?>framework/js/validations.js"></script>
<script type="text/javascript" src="<?php site_assets();?>framework/js/app.js"></script>
<script type="text/javascript" src="<?php site_assets();?>framework/js/functions.js"></script>
<?php google_analytics();?> 
</head>
<body>