

<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

           Send Bulk Email

            <!--<small>Add Templates </small>-->

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            

            <li class="active">Send Bulk Email </li>

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

			<?php if(!empty($file_error1)){ ?>

				<div class="alert alert-danger">

					<a href="#" class="close" data-dismiss="alert">&times;</a>

					<strong>Error!</strong> <?php echo $file_error1; ?>

				</div>

			<?php } ?>
			
			
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

                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/email_template/send_bulk_sms" enctype= "multipart/form-data">          

                       						
						<div class="form-group">

                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">SMS</label></label>

                            <div class="col-md-8">
							<textarea id="sms" name="sms"></textarea>
							</div>
							     

                       </div>
					   
						<div class="form-group">

                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Type</label></label>

                            <div class="col-md-5">
							<span>Register User</span> &nbsp; <input type="radio" checked="checked" value="register user" name="type"> &nbsp; &nbsp;
							<span>Upload File</span> &nbsp; <input type="radio" value="upload file" name="type">
							</div>
							     

                       </div>
						
						<div class="form-group" id="city_user">
							<label for="cal_event_info" class="col-md-4 control-label"><label for="status">City</label></label>
								<div class="col-md-8">
								<select class="form-control" name="city" id="city">
								<option value=""> Select City</option>
								<?php foreach($exhibition_city as $exhibition_citys){?>
									<option value="<?php echo $exhibition_citys->id;?>"><?php echo $exhibition_citys->city_name;?></option>
								<?php } ?>	
								</select>
						</div>

                        </div>
						
						<div class="form-group" id="user_email_file" style="display: none;">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="feature content">Upload CSV</label></label>
                            <div class="col-md-8">
							<input type="file" name="emailFile" id="emailFile" />
                            </div>
                        </div>
					   
					         <div class="form-group">

                            <label for="full_name" class="col-md-4 control-label"></label>

                            <div class="col-md-8">

                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Send" name="submit"/> 

                                 <input type="button" class="btn btn-info br0 hide" value="Send" id="on_sending_req_reg"/>           

                            </div>

                        </div>

                    </form> 

            </div><!-- ./col -->

    </div>



</section><!-- /.content -->



</aside>    

<script type="text/javascript">

$('input[name=type]').on('ifChecked', function(event){
	var radioValue = this.value;
	
	if(radioValue=='register user')
    {
		
        $('#city_user').show();
        $('#user_email_file').hide();
        $("#emailFile").prop('required',false);
    }
    if(radioValue=='upload file')
    {
		
        $("#templateFile").prop('required',true);
        $('#user_email_file').show();
        $('#city_user').hide();
    }
	
  //alert(radioValue);
});


/* function show_messagebox(messagetype)
{
	alert("Test");
    if(messagetype=='textbox')
    {
        $('#textbox').show();
        $('#email_template_file').hide();
        $("#templateFile").prop('required',false);
    }
    if(messagetype=='templatefiles')
    {
        $("#templateFile").prop('required',true);
        $('#email_template_file').show();
        $('#textbox').hide();
    }
} */
</script>
