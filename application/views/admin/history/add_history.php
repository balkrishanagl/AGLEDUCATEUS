<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
           Educatus History
            <small>Add History</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/history/manage_history"><i class="fa fa-dashboard"></i> Educatus History</a></li>
            <li class="active">Add History</li>
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
                <form id="add_history_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/history/add_history"  enctype="multipart/form-data">          
                        
						 <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Year</label></label>
                            <div class="col-md-8">
                            <select class="form-control" name="year" id="year">
							<option value="">Select Year</option>
							<?php $firstYear = (int)date('Y') - 20;
								$lastYear = $firstYear + 20;
								for($i=$firstYear;$i<=$lastYear;$i++)
								{
									echo '<option value='.$i.'>'.$i.'</option>';
								} ?>
                                
                                
                            </select>
                                
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Title 1</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Title 1" class="form-control input-sm br0" size="30" id="title_1" value="<?php echo set_value('title_1'); ?>" name="title_1" />                            
								<div class="form_er_msg"><?php echo form_error('title_1'); ?></div>	
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Detal 1</label></label>
                            <div class="col-md-8">
                             <?php echo $this->ckeditor->editor('detail_1',@$default_value);?> 
							<div class="form_er_msg"><?php echo form_error('detail_1'); ?></div>								 
                            </div>
                        </div>
					   			   
					   
					
						<div class="form-group">
							 <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="insurance partner image">Image 1</label></label>
							 <div class="col-md-8">
							 <input type="file"  class="form-control input-sm br0"  size="30" id="image_1" name="image_1"/>                            
							 <span class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </span>
							 <div class="form_er_msg"><?php echo form_error('image_1'); ?></div>	
							 </div>
						 </div>
						 
						 <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Title 2</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Title 2" class="form-control input-sm br0" size="30" id="title_2" value="<?php echo set_value('title_2'); ?>" name="title_2" />                            
								<div class="form_er_msg"><?php echo form_error('title_2'); ?></div>	
                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Detal 2</label></label>
                            <div class="col-md-8">
                             <?php echo $this->ckeditor->editor('detail_2',@$default_value);?> 
							<div class="form_er_msg"><?php echo form_error('detail_2'); ?></div>								 
                            </div>
                        </div>
					   			   
					   
					
						<div class="form-group">
							 <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="insurance partner image">Image 2</label></label>
							 <div class="col-md-8">
							 <input type="file"  class="form-control input-sm br0"  size="30" id="image_2" name="image_2"/>                            
							 <span class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </span>
							 <div class="form_er_msg"><?php echo form_error('image_3'); ?></div>	
							 </div>
						 </div>

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside> 

