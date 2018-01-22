<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            Clients
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Client List</li>
        </ol>
    </section>

     <!-- Main content -->
	 
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
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Client List</h3>
                </div><!-- /.box-header -->
				
				<form id ="filter_registration" method="post" role="form" id="exportdata" action="#" accept-charset="utf-8">



						<table border='0' width='100%'>

							<tr>

								<td colspan='4'><p>Filter By:</p></td>

							</tr>

							<tr>
							
							<td>
							<div class="form-group">
							<label>Client</label>
							
								<select name="client" id="client" class="form-control">
								<option value="">Select Client</option>
								<?php foreach($clients as $client){ ?>
									<option <?php if(isset($_POST['client']) and $_POST['client']==$client->id){ echo "selected='selected'"; } ?> value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
								<?php } ?>
								</select>
							</div>
							</td>
							
							<td>

							
							<td>

								<div class="form-group">

								<label>From</label>

								<input type="text"  id="client_from" value="" name="client_from" class="form-control" />

								</div>

							</td>



							<td>

								<div class="form-group">

								<label>To</label>

								<input type="text"  id="client_to" value="" name="client_to" class="form-control" />

								</div>

							</td>





							</tr>



							<tr>

							<td>

							<input type="button" class="btn-info" id="btnReport" value="Search"/>

							<input type="button" class="btn-primary" id="btnExport" value="Export"/>

							<input type="button" class="btn-info" id="btnClear" value="Clear"/>

							</td>

							</tr>



						</table>





					</form>
					
					
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contract value</th>
                                <th>First installment</th>
                                <th>Second installment</th>
                                <th>Third installment</th>
                                <th>Fourth installment</th>
                                <th>Fifth installment</th>
								<th>First installment status</th>
                                <th>Second installment status</th>
                                <th>Third installment status</th>
                                <th>Fourth installment status</th>
                                <th>Fifth installment status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($client_details) && $client_details != NULL) {?>
                                <?php $i=0; foreach($client_details as $client_detail) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
										<td><?php echo date("d/m/Y", strtotime($client_detail->created));?></td>
                                        <td><?php echo $client_detail->client_name;?></td>
                                        <td><?php echo $client_detail->email;?></td>
                                        <td><?php echo $client_detail->contract_value;?></td>
                                        <td><?php echo $client_detail->first_inst_net_amount;?></td>
                                        <td><?php echo $client_detail->second_inst_net_amount;?></td>
                                        <td><?php echo $client_detail->third_inst_net_amount;?></td>
                                        <td><?php echo $client_detail->fourth_inst_net_amount;?></td>
                                        <td><?php echo $client_detail->fifth_inst_net_amount;?></td>
										<td><?php if($client_detail->first_installment_status=='Received'){ echo "&#10004;"; } else { echo "&#10006;"; } ?></td>
										<td><?php if($client_detail->second_installment_status=='Received'){ echo "&#10004;"; } else { echo "&#10006;"; } ?></td>
										<td><?php if($client_detail->third_installment_status=='Received'){ echo "&#10004;"; } else { echo "&#10006;"; } ?></td>
										<td><?php if($client_detail->fourth_installment_status=='Received'){ echo "&#10004;"; } else { echo "&#10006;"; } ?></td>
										<td><?php if($client_detail->fifth_installment_status=='Received'){ echo "&#10004;"; } else { echo "&#10006;"; } ?></td>
										<td><?php if($client_detail->status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td><a href="<?php echo base_url(); ?>admin/client/edit_client/<?php echo $client_detail->id;?>">Edit</a>
										<?php if($client_detail->status==1){ ?>
										|<a href="javascript:void(0);" onclick="delete_client(<?php echo $client_detail->id ?>)">Inactive</a>
										<?php }else{ ?>
										&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="active_client(<?php echo $client_detail->id ?>)">Active</a>
										<?php } ?>
                                        </td>
                                        
                                    </tr>    
                                <?php }?>    
                            <?php }?> 
                            
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>


<script type="text/javascript">

function delete_client(id){
	var r = confirm('Are you sure to deactivate?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/client/delete_client/'+id;
	}
}

function active_client(id){
	var r = confirm('Are you sure to active?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/client/active_client/'+id;
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
	
$(document).ready(function(){
		
		$("#client_from").datepicker({

			autoclose: true,

			format: 'yyyy-mm-dd',

			}).on('changeDate', function (selected) {



			});
		
		$("#client_to").datepicker({

				autoclose: true,

				format: 'yyyy-mm-dd',

			}).on('changeDate', function (selected) {



				});
				
	$('#btnClear').click(function(){

		$('#filter_registration')[0].reset();

	});
	
	
	
	$('#btnReport').click(function(){



	var fromDate = $('#client_from').val();

	var toDate = $('#client_to').val();
	
	var client = $('#client').val();

	$.ajax({

            url: "<?php echo base_url(); ?>admin/client/manage_client",

            type: "POST",

            data: {fromdt:fromDate, todt:toDate, clientId:client} ,

			dataType: 'json',

			 success: function(dataJson) {

				// alert(dataJson);

				$('#example1').dataTable().fnClearTable();



				for(var i = 0; i < dataJson.length; i++) {



					$('#example1').dataTable().fnAddData([ dataJson[i]]);

				}



                }

        });

	});
	
	$('#btnExport').click(function(){
		
		var fromDate = null;
		var toDate = null;
		var clientId = null;
		
		if($('#client_from').val() !=""){
			fromDate = $('#client_from').val();
		}
		
		if($('#client_to').val() !=""){
			toDate = $('#client_to').val();
		}
		
		if($('#client').val() !=""){
			clientId = $('#client').val();
		}
		
		
		
		window.location.href='<?php echo base_url();?>admin/client/download_client_csv/'+fromDate+'/'+toDate+'/'+clientId;
		return false;
	});
	
});	
</script>