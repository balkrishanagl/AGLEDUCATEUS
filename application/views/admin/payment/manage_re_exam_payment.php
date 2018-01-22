<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Re Exam Payment
            <!--<small><a href="<?php echo base_url();?>admin/payment/add_payment">Add Payment</a></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Re Exam Payment List</li>
        </ol>
    </section>
     <!-- Main content -->
<section class="content">
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Re Exam Payment List</h3>
                </div><!-- /.box-header -->
				
						<form id="filter_session" method="post" role="form" id="filter_session" action="#" accept-charset="utf-8">
				<table border='0' width='100%'>
					<tr>
						<td colspan='2'><p>Filter By:</p></td>
					</tr>
					<tr>
						<td>
						  <div class="form-group">
							<label>Session</label>
							<select name="session" id="session" class="form-control">
								<option value="">Select</option>
							<?php foreach($session_data as $sessionList){ ?>
								<option <?php if(isset($_POST['payment_type']) and $_POST['payment_type']==$sessionList->id){ echo "selected='selected'"; } ?> value="<?php echo $sessionList->id; ?>"><?php echo $sessionList->name; ?></option>
							<?php } ?>
							</select>
							</div>
						</td>
						<td>
						<input type="button" class="btn-info" id="btnSearch" value="Search"/>
						<input type="button" class="btn-primary" id="btnClear" value="Clear"/>
						</td>
						</tr>
				</table>
		</form>	
		
				Multiselect Action:	<select id="save_value" ><option>Select Action</option><option value="1">Active</option><option value="0">Inactive</option></select><span id="message"></span>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
							   <th></th>
                                <th>Sr No</th>
                                <th>Session</th>
								<th>Username</th>
                                <th>Payment Type</th>
								<th>Payment Date</th>
								<th>Fees</th>
								<th>Vendor Amount</th>
								<th>Service Tax Amount</th>
								<th>Gross Amount</th>
								<th>Reference No</th>
								<th>Bank Name</th>
								<th>Branch Name</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							if(isset($payment_list) && $payment_list != NULL) {?>
                                <?php $i=0; foreach($payment_list as $payment) { $i++;?>
                                    <tr>
									 <td><input type="checkbox" id="pay_id" value="<?php echo $payment->id;?>" name="select_option[]" /></td>
                                        <td><?php echo $i;?></td>
										<td><?php echo $payment->session;?></td>
                                        <td><?php echo $payment->username;?></td>
										<td><?php echo $payment->payment_type_id;?></td>
										<td><?php echo $payment->cheque_date;?></td>
										<td><?php echo $payment->course_fee;?></td>
										<td><?php echo $payment->vendor_amount;?></td>
										<td><?php echo $payment->servicetax_amount;?></td>
										<td><?php echo $payment->gross_amount;?></td>
										<td><?php echo $payment->reference_no;?></td>
										<td><?php echo $payment->bank_name;?></td>
										<td><?php echo $payment->branch_name;?></td>
										<td><?php if($payment->re_exam_payment_status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td>
										<a href="<?php echo site_url().'admin/payment/edit_payment/'.$payment->id ?>">Edit</a> | 
										<?php if($payment->re_exam_payment_status==1){ echo "Payment Verified"; 
										}else{?> <a onclick="change_status(<?php echo $payment->user_id;?>,<?php echo $payment->id;?>,<?php echo $payment->re_exam_payment_status; ?>);" href="javascript:void(0);">Active</a> <?php } ?>
										
										&nbsp;|&nbsp;<a onclick="delete_payment(<?php echo $payment->id;?>);" href="javascript:void(0);">Delete</a>
                                        </td>
                                        
                                    </tr>    
                                <?php }?>    
                            <?php } ?> 
                            
                        </tbody>
                        
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

<script type="text/javascript">
function delete_payment(id){
	var r = confirm('are you sure to delete payment?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/payment/delete_payment/"+id;
	}
}

function change_status(user_id,id, status){
	var r = confirm('are you sure to change payment status?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/payment/update_reExamPaymentstatus/"+user_id+"/"+id+"/"+status;
	}
}
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>

<script>
 $(function(){
      $('#save_value').change(function(){
		 var stat_value = $('#save_value').val();
         var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
		  
		  });
		   if(val!='') {
			  $.ajax({
            url: "<?php echo base_url(); ?>admin/payment/update_multi_reexam_status",
            type: "POST",
            data: {pid : stat_value, val: val} ,
           // dataType : 'json',
			 success: function(html) {
				$("#message").text("Successfully status updated");
				window.location.href = "<?php echo base_url(); ?>admin/payment/manage_re_exam_payment";
                }
        });
		   }
 else {
	 alert("Select atleast one User");
	 return false;
	 
 }		   
		    
        
		});
    });
	
$(function(){
	$('#btnSearch').click(function(){
		var session = $('#session').val();
		
		$.ajax({
			
			url: "<?php echo base_url(); ?>admin/payment/filter_re_exam_payment",
            type: "POST",
            data: {session_value : session} ,
            dataType : 'json',
			 success: function(dataJson) {
				 //alert(dataJson);
								
				 $('#example1').dataTable().fnClearTable();
				 
				 for(var i = 0; i < dataJson.length; i++) { 
				
					$('#example1').dataTable().fnAddData([ dataJson[i]]);  
				}
				
                }
				
		});
	});
	
	$('#btnClear').click(function(){
		$('#filter_session')[0].reset();
	});
});		
</script>