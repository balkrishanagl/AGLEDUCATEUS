
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Participat collages
            <small>Edit Partner</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/participat_collage/manage_participat_collage"><i class="fa fa-dashboard"></i>Participat collages</a></li>
            <li class="active">Edit Collage</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
				
										
		<?php if(isset($file_error)){ 
		
			foreach($file_error as $file_errors){
					?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $file_errors; ?>
				</div>
				<?php }
				} ?>
				
			<?php //echo validation_errors(); ?>
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php }else if(validation_errors()){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
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

	               <form id="add_collage_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/dream_collage/edit_dream_collage/<?php echo $dream_collage_data->id;?>"  enctype="multipart/form-data">          
						
						
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Title" class="form-control input-sm br0" size="30" id="collage_title" value="<?php  if(isset($dream_collage_data) && $dream_collage_data != ''){ echo $dream_collage_data->name; }?>" name="collage_title" required/>                            
								
                            </div>
                       </div>
					   
					
						
						<div class="form-group">
							<label for="cal_insurance_partner_info" class="col-md-4 control-label"><label for="main image">Image</label></label>
								<div class="col-md-8">
								   <input type="file"  class="form-control input-sm br0" size="30" id="main_image" name="main_image"/> 
								    <!--<span class="form_er_msg" id="error_password">Allowed Type:- PNG/JPG/JPEG/GIF</span>-->
						  
									<?php if(isset($dream_collage_data->image) && $dream_collage_data->image != ''){ ?>
									<img src="<?php echo base_url().$dream_collage_data->image;?>" height="100" width="100"/> 
									   <input type="hidden" value="<?php echo $dream_collage_data->image; ?>" name="exist_main_image">
									   <?php } else { ?>
									   <img src="<?php echo base_url();?>uploads/no_image.jpg">
									   <?php } ?>
									 <p class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </p> 
									</div>
									 
						   </div>
						<div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

 <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>-->
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.duplicate.js"></script>

