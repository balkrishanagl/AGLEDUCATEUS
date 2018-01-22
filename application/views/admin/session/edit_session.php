
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Session
            <small>Edit Session</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/session/manage_session"><i class="fa fa-dashboard"></i> session</a></li>
            <li class="active">Edit Session</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
			<?php //echo validation_errors(); ?>
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
			<?php }else if(validation_errors()){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
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
		
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/session/edit_session/<?php echo $session_detail->id;?>">          
                        <div class="form-group">
                            <label for="cal_session" class="col-md-4 control-label"><label for="category name">Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Session Name" class="form-control input-sm br0" size="30" id="session_name" value="<?php  if(isset($session_detail) && $session_detail != ''){ echo $session_detail->name; }?>" name="session_name" required/>                            
                             
                            </div>
                       </div>

						<div class="form-group">
                            <label class="col-md-4 control-label"><label>Session Start</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="session_start_on" value="<?php  if(isset($session_detail) && $session_detail != ''){ echo $session_detail->start_on; }?>" name="session_start_on" />                            
								
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-4 control-label"><label>Session End</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="session_end_on" value="<?php  if(isset($session_detail) && $session_detail != ''){ echo $session_detail->end_on; }?>" name="session_end_on" />                            
								
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-4 control-label"><label>Registration Start</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="registration_start_on" value="<?php  if(isset($session_detail) && $session_detail != ''){ echo $session_detail->register_start_on; }?>" name="registration_start_on" />                            
								
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="col-md-4 control-label"><label>Registration End</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="registration_end_on" value="<?php  if(isset($session_detail) && $session_detail != ''){ echo $session_detail->register_end_on; }?>" name="registration_end_on" />                            
								
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

<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){

		
		 $("#session_start_on").datepicker({
			autoclose: true,
			format: 'yyyy/mm/dd',
			}).on('changeDate', function (selected) {
				var minDate = new Date(selected.date.valueOf());
				$('#session_end_on').datepicker('setStartDate', minDate);
			});

			$("#session_end_on").datepicker({
				autoclose: true,
				format: 'yyyy/mm/dd',
			}).on('changeDate', function (selected) {
					var maxDate = new Date(selected.date.valueOf());
					$('#session_start_on').datepicker('setEndDate', maxDate);
				});
				
			 $("#registration_start_on").datepicker({
			//startDate:  new Date(),
				autoclose: true,
				format: 'yyyy/mm/dd',
				}).on('changeDate', function (selected) {
					var minDate = new Date(selected.date.valueOf());
					$('#registration_end_on').datepicker('setStartDate', minDate);
				});

			$("#registration_end_on").datepicker({
				//startDate:  new Date(),
				autoclose: true,
				format: 'yyyy/mm/dd',
			}).on('changeDate', function (selected) {
					var maxDate = new Date(selected.date.valueOf());
					$('#registration_start_on').datepicker('setEndDate', maxDate);
				});	
				
			})
</script>

