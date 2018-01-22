<!-- ------------- start banner ------------------------- -->

<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <img src="<?php echo base_url().$page_data->banner_image; ?>" alt="">
        <div class="tags inner_tags"> <span class="tag1">Register Online</span> </div>
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
  <h1>Register Now for Free Entry at Expo</h1>
  <form name="online_register_form" method="post" action="<?php echo base_url(); ?>online-register" id="online_register_form" data-toggle="validator" role="form">
  <ul class="registration_list">
    <li class="mr">
      <label>Full Name*:</label>
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
      <label>Email Id*:</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Please Enter Email" onblur="return forceLower(this);" name="email" id="email" <?php if(isset($_POST['email']) && $_POST['email']!=''){ ?> value="<?php echo $_POST['email']; ?>" <?php } ?> pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required >
	  <div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li class="nineone">
      <label>Mobile No*:</label>
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
      <label>Alternate Mob. No.* :</label>
      <div class="right_input">
	  <div class="form-group">
        <input type="text" placeholder="Alternate Mob. No."  maxlength="10" name="aphone" id="aphone" <?php if(isset($_POST['aphone']) && $_POST['aphone']!=''){ ?> value="<?php echo $_POST['aphone']; ?>" <?php } ?> pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Alternate Mobile No" data-error="Please Enter Alternate Mobile No" required >
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
      <label>Select Course*:</label>
      <div class="right_input">
	  <div class="form-group">
        <select name="course" id="course" data-error="Please Select Course" required >
		<option value="">Select Course</option>
          <?php foreach($course_data as $course){?>
			 <option value="<?php echo $course->id;?>" <?php if(isset($_POST['course']) && $_POST['course']==$course->id){ ?> selected <?php } ?>><?php echo $course->name;?></option>
		<?php } ?>
        </select>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <label>Educational Qualification*:</label>
      <div class="right_input">
	  <div class="form-group">
        <select name="qualification" id="qualification" data-error="Please Select Qualifiation" required >
          <option value="">Select Qualification</option>
		  <option value="10th" <?php if(isset($_POST['qualification']) && $_POST['qualification']=="10th"){ ?> selected <?php } ?>>10th</option>
          <option value="12th" <?php if(isset($_POST['qualification']) && $_POST['qualification']=="12th"){ ?> selected <?php } ?>>12th</option>
          <option value="Graduation" <?php if(isset($_POST['qualification']) && $_POST['qualification']=="Graduation"){ ?> selected <?php } ?>>Graduation</option>
        </select>
		<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <label>Percentage*:</label>
      <div class="right_input">
	  <div class="form-group">
		<input type="text" name="percentage" id="percentage" <?php if(isset($_POST['percentage']) && $_POST['percentage']!=''){ ?> value="<?php echo $_POST['percentage']; ?>" <?php } ?> placeholder="Please enter Percentage" pattern="\d*\.?\d*" data-pattern-error="Please Enter Valid Percentage" data-error="Please Enter Your Percentage" required >
	<div class="help-block with-errors"></div>
	  </div>
      </div>
    </li>
    <li>
      <label></label>
      <div class="right_input">
        <p>Appeared JEE or any other Qualifying Exam</p>
        <input type="radio" value="Yes" name="rdjee" <?php if(isset($_POST['rdjee']) && $_POST['rdjee']=='Yes'){ ?> checked <?php } ?> >
        <strong>Yes</strong>
        <input type="radio" value="No" name="rdjee" <?php if(isset($_POST['rdjee']) && $_POST['rdjee']=='No'){ ?> checked <?php } ?> checked>
        <strong>No</strong> </div>
    </li>
    <li>
      <label>How did you come to<br/>
        know about Expo:</label>
      <div class="right_input">
	  <div class="form-group">
        <select name="source" id="source" data-error="Please Select Source" required >
		<option value="">Select Source</option>
		<?php foreach($sourceData as $source){?>
		 <option value="<?php echo $source->id;?>" <?php if(isset($_POST['source']) && $_POST['source']==$source->id){ ?> selected <?php } ?>><?php echo $source->name;?></option>
		<?php } ?>
        </select>
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