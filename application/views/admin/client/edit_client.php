
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client
            <small>Edit Client</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/client/manage_client"><i class="fa fa-dashboard"></i>Client</a></li>
            <li class="active">Edit Client</li>
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
				
			<?php //echo validation_errors(); ?>
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

	               <form id="add_history_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/client/edit_client/<?php echo $client_data->id;?>"  enctype="multipart/form-data">          
					
					<div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Client Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Client Name" class="form-control input-sm br0" id="client_name" value="<?php echo $client_data->client_name; ?>" name="client_name" />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Email</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Client Email" class="form-control input-sm br0" id="email" value="<?php echo $client_data->email; ?>" name="email" />                            
								                             
                            </div>
                       </div>
						
						<div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Contract Value</label></label>
                            <div class="col-md-8">
                                <input type="number" placeholder="Contract Value" class="form-control input-sm br0" id="contract_value" value="<?php echo $client_data->contract_value; ?>" name="contract_value" />                            
								                             
                            </div>
                       </div>
					   
					    <!--<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Apply TDS</label></label>
                            <div class="col-md-5">
                                <input type="checkbox" id="chk_tds" value="1" <?php //if($client_data->apply_tds == 1){ echo 'checked'; } ?> name="chk_tds"/>
                                
                            </div>
                       </div>
					   
					   <div class="form-group" id="tds_section" style="display: none;">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">TDS Rate</label></label>
                            <div class="col-md-8">
                                <input type="number" class="form-control input-sm br0" id="tds_rate" value="<?php //echo $client_data->tds_rate; ?>" name="tds_rate"  />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">GST Rate</label></label>
                            <div class="col-md-8">
                                <input type="number"  class="form-control input-sm br0" id="gst_rate" value="<?php //echo $client_data->gst_rate; ?>" name="gst_rate" />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Total TDS</label></label>
                            <div class="col-md-8">
                                <input type="number"  class="form-control input-sm br0" id="total_tds" value="<?php //echo $client_data->total_tds; ?>" name="total_tds" readonly />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Total GST</label></label>
                            <div class="col-md-8">
                                <input type="number"  class="form-control input-sm br0" id="total_gst" value="<?php //echo $client_data->total_gst; ?>" name="total_gst" readonly />                            
								                             
                            </div>
                       </div>-->
					    
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">First Installment</label></label>
                            <div class="col-md-2">
                                <input type="number" placeholder="Installment" class="form-control input-sm br0" id="first_installment" value="<?php echo $client_data->first_installment; ?>" name="first_installment" />                            
							</div>
							
							<div class="col-md-2">
                                <input type="number" placeholder="TDS %" class="form-control input-sm br0" id="first_inst_tds" value="<?php echo $client_data->first_inst_tds_rate; ?>" name="first_inst_tds" />
								<input type="hidden" class="form-control input-sm br0" id="first_inst_tds_amount" value="<?php echo $client_data->first_installment_tds; ?>" name="first_inst_tds_amount" />                            								
								                             
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="GST %" class="form-control input-sm br0" id="first_inst_gst" value="<?php echo $client_data->first_inst_gst_rate; ?>" name="first_inst_gst" />                            
								  <input type="hidden" class="form-control input-sm br0" id="first_inst_gst_amount" value="<?php echo $client_data->first_inst_gst_rate; ?>" name="first_inst_gst_amount" />                            
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="Net Amount" class="form-control input-sm br0" id="first_inst_net_amount" value="<?php echo $client_data->first_inst_net_amount; ?>" name="first_inst_net_amount" readonly />                            
								                             
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">First Due Date</label></label>
                            <div class="col-md-8">
                               <input type="text"  class="due_date" value="<?php echo $client_data->first_installment_due; ?>" name="first_installment_due" class="form-control" readonly />
							   <input type="checkbox" id="chk_tds" value="Received" <?php if($client_data->first_installment_status == 'Received'){ echo 'checked'; } ?> name="first_installment_status"/> Payment Received                          
							   <input type="hidden" name="chkStatusfirstInstallment" value="<?php echo $client_data->first_installment_status; ?>">
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Second Installment</label></label>
                            <div class="col-md-2">
                                <input type="number" placeholder="Installment" class="form-control input-sm br0" id="second_installment" value="<?php echo $client_data->second_installment; ?>" name="second_installment" />                            
								                             
                            </div>
							
							<div class="col-md-2">
                                <input type="number" placeholder="TDS %" class="form-control input-sm br0" id="second_inst_tds" value="<?php echo $client_data->second_inst_tds_rate; ?>" name="second_inst_tds" />
								<input type="hidden" class="form-control input-sm br0" id="second_inst_tds_amount" value="<?php echo $client_data->second_installment_tds; ?>" name="second_inst_tds_amount" />                            								
								                             
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="GST %" class="form-control input-sm br0" id="second_inst_gst" value="<?php echo $client_data->second_inst_gst_rate; ?>" name="second_inst_gst" />                            
								  <input type="hidden" class="form-control input-sm br0" id="second_inst_gst_amount" value="<?php echo $client_data->second_inst_gst_rate; ?>" name="second_inst_gst_amount" />                            
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="Net Amount" class="form-control input-sm br0" id="second_inst_net_amount" value="<?php echo $client_data->second_inst_net_amount; ?>" name="second_inst_net_amount" readonly />                            
								                             
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Second Due Date</label></label>
                            <div class="col-md-8">
                               <input type="text"  class="due_date" value="<?php echo $client_data->second_installment_due; ?>" name="second_installment_due" class="form-control" readonly />
							   <input type="checkbox" id="chk_tds" value="Received" <?php if($client_data->second_installment_status == 'Received'){ echo 'checked'; } ?> name="second_installment_status"/> Payment Received                            
							   <input type="hidden" name="chkStatussecondInstallment" value="<?php echo $client_data->second_installment_status; ?>">
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Third Installment</label></label>
                            <div class="col-md-2">
                                <input type="number" placeholder="Installment" class="form-control input-sm br0" id="third_installment" value="<?php echo $client_data->third_installment; ?>" name="third_installment" />                            
								                             
                            </div>
							
							<div class="col-md-2">
                                <input type="number" placeholder="TDS %" class="form-control input-sm br0" id="third_inst_tds" value="<?php echo $client_data->third_inst_tds_rate; ?>" name="third_inst_tds" />
								<input type="hidden" class="form-control input-sm br0" id="third_inst_tds_amount" value="<?php echo $client_data->third_installment_tds; ?>" name="third_inst_tds_amount" />                            								
								                             
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="GST %" class="form-control input-sm br0" id="third_inst_gst" value="<?php echo $client_data->third_inst_gst_rate; ?>" name="third_inst_gst" />                            
								  <input type="hidden" class="form-control input-sm br0" id="third_inst_gst_amount" value="<?php echo $client_data->third_inst_gst_rate; ?>" name="third_inst_gst_amount" />                            
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="Net Amount" class="form-control input-sm br0" id="third_inst_net_amount" value="<?php echo $client_data->third_inst_net_amount; ?>" name="third_inst_net_amount" readonly />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Third Due Date</label></label>
                            <div class="col-md-8">
                                <input type="text"  class="due_date" value="<?php echo $client_data->third_installment_due; ?>" name="third_installment_due" class="form-control" readonly />
								<input type="checkbox" id="chk_tds" value="Received" <?php if($client_data->third_installment_status == 'Received'){ echo 'checked'; } ?> name="third_installment_status"/> Payment Received                             
								<input type="hidden" name="chkStatusthirdInstallment" value="<?php echo $client_data->third_installment_status; ?>">
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Fourth Installment</label></label>
                            <div class="col-md-2">
                                <input type="number" placeholder="Installment" class="form-control input-sm br0" id="fourth_installment" value="<?php echo $client_data->fourth_installment; ?>" name="fourth_installment" />                            
								                             
                            </div>
							
							<div class="col-md-2">
                                <input type="number" placeholder="TDS %" class="form-control input-sm br0" id="fourth_inst_tds" value="<?php echo $client_data->fourth_inst_tds_rate; ?>" name="fourth_inst_tds" />
								<input type="hidden" class="form-control input-sm br0" id="fourth_inst_tds_amount" value="<?php echo $client_data->fourth_installment_tds; ?>" name="fourth_inst_tds_amount" />                            								
								                             
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="GST %" class="form-control input-sm br0" id="fourth_inst_gst" value="<?php echo $client_data->fourth_inst_gst_rate; ?>" name="fourth_inst_gst" />                            
								  <input type="hidden" class="form-control input-sm br0" id="fourth_inst_gst_amount" value="<?php echo $client_data->fourth_inst_gst_rate; ?>" name="fourth_inst_gst_amount" />                            
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="Net Amount" class="form-control input-sm br0" id="fourth_inst_net_amount" value="<?php echo $client_data->fourth_inst_net_amount; ?>" name="fourth_inst_net_amount" readonly />                            
								                             
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Fourth Due Date</label></label>
                            <div class="col-md-8">
                               <input type="text"  class="due_date" value="<?php echo $client_data->fourth_installment_due; ?>" name="fourth_installment_due" class="form-control" readonly />
								<input type="checkbox" id="chk_tds" value="Received" <?php if($client_data->fourth_installment_status == 'Received'){ echo 'checked'; } ?> name="fourth_installment_status"/> Payment Received                             
								<input type="hidden" name="chkStatusfourthInstallment" value="<?php echo $client_data->fourth_installment_status; ?>">
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Fifth Installment</label></label>
                            <div class="col-md-2">
                                <input type="number" placeholder="Installment" class="form-control input-sm br0" id="fifth_installment" value="<?php echo $client_data->fifth_installment; ?>" name="fifth_installment" />                            
								                            
                            </div>
							
							<div class="col-md-2">
                                <input type="number" placeholder="TDS %" class="form-control input-sm br0" id="fifth_inst_tds" value="<?php echo $client_data->fifth_inst_tds_rate; ?>" name="fifth_inst_tds" />
								<input type="hidden" class="form-control input-sm br0" id="fifth_inst_tds_amount" value="<?php echo $client_data->fifth_installment_tds; ?>" name="fifth_inst_tds_amount" />                            								
								                             
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="GST %" class="form-control input-sm br0" id="fifth_inst_gst" value="<?php echo $client_data->fifth_inst_gst_rate; ?>" name="fifth_inst_gst" />                            
								  <input type="hidden" class="form-control input-sm br0" id="fifth_inst_gst_amount" value="<?php echo $client_data->fifth_inst_gst_rate; ?>" name="fifth_inst_gst_amount" />                            
                            </div>
							<div class="col-md-2">
                                <input type="number" placeholder="Net Amount" class="form-control input-sm br0" id="fifth_inst_net_amount" value="<?php echo $client_data->fifth_inst_net_amount; ?>" name="fifth_inst_net_amount" readonly />                            
								                             
                            </div>
                       </div>
					   
					   <div class="form-group">
                            <label for="cal_insurance_partner_datetime" class="col-md-4 control-label"><label for="collage title">Fifth Due Date</label></label>
                            <div class="col-md-8">
                               <input type="text"  class="due_date" value="<?php echo $client_data->fifth_installment_due; ?>" name="fifth_installment_due" class="form-control" readonly />
								<input type="checkbox" id="chk_tds" value="Received" <?php if($client_data->fifth_installment_status == 'Received'){ echo 'checked'; } ?> name="fifth_installment_status"/> Payment Received      
								<input type="hidden" name="chkStatusfifthInstallment" value="<?php echo $client_data->fifth_installment_status; ?>">
								
                            </div>
                       </div>
					   
					  <div class="form-group">

                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Status</label></label>

                            <div class="col-md-8">

                               <select class="form-control" name="status" id="status">

                                   

                            <option value="1" <?php if($client_data->status == 1){ echo 'selected'; }?>>Active</option>

							 <option value="0" <?php if($client_data->status == 0){ echo 'selected'; }?>>Inactive</option>

                               

                               </select>

                                

                            </div>

                        </div>
						
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

 <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>-->
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.duplicate.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script>

