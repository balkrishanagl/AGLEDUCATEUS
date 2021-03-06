
<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            News
            <small>Add News</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/news/manage_news"><i class="fa fa-dashboard"></i> News</a></li>
            <li class="active">Add News</li>
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
                <form id="add_event_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/news/add_news"  enctype="multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_news_datetime" class="col-md-4 control-label"><label for="event title">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="News Title" class="form-control input-sm br0" size="30" id="news_title" value="" name="news_title" required/>                            
                             
                            </div>
                       </div>

                     <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Content</label></label>
                            <div class="col-md-8">
                             <?php echo $this->ckeditor->editor('content',@$default_value);?> 
							<div class="form_er_msg"><?php echo form_error('content'); ?></div>								 
                            </div>
                        </div>
						
						<div class="form-group">
							 <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Main Image</label></label>
							 <div class="col-md-8">
							 <input type="file"  class="form-control input-sm br0"  size="30" id="main_image" name="main_image"/>                            
							 <span class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </span>
							 <div class="form_er_msg"><?php echo form_error('main_image'); ?></div>	
							 </div>
						 </div>
						 
			           
						
                        <div class="form-group">
                            <label for="cal_news_info" class="col-md-4 control-label"><label for="status">Status</label></label>
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
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add News" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

