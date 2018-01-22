
<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            Exhibition
            <small>Add Exhibition</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/event/manage_event"><i class="fa fa-dashboard"></i> Exhibition</a></li>
            <li class="active">Add Exhibition</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
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
				
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php }else if(validation_errors()){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
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
                <form id="add_event_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/event/add_event"  enctype="multipart/form-data">          
                       
					  <div class="form-group">
						<label for="cal_testimonial_info" class="col-md-4 control-label"><label for="type">Type</label></label>
							<div class="col-md-8">
								<select class="form-control" name="type" id="type">
									<option value="">Select</option>
									<option value="Domestic">Domestic</option>
									<option value="International">International</option>
								</select>
							</div>
					</div>
			
					<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">City</label></label>
                            <div class="col-md-8">
                            <select class="form-control" name="city" id="city">
                                <option value="">Select City</option>
                                <?php //foreach($city_detail as $city){ ?>      
                                    <!--<option value="<?php //echo $city->id; ?>"><?php //echo $city->city_name; ?></option>-->
                                <?php //} ?>
                            </select>
                                
                            </div>
                        </div>
						
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Title" class="form-control input-sm br0" size="30" id="event_title" value="<?php echo set_value('event_title'); ?>" name="event_title" />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Location</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="location" class="form-control input-sm br0" id="location" value="<?php echo set_value('location'); ?>" name="location" />                            
								                             
                            </div>
                       </div>	
						
					 <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Map</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Map" class="form-control input-sm br0" id="map" value="<?php echo set_value('map'); ?>" name="map" />                            
								                             
                            </div>
                       </div>	
                     

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Content</label></label>
                            <div class="col-md-8">
                             <?php echo $this->ckeditor->editor('event_content',@$default_value);?> 
													 
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Dream Collage</label></label>
                            <div class="col-md-8">
                            <select name="dream_collage[]" multiple>
							  <?php foreach($dream_collage as $dCollage){ ?>      
                                    <option value="<?php echo $dCollage->id; ?>"><?php echo $dCollage->name; ?></option>
                                <?php } ?>
							</select>
                                
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Course</label></label>
                            <div class="col-md-8">
                            <select name="course[]" multiple>
							  <?php foreach($course as $courses){ ?>      
                                    <option value="<?php echo $courses->id; ?>"><?php echo $courses->name; ?></option>
                                <?php } ?>
							</select>
                                
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Universities</label></label>
                            <div class="col-md-8">
                            <select name="universities[]" multiple>
							  <?php foreach($universities as $university){ ?>      
                                    <option value="<?php echo $university->id; ?>"><?php echo $university->name; ?></option>
                                <?php } ?>
							</select>
                                
                            </div>
                        </div>
						
						<div class="form-group">
							 <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Thumb Image</label></label>
							 <div class="col-md-8">
							 <input type="file"  class="form-control input-sm br0"  size="30" id="thumb_image" name="thumb_image"/>                            
							 <!--<span class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </span>-->
							 <div class="form_er_msg"><?php echo form_error('thumb_image'); ?></div>	
							 </div>
						 </div>
						
						<div class="form-group">
							 <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Main Image</label></label>
							 <div class="col-md-8">
							 <input type="file"  class="form-control input-sm br0"  size="30" id="main_image" name="main_image"/>                            
							 <!--<span class="form_er_msg" id="error_password">Image Type:- jpg/JPEG/gif/png. Max Size:- 200 KB. Max Height And Width (620x460) </span>-->
							 <div class="form_er_msg"><?php echo form_error('main_image'); ?></div>	
							 </div>
						 </div>
						 
						 <!--<div class="row" data-duplicate="conditions" data-duplicate-min="1">
							<div class="col-md-4">	  
								<button class="btn" type="button"  data-duplicate-add="conditions">+</button>
								<button class="btn" type="button"  data-duplicate-remove="conditions">-</button>
							</div>

							<div class="col-md-8">	
								<input type="file"  class="form-control input-sm br0"  size="30" id="event_image" name="event_images[]">                            

							</div>
						</div>-->
						
						 
			            <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title"> Date 1</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="event_start_date" value="" name="event_start_date" />                            
								
                             
                            </div>
                        </div>
						
												
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Date 2</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="form-control input-sm br0" size="30" id="event_end_date" value="" name="event_end_date" />                            
								
                             
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">Start Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 event_start_time" size="30" value="<?php echo set_value('event_start_time'); ?>" readonly="readonly" name="event_start_time"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="quizname">End Time</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="" class="form-control input-sm br0 event_end_time" size="30" value="<?php echo set_value('event_end_time'); ?>" readonly="readonly" name="event_end_time"/>                            
                                <span class="form_er_msg" id="error_time"></span>
                            </div>
                       </div>
					
					<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Meta Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Meta Title" class="form-control input-sm br0" id="meta_title" value="<?php echo set_value('meta_title'); ?>" name="meta_title" />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Meta Keywords</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Meta Keyword" class="form-control input-sm br0" id="meta_keyword" value="<?php echo set_value('meta_keyword'); ?>" name="meta_keyword" />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta description">Meta Description</label></label>
                            <div class="col-md-8">
                              <textarea placeholder="Meta description" class="form-control input-sm br0" id="meta_description" value="<?php echo set_value('meta_description'); ?>" name="meta_description" ></textarea>
							  
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    
<!-- Include Date Range Picker -->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.duplicate.js"></script>
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
	
	if($("#type").val()=="Event"){
		$("#event_shedule").show();
	}else{
		$("#event_shedule").hide();
	}
	
	
	 $("#event_start_date").datepicker({
			//startDate:'01/01/2000',
			autoclose: true,
			format: 'yyyy/mm/dd',
			}).on('changeDate', function (selected) {
				var minDate = new Date(selected.date.valueOf());
				$('#event_end_date').datepicker('setStartDate', minDate);
			});

			$("#event_end_date").datepicker({
				//startDate:   new Date(),
				autoclose: true,
				format: 'yyyy/mm/dd',
			}).on('changeDate', function (selected) {
					var maxDate = new Date(selected.date.valueOf());
					$('#event_start_date').datepicker('setEndDate', maxDate); 
				});
				
				
	$("#type").change(function() {
		
		if(this.value == "Event"){
			$("#event_shedule").show();
		}else{
			$("#event_shedule").hide();
		}
	});	
	
	
	$('#type').on('change',function(){
        var type = $(this).val();
        if(type){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>admin/event/getCityByType/'+type,
                data:'type='+type,
                success:function(html){
                    $('#city').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            /* $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>');  */
        }
    });
	
	
	$('.event_start_time').timepicker({
		timeFormat: 'h:mm p',
		interval: 30,
		minTime: '10',
		//maxTime: '6:00pm',
		defaultTime: '11',
		dynamic: false,
		dropdown: true,
		scrollbar: true,
});

		$('.event_end_time').timepicker({
				timeFormat: 'h:mm p',
				interval: 30,
				minTime: '10',
				//maxTime: '6:00pm',
				defaultTime: '11',
				dynamic: false,
				dropdown: true,
				scrollbar: true
		});
	
});
</script>
