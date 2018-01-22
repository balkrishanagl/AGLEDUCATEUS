<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payment Report
            <!--<small><a href="<?php echo base_url();?>admin/payment/add_payment">Add Payment</a></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Payment Report</li>
        </ol>
    </section>
	
     <!-- Main content -->
<section class="content">
	<div>
		<?php if($this->session->userdata('date_error_msg')){ ?>
			<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Warning!</strong> <?php echo $this->session->userdata('date_error_msg'); $this->session->unset_userdata('date_error_msg'); ?>
				</div>
			<?php } ?>
	
	</div>
	
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Payment Report</h3>
                </div><!-- /.box-header -->
				<!--
				
						
				
				
				
				From
				<input type="text"  id="payment_from" value="" name="payment_from" /> 
				To
				<input type="text"  id="payment_to" value="" name="payment_to" /> 
				<input type="submit" class="btn-info" id="btnReport" value="Search"/>
				<input type="submit" class="btn-primary" id="btnExport" value="Export"/>-->

				<form id="filter_payment" method="post" role="form" id="exportdata" action="#" accept-charset="utf-8">
				<table border='0' width='100%'>
					<tr>
						<td colspan='4'><p>Filter By:</p></td>
					</tr>
					<tr>
						<td>
						<div class="form-group">
							<label>TYPE</label>
							<select name="payment_type" id="payment_type" class="form-control">
								<option value="">Select</option>
							<?php foreach($payment_type_list as $payment){ ?>
								<option <?php if(isset($_POST['payment_type']) and $_POST['payment_type']==$payment->id){ echo "selected='selected'"; } ?> value="<?php echo $payment->payment_type; ?>"><?php echo $payment->payment_type; ?></option>
							<?php } ?>
							</select>
							</div>
						</td>
						<td>
						<div class="form-group">
							<label>Status</label>
						
							<select name="payment_status" id="payment_status" class="form-control">
							<option value="">Select</option>
							<option value="1" <?php if(isset($_POST['payment_type']) and $_POST['payment_type']==1){ echo "selected='selected'"; } ?>>Active</option>
							<option value="0" <?php if(isset($_POST['payment_type']) and $_POST['payment_type']==0){ echo "selected='selected'"; } ?>>Inactive</option>
							
							</select>
							</div>
						</td>
						<td>
						<div class="form-group">
							<label>Session</label>
							
							<select name="session" id="session" class="form-control">
							<option value="">Select</option>
							<?php foreach($session_data as $sessionData){ ?>
								<option <?php if(isset($_POST['session']) and $_POST['session']==$sessionData->id){ echo "selected='selected'"; } ?> value="<?php echo $sessionData->id; ?>"><?php echo $sessionData->name; ?></option>
							<?php } ?>
							
							</select>
							</div>
						</td>
						<td>
						<div class="form-group">
							<label>Applicant Category</label>
							
							<select name="appl_category" id="appl_category" class="form-control">
							<option value="">Select</option>
							<?php foreach($user_type as $userType){ ?>
								<option <?php if(isset($_POST['appl_category']) and $_POST['appl_category']==$userType->user_type_id){ echo "selected='selected'"; } ?> value="<?php echo $userType->user_type_id; ?>"><?php echo $userType->user_type_name; ?></option>
							<?php } ?>
							
							</select>
							</div>
						</td>
						<td>
						<div class="form-group">
							<label>Source Of information</label>
							
							<select name="source_information" id="source_information" class="form-control">
							<option value="">Select</option>
							<?php foreach($source_data as $source_information){ ?>
								<option <?php if(isset($_POST['source_information']) and $_POST['source_information']==$payment->id){ echo "selected='selected'"; } ?> value="<?php echo $source_information->id; ?>"><?php echo $source_information->name; ?></option>
							<?php } ?>
							
							</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
						<div class="form-group">
							<label>Exam Type</label>
							
							<select name="exam_type" id="exam_type" class="form-control">
							<option value="">Select</option>
							
							   <option value="1">Main</option>
							   <option value="2">Re-Exam</option>
						
							</select>
						</div>
						</td>
						<td>
						<div class="form-group">
						<label>From</label>
							<input type="text"  id="payment_from" value="<?php echo $this->session->userdata('from'); ?>" name="payment_from" /> 
						</div>	
						</td>
						<td>
						<div class="form-group">
						<label>To</label>
							<input type="text"  id="payment_to" value="<?php echo $this->session->userdata('to'); ?>" name="payment_to" /> 
						</div>	
						</td>
						<td>
						<div class="form-group">
						<input type="button" class="btn-info" id="btnReport" value="Search"/>
						<input type="button" class="btn-primary" id="btnExport" value="Export"/>
						<input type="button" class="btn-info" id="btnclear" value="Clear"/>
						</div>
						</td>
						
						
					</tr>
				</table>
				</form>
				
				
				
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped dataTable">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Session Name</th>
                                <th>Registration On</th>
                                <th>User Registration Id</th>
                                <th>Applicant Category</th>
                                <th>Name</th>
								<th>Username</th>
								<th>Email</th>
								<th>Mobile Number</th>
								<th>Referral Source</th>
								<th>Referral Source Others</th>
								<th>Fees</th>
								<th>Vendor Amount</th>
								<th>Service Tax Amount</th>
								<th>Gross Amount</th>
                                <th>Payment Type</th>
								<th>Payment Date</th>
								<th>Reference No</th>
								<th>Exam Type</th>
								<th>Bank Name</th>
								<th>Branch Name</th>
								<th>Status</th>
                               
                            </tr>
                        </thead>
                        <tbody class="dtPayment">
                            <?php 
							if(isset($payment_list) && $payment_list != NULL) {?>
                                <?php $i=0; 
									$totalfees=0;
									$totalvendorAmount=0;
									$totalServiceTax=0;
									$totalGrossAmount=0;
								
								foreach($payment_list as $payment) { $i++;
								
									$totalfees+= $payment->course_fee;
									$totalvendorAmount+= $payment->vendor_amount;
									$totalServiceTax+= $payment->servicetax_amount;
									$totalGrossAmount+= $payment->gross_amount;
								?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $payment->session;?></td>
										<td><?php echo date("d/m/Y", strtotime($payment->created));?></td>
										<td><?php echo $payment->enrollment_no;?></td>
										<td><?php echo $payment->user_type_name;?></td>
										<td><?php echo $payment->first_name;?></td>
                                        <td><?php echo $payment->username;?></td>
                                        <td><?php echo $payment->email;?></td>
                                        <td><?php echo $payment->mobile_number;?></td>
                                        <td><?php echo $payment->source;?></td>
                                        <td><?php echo $payment->source_detail;?></td>
										<td><?php echo $payment->course_fee;?></td>
										<td><?php echo $payment->vendor_amount;?></td>
										<td><?php echo $payment->servicetax_amount;?></td>
										<td><?php echo $payment->gross_amount;?></td>
										<td><?php echo $payment->payment_type_id;?></td>
										<td><?php echo $payment->cheque_date;?></td>
										<td><?php echo $payment->reference_no;?></td>
										<td><?php if($payment->exam_type==1){ echo "Main"; } else { echo "Re-Exam"; }?></td>
										<td><?php echo $payment->bank_name;?></td>
										<td><?php echo $payment->branch_name;?></td>
										<?php if($payment->exam_type==1){ ?>
										<td><?php if($payment->status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
										<?php }elseif($payment->exam_type==2){ ?>
										<td><?php if($payment->re_exam_payment_status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
										<?php }else{ ?>
											<td></td>
										<?php } ?>
                                      
                                        
                                    </tr>    
                                <?php }?>  
									
                            <?php }?> 
                            
                        </tbody>
						
						<tfoot>
						<tr>
							<th colspan="11" style="text-align:right">Total</th>
							<th><?php if(isset($totalfees)){ echo $totalfees; } ?></th>
							<th><?php if(isset($totalvendorAmount)){ echo $totalvendorAmount; } ?></th>
							<th><?php if(isset($totalServiceTax)){ echo $totalServiceTax; } ?></th>
							<th><?php  if(isset($totalGrossAmount)){ echo $totalGrossAmount; } ?></th>
						</tr>
						</tfoot>
                        
                    </table>
					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

</aside>    

<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/js/custom.js" type="text/javascript"></script>



<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script type="text/javascript">
function payment_type(){
	var type = document.getElementById("selectbox").value;
		window.location.href = "<?php echo base_url(); ?>admin/report/payment_report/"+type;
	
}

function payment_status(){
	var type = document.getElementById("selectbox1").value;
		window.location.href = "<?php echo base_url(); ?>admin/report/payment_report/"+type;
	
}
function change_status(user_id,id, status){
	var r = confirm('are you sure to change payment status?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/payment/update_status/"+user_id+"/"+id+"/"+status;
	}
}
    $(function() {
        $("#example1").dataTable( { 
		  dom: 'Bfrtip',
        buttons: [
           'csvHtml5',
            
        ]
		
		} );
        
    });
	
	
	
	
</script>

<script>
	$(document).ready(function(){

		
		 $("#payment_from").datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			}).on('changeDate', function (selected) {
				
			});
			
			

			$("#payment_to").datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
			}).on('changeDate', function (selected) {
					
				});
			})
			
			
