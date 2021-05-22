<?php include_once('header.php') ?>
<!-- Start main-content -->
<div class="main-content">
  <?php include_once('slider.php') ?>  
  <!-- Section: About -->
  <section id="about">
    <div class="container pb-70">
      <div class="section-content">
        <div class="row">
          <div class="col-md-8 col-sm-12 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
            <h2 class="text-uppercase mt-0">Welcome To <span class="text-theme-color-2"> Global India Infotech</span></h2>
            <div class="description">           
              <p class="text-justify">It gives us immense pleasure to welcome you to Global India Infotech. We are always there as your business partner, offering you world class services that help you stay compliant. We are more than happy to hear from all our valued clients and have the pleasure to meet your needs and exceed your expectations. We are dedicated to help you successfully implement your solutions to achieve operational efficiencies, improve outcomes, and drive value to your organization, your customers and your collaborative partners. </p>
<p class="text-justify">Our people are our real asset that gives us a differentiated presence. We’re passionate about making a noticeable impact in every service we render. Our inimitable expertise and approach deliver enduring results, true to each client’s specific situation. </p>
<p class="text-justify">We are privileged to have work with some really reputable companies and helped them to improve their service experience and develop stronger ongoing relationships with their customers leading to better performance and enhanced profits.</p>
<p class="text-justify">We perform our business with professional attitude and integrity. Our values of honesty, integrity, commitment and delivery are important to us. We strive for excellence and aim to exceed expectations. Maintaining our competitive edge through innovation is vital to the way we operate and we are always looking to improve our business processes and services.</p>

              <a class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-left" href="">Read more</a> </div>
          </div>
          <div class="col-md-4 col-sm-12 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
          <img src="<?php site_assets()?>images/home-image-1-1.png" alt="Global India Infotech" class="img-responsive">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 



  <div class="edm-home-top-section edm-clearfix" style="background:#EFEFEF;">
    <div class="container"><section id="custom_html-3" class="widget_text widget widget_custom_html"><div class="textwidget custom-html-widget"><div class="services-wrapper">
  <div class="row">
    <div class="col-md-12">
        <h2 class="mt-0 line-height-1 text-center text-uppercase mb-50 text-black-333"><b>End user support <span class="text-theme-color-2">services</span></b></h2>
     
    </div>
  </div>
  <div class="row">

 <?php
          if(isset($aSupport) && is_array($aSupport) && !empty($aSupport)){
            foreach ($aSupport as $row)
            {
               $name=$row->caption;
               $thumbnail=base_url().'media/'.$row->thumbnail;
          
  ?>

    <div class="col-md-3">
      <div class="services-box"><a href="<?php echo base_url()?>support?support=<?php echo base64_encode($row->support_id);?>">
       <img src="<?php echo $thumbnail; ?>" alt="Support Services" class="services-img" />
        <h4 class="services-title"><?php echo $row->caption; ?></h4>
        </a> </div>
    </div>

  <?php } } ?>



  </div>
</div>
</div></section></div>
  </div><!-- .edm-home-top-section -->
  




  <section>
    <div class="container pt-70 pb-40">
      <div class="section-title text-center">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h2 class="mt-0 line-height-1 text-center text-uppercase mb-10 text-black-333">Our <span class="text-theme-color-2">What We Offer</span></h2>
          </div>
        </div>
      </div>
      <div class="row multi-row-clearfix">
        <div class="col-md-12">
          <div class="owl-carousel-3col owl-nav-top" data-dots="true">
    <?php
          if(isset($aService) && is_array($aService) && !empty($aService)){
            foreach ($aService as $row)
            {
               $name=$row->caption;
               $image=base_url().'media/'.$row->image;
          
          ?>
            <div class="item">
              <div class="project mb-30 border-2px">
                <div class="thumb"> <img class="img-fullwidth courses-img" alt="Primary Level" src="<?php echo $image; ?>"> </div>
                <div class="project-details p-15 pt-10 pb-10">
                  <h5 class="text-uppercase mt-0"><a href="<?php echo base_url()?>service/?service=<?php echo base64_encode($row->service_id);?>"><?php echo $row->caption; ?></a></h5>
                  <p class="text-justify"><?php echo substr($row->short_description, 0, 120)?>...</p>
                  <a class="btn btn-flat btn-dark btn-theme-colored btn-sm text-center" href="<?php echo base_url()?>service/?service=<?php echo base64_encode($row->service_id);?>">Read more</a> </div>
              </div>
            </div>
            
             <?php } } ?>


          </div>
        </div>
      </div>
    </div>
  </section>
  
 
</div>
<!-- end main-content -->
<?php include_once('footer.php') ?>
