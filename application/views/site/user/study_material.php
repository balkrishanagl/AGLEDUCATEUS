<div class="banner">
  <ul class="owl-carousel" id="home_slide">
    <li> <img src="<?php echo base_url(); ?>assets/site/images/registraion_banner.jpg" alt="">
      <div class="tag1">Study Material</div>
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
						<?php if(count($study_material)>0){ ?>
							<table border="0" cellpadding="0 0 15 0" cellspacing="0">
						<thead>
							<tr class="my-tr">
									<td>S.No.</td>
									<td>Course</td>
									<td>Filename</td>
									<td>Action</td>
								</tr>
						</thead>
						<tbody>
								<?php $i=1; foreach($study_material as $study_materials){ ?>
								<tr class="my-tr">
									<td><span><?php echo $i; ?></span></td>
									<td><?php echo $study_materials['course']; ?></td>
									<td><?php echo $study_materials['study_material']; ?></td>
									<td><a href="<?php echo base_url(); ?>student/download_study_material/?path=<?php echo base_url()."uploads/study_material/".$study_materials['study_material']; ?>&filename=<?php echo $study_materials['study_material']; ?>">Download</a>
									&nbsp;
									</td>
								
								</tr>
								<?php $i++; } ?>
								
							</table>
						<?php } else { ?>
							<h3><center>No any study material found!</center></h3>
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