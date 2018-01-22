<section class="banner">
			<ul>			
				<li>
					<img src="<?php echo base_url();?>assets/site/img/form-banner.jpg" alt="">
				</li>
			</ul>
	<section class="news padding0">
		<div class="wrapper">
			<p>FICCI-RGNIIPM Online Cretificate Course on IP Protection& Commercilization</p>
		</div>
	</section>
	
</section>
<?php
/*$session_data = $this->session->userdata;
echo "<pre>";
print_r($session_data);
echo "</pre>"; die;*/
?>
<style>
.error{
	float:left !important;
}
</style>
<section class="formsection">
			<div class="wrapper">
				<div class="form-outer">
					<div class="steps">
						<div class="step">
							<div class="step-left">Step 1:</div>
							<div class="step-right">Enter Registration Number</div>
						</div>
						<div class="step">
							<div class="step-left">Step 2:</div>
							<div class="step-right">Click Download Button</div>
						</div>
					</div>
					<form class="paymentForm" method="post" action="<?php echo base_url(); ?>student/download_admit_card/">
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
				<?php }else if(isset($file_error)){
					foreach($file_error as $error){
					?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Error!</strong> <?php echo $error; ?>
					</div>
					<?php }
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
						<div class="formTop">
								
						<div class="user-type">
							
						
						
						    <div class="form-part">
							
							<div class="form-right">
							
								<div class="form-row">
									<div class="form-label">Email:</div>
									<div class="form-input"><input type="email" name="registration_number" id="registration_number"  placeholder="Enter Registered Email" value="<?php echo set_value('registration_number'); ?>" required></div>
								</div>
								
							</div>
						</div></div>
						
						
						</div>
						<div class="form-actions">
							<input type="submit" value="Download">
						</div>
					</form>
				</div>
			</div>
		</section>
		
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/site/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/bootstrap-datepicker3.css"/>
<script>
	$(document).ready(function(){
		var date = new Date();
		date.setDate(date.getDate());
		
		var date_input=$('input[name="chequedate"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			//startDate: date,
		})
		  $('#reg_num').on('keydown', '#child', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

	})
</script>