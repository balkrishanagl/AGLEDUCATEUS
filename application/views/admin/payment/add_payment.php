
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payment
            <small><?php echo $type; ?> Payment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/payment/manage_payment"><i class="fa fa-dashboard"></i> Payment</a></li>
            <li class="active"><?php echo $type; ?> Payment</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
		<div>
			<?php if(validation_errors()){?>
			
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
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="">
                     <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Students</label></label>
                            <div class="col-md-5">
							
                                <select name="student_id" class="form-control stuName" id="quiz_id" required>
									<option value="">Select Student</option>
									<?php foreach($studentList as $stuList){?>
									<option <?php if(isset($_POST['student_id']) && $_POST['student_id']==$stuList->id || isset($payDetail->user_id) && $payDetail->user_id==$stuList->id){ ?> selected <?php } ?> value="<?php echo $stuList->id; ?>"><?php echo $stuList->first_name.' '.$stuList->last_name; ?></option>
									<?php } ?>
								</select>
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Payment Type</label></label>
                            <div class="col-md-5">

                                <select name="payment_type" class="form-control" id="quiz_id" required>
                                    <option value="">Select Payment Type</option>
                                    <?php foreach($payment_type as $payType){ ?>
                                        <option <?php  if(!empty($payDetail)){ if($payDetail->payment_type_id==$payType->payment_type){ ?> selected <?php }} ?> value="<?php echo $payType->payment_type; ?>"><?php echo $payType->payment_type; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label>Reference No</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Reference Number" class="form-control input-sm br0" size="30" id="chequenumber" <?php if(isset($payDetail->reference_no)){ ?> value="<?php echo $payDetail->reference_no; ?>" <?php }else{ ?> value="<?php echo set_value('chequenumber'); ?>" <?php } ?> name="chequenumber"/>                            
                                <span class="form_er_msg" id="error_title"></span>
                            </div>
                       </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label>Cheque/DD Date</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Cheque Date" class="form-control input-sm br0" size="30" id="paymentDate" <?php if(isset($payDetail->cheque_date)){ ?> value="<?php echo $payDetail->cheque_date; ?>" <?php }else{ ?> value="<?php echo set_value('chequedate'); ?>" <?php } ?> name="chequedate" />                            
                                <span class="form_er_msg" id="error_title"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label>Course Fees</label></label>
                            <div class="col-md-5">
                                <input type="text" readonly placeholder="500" class="form-control input-sm br0" size="30" id="coursefee" <?php if(isset($payDetail->course_fee)){ ?> value="<?php echo $payDetail->course_fee; ?>" <?php }else{ ?> value="<?php echo set_value('coursefees'); ?>" <?php } ?> name="coursefees" />                            
                                <span class="form_er_msg" id="error_title"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label>Bank Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Bank Name" class="form-control input-sm br0" size="30" id="bankname" <?php if(isset($payDetail->bank_name)){ ?> value="<?php echo $payDetail->bank_name; ?>" <?php }else{ ?> value="<?php echo set_value('bankname'); ?>" <?php } ?> name="bankname" />                            
                                <span class="form_er_msg" id="error_title"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label>Branch Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Branch Name" class="form-control input-sm br0" size="30" id="branchname" <?php if(isset($payDetail->branch_name)){ ?> value="<?php echo $payDetail->branch_name; ?>" <?php }else{ ?> value="<?php echo set_value('branchname'); ?>" <?php } ?> name="branchname" />                            
                                <span class="form_er_msg" id="error_title"></span>
                            </div>
                       </div>
					   
					   
					   
					   
					   
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="<?php echo $type; ?> Payment" name="submit"/> 
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
  
<script type="text/javascript">

$(document).ready(function(){

	
	var isProcessing = false;  

     
});
</script>
<script>
$(document).ready(function(){

	
	 $("#paymentDate").datepicker({
//		startDate:  new Date(),
		autoclose: true,
		format: 'yyyy/mm/dd',
		}).on('changeDate', function (selected) {
			var minDate = new Date(selected.date.valueOf());
			$('#paymentDate').datepicker('setStartDate', minDate);
		});

})

$(function(){ // start of doc ready.
   $(".stuName").change(function(e){
      e.preventDefault();  // stops the jump when an anchor clicked.
      var studentid = $(this).val(); // anchors do have text not values.
	
      $.ajax({
        url: '<?php echo site_url()?>admin/payment/get_data_by_id',
        data: {'studentid': studentid}, // change this to send js object
        type: "post",
        success: function(data){
			$('#coursefee').val(data);
           //document.write(data); just do not use document.write
           console.log(data);
        }
      });
   });
}); // end of doc ready


</script>