$(document).ready(function(){
	
	var isChecked = $("#chk_tds").is(":checked");
	if(isChecked){
		$('#tds_section').show();
	}
	/* if($('#chk_tds').val() == 1){
		
	} */
});

$(".due_date").datepicker({
	autoclose: true,
	format: 'yyyy-mm-dd',
}).on('changeDate', function (selected) {
	
});
/* 
$('#chk_tds').on('ifChecked', function () { 
	$('#tds_section').show();
});

$('#chk_tds').on('ifUnchecked', function () { 
	$('#tds_section').hide();
	$('#tds_rate').val('');
});

 $("#contract_value").focusout(function(){
	var contractValue = $('#contract_value').val();
	var tds_rate = $('#tds_rate').val();
	var gst_rate = $('#gst_rate').val();
	var tdsamount = contractValue * tds_rate/100;
	var gstamount = contractValue * gst_rate/100;
	
	$('#total_tds').val(tdsamount);
	$('#total_gst').val(gstamount);
    
});

 $("#tds_rate").focusout(function(){
	var contractValue = $('#contract_value').val();
	var tds_rate = $('#tds_rate').val();
	var gst_rate = $('#gst_rate').val();
	var tdsamount = contractValue * tds_rate/100;
	var gstamount = contractValue * gst_rate/100;
	
	$('#total_tds').val(tdsamount);
	$('#total_gst').val(gstamount);
    
});

$("#gst_rate").focusout(function(){
	var contractValue = $('#contract_value').val();
	var tds_rate = $('#tds_rate').val();
	var gst_rate = $('#gst_rate').val();
	var tdsamount = contractValue * tds_rate/100;
	var gstamount = contractValue * gst_rate/100;
	
	$('#total_tds').val(tdsamount);
	$('#total_gst').val(gstamount);
    
}); */


