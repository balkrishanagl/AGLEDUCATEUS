
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            slider
            <small>Edit slider</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/slider/manage_slider"><i class="fa fa-dashboard"></i> slider</a></li>
            <li class="active">Edit slider</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
				
			<?php if(validation_errors()){?>
			
			<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
				</div>
			<?php } ?>	
				<?php if(isset($file_error)){ ?>
				
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $file_error; ?>
				</div>
				<?php } ?>
			
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

	               <form id="add_slider_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/slider/edit_slider/<?php echo $slider_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Banner Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="slider Title" class="form-control input-sm br0" size="30" id="banner_name" value="<?php  if(isset($slider_data) && $slider_data != ''){ echo $slider_data->banner_name; }?>" name="banner_name" required/>                            
                             
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">URL</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="URL" class="form-control input-sm br0" id="url" value="<?php  if(isset($slider_data) && $slider_data != ''){ echo $slider_data->url; }?>" name="url">                            
                             
                            </div>
                       </div>

                       
                        <div class="form-group">
                            <label for="cal_slider_info" class="col-md-4 control-label"><label for="meta title">Image Caption</label></label>
                            <div class="col-md-8">
                              <input type="text" placeholder="Image caption" class="form-control input-sm br0" size="30" id="img_caption" value="<?php  if(isset($slider_data) && $slider_data != ''){ echo $slider_data->img_caption; }?>" name="img_caption" required/>                            
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Banner Content</label></label>
                            <div class="col-md-8">
                              <textarea placeholder="slider Content" class="form-control input-sm br0" id="banner_content" name="banner_content" required><?php  if(isset($slider_data) && $slider_data != ''){ echo $slider_data->banner_content; }?></textarea>                            
                            </div>
                       </div>
                        

						 <div class="form-group">
                            <label for="cal_slider_datetime" class="col-md-4 control-label"><label for="slider title">Banner Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="banner_image" value="" name="banner_image">                            
                             <?php if(isset($slider_data->banner_image) && $slider_data->banner_image!='')
							{?>
						<input type="hidden" value="<?php echo $slider_data->banner_image; ?>" name="exist_slide">
                               <img src="<?php echo base_url().$slider_data->banner_image;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
							<p class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 500 KB Max Height And Width(661x1919) </p>
                            </div>
							
                       </div>
			       
                        <div class="form-group">
                            <label for="cal_slider_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1" <?php  if(isset($slider_data) && $slider_data != ''){ if($slider_data->status == 1){ echo "selected"; } }?> >Active</option>
							 <option value="0" <?php  if(isset($slider_data) && $slider_data != ''){ if($slider_data->status == 0){ echo "selected"; } }?> >Inactive</option>
                               
                               </select>
                                
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update slider" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

 