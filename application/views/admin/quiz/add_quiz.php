
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            MCQ Exam
            <small>Add MCQ Exam</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/quiz/manage_quiz"><i class="fa fa-dashboard"></i> MCQ Exam</a></li>
            <li class="active">Add MCQ Exam</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
		<div>
			<?php if(validation_errors()){ ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
				</div>
			<?php } ?>
			
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
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/quiz/add_quiz/">
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">MCQ Exam Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="MCQ Exam Name" class="form-control input-sm br0" size="30" id="quizname" value="<?php echo set_value('quizname'); ?>" name="quizname"/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   	<div class="form-group">
							<label for="cal_course_info" class="col-md-4 control-label"><label for="status">Session</label></label>
							<div class="col-md-8">
							<select class="form-control" name="session" id="session">
								<option value="">Select</option>
								<?php foreach($session_detail as $sessions){ ?>
									<option value="<?php echo $sessions->id; ?>"><?php echo $sessions->name; ?></option>
								<?php } ?>
							</select>
					
						</div>
						</div>
						<!--=================== First Level ===================-->
						<div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam date">Exam Date 1st</label></label>
                            <div class="col-md-8">
							
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_date" id="exam_date1" size="30" value="<?php echo set_value('exam_date'); ?>" name="exam_date"/>                            
                                                             
                            </div>
							
                        </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Start Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_start_time" id="exam_start_time1" size="30" value="<?php echo set_value('exam_start_time'); ?>" readonly="readonly" name="exam_start_time"  />                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">End Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_end_time" id="exam_end_time1" size="30" value="<?php echo set_value('exam_end_time'); ?>" readonly="readonly" name="exam_end_time" />                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					  
					<!--=============================================================-->
					
					<!--======================== Second Level =======================-->
					<div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam date">Exam Date 2nd</label></label>
                            <div class="col-md-8">
							
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_date" id="exam_date2" size="30" value="<?php echo set_value('exam_date2'); ?>" name="exam_date2"/>                            
                                                             
                            </div>
							
                        </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Start Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_start_time" size="30" value="<?php echo set_value('exam_start_time2'); ?>" readonly="readonly" name="exam_start_time2"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">End Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_end_time" size="30" value="<?php echo set_value('exam_end_time2'); ?>" readonly="readonly" name="exam_end_time2"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					   
					<!--=====================================================================-->
					
					<!--================================ Third Level =========================-->
					<div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam date">Exam Date 3rd</label></label>
                            <div class="col-md-8">
							
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_date" id="exam_date3" size="30" value="<?php echo set_value('exam_date3'); ?>" name="exam_date3"/>                            
                                                             
                            </div>
							
                        </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Start Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_start_time" size="30" value="<?php echo set_value('exam_start_time3'); ?>" readonly="readonly" name="exam_start_time3"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">End Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 exam_end_time" size="30" value="<?php echo set_value('exam_end_time3'); ?>" readonly="readonly" name="exam_end_time3"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Exam Duration</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="MCQ Exam Duration" class="form-control input-sm br0" size="30" id="exam_duration" value="<?php echo set_value('exam_duration'); ?>" name="exam_duration"/>                            
                                <span class="form_er_msg" id="error_duration"></span>
                            </div>
                       </div>
					   
					<div class="form-group">
                            <label for="cal_exam_info" class="col-md-4 control-label"><label for="status">Exam Type</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="exam_type" id="exam_type">
                             <option value="">Select Exam Type</option>      
                             <option value="main">Main</option>
							 <option value="re-exam">Re-Exam</option>
                               
                               </select>
                                
                            </div>
                        </div>
					
					<div class="form-group">
                            <label for="cal_exam_info" class="col-md-4 control-label"><label for="status">Status</label></label>
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
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add MCQ Exam" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script type="text/javascript">

$(document).ready(function(){

	
	var isProcessing = false;  

$('.exam_start_time').timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		minTime: '10',
		//maxTime: '6:00pm',
		defaultTime: '11',
		//startTime: '10:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true,
});

$('.exam_end_time').timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		minTime: '10',
		//maxTime: '6:00pm',
		defaultTime: '11',
		//startTime: $('.exam_start_time').val(),
		dynamic: false,
		dropdown: true,
		scrollbar: true
});

/* $(".exam_date").datepicker({
	startDate:  new Date(),
	autoclose: true,
	format: 'yyyy/mm/dd',
	}).on('changeDate', function (selected) {
		var minDate = new Date(selected.date.valueOf());
		$('.exam_date').datepicker('setStartDate', minDate);
}); */


		var start = new Date();
		// set end date to max one year period:
		var end = new Date(new Date().setYear(start.getFullYear()+1));

		$('#exam_date1').datepicker({
			startDate : start,
			endDate   : end,
			autoclose: true,
			format: 'yyyy/mm/dd',
		
		}).on('changeDate', function(){
			
			$('#exam_date2').datepicker('setStartDate', new Date($(this).val()));
			$('#exam_date3').datepicker('setStartDate', new Date($(this).val()));
		}); 

		$('#exam_date2').datepicker({
			startDate : start,
			endDate   : end,
			autoclose: true,
			format: 'yyyy/mm/dd',
		
		});
		
		$('#exam_date3').datepicker({
			startDate : start,
			endDate   : end,
			autoclose: true,
			format: 'yyyy/mm/dd',
		
		});

});
</script>