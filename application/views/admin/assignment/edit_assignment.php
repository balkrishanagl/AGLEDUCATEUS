
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Assignment
            <small>Edit Assignment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/assignment/assignment_list"><i class="fa fa-dashboard"></i> Assignment</a></li>
            <li class="active">Edit Assignment</li>
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
			<?php 
				}else if($this->session->flashdata('warning')){  ?>
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
		
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/assignment/edit_assignment/<?php echo $assignment[0]->id; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Filename</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="filename" value="<?php if(isset($assignment[0]->filename)) echo $assignment[0]->filename; else echo set_value('filename'); ?>" name="filename" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Caption</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Caption" class="form-control input-sm br0" size="30" id="caption" value="<?php if(isset($assignment[0]->caption)) echo $assignment[0]->caption; else echo set_value('caption'); ?>" name="caption" required/>
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">File</label></label>
                            <div class="col-md-5">
                                <input type="file" placeholder="File" class="form-control input-sm br0" size="30" id="file" value="" name="file" />
                                <span class="form_er_msg" id="error_password"><p class="form_er_msg" id="error_password">Allowed Type:- PDF/DOC/DOCX/DOC/DOCX Max Size:-10 MB</p></span>
                                <?php if(!empty($assignment[0]->path)){ ?>
                                    <span class="file_name_ass"><?php echo $assignment[0]->path; ?></span>
                                <?php } ?>
                            </div>
                        </div>
						
						<div class="form-group">
							<label for="cal_course_info" class="col-md-4 control-label"><label for="status">Session</label></label>
							<div class="col-md-8">
							<select class="form-control" name="session" id="session" required/>
								<option value="">Select</option>
								<?php foreach($session_detail as $sessions){ ?>
									<option  <?php  if(isset($sessions) && $sessions != ''){ if($assignment[0]->session_id == $sessions->id){ echo "selected"; } }?> value="<?php echo $sessions->id; ?>"><?php echo $sessions->name; ?></option>
								<?php } ?>
							</select>
					
						</div>
						</div>
						
                         <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Status</label></label>
                            <div class="col-md-5">
                               <select class="form-control input-sm br0" name="status">
							   <option <?php if($assignment[0]->status==1){echo "selected=selected";}?> value="1">Active</option>
							   <option <?php if($assignment[0]->status==0){echo "selected=selected";}?> value="0">Inactive</option>
							   </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update Assignment" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script type="text/javascript">

$(document).ready(function(){

	
	var isProcessing = false;  

     
});
</script>