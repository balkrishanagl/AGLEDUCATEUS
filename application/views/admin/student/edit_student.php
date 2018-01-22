
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Student
            <small>Edit Student</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/user/student_list"><i class="fa fa-dashboard"></i> Student</a></li>
            <li class="active">Edit Student</li>
        </ol>
    </section>

     <!-- Main content -->
	 
<section class="content">
<?php //echo"<pre>"; print_r($user_data); ?>
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
                <form id="edit_student_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/user/edit_student/<?php echo $user_data->user_id; ?>">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="studentname">First Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="First Name" class="form-control input-sm br0" size="30" id="student_name" value="<?php if(isset($_POST['student_name'])){ echo $_POST['student_name']; } else { echo $user_data->first_name; }?>" name="student_name" required/>                            
                                <span class="form_er_msg" id="error_studentname"></span>
                            </div>
                       </div>
                         <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Username <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Username" class="form-control input-sm br0" size="30" id="user_name" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } else { echo $user_data->username; }?>" name="username" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					     <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="Fathername">Father Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Father Name" class="form-control input-sm br0" size="30" id="father_name" value="<?php if(isset($_POST['student_fathername'])){ echo $_POST['student_fathername']; } else { echo $user_data->father_name; }?>" name="student_fathername" required/>                            
                                <span class="form_er_msg" id="error_fathername"></span>
                            </div>
                       </div>
					     <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="address">Permanent Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <textarea placeholder="Permanent Address" class="form-control input-sm br0" id="paddress"  name="student_address" required><?php if(isset($_POST['student_address'])){ echo $_POST['student_address']; } else { echo $user_data->permanent_address; }?></textarea>                            
                                <span class="form_er_msg" id="error_address"></span>
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="address">Correspondance Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <textarea placeholder="Correspondance Address" class="form-control input-sm br0" id="caddress"  name="student_caddress" required><?php if(isset($_POST['student_caddress'])){ echo $_POST['student_caddress']; } else { echo $user_data->correspondence_address; }?></textarea>                            
                                <span class="form_er_msg" id="error_address"></span>
                            </div>
                       </div>
										   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="nationality">Nationality <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <!--<input type="text" placeholder="Nationality" class="form-control input-sm br0" size="30" id="nationality" value="" name="student_nationality" required/>-->
                                <select name="student_nationality" class="form-control input-sm br0" required>
									
									<?php foreach($country as $contries){ ?>
										
										<option value="<?php echo $contries->country_name; ?>" <?php if($contries->country_name==$user_data->nationality){ echo "selected";} ?> ><?php echo $contries->country_name; ?></option>
									  <?php } ?>
								</select>
								
								
								<span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="source_information">Source Of Information <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <!--<input type="text" placeholder="Source Of  Information" class="form-control input-sm br0" size="30" id="source_information" value="<?php if(isset($_POST['source_information'])){ echo $_POST['source_information']; } else { echo $user_data->sourceinformation; }?>" name="source_information" required/>-->                            
                                <select  class="form-control" name="source_information" id="source_information" required>
                                    <option value=''>-Select Source of Information-</option>
                                    <?php foreach ($source_data as $source_datas) { ?>
                                        <option value="<?php echo $source_datas->id; ?>" <?php if($source_datas->id==$user_data->sourceinformation){ echo "selected";} ?> data-option="<?php echo $source_datas->other_option_applicable;?>"><?php echo $source_datas->name; ?></option>
                                    <?php } ?>
                                </select>
								<input type="hidden" name="chk_otheroption" id="chk_otheroption" value="">
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   <div  id="source_option_section"  style="display:none;" class="form-group required">
						
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="studentname">Source Detail <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                 <input type="text"  class="form-control input-sm br0" placeholder="Source Detail" name="source_detail" id="source_detail" value="<?php if(isset($_POST['source_detail'])){ echo $_POST['source_detail']; } else { echo $user_data->source_detail; }?>">
                                <span class="form_er_msg" id="error_studentname"></span>
                            </div>
                       </div>
					   
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Qualification <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
								<select  class="form-control" name="student_qualification" id="st_qualification" required>
									<option value=''>-Select Student Qualification-</option>
									<option value="Graduate" <?php if($user_data->qualification=='Graduate'){ echo "selected";} ?>>Graduate</option>
									<option value="Under Graduate" <?php if($user_data->qualification=='Under Graduate'){ echo "selected";} ?>>Under Graduate</option>
									<option value="Post Graduate" <?php if($user_data->qualification=='Post Graduate'){ echo "selected";} ?>>Post Graduate</option>
								</select>                           
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Type <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
								<select  class="form-control" name="student_type" id="st_type"  required>
									<option value=''>-Select Student Type-</option>
									<?php foreach ($user_type as $type) { ?>
                                        
										<option value="<?php echo $type->user_type_id; ?>" data-fees="<?php echo $type->fees;?>" <?php if($type->user_type_id==$user_data->user_type_id){ echo "selected";} ?> ><?php echo $type->user_type_name; ?></option>
                                    <?php } ?>
									
								</select>                           
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							<div id="field_user_type_student">
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Course <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Course" class="form-control input-sm br0" size="30" id="st_course" value="<?php if(isset($_POST['student_course'])){ echo $_POST['student_course']; } else { echo $user_data->about_course; }?>" name="student_course" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Course Year <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
								<select class="form-control" name="student_course_year" id="st_course_year" >
									<option value=''>-Select Year-</option>
									<option value="1 Year's" <?php if($user_data->course_year=="1 Year's"){ echo "selected";} ?>>1 Year's</option>
									<option value="2 Year's" <?php if($user_data->course_year=="2 Year's"){ echo "selected";} ?>>2 Year's</option>
									<option value="3 Year's" <?php if($user_data->course_year=="3 Year's"){ echo "selected";} ?>>3 Year's</option>
									<option value="4 Year's" <?php if($user_data->course_year=="4 Year's"){ echo "selected";} ?>>4 Year's</option>
									<option value="5 Year's" <?php if($user_data->course_year=="5 Year's"){ echo "selected";} ?>>5 Year's</option>
									<option value="Others" <?php if($user_data->course_year=="Others"){ echo "selected";} ?>>Others</option>
								</select>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							 <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="Collegename">Student College Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="College Name" class="form-control input-sm br0" size="30" id="st_collegename" value="<?php if(isset($_POST['student_collegename'])){ echo $_POST['student_collegename']; } else { echo $user_data->college_name; }?>" name="student_collegename" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							
						    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="collegeaddress">Student College Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="College Address" class="form-control input-sm br0" size="30" id="st_collegeaddress" value="<?php if(isset($_POST['student_collegeaddress'])){ echo $_POST['student_collegeaddress']; } else { echo $user_data->college_address; }?>" name="student_collegeaddress" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
						</div>	
						
						<div id="field_user_type_other">
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="orgname">Organization Name  <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Organization Name" class="form-control input-sm br0" size="30" id="st_orgname" value="<?php if(isset($_POST['st_orgname'])){ echo $_POST['st_orgname']; } else { echo $user_data->organization; }?>" name="st_orgname" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                         </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Designation  <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Designation" class="form-control input-sm br0" size="30" id="designation" value="<?php if(isset($_POST['designation'])){ echo $_POST['designation']; } else { echo $user_data->designation; }?>" name="designation" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                          </div>
						  
						   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="orgaddress">Organization Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Organization Address" class="form-control input-sm br0" size="30" id="st_orgaddress" value="<?php if(isset($_POST['st_orgaddress'])){ echo $_POST['st_orgaddress']; } else { echo $user_data->organisation_address; }?>" name="st_orgaddress" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                           </div>
							
						</div>	
						
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="collegefees">Course Fees <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Course Fees" class="form-control input-sm br0" size="30" id="st_coursefee" value="<?php if(isset($_POST['student_collegefee'])){ echo $_POST['student_collegefee']; } else { echo $user_data->course_fee; }?>"  readonly name="student_collegefee" required/>                            
                                <span class="form_er_msg" id="error_collegefee"></span>
                            </div>
                            </div>
							
                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Email <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="email" placeholder="Email" class="form-control input-sm br0" size="30" id="student_email" value="<?php if(isset($_POST['student_email'])){ echo $_POST['student_email']; } else { echo $user_data->email; }?>" name="student_email" required/>
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>
						
						    <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="gender">Gender <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="radio" placeholder="" class="form-control input-sm br0" size="30" id="" value="<?php if(isset($user_data)) { echo $user_data->gender; }?>" <?php if($user_data->gender=='Male') { echo "checked"; }?> name="student_gender" required/>Male
								  <input type="radio" placeholder="" class="form-control input-sm br0" size="30" id="" value="<?php if(isset($user_data)) { echo $user_data->gender; }?>" <?php if($user_data->gender=='Female') { echo "checked"; }?> name="student_gender" required/>Female
                                <span class="form_er_msg" id="error_gender"></span>
                            </div>
                        </div>
						
						    <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="dob">Dob <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="DOB" class="form-control input-sm br0" size="30" id="student_dob" value="<?php if(isset($_POST['student_dob'])){ echo $_POST['student_dob']; } else { echo $user_data->dob; }?>" name="student_dob" required/>
                                <span class="form_er_msg" id="error_dob"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="mobile">Mobile <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Mobile" class="form-control input-sm br0" size="30" id="student_mobile" value="<?php if(isset($_POST['student_mobile'])){ echo $_POST['student_mobile']; } else { echo $user_data->mobile_number; }?>" name="student_mobile" required/>
                                <span class="form_er_msg" id="error_mobile"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Contact Number</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Contact Mobile" class="form-control input-sm br0" size="30" id="student_amobile" value="<?php if(isset($_POST['student_amobile'])){ echo $_POST['student_amobile']; } else { if($user_data->contact_number!=0) echo $user_data->contact_number; }?>" name="student_amobile" />
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>
						
                        <input type="hidden" name="user_id" value="<?php if(isset($user_data)) { echo $user_data->id; }?>" id="user_id" />

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update" name="submit"/> 
                                 <input type="button" class="btn btn-info br0 hide" value="Adding Request..." id="on_sending_req_reg"/>           
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
		
	if($('#source_information').val() !=""){
		var op_val = $('#source_information').find(':selected').attr('data-option');
		if($('#source_information').find(':selected').attr('data-option') !=0){
			$('#source_option_section').show();
			$('#chk_otheroption').val(op_val);
		}else{
			$('#source_option_section').hide();
			$('#chk_otheroption').val(op_val);
			$('#source_detail').val('');
		}
}
	
	if($("#st_type").val() == 4){
		$('#field_user_type_student').show();
		$('#field_user_type_other').hide();
		//$("#st_coursefee").val($('#st_type').find(':selected').attr('data-fees'));
	}else{
		
		$('#field_user_type_other').show();
		$('#field_user_type_student').hide();
	}
	
		 $("#student_dob").datepicker({
			startDate:  new Date(),
			autoclose: true,
			format: 'yyyy/mm/dd',
			});
			
		
	$("#st_type").change(function() {
		var fees = $(this).find(':selected').attr('data-fees');
		$("#st_coursefee").val(fees);
		
		if(this.value == ""){
			$('#field_user_type_student').hide();
			$('#field_user_type_other').hide(); 
		}else if(this.value == 4){
			$('#field_user_type_student').show();
			$('#field_user_type_other').hide(); 
		}else{
			
			$('#field_user_type_student').hide();
			$('#field_user_type_other').show(); 
		}
	});
	
	$("#source_information").change(function() {
		var option = $(this).find(':selected').attr('data-option');
		
		if(option == 1){
			$('#source_detail').val('');
			$('#source_option_section').show();
			$('#chk_otheroption').val(option);
		}else{
			
			$('#source_option_section').hide();
			$('#chk_otheroption').val(option);
			$('#source_detail').val('');
		}
		//$("#st_coursefee").val(fees);
	 });
	
	});
</script>
<script type="text/javascript">

$(document).ready(function(){    	
    var isProcessing = false;     
});
</script>