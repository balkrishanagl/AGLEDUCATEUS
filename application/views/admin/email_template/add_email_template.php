

<!-- Right side column. Contains the navbar and content of the page -->

<aside class="right-side">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Email Templates

            <small>Add Templates </small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="<?php echo base_url()?>admin/email_template/manage_email_templates"><i class="fa fa-dashboard"></i>  Email Templates </a></li>

            <li class="active">Add Templates </li>

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

                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/email_template/add_template" enctype= "multipart/form-data">          

                        <div class="form-group">

                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Email Title</label></label>

                            <div class="col-md-8">

                                <input type="text" placeholder="Email Title" class="form-control input-sm br0"  id="email_title" value="" name="email_title" />  

                            </div>

                       </div>
					   
					   <div class="form-group">

                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Email Subject</label></label>

                            <div class="col-md-8">

                                <input type="text" placeholder="Email Subject" class="form-control input-sm br0"  id="email_subject" value="" name="email_subject" />  

                            </div>

                       </div>
					   
					   
					   <div class="form-group">

                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="page title">Message Type</label></label>

                            <div class="col-md-5">
							<span>Text Box</span> &nbsp; <input type="radio" checked="checked" value="textbox" name="message_type"> &nbsp; &nbsp;
							<span>Template File</span> &nbsp; <input type="radio" value="templatefiles" name="message_type">
							</div>
							     

                       </div>
					   
					   <div class="form-group" id="textbox">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="feature content">Email Description</label></label>
                            <div class="col-md-8">
							<?php echo $this->ckeditor->editor('email_description',@$default_value);?>                              
                            </div>
                        </div>
						
						<div class="form-group" id="email_template_file" style="display: none;">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="feature content">Upload Template</label></label>
                            <div class="col-md-8">
							<input type="file" name="templateFile" id="templateFile" accept=".html" />
							
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Status</label></label>

                            <div class="col-md-8">

                               <select class="form-control" name="status" id="status">

                                   

                            <option value="Active">Active</option>

							 <option value="Inactive">Inactive</option>

                               

                               </select>

                                

                            </div>

                        </div>

						



                        <div class="form-group">

                            <label for="full_name" class="col-md-4 control-label"></label>

                            <div class="col-md-8">

                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 

                                 <input type="button" class="btn btn-info br0 hide" value="Add" id="on_sending_req_reg"/>           

                            </div>

                        </div>

                    </form> 

            </div><!-- ./col -->

    </div>



</section><!-- /.content -->



</aside>    

<script type="text/javascript">

$('input[name=message_type]').on('ifChecked', function(event){
	var radioValue = this.value;
	
	if(radioValue=='textbox')
    {
		
        $('#textbox').show();
        $('#email_template_file').hide();
        $("#templateFile").prop('required',false);
    }
    if(radioValue=='templatefiles')
    {
		
        $("#templateFile").prop('required',true);
        $('#email_template_file').show();
        $('#textbox').hide();
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
