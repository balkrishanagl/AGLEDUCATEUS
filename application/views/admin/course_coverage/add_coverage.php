
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Feature
            <small>Add Course Coverage</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/course_coverage/manage_course_coverage"><i class="fa fa-dashboard"></i> coverage</a></li>
            <li class="active">Add Coverage</li>
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
                <form id="add_coverage_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/course_coverage/add_coverage" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="coverage title">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Coverage Title" class="form-control input-sm br0" size="30" id="feature_title" value="" name="coverage_title" required/>                            
                             
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="feature content">Content</label></label>
                            <div class="col-md-8">
							<?php echo $this->ckeditor->editor('coverage_content',@$default_value);?>                              
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Icon Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="icon_image" value="" name="icon_image" />                            
								<span class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 100 KB Max Height And Width(100x100) </span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="image" value="" name="image" />                            
								<span class="form_er_msg" id="error_password">Image type:- jpg/JPEG/gif/png. Max Size:- 100 KB Max Height And Width(620x460) </span>
                            </div>
                       </div>

						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 
                                 <input type="button" class="btn btn-info br0 hide" value="Adding Request..." id="on_sending_req_reg"/>           
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script>
allowedContent: {
    img: {
       attributes: '!src, alt', // src is required
       styles: 'height, width'
    }
}

</script>