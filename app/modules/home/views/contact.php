<?php include_once('header.php');?>
<script>document.getElementById('contact').setAttribute('class','active')</script>
<div class="main-content bg-lighter">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="<?php site_assets()?>images/bg/bg6.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-white text-center">Contact Us</h2>
              <ol class="breadcrumb text-left text-black mt-10">
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
               
                <li class="active text-gray-silver">Contact Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

<section class="divider">
      <div class="container">
        <div class="row pt-30">
          <div class="col-md-4">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="icon-box left media bg-deep p-30 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR LOCATION</strong>
                    <p>Deendayal Upadhyay Nagar, Mangla, Bilaspur, Chhattisgarh-495001, India</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-10 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-call text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR CONTACT NUMBER</strong>
                    <p><a href="tel:7354348575" >+91-7354348575</a>, <a href="tel:8871105390">8871105390</a>, <a href="tel:7777878221">7777878221</a></p>
                
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="icon-box left media bg-deep p-20 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-mail text-theme-colored"></i></a>
                  <div class="media-body"> <strong>OUR CONTACT E-MAIL</strong>
                    <p><a href="mailto:info@globalindiainfotech.com">info@globalindiainfotech.com</a></p>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-8">
            <h3 class="line-bottom mt-0 mb-20">Send Your Query</h3>
            <p class="mb-20">We are always looking to hear from you.</p>
           
            <!-- Contact Form -->
           <form name="form1"  id="form1">

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="name" id="name" placeholder="Name" type="text" validate="Required"  required="required"  class="form-control" >
                  </div>
                  
                  
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <input name="email" id="email" placeholder="Email" type="email" validate="Required|Email" required="required" class="form-control"   >
                  </div>
                 
                </div>
              </div>
                
              <div class="row">
                
                <div class="col-sm-12">
                  <div class="form-group">
                    <input  name="mobile" id="mobile" placeholder="Mobile No." validate="Required|Mobile" required="required"  type="text"  class="form-control"   >
                  </div>
                 
                </div>


 <div class="col-sm-12">
                  <div class="form-group">
                  
                    <select validate="Required" required="required"  type="text" name="service" id="service"  class="form-control" >
                      <option disabled="disabled" selected="selected">-----Select Services ----</option>
                            <?php
                                      if(isset($aService) && is_array($aService) && !empty($aService)){
                                        foreach ($aService as $row)
                                        {
                                           $name=$row->caption;
                                      
                                      ?>
                                      <option value="<?php echo $name; ?>"><?php echo $name; ?></option>

                       <?php } } ?>
                    </select>
                  </div>
                 
                </div>


              </div>

              <div class="form-group">
               <textarea class="form-control" rows="6" id="message" name="message" placeholder="Message" validate="Required" required="required"></textarea>
                
              </div>
              <div class="form-group">

                    <button class="btn btn-flat btn-theme-colored text-uppercase mt-10 mb-sm-30 border-left-theme-color-2-4px" type="button" name="submit" id="submit" onclick="saveEnquiry('form1')" >Submit Now <span class="icon-more-icon"></span></button>

               
               
            </form>

            <!-- Contact Form Validation-->
            
          </div>
        </div>
      </div>
    </section>
    


  </div>
<?php include_once('footer.php') ?>
