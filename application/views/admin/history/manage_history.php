<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            Educatus History
            <small><a href="<?php echo base_url();?>admin/history/add_history">Add History</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Educatus History List</li>
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
                    <h3 class="box-title">History List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Title 1</th>
                                <th>Title 2</th>
                                <th>Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($history_details) && $history_details != NULL) {?>
                                <?php $i=0; foreach($history_details as $history_detail) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $history_detail->title_1;?></td>
                                        <td><?php echo $history_detail->title_2;?></td>
                                        <td><?php echo $history_detail->year;?></td>
                                        <td><?php if($history_detail->status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td><a href="<?php echo base_url(); ?>admin/history/edit_history/<?php echo $history_detail->id;?>">Edit</a>
										<?php if($history_detail->status==1){ ?>
										|<a href="javascript:void(0);" onclick="delete_history(<?php echo $history_detail->id ?>)">Inactive</a>
										<?php }else{ ?>
										&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="active_history(<?php echo $history_detail->id ?>)">Active</a>
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

function delete_history(id){
	var r = confirm('Are you sure to deactivate?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/history/delete_history/'+id;
	}
}

function active_history(id){
	var r = confirm('Are you sure to active?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/history/active_history/'+id;
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