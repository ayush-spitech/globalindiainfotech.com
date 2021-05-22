<?php include_once('header.php'); ?>
<script>document.getElementById('<?php echo $cms->menu; ?>').setAttribute('class','active');</script>
<?php 
if(isset($aSupportDetails) && is_object($aSupportDetails) && !empty($aSupportDetails)){
  $support_id=$aSupportDetails->support_id;
  $support_name=$aSupportDetails->caption;
  $image=$aSupportDetails->image;
  $description=$aSupportDetails->short_description;
  if($image!=''){
    $image=base_url().'media/'.$image;
    $image='<img src="'.$image.'" class="img-fullwidth support-img-details" alt="'.$support_name.'"  />';
  }
}

?>


<div class="main-content bg-lighter">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php site_assets()?>images/bg/bg6.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white text-center"><?php echo $support_name ?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
               
                <li class="active text-gray-silver"><?php echo $support_name ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: About -->
    <section >
      <div class="container mt-50 pb-70 pt-0">
        <div class="section-content">
          <div class="row mt-10">
            <div class="col-sm-12 col-md-12 mb-sm-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <h3 class="text-uppercase mt-15"><?php echo $support_name ?></h3> 

                  <?php echo $image; ?>             
               
               <?php echo $description; ?>        
              
            </div>
           
          </div>
        </div>
      </div>
    </section>


  </div>
<?php include_once('footer.php') ?>
