<!-- start banner box -->

<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Login</div>
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
        <form id="frmRegister" name="frmRegister" method="POST" action="<?php echo base_url(); ?>welcome/user_login/" data-toggle="validator" role="form">
          <ul>
          
           
            <li>
			
				<label>User Name <sup>*</sup></label>
				<div class="form-group">
				<input type="text" value="" name="username" placeholder="User Name" data-error="Please Enter User Name" required >
				<div class="help-block with-errors"></div>
				</div>
			  
            </li>
            
            
            
              <li>
              <label>Password <sup>*</sup></label>
			  <div class="form-group">
              <input type="password" value="" id="password" name="password" placeholder="Password" data-error="Please Enter Password" required>
			  <div class="help-block with-errors"></div>
            </li>
            <li><a href="<?php echo base_url().'forget-password'; ?>">Forgot Password</a></li>
            
            
            <li><label>&nbsp;</label> <input type="submit" id="btnRegister" value="Login"></li>
            
           
          </ul>
        </form>
      </div>
  
  </div>
      
   
    
    

  </div>
</div>

<!-- end about section --> 

