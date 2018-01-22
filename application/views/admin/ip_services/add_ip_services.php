
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            IP Services
            <small>Add IP Services</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/ip_services/manage_ip_services"><i class="fa fa-dashboard"></i> IP Services</a></li>
            <li class="active">Add IP Services</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
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
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/ip_services/add_ip_services" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Page Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page Title" class="form-control input-sm br0" size="30" id="page_title" value="" name="page_title" required/>                            
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_banner_datetime" class="col-md-4 control-label"><label for="banner title">Banner Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="banner_image" value="" name="banner_image" required/>                            
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_icon_datetime" class="col-md-4 control-label"><label for="icon title">Icon Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="icon_image" value="" name="icon_image" required/>                            
                             
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Page Content</label></label>
                            <div class="col-md-8">
							<?php echo $this->ckeditor->editor('page_content',@$default_value);?>                              
                            </div>
                        </div>
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Extra Content</label></label>
                            <div class="col-md-8">
							<?php echo $this->ckeditor->editor('extra_content',@$default_value);?>                              
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_banner_datetime" class="col-md-4 control-label"><label for="banner title">Image 1</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="image_1" value="" name="image_1" required/>                            
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_icon_datetime" class="col-md-4 control-label"><label for="icon title">Image 2</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="image_2" value="" name="image_2" required/>                            
                             
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Meta Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page meta title" class="form-control input-sm br0" size="30" id="page_meta_title" value="" name="page_meta_title" required/>
                               
                            </div>
                        </div>
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta keyword">Meta keyword</label></label>
                            <div class="col-md-8">
                               
                           <textarea placeholder="Page meta keyword" class="form-control input-sm br0" size="30" id="page_meta_keyword" value="" name="page_meta_keyword" required></textarea>
						
                            </div>
                        </div>
						
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta description">Meta Description</label></label>
                            <div class="col-md-8">
                              <textarea placeholder="Page meta description" class="form-control input-sm br0" size="30" id="page_meta_description" value="" name="page_meta_description" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Status</label></label>
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