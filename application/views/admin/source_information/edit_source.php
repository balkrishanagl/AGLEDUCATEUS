<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Source of Information
		<small>Edit Source info</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
		 <li><a href="<?php echo base_url()?>admin/source_information/manage_source"><i class="fa fa-dashboard"></i> Source of Information</a></li>
		<li class="active">Edit source info</li>
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
		</div>

	   <form id="add_source_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url();?>admin/source_information/edit_source/<?php echo $source_data->id;?>">          
	   <div class="form-group">
	   <label for="cal_source_website_url" class="col-md-4 control-label"><label for="Website URL">Website URL</label></label>
	   <div class="col-md-8">
	   <input type="text" placeholder="Website URL" class="form-control input-sm br0" size="30" id="website_url" value="<?php  if(isset($source_data) && $source_data != ''){ echo $source_data->website_url; }?>" name="website_url" >                            
	   </div>
	   </div>
	    <div class="form-group">
		  <label for="cal_source_name" class="col-md-4 control-label"><label for="Name">Name</label></label>
		     <div class="col-md-8">
		     <input type="text" placeholder="Name" class="form-control input-sm br0" size="30" id="name" value="<?php  if(isset($source_data) && $source_data != ''){ echo $source_data->name; }?>" name="name" required/>                            
	
		</div>
		</div>
		
		<!--<div class="form-group">
     		<label for="cal_source_status" class="col-md-4 control-label"><label for="status">User Type</label></label>
	    	<div class="col-md-8">
		    <select class="form-control" name="usertype" id="usertype">
				<?php foreach($all_user_type as $allUserType){ ?>
					<option <?php if($source_data->usertype==$allUserType->user_type_id){ ?> selected <?php } ?> value="<?php echo $allUserType->user_type_id; ?>"><?php echo $allUserType->user_type_name; ?></option>
				<?php } ?>
			</select>
					
			</div>
			</div>
			-->
			<div class="form-group">
     		<label for="cal_source_status" class="col-md-4 control-label"><label for="status">User Type</label></label>
	    	<div class="col-md-8">
			<?php $typeId = explode(',',$source_data->usertype); ?>
			<?php 
			$j=0;
			foreach($all_user_type as $allUserType){
			?>
			
		    <input type="checkbox" name="usertype[]" <?php if(isset($typeId[$j])==$allUserType->user_type_id){ ?> checked <?php } ?> value="<?php echo $allUserType->user_type_id; ?>"/> <?php echo $allUserType->user_type_name; ?>
			
			<?php $j++; } ?>
					
			</div>
			</div>
			
			<div class="form-group">
     		<label for="cal_source_status" class="col-md-4 control-label"><label for="status">Other Option Applicable </label></label>
	    	<div class="col-md-8">
	
		    <input type="checkbox" name="other_option" <?php if($source_data->other_option_applicable == 1){ ?> checked <?php } ?> value="<?php echo $source_data->other_option_applicable; ?>"/> Option
			
					
			</div>
			</div>
			
			<div class="form-group">
     		<label for="cal_source_status" class="col-md-4 control-label"><label for="status">Payment Type</label></label>
	    	<div class="col-md-8">
		    <select class="form-control" name="payment_type" id="payment_type">
				<option <?php if($source_data->payment_type=='percent'){ ?> selected <?php } ?> value="percent">%</option>
				<option <?php if($source_data->payment_type=='flat'){ ?> selected <?php } ?> value="flat">Flat</option>
				<option <?php if($source_data->payment_type=='fixed_amount'){ ?> selected <?php } ?> value="fixed_amount">Fixed Amount</option>
			</select>
					
			</div>
			</div>
		
		<div class="form-group">
		 <label for="cal_source_name" class="col-md-4 control-label"><label for="Name">Payment share</label></label>
		 <div class="col-md-8">
		 <input type="text" placeholder="payment %" class="form-control input-sm br0" size="30" id="payment_share" value="<?php  if(isset($source_data) && $source_data != ''){ echo $source_data->amount; }?>" name="payment_share" required/>                            
	
		</div>
		</div>
		<?php if($this->session->userdata['admin_user']['admin_user_type_id']=='7'){ ?>
		<div class="form-group">
		  <label for="cal_source_name" class="col-md-4 control-label"><label for="Name">Count</label></label>
		     <div class="col-md-8">
		     <input type="text" placeholder="Count" class="form-control input-sm br0" size="30" id="count" value="<?php  if(isset($source_data) && $source_data != ''){ echo $source_data->count; }?>" name="count" required/>                            
	
		</div>
		</div>
		<?php } ?>
		
		
		<div class="form-group">
			<label for="cal_event_datetime" class="col-md-4 control-label"><label for="category name">Order No</label></label>
			<div class="col-md-8">
			<input type="number" placeholder="Order No" class="form-control input-sm br0" size="30" id="order_no" value="<?php  if(isset($source_data) && $source_data != ''){ echo $source_data->order_no; }?>" name="order_no" required/>                            
			</div>
        </div>
					   
       <div class="form-group">
	   <label for="cal_source_status" class="col-md-4 control-label"><label for="status">Status</label></label>
	   <div class="col-md-8">
	   <select class="form-control" name="status" id="status">
	 
	   <option value="1" <?php  if(isset($source_data) && $source_data != ''){ if($source_data->status == 1){ echo "selected"; } }?> >Active</option>
	   <option value="0" <?php  if(isset($source_data) && $source_data != ''){ if($source_data->status == 0){ echo "selected"; } }?> >Inactive</option>
                         
       </select>
                                
		</div>
    	</div>
		
	

		<div class="form-group">
    	<label for="full_name" class="col-md-4 control-label"></label>
		<div class="col-md-8">
	    <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update Source of Information" name="submit"/> 
		</div>
		</div>
	    </form> 
        </div><!-- ./col -->
        </div>

</section><!-- /.content -->

</aside>    

 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>