$("#first_installment").focusout(function(){
	var first_instValue = $('#first_installment').val();
	var first_inst_tds = $('#first_inst_tds').val();
	var first_inst_gst = $('#first_inst_gst').val();
	var firstInsttdsamount = first_instValue * first_inst_tds/100;
	var firstInstgstamount = first_instValue * first_inst_gst/100;
	var firstInstnetAmount = parseInt(first_instValue) + parseInt(firstInsttdsamount) + parseInt(firstInstgstamount);
	
	$('#first_inst_net_amount').val(firstInstnetAmount);
	$('#first_inst_tds_amount').val(firstInstnetAmount);
	$('#first_inst_gst_amount').val(firstInstnetAmount);
	//$('#total_gst').val(gstamount);
    
});

$("#first_inst_tds").focusout(function(){
	var first_instValue = $('#first_installment').val();
	var first_inst_tds = $('#first_inst_tds').val();
	var first_inst_gst = $('#first_inst_gst').val();
	var firstInsttdsamount = first_instValue * first_inst_tds/100;
	var firstInstgstamount = first_instValue * first_inst_gst/100;
	var firstInstnetAmount = parseInt(first_instValue) + parseInt(firstInsttdsamount) + parseInt(firstInstgstamount);
	
	$('#first_inst_net_amount').val(firstInstnetAmount);
	$('#first_inst_tds_amount').val(firstInsttdsamount);
	$('#first_inst_gst_amount').val(firstInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#first_inst_gst").focusout(function(){
	var first_instValue = $('#first_installment').val();
	var first_inst_tds = $('#first_inst_tds').val();
	var first_inst_gst = $('#first_inst_gst').val();
	var firstInsttdsamount = first_instValue * first_inst_tds/100;
	var firstInstgstamount = first_instValue * first_inst_gst/100;
	var firstInstnetAmount = parseInt(first_instValue) + parseInt(firstInsttdsamount) + parseInt(firstInstgstamount);
	
	$('#first_inst_net_amount').val(firstInstnetAmount);
	$('#first_inst_tds_amount').val(firstInsttdsamount);
	$('#first_inst_gst_amount').val(firstInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#second_installment").focusout(function(){
	var second_instValue = $('#second_installment').val();
	var second_inst_tds = $('#second_inst_tds').val();
	var second_inst_gst = $('#second_inst_gst').val();
	var secondInsttdsamount = second_instValue * second_inst_tds/100;
	var secondInstgstamount = second_instValue * second_inst_gst/100;
	var secondInstnetAmount = parseInt(second_instValue) + parseInt(secondInsttdsamount) + parseInt(secondInstgstamount);
	
	$('#second_inst_net_amount').val(secondInstnetAmount);
	$('#first_inst_tds_amount').val(firstInsttdsamount);
	$('#first_inst_gst_amount').val(firstInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#second_inst_tds").focusout(function(){
	var second_instValue = $('#second_installment').val();
	var second_inst_tds = $('#second_inst_tds').val();
	var second_inst_gst = $('#second_inst_gst').val();
	var secondInsttdsamount = second_instValue * second_inst_tds/100;
	var secondInstgstamount = second_instValue * second_inst_gst/100;
	var secondInstnetAmount = parseInt(second_instValue) + parseInt(secondInsttdsamount) + parseInt(secondInstgstamount);
	
	$('#second_inst_net_amount').val(secondInstnetAmount);
	$('#second_inst_tds_amount').val(secondInsttdsamount);
	$('#second_inst_gst_amount').val(secondInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#second_inst_gst").focusout(function(){
	var second_instValue = $('#second_installment').val();
	var second_inst_tds = $('#second_inst_tds').val();
	var second_inst_gst = $('#second_inst_gst').val();
	var secondInsttdsamount = second_instValue * second_inst_tds/100;
	var secondInstgstamount = second_instValue * second_inst_gst/100;
	var secondInstnetAmount = parseInt(second_instValue) + parseInt(secondInsttdsamount) + parseInt(secondInstgstamount);
	
	$('#second_inst_net_amount').val(secondInstnetAmount);
	$('#second_inst_tds_amount').val(secondInsttdsamount);
	$('#second_inst_gst_amount').val(secondInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#third_installment").focusout(function(){
	var third_instValue = $('#third_installment').val();
	var third_inst_tds = $('#third_inst_tds').val();
	var third_inst_gst = $('#third_inst_gst').val();
	var thirdInsttdsamount = third_instValue * third_inst_tds/100;
	var thirdInstgstamount = third_instValue * third_inst_gst/100;
	var thirdInstnetAmount = parseInt(third_instValue) + parseInt(thirdInsttdsamount) + parseInt(thirdInstgstamount);
	
	$('#third_inst_net_amount').val(thirdInstnetAmount);
	$('#second_inst_tds_amount').val(secondInsttdsamount);
	$('#second_inst_gst_amount').val(secondInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#third_inst_tds").focusout(function(){
	var third_instValue = $('#third_installment').val();
	var third_inst_tds = $('#third_inst_tds').val();
	var third_inst_gst = $('#third_inst_gst').val();
	var thirdInsttdsamount = third_instValue * third_inst_tds/100;
	var thirdInstgstamount = third_instValue * third_inst_gst/100;
	var thirdInstnetAmount = parseInt(third_instValue) + parseInt(thirdInsttdsamount) + parseInt(thirdInstgstamount);
	
	$('#third_inst_net_amount').val(thirdInstnetAmount);
	$('#third_inst_tds_amount').val(thirdInsttdsamount);
	$('#third_inst_gst_amount').val(thirdInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#third_inst_gst").focusout(function(){
	var third_instValue = $('#third_installment').val();
	var third_inst_tds = $('#third_inst_tds').val();
	var third_inst_gst = $('#third_inst_gst').val();
	var thirdInsttdsamount = third_instValue * third_inst_tds/100;
	var thirdInstgstamount = third_instValue * third_inst_gst/100;
	var thirdInstnetAmount = parseInt(third_instValue) + parseInt(thirdInsttdsamount) + parseInt(thirdInstgstamount);
	
	$('#third_inst_net_amount').val(thirdInstnetAmount);
	$('#third_inst_tds_amount').val(thirdInsttdsamount);
	$('#third_inst_gst_amount').val(thirdInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fourth_installment").focusout(function(){
	var fourth_instValue = $('#fourth_installment').val();
	var fourth_inst_tds = $('#fourth_inst_tds').val();
	var fourth_inst_gst = $('#fourth_inst_gst').val();
	var fourthInsttdsamount = fourth_instValue * fourth_inst_tds/100;
	var fourthInstgstamount = fourth_instValue * fourth_inst_gst/100;
	var fourthInstnetAmount = parseInt(fourth_instValue) + parseInt(fourthInsttdsamount) + parseInt(fourthInstgstamount);
	
	$('#fourth_inst_net_amount').val(fourthInstnetAmount);
	$('#fourth_inst_tds_amount').val(fourthInsttdsamount);
	$('#fourth_inst_gst_amount').val(fourthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fourth_inst_tds").focusout(function(){
	var fourth_instValue = $('#fourth_installment').val();
	var fourth_inst_tds = $('#fourth_inst_tds').val();
	var fourth_inst_gst = $('#fourth_inst_gst').val();
	var fourthInsttdsamount = fourth_instValue * fourth_inst_tds/100;
	var fourthInstgstamount = fourth_instValue * fourth_inst_gst/100;
	var fourthInstnetAmount = parseInt(fourth_instValue) + parseInt(fourthInsttdsamount) + parseInt(fourthInstgstamount);
	
	$('#fourth_inst_net_amount').val(fourthInstnetAmount);
	$('#fourth_inst_tds_amount').val(fourthInsttdsamount);
	$('#fourth_inst_gst_amount').val(fourthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fourth_inst_gst").focusout(function(){
	var fourth_instValue = $('#fourth_installment').val();
	var fourth_inst_tds = $('#fourth_inst_tds').val();
	var fourth_inst_gst = $('#fourth_inst_gst').val();
	var fourthInsttdsamount = fourth_instValue * fourth_inst_tds/100;
	var fourthInstgstamount = fourth_instValue * fourth_inst_gst/100;
	var fourthInstnetAmount = parseInt(fourth_instValue) + parseInt(fourthInsttdsamount) + parseInt(fourthInstgstamount);
	
	$('#fourth_inst_net_amount').val(fourthInstnetAmount);
	$('#fourth_inst_tds_amount').val(fourthInsttdsamount);
	$('#fourth_inst_gst_amount').val(fourthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fifth_installment").focusout(function(){
	var fifth_instValue = $('#fifth_installment').val();
	var fifth_inst_tds = $('#fifth_inst_tds').val();
	var fifth_inst_gst = $('#fifth_inst_gst').val();
	var fifthInsttdsamount = fifth_instValue * fifth_inst_tds/100;
	var fifthInstgstamount = fifth_instValue * fifth_inst_gst/100;
	var fifthInstnetAmount = parseInt(fifth_instValue) + parseInt(fifthInsttdsamount) + parseInt(fifthInstgstamount);
	
	$('#fifth_inst_net_amount').val(fifthInstnetAmount);
	$('#fifth_inst_tds_amount').val(fifthInsttdsamount);
	$('#fifth_inst_gst_amount').val(fifthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fifth_inst_tds").focusout(function(){
	var fifth_instValue = $('#fifth_installment').val();
	var fifth_inst_tds = $('#fifth_inst_tds').val();
	var fifth_inst_gst = $('#fifth_inst_gst').val();
	var fifthInsttdsamount = fifth_instValue * fifth_inst_tds/100;
	var fifthInstgstamount = fifth_instValue * fifth_inst_gst/100;
	var fifthInstnetAmount = parseInt(fifth_instValue) + parseInt(fifthInsttdsamount) + parseInt(fifthInstgstamount);
	
	$('#fifth_inst_net_amount').val(fifthInstnetAmount);
	$('#fifth_inst_tds_amount').val(fifthInsttdsamount);
	$('#fifth_inst_gst_amount').val(fifthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});

$("#fifth_inst_gst").focusout(function(){
	var fifth_instValue = $('#fifth_installment').val();
	var fifth_inst_tds = $('#fifth_inst_tds').val();
	var fifth_inst_gst = $('#fifth_inst_gst').val();
	var fifthInsttdsamount = fifth_instValue * fifth_inst_tds/100;
	var fifthInstgstamount = fifth_instValue * fifth_inst_gst/100;
	var fifthInstnetAmount = parseInt(fifth_instValue) + parseInt(fifthInsttdsamount) + parseInt(fifthInstgstamount);
	
	$('#fifth_inst_net_amount').val(fifthInstnetAmount);
	$('#fifth_inst_tds_amount').val(fifthInsttdsamount);
	$('#fifth_inst_gst_amount').val(fifthInstgstamount);
	//$('#total_gst').val(gstamount);
    
});
</script>