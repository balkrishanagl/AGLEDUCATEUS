<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            City Exhibition Register
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/register/city_exhibition_register_list"><i class="fa fa-dashboard"></i>City Exhibition Register</a></li>
            <li class="active">City Exhibition Register view</li>
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

	               <?php if(isset($city_exhibition_register_list) && $city_exhibition_register_list != NULL) {?>
				   
                    
							 <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Registration date</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->created)){ echo date("d-m-Y",strtotime($city_exhibition_register_list->created)); } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Exhibition City</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->city)){ echo $city_exhibition_register_list->city; } ?></label></label>
									 
									</div>
							   </div>
							   
								<div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Name</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->name)){ echo $city_exhibition_register_list->name; } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Email</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->email)){ echo $city_exhibition_register_list->email; } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Mobile Number</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->mobile)){ echo $city_exhibition_register_list->mobile; } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">User City</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->user_city)){ echo $city_exhibition_register_list->user_city; } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Qualification</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->qualification)){ echo $city_exhibition_register_list->qualification; } ?></label></label>
									 
									</div>
							   </div>
							   
							   <div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title">Course</label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if(isset($city_exhibition_register_list->course)){ echo $city_exhibition_register_list->course; } ?></label></label>
									 
									</div>
							   </div>
							   
							   
					 <?php
					
				   }?>
                    
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    
