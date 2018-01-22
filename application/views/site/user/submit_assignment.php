<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Submit Assignments</div>
    </li>
  </ul>
</div>

<section class="about_sec registration title_bdr">
<div class="wrapper">
<div class="regis_form_box">

<div class="reg">

<div>

<?php if(isset($file_error)){ 
		foreach($file_error as $file_errors){
					?>
 <div style="margin-top: 10px; color: red;">
					
	<?php echo $file_errors; ?>
</div>
 <?php }
	} ?>
 
			<?php echo validation_errors(); ?>
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php }else if($this->session->flashdata('error')){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
				</div>
			
				<?php }else if($this->session->flashdata('warning')){  ?>
				<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Warning!</strong> <?php echo $this->session->flashdata('warning'); ?>
				</div>
			<?php }else if($this->session->flashdata('info')){  ?>
				<div class="alert alert-info">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
				</div>
			<?php } ?>
		</div>
		
        <form id="frmPayment" name="frmPayment" method="POST" action="<?php echo base_url(); ?>student/submit_assignment/<?php echo $id; ?>" data-toggle="validator" role="form" enctype="multipart/form-data">
          <ul>
          
             <li>
				  <label>File Name</label>
					<div class="form-group"><input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="filename" value="<?php echo set_value('filename'); ?>" name="filename" pattern="^[a-zA-Z ]+$" data-pattern-error="Please Enter Valid File Name" data-error="Please Enter File Name" required/>
                    <div class="help-block with-errors"></div>
					</div>
              </li>
			 <li>
				  <label>File</label>
                  <div class="form-group">
				 <input type="file" placeholder="File" class="form-control input-sm br0" size="30" id="file" value="" name="file" required/>
                 <p style="margin-top: 10px; color: red;">Allowed Type:- pdf/doc/docx. Max Size :- 10 MB</p>
				 <div class="help-block with-errors"></div>
                 </div>
				
			</li> 
			<input type="hidden" name="faculty_assignment_id" value="<?php echo $id; ?>">
			
			 <li><input type="submit" id="btnSubmitAssignment" value="Submit"></li>
		</ul>
	    </form>
</div>
</div>
</div>
</section>