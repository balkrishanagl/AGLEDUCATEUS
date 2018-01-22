
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Counselor
            <small>Edit Counselor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/counselor/manage_counselor"><i class="fa fa-dashboard"></i>Counselor</a></li>
            <li class="active">Edit Counselor</li>
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

	               <form id="add_counselor_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/counselor/edit_counselor/<?php echo $counselor_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_testimonial_datetime" class="col-md-4 control-label"><label for="testimonial title">Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Name" class="form-control input-sm br0" size="30" id="title" value="<?php  if(isset($counselor_data) && $counselor_data != ''){ echo $counselor_data->title; }?>" name="title" required/>                            
                             
                            </div>
                       </div>
                     <div class="form-group">
                            <label for="cal_testimonial_datetime" class="col-md-4 control-label"><label for="testimonial designation">Designation</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Designation" class="form-control input-sm br0" size="30" id="designation" value="<?php  if(isset($counselor_data) && $counselor_data != ''){ echo htmlentities($counselor_data->designation); }?>" name="designation" required/>                            
                             
                            </div>
                       </div>

                     

                        <div class="form-group">
                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="meta title">Description</label></label>
                            <div class="col-md-8">
                             <textarea placeholder="Description" class="form-control input-sm br0"  id="description" value="" name="description" required><?php  if(isset($counselor_data) && $counselor_data != ''){ echo $counselor_data->description; }?></textarea> 
                            </div>
                        </div>																		<div class="form-group">                            <label for="cal_testimonial_datetime" class="col-md-4 control-label"><label for="name">Website</label></label>                            <div class="col-md-8">                                <input type="text" placeholder="Website" class="form-control input-sm br0" id="website" value="<?php  if(isset($counselor_data) && $counselor_data != ''){ echo $counselor_data->website; }?>" name="website" />                                                                                     </div>                       </div>					   					   <div class="form-group">                            <label for="cal_testimonial_datetime" class="col-md-4 control-label"><label for="name">Phone</label></label>                            <div class="col-md-8">                                <input type="text" placeholder="Phone Number" class="form-control input-sm br0" id="phone" value="<?php  if(isset($counselor_data) && $counselor_data != ''){ echo $counselor_data->phone; }?>" name="phone" />                                                                                     </div>                       </div>					   					   <div class="form-group">                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="description">Skills</label></label>                            <div class="col-md-8">                             <textarea placeholder="Skills" class="form-control input-sm br0"  id="skills" value="" name="skills"><?php  if(isset($counselor_data) && $counselor_data != ''){ echo $counselor_data->skills; }?></textarea>                             </div>                        </div>
						
						 <div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="image" value="" name="image" />                            
                             <?php if(isset($counselor_data->image) && $counselor_data->image!='')
							{ ?>
                               <img src="<?php echo base_url(). $counselor_data->image;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
							
							<p class="form_er_msg" id="error_password">Image type:- jpg/jpeg/gif/png. Max Size:- 200 KB Max Height And Width(620x460) </p>
                            </div>
                       </div>
						
			           

                        <div class="form-group">
                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1" <?php  if(isset($counselor_data) && $counselor_data != ''){ if($counselor_data->status == 1){ echo "selected"; } }?> >Active</option>
							 <option value="0" <?php  if(isset($counselor_data) && $counselor_data != ''){ if($counselor_data->status == 0){ echo "selected"; } }?> >Inactive</option>
                               
                               </select>
                                
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

 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date = new Date();
		date.setDate(date.getDate());
		
		var date_input=$('input[name="testimonial_date"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			startDate: date,
		})
	})
</script>