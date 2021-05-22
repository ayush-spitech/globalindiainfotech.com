<?php include_once('header.php') ?>
<script>document.getElementById('<?php echo $cms->menu; ?>').setAttribute('class','active');</script>
<div class="main-content bg-lighter">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php site_assets()?>images/bg/bg6.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white text-center"><?php echo $cms->page_title; ?></h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
               
                <li class="active text-gray-silver"><?php echo $cms->page_title; ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: About -->
    <section id="about">
      <div class="container mt-50 pb-70 pt-0">
        <div class="section-content">
          <div class="row mt-10">
            <div class="col-sm-12 col-md-12 mb-sm-20 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <div class="col-sm-12 col-md-12">
              <h3 class="text-uppercase mt-15"><?php echo $cms->page_title; ?></h3>  
              </div>           
               
               <?php echo html_entity_decode($cms->page_content); ?>               
              
            </div>
           
          </div>
        </div>
      </div>
    </section>


  </div>
<?php include_once('footer.php') ?>