$(function(){
	$('#btnReport').click(function(){
	
	var paymentType = $('#payment_type').val();
	var paymentStatus = $('#payment_status').val();
	var fromDate = $('#payment_from').val();
	var toDate = $('#payment_to').val();
	var session = $('#session').val();
	var appl_category = $('#appl_category').val();
	var source_information = $('#source_information').val();
	var examtype = $('#exam_type').val();
	//alert(paymentType);
	$.ajax({
            url: "<?php echo base_url(); ?>admin/report/payment_report",
            type: "POST",
            data: {payment_type : paymentType, payment_status: paymentStatus, fromdt:fromDate, todt:toDate, sessionId:session, userType:appl_category, source:source_information, exam_type:examtype} ,
            dataType : 'json',
			 success: function(dataJson) {
				 //alert(html);
				 //$(".dtPayment").append(html);
				 /* $(".dtPayment").empty();
				 $(".dtPayment").append(html); */
				 
				 $('#example1').dataTable().fnClearTable();
				 
				 for(var i = 0; i < dataJson.length; i++) { 
				
					$('#example1').dataTable().fnAddData([ dataJson[i]]);  
				}
				/* $("#message").text("Successfully status updated");
				window.location.href = "<?php echo base_url(); ?>admin/payment/manage_payment"; */
                }
        });
	});
	
	$('#btnExport').click(function(){
		
		var paymentType = $('#payment_type').val();
		var paymentStatus = $('#payment_status').val();
		var fromDate = $('#payment_from').val();
		var toDate = $('#payment_to').val();
		//alert(paymentType);
			window.location.href='<?php echo base_url();?>admin/report/exportPayment/';
                    
                    return false;
		 
	});
	
	$('#btnclear').click(function(){
		$('#filter_payment')[0].reset();
	});
	
	

});
</script>