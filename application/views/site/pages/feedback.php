<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url(); ?>assets/site/images/register_online_banner.jpg" alt="">
        <div class="inner_tags"> <span class="tag1">Feedback</span> </div>
      </li>
    </ul>
  </div>
  
</section>
<!-- ------------- end banner ------------------------- -->
		
<!-- --------- -- up coming ------------- -->

<div class="register_form feedback_form">

<div class="layout">

  <h1>Your Feedback is Appreciated</h1>
  <form name="feedback_form" id="feedback_form" method="post"  data-toggle="validator" role="form">
  
  <ul class="registration_list">
  
  <div class="successMsg"></div>
  <input type="hidden" name="formName" value="Feedback Form">
  
   <li>
      <label>Category:</label>
      <div class="right_input">
	  <div class="form-group">
        <select name="Category" id="category">
          <option value="Student">Student</option>
		  <option value="Parent">Parent</option>
          <option value="University/College Name">University/College Name</option>
          
        </select>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
   <li>
      <label>Name*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Your Name" name="Name" id="fName" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid First Name" data-error="Please Enter Your First Name" required   >
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    
     <li>
      <label>Email Id*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Your Email" onblur="return forceLower(this);" name="Email" id="fEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required  >
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
   
    <li class="nineone">
      <label>Mobile No*:</label>
      <div class="right_input">
	   <div class="form-group">
        <input type="text" placeholder="+91" maxlength="3" name="code" id="code"  pattern="^\+?\d+$" data-pattern-error="Please Enter Valid Code" data-error="Please Enter Code" required >
		<div class="help-block with-errors"></div>
	  </div>
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Your Phone No" maxlength="10" name="Phone" id="phone"  pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Mobile No" data-error="Please Enter Mobile No" required >
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    
    
    <li>
      <label>Topic*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Topic" name="Topic" id="topic" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Topic" data-error="Please Enter Topic" required >
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
   
    <li>
      <label>Message*:</label>
      <div class="right_input">
	   <div class="form-group">
        <textarea placeholder="Message" data-error="Please Enter Message" name="Message" id="message" required></textarea>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      
        <input type="submit" value="Submit">
   
    </li>
  </ul>
 </form>
  </div>
</div>

<!-- ----------end upcoming ------------ --> 