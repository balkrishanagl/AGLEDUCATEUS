<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		City
		<small>Edit City</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="<?php echo base_url()?>admin/city/manage_city"><i class="fa fa-dashboard"></i>City</a></li>
		<li class="active">Edit City</li>
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
			<?php } else if(isset($file_error)){
				foreach($file_error as $error){
				?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $error; ?>
				</div>
				<?php }
				} else if($this->session->flashdata('warning')){  ?>
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
			
			<?php if(isset($msg)){ ?>
					<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Error!</strong>  <?php echo $msg; ?>
					</div>	
					<?php }
					?>
		</div>

	   <form id="add_city_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url();?>admin/city/edit_city/<?php echo $city_data->id;?>" enctype="multipart/form-data">

<?php if($city_data->type == "Domestic"){ ?>
  <div class="form-group">
			   <label for="cal_college_info" class="col-md-4 control-label"><label for="state">State</label></label>
               <div class="col-md-8">
                   <select class="form-control" name="state" id="state">
				   <option value="">Select State</option>
					   <?php

					   foreach ($state_data as $all_state){  ?>
						   <option value="<?php  echo $all_state->state_name; ?>" <?php  if ($city_data->state_name == $all_state->state_name ){ echo "selected"; } ?>><?php  echo $all_state->state_name; ?></option>
					   <?php  } ?>

				   </select>

			   </div>
		   </div>
<?php } ?>
	   <div class="form-group">
	   <label for="cal_city_datetime" class="col-md-4 control-label"><label for="city name">City Name</label></label>
	   <div class="col-md-8">
	   <input type="text" placeholder="City Name" class="form-control input-sm br0" size="30" id="city_name" value="<?php  if(isset($city_data) && $city_data != ''){ echo $city_data->city_name; }?>" name="city_name" required/>
	   </div>
	   </div>


		<div class="form-group">
    	<label for="full_name" class="col-md-4 control-label"></label>
		<div class="col-md-8">
	    <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update city" name="submit"/> 
		</div>
		</div>
	    </form> 
        </div><!-- ./col -->
        </div>

</section><!-- /.content -->

</aside>    

 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>
