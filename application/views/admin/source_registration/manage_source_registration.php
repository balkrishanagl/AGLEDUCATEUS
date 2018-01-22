<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the source of Information -->
<aside class="right-side">
    <!-- Content Header (source of Information header) -->
    <section class="content-header">
        <h1>
            source of Registration
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">source of Registration List</li>
        </ol>
    </section>

     <!-- Main content -->
	 
	 	<div>
			<?php
				$session_data = $this->session->userdata('admin_user');
				$user_session_data['id'] = $session_data['id'];
				$user_session_data['username'] = $session_data['admin_username'];
$user_session_data['user_type_id'] = $session_data['admin_user_type_id'];
			 echo validation_errors(); ?>
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
    <h3 class="box-title">source of Registration List</h3>
	</div><!-- /.box-header -->
	

	<div class="box-body table-responsive">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr No</th>
		<th>Website URL</th>
		<th>Count</th>
		<th>Status</th>
		<?php if($user_session_data['user_type_id'] == '7'){ ?>
		<th>Action</th>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
		<?php if(isset($source_details) && $source_details != NULL) {?>
			<?php $i=0; foreach($source_details as $source_detail) { $i++;?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $source_detail->website_url;?></td>
			<td><?php echo $source_detail->count; ?></td>
			<td><?php if($source_detail->status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
			<?php if($user_session_data['user_type_id'] == '7'){ ?>
			<td><a href="<?php echo base_url(); ?>admin/source_registration/edit_source_registration/<?php echo $source_detail->id;?>">Edit</a>
			</td>
			<?php } ?>
			
		</tr>    
	<?php } ?>    
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

/*function delete_source(id){
	var r = confirm('Are you sure to delete source?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/source_registration/delete_source/'+id;
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
    });*/
</script>