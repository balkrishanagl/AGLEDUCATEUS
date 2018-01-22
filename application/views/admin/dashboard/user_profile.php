
<!-- Right side column. Contains the navbar and content of the User profile -->
<aside class="right-side">
    <!-- Content Header (exam header) -->
    <section class="content-header">
        <h1>
            User profile
              </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">User profile</li>
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
		<?php //echo "<pre>"; print_r($admin_user_data);?>
                <form id="add_exam_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/user_profile/<?php echo $admin_user_data->id;?>" enctype= "multipart/form-data">          
                        <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="username">Name</label></label>
                            <div class="col-md-8">
                            <!--<p class="form-control input-sm br0"><?php //echo $admin_user_data->name;?></p>-->							<input type="text" placeholder="Name" class="form-control input-sm br0"  id="name" value="<?php if(isset($admin_user_data)) { echo $admin_user_data->name; }?>" name="name"/>                            
							
                            </div>
                       </div>

                      <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="email">Email</label></label>
                            <div class="col-md-8">
                             <p class="form-control input-sm br0"><?php echo $admin_user_data->email;?></p>
                            </div>
                       </div>					   					    <div class="form-group">                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">City</label></label>                            <div class="col-md-5">                               <select class="form-control" name="city" id="city">                                    <?php if(isset($city_data) && $city_data != NULL) {?>										<option value="">Select City</option>                                        <?php foreach($city_data as $allCity){																						?>                                            <option value="<?php echo $allCity->id; ?>" <?Php if($allCity->id == $admin_user_data->city){ echo "selected"; }?>><?php echo $allCity->city_name; ?></option>											                                    <?php }									}?>                               </select>                                <span class="form_er_msg" id="error_user_type"></span>                            </div>                        </div>												<div class="form-group">                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Phone</label></label>                            <div class="col-md-5">                                <input type="text" placeholder="Phone Number" class="form-control input-sm br0"  id="phone" value="<?php if(isset($admin_user_data)) { echo $admin_user_data->phone; }?>" name="phone"/>                                                            <span class="form_er_msg" id="error_username"></span>                            </div>                       </div>					   					   <div class="form-group">                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Address</label></label>                            <div class="col-md-5">                                <textarea  class="form-control input-sm br0" name="address" id="address"><?php if(isset($admin_user_data)) { echo $admin_user_data->address; }?></textarea>                            </div>                       </div>					   					   <div class="form-group">                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Pincode</label></label>                            <div class="col-md-5">                                <input type="text" placeholder="Pincode" class="form-control input-sm br0"  id="pincode" value="<?php if(isset($admin_user_data)) { echo $admin_user_data->pincode; }?>" name="pincode"/>                                                                                        </div>                       </div>

					   <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="password">Password</label></label>
                            <div class="col-md-8">
                                <input type="password" placeholder="" class="form-control input-sm br0" size="30" id="user_password" value="" name="user_password"/>                            
                             
                            </div>
							</div>
							 <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="password">Confirm Password</label></label>
                            <div class="col-md-8">
                                <input type="password" placeholder="" class="form-control input-sm br0" size="30" id="user_cpassword" value="" name="user_cpassword" 
								/>                            
                             
                            </div>
							</div>
							<div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="password">Image</label></label>
                            <div class="col-md-8">
                                <input type="file" placeholder="" class="form-control input-sm br0" size="30" id="user_image_file" value="" name="user_image_file"/>                            
                             
                            </div>
							</div>  
	                       <div class="form-group">
                            <label for="cal_exam_datetime" class="col-md-4 control-label"><label for="password">Image</label></label>
                            <div class="col-md-8">
							<?php if(isset($admin_user_data->user_image_file) && $admin_user_data->user_image_file!='')
							{?>
                               <img src="<?php echo base_url();?>uploads/adminuser/<?php echo $admin_user_data->user_image_file;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>
                            </div>
							</div> 							
                            <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update Profile" name="submit"/> 
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
