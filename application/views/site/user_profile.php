<!-- start banner box -->

<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Profile</div>
    </li>
  </ul>
</div>

<!-- end banner box --> 

<!-- start breadcrum -->
<div class="breadcrum">
  <div class="wrapper">
    <ul>
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li>Profile</li>
    </ul>
  </div>
</div>
<!-- end breadcrum --> 

<!-- start about section -->

<div class="about_sec registration title_bdr">
  <div class="wrapper">
  <!--<div>Register Successfully</div>-->

 <?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					
					<?php echo $this->session->flashdata('success'); ?>
				</div>
 <?php } ?>
 
 <?php if($this->session->flashdata('error')){ ?>
				<div class="alert alert-error">
					
					<?php echo $this->session->flashdata('error'); ?>
				</div>
 <?php } ?>
  <h1>Profile</h1>
  
  
  <div class="regis_form_box">
  
  
  <div class="reg profile_form">
        <form id="frmRegister" name="frmRegister" enctype="multipart/form-data" method="POST" action="<?php echo base_url(); ?>welcome/user_profile/<?php echo $user_details[0]->user_id?>" data-toggle="validator" role="form">
          <ul>
          
            
            <li>
			
				<label>Name <sup>*</sup></label>
				<div class="form-group">
				<input type="text" value="<?php echo $user_details[0]->first_name; ?>" name="user_fname" placeholder="Please write name" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Name" data-error="Please Enter Your Name"  required >
				<div class="help-block with-errors"></div>
				</div>
			  
            </li>
            
             <li>
              <label>Gender<sup>*</sup></label>
              <div class="form-group">
              <input type="radio" value="Male" name="rdGender" <?php if($user_details[0]->gender == "Male"){ echo 'checked'; }?> ><span>Male</span>
              <input type="radio" value="Female" name="rdGender" <?php if($user_details[0]->gender == "Female"){ echo 'checked'; }?> ><span>Female</span>
             </div>
              
              </li>
                        
             <li>
              <label>Email - Address <sup>*</sup></label>
			  <div class="form-group">
              <input type="email" value="<?php echo $user_details[0]->email; ?>" name="user_email" placeholder="Please write email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            
            <li>
              <label>Father Name <sup>*</sup></label>
			  <div class="form-group">
              <input type="text" value="<?php echo $user_details[0]->father_name; ?>" name="user_fathername" placeholder="Please write father name" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid Father Name" data-error="Please Enter Father Name" required >
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
             <li class="date">
			 
			 <?php 
				$dob = explode("-",$user_details[0]->dob);
				$year = $dob[0];
				$month = $dob[1];
				$date = $dob[2];
			 ?>
              <label>Date of birth <sup>*</sup></label>
              <div class="form-group">
              <input type="text" id="student_dob" value="<?php echo $user_details[0]->dob; ?>" name="student_dob" placeholder="Date Of Birth" data-error="Please Select Date Of Birth" readonly required />
              </div>
            </li>
            
             <li>
              <label>Contact No </label>
              <div class="form-group">
              <input name="contact_no" type="tel" value="<?php echo $user_details[0]->contact_number; ?>" placeholder="Please write contact number">
              </div>
            </li>
            
            <li>
              <label>Mobile No <sup>*</sup></label>
			  <div class="form-group">
              <input name="mob_no" type="tel" value="<?php echo $user_details[0]->mobile_number; ?>" placeholder="Please write mobile number"  pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Mobile No" data-error="Please Enter Mobile No" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            <li>
              <label>Nationality <sup>*</sup></label>
              <div class="form-group">
              <select name="user_nationality">
                <option value="Indian" <?php if($user_details[0]->nationality == "Indian"){ echo 'selected'; }?>>Indian</option>
                <option value="Nepal" <?php if($user_details[0]->nationality == "Nepal"){ echo 'selected'; }?>>Nepal</option>
                <option value="Bhutan" <?php if($user_details[0]->nationality == "Bhutan"){ echo 'selected'; }?>>Bhutan</option>
                <option value="USA" <?php if($user_details[0]->nationality == "USA"){ echo 'selected'; }?>>USA</option>
                <option value="UK" <?php if($user_details[0]->nationality == "UK"){ echo 'selected'; }?>>UK</option>
              </select>
             </div>
            </li>
            
            <li>
              <label>Permanent Address <sup>*</sup></label>
			  <div class="form-group">
               <textarea name="permanent_add" cols="20" rows="10" placeholder="Please write permanent address" data-error="Please Enter Permanent Address" required ><?php echo $user_details[0]->permanent_address; ?> </textarea>
			   <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            <li>
              <label>Correspondence Address <sup>*</sup></label>
			  <div class="form-group">
              <textarea name="correspondence_add" cols="20" rows="10" placeholder="Please write your name" data-error="Please Enter Correspondence Address" required><?php echo $user_details[0]->correspondence_address; ?></textarea>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            <li>
              <label>Qualification <sup>*</sup></label>
              <div class="form-group">
              <input type="radio" value="Under Graduate" name="rdQualification" <?php if($user_details[0]->qualification == "Under Graduate"){ echo 'checked'; }?> ><span>Under Graduate</span>
              <input type="radio" value="Graduate" name="rdQualification" <?php if($user_details[0]->qualification == "Graduate"){ echo 'checked'; }?>><span>Graduate</span>
              <input type="radio" value="Post Graduate" name="rdQualification" <?php if($user_details[0]->qualification == "Post Graduate"){ echo 'checked'; }?> ><span>Post Graduate</span>
              </div>
              </li>
       
			
           
             <li>
              <label>Source of Information about course  <sup>*</sup></label>
              <div class="form-group">
              <select name="source_information" id="source_information" data-error="Please Select Source Of Information" required>
                <!--<option value="Mail received from FICCI" <?php if($user_details[0]->sourceinformation == "Mail received from FICCI"){ echo 'selected'; }?>>Mail received from FICCI</option>
                <option value="Google" <?php if($user_details[0]->sourceinformation == "Google"){ echo 'selected'; }?>>Google</option>
                <option value="Freinds" <?php if($user_details[0]->sourceinformation == "Freinds"){ echo 'selected'; }?>>Freinds</option>
                <option value="Relative" <?php if($user_details[0]->sourceinformation == "Relative"){ echo 'selected'; }?>>Relative</option>
                <option value="Other" <?php if($user_details[0]->sourceinformation == "Other"){ echo 'selected'; }?>>Other</option>
				-->
				<?php foreach($sourceData as $sRcd){ ?>
					<option <?php if(isset($_POST['source_information']) && $_POST['source_information']==$sRcd->id || $user_details[0]->sourceinformation==$sRcd->id){ ?> selected <?php } ?> value="<?php echo $sRcd->id; ?>" data-option="<?php echo $sRcd->other_option_applicable;?>"><?php echo $sRcd->name; ?></option>
				<?php } ?>
				
			  </select>
			  <input type="hidden" name="chk_otheroption" id="chk_otheroption" value="">
             </div>
            </li>
			
			<li id="source_option_section" style="display:none;">
				  <label>Details  <sup>*</sup></label>
				  <div class="form-group">
				  <input type="text" value="<?php echo $user_details[0]->source_detail; ?>" placeholder="Source Detail" name="source_detail" id="source_detail" pattern="^[a-zA-Z. ]+$">
				  <div class="help-block with-errors"><?php echo form_error('source_detail'); ?></div>
				  </div>
			</li>
			
			<?php if($user_details[0]->user_image_file!='NULL' && $user_details[0]->user_image_file!=''){ ?>
			<li>
              <label>Profile Image</label>
			  <div class="form-group">
				<img width="150" src="<?php echo base_url().'uploads/user_image/'.$user_details[0]->user_image_file; ?>"/>
			  </div>
            </li>
			<?php } ?>
			
			<li>
              <label>Profile Image upload</label>
			  <div class="form-group">
              <input type="file" name="user_image" accept="image/*"/>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            <li><input type="submit" id="btnUpdate" value="Update"></li>
            
           
          </ul>
        </form>
      </div>
  
  </div>
      
   
    
    

  </div>
</div>

<!-- end about section --> 

