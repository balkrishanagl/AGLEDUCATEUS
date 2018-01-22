<?php
$images = json_decode($page_data->images, true);
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            IP Services
            <small>Edit IP Services</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/ip_services/manage_ip_services"><i class="fa fa-dashboard"></i> IP Services</a></li>
            <li class="active">Edit IP Services</li>
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
		
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/ip_services/edit_ip_services/<?php echo $page_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Page Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page Title" class="form-control input-sm br0" size="30" id="page_title" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_title; }?>" name="page_title" required/>                            
                             
                            </div>
                       </div>
						<div class="form-group">
                            <label for="cal_banner_datetime" class="col-md-4 control-label"><label for="banner title">Banner Image</label></label>
                            <div class="col-md-8">
								<input type="hidden" name="image_json_data" value='<?php echo $page_data->images?>'>
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="banner_image" value="" name="banner_image" /> 
								<?php if(isset($images['banner_image']) && $images['banner_image']!='')
							{ ?>
                               <img src="<?php echo base_url().$images['banner_image'];?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_icon_datetime" class="col-md-4 control-label"><label for="icon title">Icon Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="icon_image" value="" name="icon_image" />                            
                             <?php if(isset($images['icon_image']) && $images['icon_image']!='')
							{ ?>
                               <img src="<?php echo base_url().$images['icon_image'];?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
                            </div>
                       </div>
                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Page Content</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('page_content',$page_data->page_content);?>                             
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Extra Content</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('extra_content',$page_data->extra_content);?>                             
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_banner_datetime" class="col-md-4 control-label"><label for="banner title">Image 1</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="image_1" value="" name="image_1" /> 
								<?php if(isset($images['image_1']) && $images['image_1']!='')
							{ ?>
                               <img src="<?php echo base_url().$images['image_1'];?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_icon_datetime" class="col-md-4 control-label"><label for="icon title">Image 2</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="image_2" value="" name="image_2" />                            
                             <?php if(isset($images['image_2']) && $images['image_2']!='')
							{ ?>
                               <img src="<?php echo base_url().$images['image_2'];?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Meta Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page meta title" class="form-control input-sm br0" size="30" id="page_meta_title" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_title; }?>" name="page_meta_title" required/>
                               
                            </div>
                        </div>
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta keyword">Meta keyword</label></label>
                            <div class="col-md-8">
                               
                           <textarea placeholder="Page meta keyword" class="form-control input-sm br0" size="30" id="page_meta_keyword"  name="page_meta_keyword" required><?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_kaywords; }?></textarea>
						
                            </div>
                        </div>
						
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta description">Meta Description</label></label>
                            <div class="col-md-8">
                              <textarea placeholder="Page meta description"   class="form-control input-sm br0" size="30" id="page_meta_description"  name="page_meta_description" required><?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_description; }?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1" <?php  if(isset($page_data) && $page_data != ''){ if($page_data->page_status == 1){ echo "selected"; } }?> >Active</option>
        <option value="0" <?php  if(isset($page_data) && $page_data != ''){ if($page_data->page_status == 0){ echo "selected"; } }?> >Inactive</option>
                               
                               </select>
                                
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

