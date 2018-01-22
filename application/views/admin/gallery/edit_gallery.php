<?php //echo '<pre>'; print_r($data); die; ?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Gallery
            <small>Edit Gallery</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/gallery/manage_gallery"><i class="fa fa-dashboard"></i> Gallery</a></li>
            <li class="active">Edit Gallery</li>
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
		
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="" enctype="multipart/form-data">
				
				<div class="form-group">
						<label for="cal_testimonial_info" class="col-md-4 control-label"><label for="type">Type</label></label>
							<div class="col-md-8">
								<select class="form-control" name="city_type" id="city_type">
									<option value="">Select</option>
									<option value="Domestic" <?php if($galleryData->city_type == "Domestic"){ echo "selected"; } ?>>Domestic</option>
									<option value="International" <?php if($galleryData->city_type == "International"){ echo "selected"; } ?>>International</option>
								</select>
							</div>
					</div>
					
					 <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">City</label></label>
                            <div class="col-md-8">
                            <select class="form-control" name="city" id="city">
                                <option value="">Select City</option>
                                <?php //foreach($city_detail as $city){ ?>      
                                   <!-- <option value="<?php //echo $city->id; ?>" <?php //if($city->id == $galleryData->city){ echo "selected"; } ?>><?php// echo $city->city_name; ?></option>-->
                                <?php //} ?>
                            </select>
                                
                            </div>
                        </div>
						<input type="hidden"  name="selected_city" id="selected_city" value="<?php echo $galleryData->city;?>">
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="filename" value="<?php if(isset($galleryData->name)) echo $galleryData->name; else echo set_value('name'); ?>" name="name" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   
						
                       
	                       <?php if($galleryData->type=='image'){ ?>
	                       	<?php if($galleryData->images){ ?>
		                      	<div class="form-group">
		                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Image</label></label>
		                            <div class="col-md-5">
		                                <img src="<?php echo base_url().'uploads/gallery/'.$galleryData->images; ?>">
		                            </div>
		                        </div>
	                        <?php } ?>
	                        <div class="form-group">
	                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Image</label></label>
	                            <div class="col-md-5">
	                                <input type="file" placeholder="Image" class="form-control input-sm br0" size="30" id="file" accept="image/*" value="" name="file" />
	                                <span class="form_er_msg" id="error_password">Allowed Type:- jpg|JPEG|png|gif Max Size :- 500 KB</span>
	                            </div>
	                        </div>
                        <?php } ?> 
						<?php if($galleryData->type=='video'){ ?>

						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Video</label></label>
                            <div class="col-md-5">
                                <textarea name="video" id="videourl" class="form-control input-sm br0" placeholder='<iframe src="https://www.youtube.com/embed/vX2VmLzs3gg"></iframe>'><?php echo $galleryData->video; ?></textarea>
                                
                                <span class="form_er_msg" id="error_password">Ex: Please enter youtube embed code. </span>
                            </div>
                        </div>
						
						<?php if($galleryData->video_image){ ?>
		                      	<div class="form-group">
		                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Video Image</label></label>
		                            <div class="col-md-5">
		                                <img src="<?php echo base_url().$galleryData->video_image; ?>">
		                            </div>
		                        </div>
	                        <?php } ?>
	                        <div class="form-group">
	                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Video Image</label></label>
	                            <div class="col-md-5">
	                                <input type="file" placeholder="Video Image" class="form-control input-sm br0" size="30" id="video_image" accept="image/*" value="" name="video_image" />
	                                <span class="form_er_msg" id="error_password">Allowed Type:- jpg|JPEG|png|gif Max Size :- 500 KB</span>
	                            </div>
	                        </div>	

						<?php } ?>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script type="text/javascript">

$(document).ready(function(){

	//alert(jQuery( "#city_type" ).val());
	
	var selectedType = jQuery( "#city_type" ).val();
	var selected_city = jQuery( "#selected_city" ).val();
        if(selectedType){
            jQuery.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>admin/gallery/getCityByType/'+selectedType,
                //data:'type='+selectedType,
				data: ({type:selectedType,city:selected_city}),
                success:function(html){
                    jQuery('#city').html(html);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
			
            /* $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>');  */
        }
	
	var isProcessing = false; 


jQuery('#city_type').on('change',function(){
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