<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function simple_ckeditor($sInputId,$sWidth,$sHeight,$sLanguage = 'en'){
	
	?>
	<!--<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>-->
	<script type="text/javascript">
			CKEDITOR.replace( '<?php echo $sInputId;?>',{toolbar : 'Basic',language: '<?php echo $sLanguage;?>',enterMode: CKEDITOR.ENTER_BR,width : '<?php echo $sWidth;?>'});	
	</script>
	<?php
}

function full_ckeditor($sInputId,$sWidth,$sHeight,$isOnBlurValue = '',$sLanguage = 'en'){
	// script_tag('tinymce/jscripts/tiny_mce/tiny_mce.js'); 
	?>
	
	<script type="text/javascript">
		CKEDITOR.replace( '<?php echo $sInputId;?>',{
			toolbar : 'Full',width : '<?php echo $sWidth;?>',height : '<?php echo $sHeight;?>',
			language: '<?php echo $sLanguage;?>',
			enterMode: CKEDITOR.ENTER_BR
		});	
		<?php if($isOnBlurValue != '') {?>
				CKEDITOR.instances.<?php echo $sInputId;?>.on('blur', function(e) {
					var ckValue = $(CKEDITOR.instances['<?php echo $sInputId;?>'].getData()).text();
					if(ckValue == '') {
						var ckValue = CKEDITOR.instances.<?php echo $sInputId;?>.getData(); //alert(ckValue2);
					}
					var len = ckValue.length;
					 if (len >= 160) {				
					   $("#<?php echo $isOnBlurValue;?>").val(ckValue.substring(0, 160));
					 } 
					 else {
					 	$("#<?php echo $isOnBlurValue;?>").val(ckValue);
					 }
			    });
				
	  
	   <?php } ?>
	</script>
	<?php
}
?>