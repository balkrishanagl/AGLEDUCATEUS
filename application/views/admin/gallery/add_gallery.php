
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
           Gallery
            <small>Add Gallery</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/gallery/manage_gallery"><i class="fa fa-dashboard"></i> Gallery List</a></li>
            <li class="active">Add Gallery</li>
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
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="" enctype="multipart/form-data">
					
					  <div class="form-group">
						<label for="cal_testimonial_info" class="col-md-4 control-label"><label for="type">Type</label></label>
							<div class="col-md-8">
								<select class="form-control" name="city_type" id="type">
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
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Name" class="form-control input-sm br0" size="30" id="coursename" value="<?php echo set_value('name'); ?>" name="name" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">File Type</label></label>
                            <div class="col-md-5">
                                <input type="radio" id="image" value="image" checked="checked" name="type"/> Image &nbsp; &nbsp;
                                <input type="radio" id="video" value="video" name="type"/> Video
                            </div>
                       </div>
                       
                       
                        <div class="form-group" id="file_upload">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Image</label></label>
                            <div class="col-md-5">
                                <input type="file" placeholder="Image" accept="image/*" class="form-control input-sm br0" size="30" id="file" name="file" required/>
                                <span class="form_er_msg" id="error_password">Allowed Type:- jpg|JPEG|png|gif Max Size :- 500 KB</span>
                            </div>
                        </div>
                        <div class="form-group" id="videolink" style="display: none;">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Video</label></label>
                            <div class="col-md-5">
                                <textarea name="video" id="videourl" class="form-control input-sm br0" placeholder='<iframe src="https://www.youtube.com/embed/vX2VmLzs3gg"></iframe>'></textarea>
                                
                                <span class="form_er_msg" id="error_password">Ex: Please enter youtube embed code. </span>
                            </div>
                        </div>
						
						 <div class="form-group" id="file_upload_video" style="display: none;">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Video Image</label></label>
                            <div class="col-md-5">
                                <input type="file" placeholder="Video Image" accept="image/*" class="form-control input-sm br0" size="30" id="video_image" name="video_image"/>
                                <span class="form_er_msg" id="error_password">Allowed Type:- jpg|JPEG|png|gif Max Size :- 500 KB</span>
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

<script type="text/javascript">

$(document).ready(function(){

    
    var isProcessing = false;  

     
});
</script>

<script type="text/javascript">

$.noConflict();
       
jQuery(document).ready(function(){
	
    jQuery('#image').click(function(){
		
        jQuery('#file_upload').show();
        jQuery('#videolink').hide();
		jQuery('#file_upload_video').hide();
        jQuery('#file').attr('required','required');
        jQuery("#videourl").removeAttr("required");

    });
    jQuery('#video').click(function(){

        jQuery('#videolink').show();
        jQuery('#file_upload_video').show();
        jQuery('#file_upload').hide();
        jQuery("#videourl").attr("required","required");
        jQuery('#file').removeAttr('required');
    });
	
	
	jQuery('#type').on('change',function(){
        var type = jQuery(this).val();
        if(type){
            jQuery.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>admin/gallery/getCityByType/'+type,
                data:'type='+type,
                success:function(html){
                    jQuery('#city').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            /* $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>');  */
        }
    });


});

</script>
