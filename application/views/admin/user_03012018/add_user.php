
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
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">User Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Username" class="form-control input-sm br0" size="30" id="username" value="" name="username"/>                            
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
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Password</label></label>
                            <div class="col-md-5">
                                <input type="password" placeholder="Password" class="form-control input-sm br0" size="30" id="password" value="" name="password"/>
                                <span class="form_er_msg" id="error_password"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Confirm Password</label></label>
                            <div class="col-md-5">
                                <input type="password" placeholder="Confirm Password" class="form-control input-sm br0" size="30" id="cpassword" value="" name="cpassword"/>
                                <span class="form_er_msg" id="error_cpassword"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Select User Type</label></label>
                            <div class="col-md-5">
                               <select class="form-control" name="user_type" id="user_type">
                                    <?php if(isset($all_user_type) && $all_user_type != NULL) {?>
										<option value="">Select user type</option>
                                        <?php foreach($all_user_type as $all_user_type_data){
											if($all_user_type_data->user_type_id!='7'){
											?>
                                            <option value="<?php echo $all_user_type_data->user_type_id; ?>"><?php echo $all_user_type_data->user_type_name; ?></option>
											<?php } }?>
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
    
        });
});
</script>