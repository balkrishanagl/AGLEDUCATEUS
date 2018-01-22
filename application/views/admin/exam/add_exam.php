
<!-- Right side column. Contains the navbar and content of the exam -->
<aside class="right-side">
    <!-- Content Header (exam header) -->
    <section class="content-header">
        <h1>
            Exam
            <small>Add Exam</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/exam/manage_exam"><i class="fa fa-dashboard"></i> exam</a></li>
            <li class="active">Add exam</li>
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
                <form id="add_exam_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/exam/add_exam">          
                        <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="name">Exam Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Exam Name" class="form-control input-sm br0" size="30" id="exam_name" value="" name="exam_name" required/>                            
                             
                            </div>
                       </div>

                      <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam date">Exam Date</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="" class="form-control input-sm br0" size="30" id="exam_date" value="" name="exam_date" required/>                            
                             
                            </div>
                       </div>

					   <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="admit card">Admit Card Start Date</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="" class="form-control input-sm br0" size="30" id="exam_admit_card_start_date" value="" name="exam_admit_card_start_date" required/>                            
                             
                            </div>
							</div>
							<div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="admit card">Admit Card End Date</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="" class="form-control input-sm br0" size="30" id="exam_admit_card_end_date" value="" name="exam_admit_card_end_date" required/>                            
                             
                            </div>
                       </div>

                   		<div class="form-group">
                        <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam time">Exam Time</label></label>
                        <div class="col-md-8">
                        <input type="text" placeholder="" class="form-control input-sm br0" size="30" id="exam_time" value="" name="exam_time" required/>                            
                        </div>
                         </div>
						<div class="form-group">
                        <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam venue">Exam Venue</label></label>
                        <div class="col-md-8">
                        <input type="text" placeholder="Enter Exam venue" class="form-control input-sm br0" size="30" id="exam_venue" value="" name="exam_venue" required/>                            
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
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add exam" name="submit"/> 
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
		var date = new Date();
		date.setDate(date.getDate());
		
		var date_input=$('input[name="exam_date"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			startDate: date,
		})
			var date_input_exam_start=$('input[name="exam_admit_card_start_date"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input_exam_start.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			startDate: date,
		})
		var date_input_exam_end=$('input[name="exam_admit_card_end_date"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input_exam_end.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			startDate: date,
		})
	$('#exam_time').timepicker({
    timeFormat: 'h:mm p',
    interval: 30,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
	})
</script>
