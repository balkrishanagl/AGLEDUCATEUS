
<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Enquiry
            <!--<small><a href="<?php echo base_url();?>admin/study_material/add_study_material">Add Study Material</a></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Results</li>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Result List</h3>
					
		
                </div><!-- /.box-header -->
				
				<form method="post" role="form" id="filter_result" action="<?php echo base_url();?>admin/student_result/download_csv" accept-charset="utf-8">
				
				<table border='0' width='100%'>
					<tr>
						<td>
							<div class="form-group">
							<label>Exam Type</label>
								<select name="exam_type" id="exam_type" class="form-control">
								<option value="">Select</option>
								<option value="main">Main</option>
								<option value="re-exam">Re-Exam</option>
							</select>
							
						</td>
						<td>
							<div class="form-group">
							<label>From</label>
							<input type="text"  id="result_from" value="<?php echo $this->session->userdata('from'); ?>" name="result_from" class="form-control" /> 
							</div>
						</td>
						<td>
							<div class="form-group">
							<label>To</label>
							<input type="text"  id="result_to" value="<?php echo $this->session->userdata('to'); ?>" name="result_to" class="form-control" /> 
							</div>
						</td>
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
                                <th>Exam Type</th>
								<th>Student Name</th>
                                <th>Exam Name</th>
								<th>Date</th>
								<th>Session Start</th>
								<th>Session End</th>
								<th>Duration</th>
								<th>Exam Marks</th>
								<th>Assignment Marks</th>
								<th>Grace Marks</th>
								<th>Final Marks</th>
								<th>Grade</th>
								<th>Status</th>
								<th>Action</th>
								
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($result_list) && $result_list != NULL) {?>
                                <?php $i=0; foreach($result_list as $result) { $i++; ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $result->type;?></td>
                                        <td><?php echo $result->first_name.' '.$result->last_name; ?></td>
                                        <td><?php echo $result->name;?></td>
										<td><?php echo $result->exam_date;?></td>
										<td><?php echo $result->sessionStart;?></td>
										<td><?php echo $result->sessionEnd;?></td>
										<td><?php echo $result->duration;?></td>
										<td><?php echo $result->marks;?></td>
										<td><?php echo $result->assignment_marks;?></td>
										<td><?php echo $result->grace_marks;?></td>
										<td><?php echo $result->final_marks;?></td>
										<td><?php echo $result->grade;?></td>
										<td><?php if($result->status=='done') { echo "Completed"; } else { echo "Pending"; } ?></td>
									    <td>
											<a href="<?php echo base_url().'admin/student_result/add_grace_marks/'.$result->id; ?>">Edit</a>
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

<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script type="text/javascript">

function delete_assignment(id){
	var r = confirm('are you sure to Enquiry data?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/enquiry/delete_formData/"+id;
	}
}


	$(document).ready(function(){

		
		 $("#result_from").datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			}).on('changeDate', function (selected) {
				
			});
			
			

			$("#result_to").datepicker({
				autoclose: true,
				format: 'yyyy-mm-dd',
			}).on('changeDate', function (selected) {
					
				});
			});
			
	

 $(function() {
       
        $('#example1').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
			"iDisplayLength": 20
        });
    });
	
$(function(){
	$('#btnReport').click(function(){
		var fromDate = $('#result_from').val();
		var toDate = $('#result_to').val();
		var type = $('#exam_type').val();
		
		$.ajax({
            url: "<?php echo base_url(); ?>admin/student_result/filter_result",
            type: "POST",
            data: {fromdt:fromDate, todt:toDate, type:type} ,
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
		
		
		
		//alert(paymentType);
			window.location.href='<?php echo base_url();?>admin/student_result/download_csv/';
                    
                    return false;
		 
	});
	
	
	$('#btnClear').click(function(){
		$('#filter_result')[0].reset();
	});
});	

</script>