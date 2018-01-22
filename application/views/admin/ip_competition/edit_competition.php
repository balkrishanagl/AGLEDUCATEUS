
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            IP Competition
            <small>Edit IP Competition</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/ip_competition/manage_ip_competition"><i class="fa fa-dashboard"></i> IP Competition</a></li>
            <li class="active">Edit IP Competition</li>
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
		
                <form id="edit_competition_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/ip_competition/edit_competition/<?php echo $competition_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="feature title">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Competition Title" class="form-control input-sm br0" size="30" id="competition_title" value="<?php  if(isset($competition_data) && $competition_data != ''){ echo $competition_data->name; }?>" name="competition_title" required/>                            
                             
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Competition Content</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('competition_content',$competition_data->description);?>                             
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Icon Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="icon_image" value="" name="icon_image" />                            
                             <?php if(isset($competition_data->icon_image) && $competition_data->icon_image!='')
							{ ?>
                               <img src="<?php echo base_url(). $competition_data->icon_image;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
							<p class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 100 KB Max Height And Width(100x100) </p>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="image" value="" name="image" />                            
                             <?php if(isset($competition_data->image) && $competition_data->image!='')
							{ ?>
                               <img src="<?php echo base_url(). $competition_data->image;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
							<p class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 100 KB Max Height And Width(620x460) </p>
                            </div>
                       </div>
		

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update" name="submit"/> 
                                 <input type="button" class="btn btn-info br0 hide" value="Adding Request..." id="on_sending_req_reg"/>           
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

