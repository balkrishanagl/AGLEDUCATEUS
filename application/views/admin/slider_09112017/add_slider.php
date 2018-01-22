
<!-- Right side column. Contains the navbar and content of the slider -->
<aside class="right-side">
    <!-- Content Header (slider header) -->
    <section class="content-header">
        <h1>
            Slider
            <small>Add slider</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/slider/manage_slider"><i class="fa fa-dashboard"></i> slider</a></li>
            <li class="active">Add slider</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
				
				<?php if(isset($file_error)){ ?>
				
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $file_error; ?>
				</div>
				<?php } ?>
				
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
			<?php } else if($this->session->flashdata('warning')){  ?>
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
                <form id="add_slider_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/slider/add_slider" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Banner Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Banner Name" class="form-control input-sm br0" size="30" id="banner_name" value="" name="banner_name" required/>                            
                             
                            </div>
                       </div>

                      <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Image caption</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Image caption" class="form-control input-sm br0" size="30" id="img_caption" value="" name="img_caption" required/>                            
                             
                            </div>
                       </div>
                   <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Banner Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="banner_image" value="" name="banner_image" required/>                            
								<span class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 500 KB Max Height And Width(850x1919) </span>
                            </div>
                       </div>
						
			       
                        <div class="form-group">
                            <label for="cal_slider_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1">Active</option>
							 <option value="0">Inactive</option>
                               
                               </select>
                                
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add slider" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

