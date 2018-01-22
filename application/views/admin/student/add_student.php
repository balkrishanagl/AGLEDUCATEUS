
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Student
            <small>Add Student</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/user/student_list"><i class="fa fa-dashboard"></i> Student</a></li>
            <li class="active">Add Student</li>
        </ol>
    </section>

     <!-- Main content -->
	 
<section class="content">
<?php //echo"<pre>"; print_r($user_data); ?>
    <div class="row">
        <div class="col-lg-8 col-xs-10">
		<div>
		
		<?php if(isset($file_error)){ 
				
				foreach($file_error as $file_errors){
					?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $file_errors; ?>
				</div>
				<?php }
	} ?>

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
                <form id="add_student_form" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/user/add_student/">          
                        <div class="form-group required">
						
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="studentname">First Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="First Name" class="form-control input-sm br0" size="30" id="student_name" value="<?php echo set_value('student_name'); ?>" name="student_name" required/>                            
                                <span class="form_er_msg" id="error_studentname"></span>
                            </div>
                       </div>
                         <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Username <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Username" class="form-control input-sm br0" size="30" id="user_name" value="<?php echo set_value('username'); ?>" name="username" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					     <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="Fathername">Father Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Father Name" class="form-control input-sm br0" size="30" id="father_name" value="<?php echo set_value('student_fathername'); ?>" name="student_fathername" required/>                            
                                <span class="form_er_msg" id="error_fathername"></span>
                            </div>
                       </div>
					     <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="address">Permanent Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <textarea placeholder="Permanent Address" class="form-control input-sm br0" id="paddress"  name="student_address" required><?php echo set_value('student_address'); ?></textarea>                            
                                <span class="form_er_msg" id="error_address"></span>
                            </div>
                       </div>
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="address">Correspondance Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <textarea placeholder="Correspondance Address" class="form-control input-sm br0" id="caddress"  name="student_caddress" required><?php echo set_value('student_caddress'); ?></textarea>                            
                                <span class="form_er_msg" id="error_address"></span>
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="nationality">Nationality <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <!--<input type="text" placeholder="Nationality" class="form-control input-sm br0" size="30" id="nationality" value="" name="student_nationality" required/>-->
                                <select name="student_nationality" class="form-control input-sm br0" required>																	<option value=''>-Select Nationality-</option>								 <?php foreach($country as $contries){ ?>								 
									<option <?php if(set_value('student_nationalityy')==$contries->country_name){ ?> selected <?php } ?> value="<?php echo $contries->country_name; ?>"><?php echo $contries->country_name; ?></option>																<?php } ?>
								</select>
								
								
								<span class="form_er_msg" id="error_username"></span>
                            </div>
                        </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="source_information">Source Of Information <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">                         
                                <select  class="form-control" name="source_information" id="source_information" required>
                                    <option value=''>-Select Source of Information-</option>
                                    <?php foreach ($source_data as $source_datas) { ?>
                                        <option <?php if(set_value('source_information')==$source_datas->id){ ?> selected <?php } ?> value="<?php echo $source_datas->id; ?>" data-option="<?php echo $source_datas->other_option_applicable;?>"><?php echo $source_datas->name; ?></option>
                                    <?php } ?>
                                </select>
								<input type="hidden" name="chk_otheroption" id="chk_otheroption" value="">
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					    <div  id="source_option_section"  style="display:none;" class="form-group">
						
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="studentname">Source Detail <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                 <input type="text"  class="form-control input-sm br0" placeholder="Source Detail" name="source_detail" id="source_detail">
                                <span class="form_er_msg" id="error_studentname"></span>
                            </div>
                       </div>
					   
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Qualification <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
								<select  class="form-control" name="student_qualification" id="st_qualification" required>
									<option value=''>-Select Student Qualification-</option>
									<option <?php if(set_value('student_caddress')=='Graduate'){ ?> selected <?php } ?> value="Graduate">Graduate</option>
									<option <?php if(set_value('student_caddress')=='Under Graduate'){ ?> selected <?php } ?> value="Under Graduate">Under Graduate</option>
									<option <?php if(set_value('student_caddress')=='Post Graduate'){ ?> selected <?php } ?> value="Post Graduate">Post Graduate</option>
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
                                        <option <?php if(set_value('student_type')==$type->user_type_id){ ?> selected <?php } ?> value="<?php echo $type->user_type_id; ?>" data-fees="<?php echo $type->fees;?>"><?php echo $type->user_type_name; ?></option>
                                    <?php } ?>
									
								</select>                           
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
						<div id="field_user_type_student">
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Degree/Diploma <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Course" class="form-control input-sm br0" size="30" id="st_course" value="<?php echo set_value('student_course'); ?>" name="student_course">                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Student Course Year <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
								<select class="form-control" name="student_course_year" id="st_course_year" >
									<option value=''>-Select Year-</option>
									<option <?php if(set_value('student_course_year')=="1 Year's"){ ?>selected <?php } ?> value="1 Year's">1 Year's</option>
									<option <?php if(set_value('student_course_year')=="2 Year's"){ ?>selected <?php } ?> value="2 Year's">2 Year's</option>
									<option <?php if(set_value('student_course_year')=="3 Year's"){ ?>selected <?php } ?> value="3 Year's">3 Year's</option>
									<option <?php if(set_value('student_course_year')=="4 Year's"){ ?>selected <?php } ?> value="4 Year's">4 Year's</option>
									<option <?php if(set_value('student_course_year')=="5 Year's"){ ?>selected <?php } ?> value="5 Year's">5 Year's</option>
									<option <?php if(set_value('student_course_year')=="Others"){ ?>selected <?php } ?> value="Others">Others</option>
								</select>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							 <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="Collegename">Student College Name <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="College Name" class="form-control input-sm br0" size="30" id="st_collegename" value="<?php echo set_value('student_collegename'); ?>" name="student_collegename" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
							
						    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="collegeaddress">Student College Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="College Address" class="form-control input-sm br0" size="30" id="st_collegeaddress" value="<?php echo set_value('student_collegeaddress'); ?>" name="student_collegeaddress" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							</div>
							
						<div id="field_user_type_other">
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="orgname">Organization Name  <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Organization Name" class="form-control input-sm br0" size="30" id="st_orgname" value="<?php echo set_value('st_orgname'); ?>" name="st_orgname" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                         </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="course">Designation  <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Designation" class="form-control input-sm br0" size="30" id="designation" value="<?php echo set_value('designation'); ?>" name="designation" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                          </div>
						  
						   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="orgaddress">Organization Address <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Organization Address" class="form-control input-sm br0" size="30" id="st_orgaddress" value="<?php echo set_value('st_orgaddress'); ?>" name="st_orgaddress" >                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                            </div>
							
						</div>						
							<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="collegefees">Course Fees <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Course Fees" class="form-control input-sm br0" size="30" id="st_coursefee" value="<?php echo set_value('student_collegefee'); ?>" readonly name="student_collegefee" required/>                            
                                <span class="form_er_msg" id="error_collegefee"></span>
                            </div>
                            </div>
							
                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Email <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="email" placeholder="Email" class="form-control input-sm br0" size="30" id="student_email" value="<?php echo set_value('student_email'); ?>" name="student_email" required/>
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>
						
						    <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="gender">Gender <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="radio" placeholder="" class="form-control input-sm br0" size="30" id="" value="Male" <?php if(set_value('student_gender')=='Male'){ ?> checked <?php } ?> name="student_gender" required/>Male
								  <input type="radio" placeholder="" class="form-control input-sm br0" size="30" id="" <?php if(set_value('student_gender')=='Female'){ ?> checked <?php } ?> value="Female" name="student_gender" required/>Female
                                <span class="form_er_msg" id="error_gender"></span>
                            </div>
                        </div>
						
						    <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="dob">Dob <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="DOB" class="form-control input-sm br0" size="30" id="student_dob" value="<?php echo set_value('student_dob'); ?>" name="student_dob" required/>
                                <span class="form_er_msg" id="error_dob"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="mobile">Mobile <span style="color:red;">*</span></label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Mobile" class="form-control input-sm br0" size="30" id="student_mobile" value="<?php echo set_value('student_mobile'); ?>" name="student_mobile" required/>
                                <span class="form_er_msg" id="error_mobile"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Contact Number</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Contact Mobile" class="form-control input-sm br0" size="30" id="student_amobile" value="<?php echo set_value('student_amobile'); ?>" name="student_amobile" />
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>
						<div class="form-group" id="student_document"  style="display:none;">
							<label for="cal_event_info" class="col-md-4 control-label"><label for="">Upload Document</label></label>
							<div class="input_fields_wrap col-md-5">
							<div><input type="file" name="myfiles[]" accept=".pdf,.doc"></div>
								<div><a href="#" class="add_field_button">Add More Documents</a></div>
								<span class="form_er_msg" id="error_document">Document Type PDF/DOC. Max Size: 200 KB. </span>
							</div>
						</div>
						<div class="form-group" id="student_id_card"  style="display:none;">
							<label for="cal_event_info" class="col-md-4 control-label"><label for="">Student ID Card</label></label>
							<div class="col-md-5">
								<input type="file" name="stu_card" accept="image/*">
								<span class="form_er_msg" id="error_id_card">Image Type jpg/JPEG/gif/png. Max Size: 200 KB. Max Height And Width (50x100) </span>
								<div class="help-block with-errors"></div>
							</div>
						</div>
						
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 
                                 <input type="button" class="btn btn-info br0 hide" value="Adding Request..." id="on_sending_req_reg"/>           
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    
<!-- Include Date Range Picker -->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>-->
<script>
	$(document).ready(function(){

		 //var myDate = new Date("March 21, 1997");
		 $("#student_dob").datepicker({
			changeMonth: true,//this option for allowing user to select month
			changeYear: true, //this option for allowing user to select from year range
			yearRange: '1950:2013'
		
			});
	});
</script>
<script type="text/javascript">
$(document).ready(function() {
	
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
	
	$('#field_user_type_other').hide(); 
	$('#field_user_type_student').hide();
	 
	 
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(".add_field_button").click(function(e){ //on add input button click
	
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="file" name="myfiles[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
	
	$("#st_type").change(function() {
		var fees = $(this).find(':selected').attr('data-fees');
		$("#st_coursefee").val(fees);
		
		if(this.value == ""){
			$('#field_user_type_student').hide();
			$('#field_user_type_other').hide(); 
			$('#student_document').hide();
			$('#student_id_card').hide();
		}else if(this.value == 4){
			$('#field_user_type_student').show();
			$('#field_user_type_other').hide(); 
			$('#student_document').show();
			$('#student_id_card').show();
		}else{
			
			$('#field_user_type_student').hide();
			$('#field_user_type_other').show(); 
			$('#student_document').hide();
			$('#student_id_card').hide();
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