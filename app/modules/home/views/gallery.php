<?php include_once('header.php') ?>
<script>document.getElementById('gallery').setAttribute('class','active')</script>
<div class="main-content bg-lighter"> 
  <!-- Section: inner-header -->
  <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php site_assets()?>images/bg/bg6.jpg">
    <div class="container pt-70 pb-20"> 
      <!-- Section Content -->
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <h2 class="title text-white text-center">Gallery</h2>
            <ol class="breadcrumb text-left text-black mt-10">
              <li><a href="<?php echo base_url(); ?>">Home</a></li>
              <li class="active text-gray-silver">Gallery</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  
      <section>  
  <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
            
        <?php 
  // debug($aGallery);
   if(isset($aGallery) && is_array($aGallery) && !empty($aGallery)){ 
   
   
     foreach ($aGallery as $row) { 
   ?>
            <h3 class="text-uppercase mt-15"><?php echo $row->title; ?></h3>
             <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
        <?php    

          $aImages=$row->aImage;       

          if(isset($aImages) && is_array($aImages) && !empty($aImages)){           

            foreach ($aImages as $data) { 

              $image=base_url().'media/'.$data->image;

       ?>
	         
             <div class="gallery-item">
                  <div class="thumb">
                    <img src="<?php echo $image; ?>" class="img-fullwidth gallery-img-thumb" alt="<?php echo $data->title; ?>" >
                                  
                    <div class="overlay-shade"></div>
                    <div class="text-holder">
                      <div class="title text-center"><?php echo $data->title; ?></div>
                    </div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?php echo $image; ?>" data-lightbox-gallery="gallery" title="<?php echo $data->title; ?>"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- End Portfolio Gallery Grid -->
           <?php } } ?>
         </div>
         <div class="clearfix"></div>
         <?php
		}} ?>
          

            </div>
          </div>
        </div>
      </div>
  
        <section>
      
</div>

<?php include_once('footer.php') ?>
