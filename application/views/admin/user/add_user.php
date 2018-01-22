
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
            <small>Add User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/user/user_list"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">Add User</li>
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
		
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/user/add_user">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Name" class="form-control input-sm br0" size="30" id="name" value="" name="name"/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Email</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Email" class="form-control input-sm br0" size="30" id="email" value="" name="email"/>
                                <span class="form_er_msg" id="error_email"></span>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">City</label></label>
                            <div class="col-md-5">
                               <select class="form-control" name="city" id="city">
                                    <?php if(isset($city_data) && $city_data != NULL) {?>
										<option value="">Select City</option>
                                        <?php foreach($city_data as $allCity){
											
											?>
                                            <option value="<?php echo $allCity->id; ?>"><?php echo $allCity->city_name; ?></option>
											
                                    <?php }
									}?>
                               </select>
                                <span class="form_er_msg" id="error_user_type"></span>
                            </div>
                        </div>
						
						 <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Phone</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Phone Number" class="form-control input-sm br0"  id="phone" value="" name="phone"/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Address</label></label>
                            <div class="col-md-5">
                                <textarea  class="form-control input-sm br0" name="address" id="address"></textarea>
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Pincode</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Pincode" class="form-control input-sm br0"  id="pincode" value="" name="pincode"/>                            
                                
                            </div>
                       </div>
                        
                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Select User Type</label></label>
                            <div class="col-md-5">
                               <select class="form-control" name="user_type" id="user_type">
                                    <?php if(isset($all_user_type) && $all_user_type != NULL) {?>
										<option value="">Select user type</option>
                                        <?php foreach($all_user_type as $all_user_type_data){
											
											?>
                                            <option value="<?php echo $all_user_type_data->user_type_id; ?>"><?php echo $all_user_type_data->user_type_name; ?></option>
											<?php  }?>
                                    <?php }?>
                               </select>
                                <span class="form_er_msg" id="error_user_type"></span>
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

<script type="text/javascript">

    $(document).ready(function(){

        
        var isProcessing = false;  
/* 
     $('body').on('submit','#add_user_form',function(e) {    
            e.preventDefault();
            
            if(isProcessing){
                    return false;
                }
            isProcessing = true;
            
            var link = $(this);
            var formData = $('#add_user_form').serializeArray();
            $.ajax({
              type: 'POST',
                 url         : $path +'ajax/user/add_user',
                 data        : formData,
                 dataType : 'json',
                 success     : function (data)
                 {
                      isProcessing = false;
                      
                    if(data.status === 'success')
                    {
                        $('.form_er_msg').html(' ');
                        alert(data.msg);
                        //$("#service_form").reset()
                        $('#add_user_form')[0].reset();
                        window.location.reload();
                        //$('#cform')[0].reset();
                         
                    }
                    else if(data.status === 'error')
                    {
                        $.each( data.response.errors, function( key, val ) {
                          $('#error_'+key).html(val);
                          
                        });
                        //$('#err_blk').html(data.msg);
                        //$('#err_blk').removeClass('hide');
                    }
                    else if(data.status === 'error_au')
                    {
                        alert(data.msg);
                    }
                 }
                 
                //   beforeSend: function()
                // {
                //     $(".on_sending_reg").addClass('hide');
                //     $("#on_sending_req_reg").removeClass('hide');
                // },
                
                //  complete: function()
                // {
                //     $(".on_sending_reg").removeClass('hide');
                //     $("#on_sending_req_reg").addClass('hide');
                // }
                
              });
              
            return false;
    
        }); */
});
</script>