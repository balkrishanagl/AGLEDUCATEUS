
<!-- start banner box -->

<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Registration</div>
    </li>
  </ul>
</div>

<!-- end banner box --> 

<!-- start breadcrum -->
<div class="breadcrum">
  <div class="wrapper">
    <ul>
      <li><a href="<?php echo base_url(); ?>">Home</a></li>
      <li>Registration</li>
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
 <?php
if(form_error('uName')!='' || form_error('user_email')!='' || form_error('stu_card')!='')
{ ?>
 <div class="alert alert-error">
					
	<?php if(form_error('user_email') !=""){
		echo "This Email is already registered. Please select a different email.<br/>";
	} ?>
	<?php if(form_error('uName') !=""){
		 echo "This Username is already registered. Please select a different username.";
	} ?>
	<?php echo form_error('stu_card'); ?>
</div>
 <?php } ?>
 
<?php if(isset($file_error)){ 
		foreach($file_error as $file_errors){
					?>
 <div class="alert alert-error">
					
	<?php echo $file_errors; ?>
</div>
 <?php }
	} ?>
 
  <h1>Registration</h1>
  
  
  <div class="regis_form_box">
  
  
  <div class="reg reg-form-block">
        <form id="frmRegister" name="frmRegister" method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>welcome/user_registration" data-toggle="validator" role="form">
          <ul>
          
             <li>
              <label>User Types <sup>*</sup></label>
              <div class="form-group">
			  <?php 
					$intialFees = "";
					foreach($fees as $userFees){ 
					if($userFees->user_type_name == "Student"){
					$intialFees = $userFees->fees;
			  ?>
              <div>
				<input type="radio" checked value="<?php echo $userFees->user_type_id;?>" name="rdUserType" id="rd<?php echo str_replace(' ', '_', $userFees->user_type_name);?>" data-fees="<?php echo $userFees->fees;?>" ><span><?php echo $userFees->user_type_name;?></span>
				</div>
			  <?php }else{ ?>
              <div>
			  <input type="radio" <?php if(isset($_POST['rdUserType']) && $_POST['rdUserType'] == $userFees->user_type_id){ echo 'checked'; } ?> value="<?php echo $userFees->user_type_id;?>" name="rdUserType" id="rd<?php echo str_replace(' ', '_', $userFees->user_type_name);?>" data-fees="<?php echo $userFees->fees;?>" ><span><?php echo $userFees->user_type_name;?></span>
              </div>
			  <?php }
			  } ?>
              
              </div>
              </li>
			 <li><label>Course Fees </label>
             <div class="form-group">
			 <span id="course_fees"> </span>
			 <input type="hidden" value="" name="course_fee" id="course_fee" >
             </div>
			 </li>
          
            <li>
			
				<label>Name <sup>*</sup></label>
				<div class="form-group">
				<input type="text" <?php if(isset($_POST['user_fname']) && $_POST['user_fname']!=''){ ?> value="<?php echo $_POST['user_fname']; ?>" <?php } ?> name="user_fname" placeholder="Name" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Name" data-error="Please Enter Your Name" required >
				<div class="help-block with-errors"></div>
				</div>
			  
            </li>
            
             <li>
              <label>Gender<sup>*</sup></label>
              <div class="form-group">
              <div>
              <input type="radio" <?php if(isset($_POST['rdGender']) && $_POST['rdGender']=='Male'){ ?> checked <?php } ?> value="Male" name="rdGender" checked ><span>Male</span>
              </div>
              <div>
              <input type="radio" <?php if(isset($_POST['rdGender']) && $_POST['rdGender']=='Female'){ ?> checked <?php } ?> value="Female" name="rdGender" ><span>Female</span>
              </div>
             </div>
              
              </li>
              
            <li>
              <label>User Name <sup>*</sup></label>
			  <div class="form-group">
              <input type="text" maxlength="50" <?php if(isset($_POST['uName']) && $_POST['uName']!=''){ ?> value="<?php echo $_POST['uName']; ?>" <?php } ?> name="uName" placeholder="User Name" pattern="^[a-zA-Z1-9. ]+$" data-pattern-error="Please Enter Valid Username" data-error="Please Enter User Name" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
              <li>
              <label>Password <sup>*</sup></label>
              <div class="form-group">
              <input type="password"  data-minlength="4" maxlength="20" value="" id="password" placeholder="Password" data-error="Please Enter Password Minimum Of 4 And Maximum 20 Characters" required>
				<div class="help-block with-errors"></div>
			 </div>
            </li>
            
             <li>
              <label>Confirm Password <sup>*</sup></label>
			  <div class="form-group">
              <input type="password" maxlength="20" value="" name="user_password" data-match="#password" placeholder="Confirm Password" data-error="Please Enter Confirm Password." data-match-error="Password not match" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
             <li>
              <label>Email - Address <sup>*</sup></label>
			  <div class="form-group">
              <input type="text" <?php if(isset($_POST['user_email']) && $_POST['user_email']!=''){ ?> value="<?php echo $_POST['user_email']; ?>" <?php } ?> name="user_email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" data-pattern-error="Please Enter Valid Email" data-error="Please Enter Your Email" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            
            <li>
              <label>Father Name <sup>*</sup></label>
			  <div class="form-group">
              <input type="text" <?php if(isset($_POST['user_fathername']) && $_POST['user_fathername']!=''){ ?> value="<?php echo $_POST['user_fathername']; ?>" <?php } ?> name="user_fathername" placeholder="Father Name" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Father Name" data-error="Please Enter Father Name" required >
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
             <li class="date">
              <label>Date of birth <sup>*</sup></label>
              <div class="form-group">
				<input type="text" id="student_dob" <?php if(isset($_POST['student_dob']) && $_POST['student_dob']!=''){ ?> value="<?php echo $_POST['student_dob']; ?>" <?php } ?> name="student_dob" placeholder="Date Of Birth" data-error="Please Enter Your Date Of Birth" required />
              <div class="help-block with-errors"><?php echo form_error('student_dob'); ?></div>
			  </div>
            </li>
            
            <li>
              <label>Permanent Address <sup>*</sup></label>
			  <div class="form-group">
               <textarea name="permanent_add" cols="20" rows="10" placeholder="Permanent Address" data-error="Please Enter Permanent Address" required ><?php if(isset($_POST['permanent_add']) && $_POST['permanent_add']!=''){ ?> <?php echo $_POST['permanent_add']; ?> <?php } ?></textarea>
			   <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            <li>
              <label>Correspondence Address <sup>*</sup></label>
			  <div class="form-group">
              <textarea name="correspondence_add" cols="20" rows="10" placeholder="Correspondence Address" data-error="Please Enter Correspondence Address" required><?php if(isset($_POST['correspondence_add']) && $_POST['correspondence_add']!=''){ ?> <?php echo $_POST['correspondence_add']; ?> <?php } ?></textarea>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            
			 <li>
              <label>Mobile No <sup>*</sup></label>
			  <div class="form-group">
              <input name="mob_no" type="tel" <?php if(isset($_POST['mob_no']) && $_POST['mob_no']!=''){ ?> value="<?php echo $_POST['mob_no']; ?>" <?php } ?> placeholder="Mobile Number"  pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Mobile No" data-error="Please Enter Mobile No" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
			
            <li>
              <label>Alternate Number </label>
              <div class="form-group">
              <input name="contact_no" type="tel" <?php if(isset($_POST['contact_no']) && $_POST['contact_no']!=''){ ?> value="<?php echo $_POST['contact_no']; ?>" <?php } ?> pattern="^\d{4}\d{3}\d{3}$" data-pattern-error="Please Enter Valid Alternate Number." placeholder="Alternate Number">
              <div class="help-block with-errors"></div>
			  </div>
            </li>
            
           
            <li>
              <label>Nationality <sup>*</sup></label>
              <div class="form-group">
              <select name="user_nationality" id="user_nationality" data-error="Please Select Nationality" required>
			  <option value="">Select Nationality</option>
               <?php foreach($country as $contries){ ?>
				<option <?php if(isset($_POST['user_nationality']) && $_POST['user_nationality']==$contries->country_name){ ?> selected <?php } ?> value="<?php echo $contries->country_name;?>"><?php echo $contries->country_name;?></option>
			  <?php } ?>
              </select>
			  <div class="help-block with-errors"><?php echo form_error('user_nationality'); ?></div>
             </div>
            </li>
           
           
            <li>
              <label>Qualification <sup>*</sup></label>
              <div class="form-group">
              <div>
              <input type="radio" <?php if(isset($_POST['rdQualification']) && $_POST['rdQualification']=='Under Graduate'){ ?> checked <?php } ?> checked value="Under Graduate" name="rdQualification"><span>Under Graduate</span>
              </div>
              <div>
              <input type="radio" <?php if(isset($_POST['rdQualification']) && $_POST['rdQualification']=='Graduate'){ ?> checked <?php } ?> value="Graduate" name="rdQualification" ><span>Graduate</span>
              </div>
              <div>
              <input type="radio" <?php if(isset($_POST['rdQualification']) && $_POST['rdQualification']=='Post Graduate'){ ?> checked <?php } ?> value="Post Graduate" name="rdQualification" ><span>Post Graduate</span>
              </div>
              </div>
              </li>
       
			<div id="field_user_type_student">
				<li><label>Degree/Diploma <sup>*</sup></label>
					<div class="form-group">
						<input type="text" <?php if(isset($_POST['courseName']) && $_POST['courseName']!=''){ ?> value="<?php echo $_POST['courseName']; ?>" <?php } ?> name="courseName" id="courseName" placeholder="Degree/Diploma" data-error="Please Enter Degree/Diploma" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Degree/Diploma Name">
					<div class="help-block with-errors"></div>
					</div>
				</li>
				
				 <li>
				  <label>Year of Degree/Diploma <sup>*</sup></label>
                  <div class="form-group">
				  <select name="courseYear" id="courseYear"  data-error="Please Select Number Of Years" required>
					<option value="">Select Number Of Years</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="1 Year's"){ ?> selected <?php } ?> value="1 Year's">1 Year's</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="2 Year's"){ ?> selected <?php } ?> value="2 Year's">2 Year's</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="3 Year's"){ ?> selected <?php } ?> value="3 Year's">3 Year's</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="4 Year's"){ ?> selected <?php } ?> value="4 Year's">4 Year's</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="5 Year's"){ ?> selected <?php } ?> value="5 Year's">5 Year's</option>
					<option <?php if(isset($_POST['courseYear']) && $_POST['courseYear']=="Others"){ ?> selected <?php } ?> value="Others">Others</option>
				  </select>
				  <div class="help-block with-errors"><?php echo form_error('courseYear'); ?></div>
				 </div>
				</li>
				
				
				<li>
				  <label>College Name  <sup>*</sup></label>
				  <div class="form-group">
				  <input type="text" <?php if(isset($_POST['collageName']) && $_POST['collageName']!=''){ ?> value="<?php echo $_POST['collageName']; ?>" <?php } ?> placeholder="College Name" name="collageName" id="collageName" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid College Name" data-error="Please Enter College Name">
				  <div class="help-block with-errors"></div>
				  </div>
				</li>
				
				
				  <li>
				  <label>College Address <sup>*</sup></label>
				  <div class="form-group">
				  <textarea cols="20" rows="10" placeholder="College Address" name="collegeAddress" id="collegeAddress" data-error="Please Enter College Address" ><?php if(isset($_POST['collegeAddress']) && $_POST['collegeAddress']!=''){ ?> <?php echo $_POST['collegeAddress']; ?> <?php } ?></textarea>
				  <div class="help-block with-errors"></div>
				  </div>
				</li>
            
			</div>
			
			<div id="field_user_type_other">
				<li><label>Organization Name <sup>*</sup></label>
					<div class="form-group">
						<input type="text" <?php if(isset($_POST['compnayName']) && $_POST['compnayName']!=''){ ?> value="<?php echo $_POST['compnayName']; ?>" <?php } ?> name="compnayName" id="compnayName" placeholder="Company Name" data-error="Please Enter Company Name">
					<div class="help-block with-errors"></div>
					</div>
				</li>
				
				 <li>
				  <label>Designation  <sup>*</sup></label>
				  <div class="form-group">
				  <input type="text" <?php if(isset($_POST['designation']) && $_POST['designation']!=''){ ?> value="<?php echo $_POST['designation']; ?>" <?php } ?> placeholder="Designation" name="designation" id="designation" pattern="^[a-zA-Z. ]+$" data-pattern-error="Please Enter Valid Designation" data-error="Please Enter Designation">
				  <div class="help-block with-errors"></div>
				 </div>
				 
				</li>
				
				
				<li>
				  <label>Organization Address <sup>*</sup></label>
				  <div class="form-group">
				  <textarea cols="20" rows="10" placeholder="Company Address" name="companyAddress" id="companyAddress" data-error="Please Enter Company Address"><?php if(isset($_POST['companyAddress']) && $_POST['companyAddress']!=''){ ?> <?php echo $_POST['companyAddress']; ?> <?php } ?></textarea>
				  <div class="help-block with-errors"></div>
				 </div>
				</li>
			
			</div>
           
             <li>
              <label>Source of Information about course  <sup>*</sup></label>
              <div class="form-group">
              <select name="source_information" id="source_information" data-error="Please Select Source Of Information" required>
                <option value="">Select source of information</option>
				<?php foreach($sourceData as $sRcd){ ?>
					<option <?php if(isset($_POST['source_information']) && $_POST['source_information']==$sRcd->id){ ?> selected <?php } ?> value="<?php echo $sRcd->id; ?>" data-option="<?php echo $sRcd->other_option_applicable;?>"><?php echo $sRcd->name; ?></option>
				<?php } ?>
                <!--<option value="Google">Google</option>
                <option value="Freinds">Freinds</option>
                <option value="Relative">Relative</option>
                <option value="Other">Other</option>-->
              </select>
			  <div class="help-block with-errors"></div>
			  <input type="hidden" name="chk_otheroption" id="chk_otheroption" value="">
			  
             </div>
            </li>
			<input type="hidden" id="srcDetail" name="src_id" value=""/>
			<li id="source_option_section" <?php if(isset($_POST['src_id']) && $_POST['src_id']=='1'){ ?> style="display:block;" <?php }else{ ?> style="display:none;" <?php } ?>>
				  <label>Details  <sup>*</sup></label>
				  <div class="form-group">
				  <input type="text" <?php if(isset($_POST['source_detail']) && $_POST['source_detail']!=''){ ?> value="<?php echo $_POST['source_detail']; ?>" <?php } ?> placeholder="Source Detail" name="source_detail" id="source_detail" data-error="Please Enter Source Detail">
				   <div class="help-block with-errors"><?php echo form_error('source_detail'); ?></div>
				  </div>
			</li>
			<li id="student_document">
				<label>Upload Document </label>
					<div class="input_fields_wrap form-group">
						<div><input type="file" name="myfiles[]" accept=".pdf,.doc"></div>
						<a href="#" class="add_field_button">Add More Documents</a>
						<p style="color:red;">Document type:- pdf/doc. Max Size:- 500 KB</p>
					</div>
			</li>
			<li id="student_id_card">
			  <label>Student ID Card <sup>*</sup></label>
			  <div class="form-group">
				<input type="file" name="stu_card" accept="image/*">
			  <div class="help-block with-errors"></div>
			  <p style="color:red;">Image type:- jpg/jpeg/gif/png. Max Size:- 200 KB Max Height And Width(50x100) </p>
			  </div>
			</li>
			
            
            <li>
			<div class="form-group">
				<input type="submit" class="form-control paybtn" id="btnRegister" value="Register"></li>
			</div>
            
           
          </ul>
        </form>
      </div>
  
  </div>
      
   
    
    

  </div>
</div>


<script type="text/javascript">
function forceLower(strInput) 
{
	strInput.value=strInput.value.toLowerCase();
}



</script>
