<?php include_once( 'partials/header.php');?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default login-box">
            <div class="form-group text-center">
                <a href="<?php echo base_url()?>admin/">
					<img width="350" src="<?php echo base_url()?>media/<?php echo config_item('site_logo')?>" class="admin-logo"/>
				</a>
            </div>
            <div class="panel-heading">
                <?php echo lang( 'Password Reset');?>
            </div>
            <div class="panel-body">
                <?php show_message();?>
                <?php $aAttributes=array( "id"=>"form1","role"=>"form"); echo form_open('',$aAttributes); ?>
                <fieldset>
                    <div class="form-group">
                        <?php $email='' ; if(isset($_POST[ 'email'])){ $email=$_POST[ 'email']; }?>
                        <input class="form-control" placeholder="<?php echo lang('Email')?>" name="email" id="email" type="email" autofocus="" validate="Required" />
                        <div id="error_email" class="error">
                            <?php echo form_error( 'email')?>
                        </div>
                    </div>

                    <input type="hidden" name="submitform" id="submitform" value="submit">
                    <a onclick="formValidate('form1')" class="btn btn-primary">
                        <?php echo lang( 'Send New Password To Email');?>
                    </a>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- /.row -->
<?php include_once( 'partials/footer.php');?>