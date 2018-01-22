<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Session
            <small><a href="<?php echo base_url();?>admin/session/add_session">Add Session</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Session List</li>
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
                    <h3 class="box-title">Session List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Start On</th>
                                <th>End On</th>
                                <th>Registration Start On</th>
                                <th>Registration End On</th>
								<th>Create Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($session_details) && $session_details != NULL) {?>
                                <?php $i=0; foreach($session_details as $session) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $session->name;?></td>
                                        <td><?php echo $session->start_on;?></td>
                                        <td><?php echo $session->end_on;?></td>
                                        <td><?php echo $session->register_start_on;?></td>
                                        <td><?php echo $session->register_end_on;?></td>
                                        <td><?php echo $session->created;?></td>
										<td><?php if($session->status==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td><a href="<?php echo base_url(); ?>admin/session/edit_session/<?php echo $session->id;?>">Edit | </a>
																				
										<?php if($session->status==1){?>
											<a href="javascript:void(0);" onclick="delete_session(<?php echo $session->id; ?>, '0')">Inactive</a>
										<?php }else{ ?>
											<a href="javascript:void(0);" onclick="delete_session(<?php echo $session->id; ?>, '1')">Active</a>
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

<script type="text/javascript">

function delete_session(id,status){
		
	if(status=='0')
		var r = confirm('Are you sure to Inactive status');
	else
		var r = confirm('Are you sure to Active status');
	
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/session/delete_session/'+id+'/'+status;
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