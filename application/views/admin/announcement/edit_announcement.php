
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Announcement
            <small>Edit announcement</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/announcement/manage_announcement"><i class="fa fa-dashboard"></i> announcement</a></li>
            <li class="active">Edit announcement</li>
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

	               <form id="add_announcement_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/announcement/edit_announcement/<?php echo $announcement_data->id;?>">          
                        <div class="form-group">
                            <label for="cal_announcement_datetime" class="col-md-4 control-label"><label for="announcement title">announcement Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="announcement Title" class="form-control input-sm br0" size="30" id="announcement_title" value="<?php  if(isset($announcement_data) && $announcement_data != ''){ echo $announcement_data->title; }?>" name="announcement_title" required/>                            
                             
                            </div>
                       </div>

                     

                        <div class="form-group">
                            <label for="cal_announcement_info" class="col-md-4 control-label"><label for="meta title">Description</label></label>
                            <div class="col-md-8">
                             <textarea placeholder="Description" class="form-control input-sm br0"  id="announcement_description" value="" name="announcement_description" required><?php  if(isset($announcement_data) && $announcement_data != ''){ echo $announcement_data->description; }?></textarea> 
                            </div>
                        </div>
						
			       
                        <div class="form-group">
                            <label for="cal_announcement_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1" <?php  if(isset($announcement_data) && $announcement_data != ''){ if($announcement_data->status == 1){ echo "selected"; } }?> >Active</option>
							 <option value="0" <?php  if(isset($announcement_data) && $announcement_data != ''){ if($announcement_data->status == 0){ echo "selected"; } }?> >Inactive</option>
                               
                               </select>
                                
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update announcement" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

 