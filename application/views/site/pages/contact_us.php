<!-- start banner box -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="inner_tags"> <span class="tag1">Contact us</span> </div>
      </li>
    </ul>
  </div>
  
</section>

<!-- end banner box --> 

<div class="four_section  contact_faq">
  <ul>
    <li>
      <div class="icons"><img src="<?php echo base_url();?>assets/site/images/post-a-query.png" alt=""></div>
      <h3>Post a Query</h3>
      <p>For any information about our locations, doctors or services, please feel free to write or fill out this convenient form.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url();?>assets/site/images/feedback.png" alt=""></div>
      <h3>Feedback</h3>
      <p> Feedback We'd love to hear from you on how we can improve ourselves to serve you better. Write to us or fill out this form here.</p>
    </li>
    <li>
      <div class="icons"><img src="<?php echo base_url();?>assets/site/images/admission.png" alt=""></div>
      <h3>ADMISSION</h3>
      <p>For information on jobs and openings, visit our Careers section or write to us</p>
    </li>
  </ul>
</div>
<!-- -------- start contact us form --------------- -->

<section class="form_area">

  <div class="right_address">
   <?php echo $page_data->page_content; ?>
  </div>

  <div class="left_form">
    <h1>Have a Query</h1>
    <ul>
	<form name="contact_form" method="post" id="contact_form" data-toggle="validator" role="form">
	<div class="successMsg"></div>
	<input type="hidden" name="formName" value="Contact Form">
      <li>
	  <div class="form-group">
        <input type="text" placeholder="Full Name*"  name="Name" id="fName" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Name" data-error="Please Enter Your Name" required >
		<div class="help-block with-errors"></div>
	  </div>
      </li>
      <li>
	   <div class="form-group">
        <input type="text" placeholder="Email*" onblur="return forceLower(this);" name="Email" id="fEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required >
		<div class="help-block with-errors"></div>
	  </div>
        
      </li>
      <li>
	  <div class="form-group">
        <input type="text" placeholder="Phone No.*"  maxlength="10" name="Phone" id="fPhone" pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Mobile No" data-error="Please Enter Mobile No" required >
		<div class="help-block with-errors"></div>
	  </div>
        
      </li>
      <li>
	  <div class="form-group">
        <textarea placeholder="Query"  name="Query" id="fquery" data-error="Please Enter Query" required></textarea>
		<div class="help-block with-errors"></div>
	  </div>
        
      </li>
      <li>
	 
         <input type="submit" value="Submit">
	
       
      </li>
    </ul>
	</form>
  </div>

</section>

<!-- -------- end contact us form --------------- --> 

<!-- --------------- start map -------------------------- -->

<section class="map"> 

<iframe src="<?php echo $page_data->map_url; ?>" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
 </section>

<!-- --------------- end map --------------------------- --> 