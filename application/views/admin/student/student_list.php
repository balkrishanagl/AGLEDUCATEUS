<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User
            <small><a href="<?php echo base_url();?>admin/user/add_student">Add Student</a></small>
			
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User List</li>
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
                    <h3 class="box-title">User List</h3> 
					<!--<a href="<?php echo base_url();?>admin/user/download_excel" style="float:right; font-size:30px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>-->
                </div><!-- /.box-header -->
				
				<!--</form>-->
				 <form method="post" role="form" id="exportdata" action="<?php echo base_url();?>admin/user/download_csv" accept-charset="utf-8">
				From
				<input type="text"  id="payment_from" value="<?php echo $this->session->userdata('from'); ?>" name="payment_from" /> 
				To
				<input type="text"  id="payment_to" value="<?php echo $this->session->userdata('to'); ?>" name="payment_to" /> 
				<!--<input type="submit" class="btn-info" id="btnReport" value="Search"/>-->
				<input type="submit" class="btn-primary" id="btnExport" value="Export"/>
				</form>
				
				
				<?php if(isset($del_msg)) { echo $del_msg;} ?>
                <div class="box-body table-responsive">
				
				<h4 id="succ_msg" style="color:green; display:none;">Record Deleted Successfully!</h4>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Email</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
								//echo "<pre>"; print_r($all_user_list); echo "</pre>"; die;
								$i=0; foreach($all_user_list as $all_user) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $all_user->first_name;?></td>
                                        <td><?php echo $all_user->email;?></td>
										<td><?php if($all_user->activated=='0'){ echo "Inactive"; }else{ echo "Active"; } ?></td>
                                        <td><a href="<?php echo base_url(); ?>admin/user/edit_student/<?php echo $all_user->id;?>">Edit</a>
										&nbsp;|&nbsp;
										<?php if($all_user->activated=='0'){ ?>
										<a href="javascript:void(0);" onclick="delete_student(<?php echo $all_user->id; ?>,'1')">Enable</a>
										<?php } else { ?>
										<a href="javascript:void(0);" onclick="delete_student(<?php echo $all_user->id; ?>,'0')">Disable</a>
										<?php } ?>
                                        </td>
                                        
                                    </tr>    
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

<script type="text/javascript">
<!-- Method to delete user -->
function delete_student(id,sts){
	var r = confirm('Are you sure to change status?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/user/delete_student/'+id+'/'+sts;
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
				
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
		});
	}, 4000);			
			})
		</script>