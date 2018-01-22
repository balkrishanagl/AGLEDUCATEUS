
<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Assignments</div>
    </li>
  </ul>
</div>

<style>
.error{
	float:left !important;
}
</style>
<section class="main">
			<div class="wrapper">
				<div class="assignment-outer">
				<div>
				<?php echo validation_errors(); ?>
				<?php if($this->session->flashdata('success')){ ?>
				<div class="succe"><?php echo $this->session->flashdata('success'); ?></div>
				<?php } ?>
			
			
			
			</div>
						<?php if(count($assignments)>0){ ?>
							<table border="0" cellpadding="0 0 15 0" cellspacing="0">
						<thead>
							<tr class="my-tr">
									<td>S.No.</td>
									<td>Faculty Name</td>
									<td>Filename</td>
									<td>Caption</td>
									<td>Action</td>
								</tr>
						</thead>
						<tbody>
								<?php 
									$i=1; foreach($assignments as $assignment){ 
									$session_data = $this->session->userdata('site_user');
									$userId = $session_data['user_id'];
									
									$studentAssignment = $this->student_model->getStudentSubmitedAssignment($userId,$assignment['id']);
									
									if(empty($studentAssignment)){
										
								?>
								<tr class="my-tr">
									<td><span><?php echo $i; ?></span></td>
									<td><?php echo $assignment['username']; ?></td>
									<td><?php echo $assignment['filename']; ?></td>
									<td><?php echo $assignment['caption']; ?></td>
									<td><a href="<?php echo base_url(); ?>student/download_assignment/?path=<?php echo base_url()."uploads/assignment_faculty/".$assignment['path']; ?>&filename=<?php echo $assignment['path']; ?>">Download</a>
									&nbsp; | &nbsp; <a href="<?php echo base_url(); ?>student/submit_assignment/<?php echo $assignment['id']; ?>">Submit</a>
									</td>
								</tr>
									<?php $i++; }
									} ?>
								
							</table>
						<?php } else { ?>
							<h3>No Any assignment found!</h3>
						<?php } ?>
							<?php //echo "<pre>"; print_r($assignments); echo "</pre>"; ?>
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
		$("tr.my-tr").after('<tr class="tr-spacer" style="border:0;"><td colspan="6" height="13" style="background:none;border:0;"></td></tr>');
	})
</script>