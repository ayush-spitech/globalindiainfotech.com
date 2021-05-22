<script type="text/javascript" src="<?php site_assets()?>js/custom.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.actions.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.carousel.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.migration.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.navigation.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.parallax.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js"></script> 
<script type="text/javascript" src="<?php site_assets()?>js/revolution-slider/js/extensions/revolution.extension.video.min.js"></script>
<script>
$.ajaxPrefilter(function( options, original_Options, jqXHR ) {
    options.async = true;
});
var len=document.getElementsByClassName('dont-repeat').length;
for(var i=1;i<len;i++)
{
	document.getElementsByClassName('dont-repeat').item(i).style.display='none';
}
</script>
</body>
</html>
