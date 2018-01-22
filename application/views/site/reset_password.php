<!-- start banner box -->

<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Change Password</div>
    </li>
  </ul>
</div>

<!-- end banner box --> 



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
  <h1>Login</h1>
  
  
  <div class="regis_form_box">
  
  
  <div class="reg">
        <form id="frmRegister" name="frmRegister" method="POST" action="<?php echo base_url(); ?>welcome/reset_password/" data-toggle="validator" role="form">
          <ul>
          
           
            <li>
              <label>Password <sup>*</sup></label>
              <div class="form-group">
              <input type="password" data-minlength="4" value="" id="password" placeholder="Please write password" data-error="Please Enter Password" required>
			   <div class="help-block with-errors"></div>
              </div>
            </li>
            
             <li>
              <label>Confirm Password <sup>*</sup></label>
			  <div class="form-group">
              <input type="password" value="" name="user_password" data-match="#password" placeholder="Please write confirm password" data-match-error="Password not match" data-error="Please Enter Confirm Password" required>
			  <div class="help-block with-errors"></div>
			  </div>
            </li>
            
            
            
            <li><label>&nbsp;</label> <input type="submit" id="btnforgetPassword" value="Change Password"></li>
            
           
          </ul>
        </form>
      </div>
  
  </div>
      
   
    
    

  </div>
</div>

<!-- end about section --> 

