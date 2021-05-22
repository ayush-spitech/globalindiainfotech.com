<footer id="footer" class="footer bg-black-222" data-bg-img="images/footer-bg.png">
   <div class="container pt-70 pb-40">
      <div class="row">
         <div class="col-sm-6 col-md-3">
            <div class="widget dark">
               <img class="mb-15" alt="" src="<?php site_assets()?>images/logo.png">
               <p class="font-16 mb-10 text-justify">GLOBAL INDIA INFOTECH is proud to introduce our-self as a professional organization for computer software, hardware and its maintenance in INDIA. GLOBAL INDIA INFOTECH is an Indian Information Technology...</p>
               <a class="font-14" href="<?php echo base_url(); ?>about"><i class="fa fa-angle-double-right text-white"></i> Read more</a> 
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="widget dark">
               <h5 class="widget-title line-bottom">End User Support Services</h5>
               <ul class="list angle-double-right list-border">
                  <?php
                     if(isset($aSupport) && is_array($aSupport) && !empty($aSupport)){
                       foreach ($aSupport as $row)
                       {
                          $name=$row->caption;
                          $thumbnail=base_url().'media/'.$row->thumbnail;
                     
                     ?>        
                  <li><a href="<?php echo base_url()?>support?support=<?php echo base64_encode($row->support_id);?>"><?php echo $row->caption; ?></a></li>
                  <?php } } ?>
               </ul>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="widget dark">
               <h5 class="widget-title line-bottom">Useful Links</h5>
               <ul class="list angle-double-right list-border">
                  <li> <a href="<?php echo base_url(); ?>solution">Solution</a> </li>
                  <li> <a href="<?php echo base_url(); ?>quality-policy">Quality Policy</a> </li>
                  <li> <a href="<?php echo base_url(); ?>gallery">Gallery</a> </li>
                  <li><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
                  <li><a href="<?php echo base_url(); ?>disclaimer">Disclaimer</a></li>
                  <li><a href="<?php echo base_url(); ?>terms-conditions">Terms of Use</a></li>
               </ul>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="widget dark">
               <h5 class="widget-title line-bottom">Quick Contact</h5>
               <ul class="">
                  <li><i class="fa fa-map-marker text-white"></i>&nbsp;&nbsp;<strong>GLOBAL INDIA INFOTECH</strong><br />
                     <a href="#" class="lineheight-20">Deendayal Upadhyay Nagar, Mangla,
                     Bilaspur, Chhattisgarh-495001, India</a>
                  </li>
                  <li><i class="fa fa-envelope text-white"></i>&nbsp;&nbsp;<a href="mailto:info@globalindiainfotech.com">info@globalindiainfotech.com</a></li>
                  <li><i class="fa fa-mobile fa-lg text-white"></i>&nbsp;&nbsp;<a href="tel:7354348575" class="text-white">+91-7354348575</a>, <a href="tel:8871105390" class="text-white">8871105390</a>, <a href="tel:7777878221" class="text-white">7777878221</a></li>
               </ul>
               <p class="font-16 text-white mb-5 mt-15">Follow Us</p>
               <ul class="styled-icons icon-dark mt-20">
                  <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".1s" data-wow-offset="10"><a href="https://www.facebook.com/" target="_blank" data-bg-color="#3B5998"><i class="fa fa-facebook"></i></a></li>
                  <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".2s" data-wow-offset="10"><a href="https://twitter.com/" data-bg-color="#02B0E8" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".4s" data-wow-offset="10"><a href="https://plus.google.com/" target="_blank" data-bg-color="#db4437"><i class="fa fa-google-plus"></i></a></li>
                  <li class="wow fadeInLeft" data-wow-duration="1.5s" data-wow-delay=".5s" data-wow-offset="10"><a href="https://www.youtube.com/channel/" target="_blank" data-bg-color="#c3181e"><i class="fa fa-youtube"></i></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
         <div class="row">
            <div class="col-md-6"> </div>
            <div class="col-md-6 text-right">
               <p class="font-11 text-black-777 m-0">Developed By : <a href="http://spitech.in/" title="SpiTech Web Services Pvt. Ltd." target="_blank" class="text-white">SpiTech Web Services Pvt. Ltd.</a> </p>
            </div>
         </div>
      </div>
   </div>
</footer>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper --> 
<?php include_once('footer-includes.php') ?>