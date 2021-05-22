<!doctype html>
<html lang="hn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $title;?></title>
	
	<link rel="shortcut icon" href="<?php echo config_item('media_url').config_item('site_favicon')?>" type="image/x-icon">
	<link href="<?php assets();?>css/bootstrap.css" rel="stylesheet">
	<link href="<?php assets();?>css/datepicker3.css" rel="stylesheet">
	<link href="<?php assets();?>font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php assets();?>css/select2.css" rel="stylesheet">
	<link href="<?php assets();?>css/bootstrap-clockpicker.css" rel="stylesheet">
	<link href="<?php assets();?>css/dropzone.css" rel="stylesheet">
	<link href="<?php assets();?>bootstrap-table/bootstrap-table.css" rel="stylesheet">
	<link href="<?php assets();?>bootstrap-table/extensions/reorder-rows/bootstrap-table-reorder-rows.css" rel="stylesheet">
	<link href="<?php assets();?>css/styles.css" rel="stylesheet">
	<link href="<?php assets();?>css/theme.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<script src="<?php assets();?>js/jquery-1.11.1.min.js" ></script>
<script src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
<script src="<?php assets();?>js/dropzone.js"></script>
<!---Custom Javascript-->
<script type="text/javascript">
	var BASE_URL='<?php echo base_url()?>';
	var MEDIA_URL='<?php echo media_url()?>';
	var MODULE_ID='<?php if(isset($moduleId)) echo $moduleId; else echo '0'; ?>';
</script>
<script src="<?php assets();?>js/app/app.js"></script>
<script src="<?php assets();?>js/app/validations.js"></script>
<script type="text/javascript">
	var csrf_token_name='<?php echo $this->security->get_csrf_token_name()?>';
	var csrf_value='<?php echo $this->security->get_csrf_hash();?>';
	function change_language(){		
		var language=$('#language').val();		
		$.ajax({
			url:BASE_URL+'admin_language/set_default_language/',
			type:'POST',
			data:{language:language,csrf_token_name:csrf_value},
			success:function(response){
				window.location.reload();
			}
		});
	}
</script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>

					<a class="navbar-brand" href="<?php echo base_url()?>admin_dashboard/"><?php echo lang('Administrator')?></a>

					<ul class="user-menu">
						<?php if(config_item('is_multilingual')=="1"){?>
						<li class="lang-dropdown pull-left"><?php 
						$language='';
						if(isset($_POST['language'])){
							$language=$_POST['language'];
						}else{
							$language=config_item('language');
						}
						$aLanguage=$this->common_model->get_languages();						
						if(isset($aLanguage) && is_array($aLanguage) && !empty($aLanguage)){
							foreach ($aLanguage as $key => $value) {
								$aOption[$value->language]=strtoupper($value->language);
							}
						}
						$attribute='id="language" class="form-control" onchange="change_language()"';
						echo form_dropdown('language',$aOption,$language,$attribute);
						?>						
					</li>
					<?php }?>
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['aUser']->name;?><span class="caret">
						</span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo base_url()?>admin_dashboard/profile/"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
							<li><a href="<?php echo base_url()?>admin_dashboard/change_password/"><span class="glyphicon glyphicon-cog"></span><?php echo lang('Change Password')?></a></li>
							<li><a href="<?php echo base_url()?>admin/logout/"><span class="glyphicon glyphicon-log-out"></span><?php echo lang('Logout')?></a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<?php include_once('sidebar.php');?>	
	