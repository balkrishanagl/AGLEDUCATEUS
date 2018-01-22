
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Multiple Payment
            <small>Add Multiple Payment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/payment/manage_payment"><i class="fa fa-dashboard"></i> Payment</a></li>
            <li class="active">Add Multiple Payment</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
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
                <form id="add_user_form" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/payment/add_multiple_payment/">
                        
					   
					   
					   <div id="csvbox">
						   <div class="form-group">
								<label for="cal_event_datetime" class="col-md-4 control-label"><label for="correct_choice">CSV</label></label>
								<div class="col-md-5">
									<input type="file" name="payment_csv"  accept=".csv" class="form-control input-sm br0 csv" id="payments" required>
									<a href="<?php echo base_url().'uploads/payment_example.csv'; ?>" target="_blank">Sample CSV</a>
									<span class="form_er_msg" id="error_title"></span>
								</div>
						   </div>
					   </div>
					   
					   
					   
					   
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add Payment" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script type="text/javascript">

$(document).ready(function(){

	//$("div").remove(".iradio_minimal"); 
	//$("ins").remove();
	var isProcessing = false;  
	 
     
});


function questiontype(questype)
{

	if(questype=='question')
    {
        $('#csvbox').hide();
        $('#questionb').show();
        //$('#sms_temp_list').val();
		$(".csv").removeAttr("required","required");
       // $("#sms_temp_list option[value='X']").remove();
    }
    if(questype=='question_csv')
    {
         $('#csvbox').show();
        $('#questionb').hide();
		$(".csv").attr("required","required");
    }
}

</script>