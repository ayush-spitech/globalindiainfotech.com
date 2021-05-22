<div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-black"  style="background:#002147 !important;">
        <div class="container">
          <nav id="menuzord-right" class="menuzord default">
            <a class="menuzord-brand pull-left flip" href="<?php echo base_url(); ?>">
              <img src="<?php site_assets()?>images/logo.png" alt="Global India Infotech" class="my-logo mg-responsive">
            </a>
            <ul class="menuzord-menu">
              <li id="home"><a href="<?php echo base_url(); ?>">Home</a></li>                 
              <li id="about"><a href="">About Us</a>
                <ul class="dropdown">
                   <li><a href="<?php echo base_url(); ?>about">Introduction</a></li>
                  <li><a href="<?php echo base_url(); ?>vision-mission">Vision, Mission & Values</a></li>
                  <li><a href="<?php echo base_url(); ?>founders-message">Founder's Message</a></li>    

                </ul>
              </li>
             <li  id="service"><a href="">Services </a>
                <ul class="dropdown">
                       <?php
          if(isset($aService) && is_array($aService) && !empty($aService)){
            foreach ($aService as $row)
            {
               $name=$row->caption;
          
          ?>
          <li><a href="<?php echo base_url()?>service?service=<?php echo base64_encode($row->service_id);?>"><?php echo $row->caption; ?></a></li>
            <?php } } ?>
                  
               
                </ul>
              </li>
              
               <li id="industry">
								<a href="">Industries</a>
								<ul class="dropdown">
                  <?php
          if(isset($aIndustry) && is_array($aIndustry) && !empty($aIndustry)){
            foreach ($aIndustry as $row)
            {
               $name=$row->caption;
          
          ?>
            <li><a href="<?php echo base_url()?>industry?industry=<?php echo base64_encode($row->industry_id);?>"><?php echo $row->caption; ?></a></li>
            <?php } } ?>
                  
								</ul>
							</li>
              <li id="gallery"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
              <li id="contact"><a href="<?php echo base_url(); ?>contact">Contact Us</a></li>                           
           </ul>
          </nav>
        </div>
      </div>
    </div>