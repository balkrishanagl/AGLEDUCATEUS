<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="tags inner_tags"> <span class="tag1">Register as Exhibitor</span> </div>
      </li>
    </ul>
  </div>

 

<!-- ------------- end banner ------------------------- --> 

<!-- --------- -- up coming ------------- -->

<div class="register_form">

 <?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					
					<?php echo $this->session->flashdata('success'); ?>
				</div>
 <?php } ?>
 
 <?php if($this->session->flashdata('error')){ ?>
				<div class="alert alert-danger">
					
					<?php echo $this->session->flashdata('error'); ?>
				</div>
 <?php } ?>
 
 <?php if(form_error('email')!=''){ ?>
 
 <div class="alert alert-danger">
	<?php echo "This Email is already registered. Please select a different email.<br/>"; ?>
</div>
 <?php } ?>

<div class="layout">
  <h1>Register as Exhibitor</h1>
  <form name="exhibitor_register_form" method="post" action="<?php echo base_url(); ?>exhibitor-register" id="exhibitor_register_form" data-toggle="validator" role="form">
  <ul class="registration_list">
    <li class="mr">
      <label>Contact Person*:</label>
      <div class="right_input">
        <select name="salut" id="salut">
          <option>Mr.</option>
          <option>Mrs.</option>
          <option>Miss.</option>
        </select>
		<div class="form-group">
		 <input type="text" class="firstname" placeholder="Please Enter First Name" name="fname" id="fname" <?php if(isset($_POST['fname']) && $_POST['fname']!=''){ ?> value="<?php echo $_POST['fname']; ?>" <?php } ?> pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid First Name" data-error="Please Enter Your First Name" required  >
		<div class="help-block with-errors"></div>
	    </div>
		<div class="form-group">
        <input type="text" class="lastname" placeholder="Please Enter Last Name" name="lname" id="lname" <?php if(isset($_POST['lname']) && $_POST['lname']!=''){ ?> value="<?php echo $_POST['lname']; ?>" <?php } ?> pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Last Name" data-error="Please Enter Your Last Name" required  >
		<div class="help-block with-errors"></div>
	    </div>
      </div>
    </li>
	<li>
		<label>Designation*:</label>
		<div class="form-group">
		<div class="right_input">
		 <input type="text" placeholder="Please Enter Designation" name="designation" id="designation" <?php if(isset($_POST['designation']) && $_POST['designation']!=''){ ?> value="<?php echo $_POST['designation']; ?>" <?php } ?> pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Designation" data-error="Please Enter Your Designation" required  >
		<div class="help-block with-errors"></div>
		</div>
	</li>
	
	 <li class="nineone">
      <label>Contact No*:</label>
      <div class="right_input">
        <div class="form-group">
		<input type="text"  placeholder="+91" maxlength="3" name="code" id="code" <?php if(isset($_POST['code']) && $_POST['code']!=''){ ?> value="<?php echo $_POST['code']; ?>" <?php } ?> pattern="^\+?\d+$" data-pattern-error="Please Enter Valid Code" data-error="Please Enter Code" required >
		<div class="help-block with-errors"></div>
		</div>
		<div class="form-group">
			<input type="text" placeholder="Please enter your Phone No" maxlength="10" name="phone" id="phone" <?php if(isset($_POST['phone']) && $_POST['phone']!=''){ ?> value="<?php echo $_POST['phone']; ?>" <?php } ?> pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Mobile No" data-error="Please Enter Mobile No" required >
		<div class="help-block with-errors"></div>
		</div>
      </div>
    </li>
	
    <li>
      <label>Email Id*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Email" onblur="return forceLower(this);" name="email" id="email" <?php if(isset($_POST['email']) && $_POST['email']!=''){ ?> value="<?php echo $_POST['email']; ?>" <?php } ?> pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required >
	  <div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
	
	 <li>
      <label>University/College Name*:</label>
      <div class="right_input">
	   <div class="form-group">
		<input type="text" placeholder="Please Enter University/College Name" name="university" id="university" <?php if(isset($_POST['university']) && $_POST['university']!=''){ ?> value="<?php echo $_POST['university']; ?>" <?php } ?> pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid University/Collage Name" data-error="Please Enter University/Collage Name" required  >
        <div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
	
    <li>
      <label>University/College Address*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter University/College Address" name="university_address" id="university_address" <?php if(isset($_POST['university_address']) && $_POST['university_address']!=''){ ?> value="<?php echo $_POST['university_address']; ?>" <?php } ?> data-error="Please Enter University/College Address" required >
	  <div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <label>Interested City*:</label>
      <div class="right_input">
	  <div class="form-group">
        <select name="city" id="city" data-error="Please Select City" required >
          <option value="">Select City</option>
		  <?php foreach($exhibition_city_data as $city){ ?>
			<option value="<?php echo $city->id;?>" <?php if(isset($_POST['city']) && $_POST['city']==$city->id){ ?> selected <?php } ?>><?php echo $city->city_name;?></option>
          <?php } ?>
        </select>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <label>Message*:</label>
      <div class="right_input">
	  <div class="form-group">
        <textarea placeholder="Message" name="message" id="message" data-error="Please Enter Your Message" required  ><?php if(isset($_POST['message']) && $_POST['message']!=''){ ?> <?php echo $_POST['message']; ?>" <?php } ?></textarea>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <div class="right_input">
        <input type="submit" value="Submit">
      </div>
    </li>
  </ul>
  </form>
</div>



</div>