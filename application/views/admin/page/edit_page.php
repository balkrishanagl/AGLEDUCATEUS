
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Page
            <small>Edit page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/page/manage_page"><i class="fa fa-dashboard"></i> page</a></li>
            <li class="active">Edit Page</li>
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
		
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/page/edit_page/<?php echo $page_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Page Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page Title" class="form-control input-sm br0" size="30" id="page_title" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_title; }?>" name="page_title" />                            
								<div class="form_er_msg"><?php echo form_error('page_title'); ?></div>	
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Page Content</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('page_content',$page_data->page_content);?>                             
									<div class="form_er_msg"><?php echo form_error('page_content'); ?></div>   
                            </div>
                        </div>
						
						<?php if($page_data->page_slug == 'about') { ?>
							
							<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Mission</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('mission',$page_data->mission);?>                             
									<div class="form_er_msg"><?php echo form_error('mission'); ?></div>   
                            </div>
                        </div>
						
						<?php } ?>
						
						
						<?php if($page_data->page_slug == 'scholarship') { ?>
							
							<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Apply Step 1</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('apply_stap1',$page_data->apply_stap1);?>                             
									<div class="form_er_msg"><?php echo form_error('apply_stap1'); ?></div>   
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Apply Step 2</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('apply_stap2',$page_data->apply_stap2);?>                             
									<div class="form_er_msg"><?php echo form_error('apply_stap2'); ?></div>   
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Apply Step 3</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('apply_stap3',$page_data->apply_stap3);?>                             
									<div class="form_er_msg"><?php echo form_error('apply_stap3'); ?></div>   
                            </div>
                        </div>
						
						
						<?php $eligibility_criteria = json_decode($page_data->eligibility_criteria, true);
						
						//echo '<pre>'; print_r($specialities); die;
											if(isset($eligibility_criteria)){
											foreach($eligibility_criteria as $ec) { 
											foreach($ec as $value){?> 
						<div class="row" data-duplicate="exist_eligibility_criteria" data-duplicate-min="0">
							<div class="col-md-4">	  
								<button class="btn" type="button"  data-duplicate-remove="exist_eligibility_criteria">-</button>
							</div>

							<!--<div class="col-md-8">	
								<input type="text" placeholder="Speciality caption" class="form-control input-sm br0" size="30" id="speciality_lable" value="<?php //echo $key; ?>" name="speciality_lable[]" required />                            

							</div>-->
							
							<div class="col-md-8">	
								<input type="text" placeholder="Eligibility Criteria" class="form-control input-sm br0" id="eligibility_criteria" value="<?php  echo $value; ?>" name="eligibility_criteria[]" required />                            

							</div>
							</div>
											<?php }
											}
						}	?>	
						
						
						<div class="row" data-duplicate="speciality" data-duplicate-min="1">
							<div class="col-md-4">	  
								<button class="btn" type="button"  data-duplicate-add="speciality">+</button>
								<button class="btn" type="button"  data-duplicate-remove="speciality">-</button>
							</div>
	
														
							<div class="col-md-8">	
								<input type="text" placeholder="Eligibility Criteria" class="form-control input-sm br0" id="eligibility_criteria" value="<?php echo set_value('eligibility_criteria'); ?>" name="eligibility_criteria[]" />                            

							</div>
						</div>
						
						<?php } ?>
						
						<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Banner Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" accept="image/*" id="banner_image" value="" name="banner_image" />                            
                             <?php if(isset($page_data->banner_image) && $page_data->banner_image!='')
							{ ?>
                               <img src="<?php echo base_url();?><?php echo $page_data->banner_image;?>" height="100" width="100"/>
							   <div class="form_er_msg"><?php echo form_error('banner_image'); ?></div>
							<?php } 
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?><p class="form_er_msg" id="error_password">Image type jpg/JPEG/gif/png. Max Size: 500 KB Max Height And Width(1650x500) </p>
                            </div>
                       </div>
					     
						
						<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Page Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" id="page_image" accept="image/*" value="" name="page_image" />                            
								<div class="form_er_msg"><?php echo form_error('page_image'); ?></div>
                             <?php if(isset($page_data->page_image) && $page_data->page_image!='')
							{ ?>
                               <img src="<?php echo base_url();?><?php echo $page_data->page_image;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
							<p class="form_er_msg" id="error_password">Image Type jpg/JPEG/gif/png. Max Size: 300 KB. Max Height And Width (620x460) </p>	
                            </div>
                       </div>
					  
					   
					   <?php if($page_data->page_slug == 'contact-us') { ?>
					
							<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Map</label></label>
                            <div class="col-md-8">
								<input type="text" placeholder="Map URL" class="form-control input-sm br0" size="30" id="map_url" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->map_url; }?>" name="map_url" />                            
							</div>
							</div>
					
					    <?php } ?>
						
						 <?php if($page_data->page_slug == 'about') { ?>
					
							<div class="form-group">
                            <label for="cal_news" class="col-md-4 control-label"><label for="icon title">Video Url</label></label>
                            <div class="col-md-8">
								<input type="text" placeholder="Video URL" class="form-control input-sm br0" size="30" id="video_url" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->video_url; }?>" name="video_url" />                            
							</div>
							</div>
					
					    <?php } ?>


                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Meta Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Page meta title" class="form-control input-sm br0" size="30" id="page_meta_title" value="<?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_title; }?>" name="page_meta_title" />
								<div class="form_er_msg"><?php echo form_error('page_meta_title'); ?></div>
                               
                            </div>
                        </div>
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta keyword">Meta keyword</label></label>
                            <div class="col-md-8">
                               
                           <textarea placeholder="Page meta keyword" class="form-control input-sm br0" size="30" id="page_meta_keyword"  name="page_meta_keyword" required><?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_kaywords; }?></textarea>
							<div class="form_er_msg"><?php echo form_error('page_meta_keyword'); ?></div>
                            </div>
                        </div>
						
						
						  <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta description">Meta Description</label></label>
                            <div class="col-md-8">
                              <textarea placeholder="Page meta description"   class="form-control input-sm br0" size="30" id="page_meta_description"  name="page_meta_description" required><?php  if(isset($page_data) && $page_data != ''){ echo $page_data->page_meta_description; }?></textarea>
							  <div class="form_er_msg"><?php echo form_error('page_meta_description'); ?></div>
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
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.duplicate.js"></script>
