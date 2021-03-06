<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            Comment
            <small><a href="<?php echo base_url();?>admin/forum/add_topic">Add Topic</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Comment List</li>
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
                    <h3 class="box-title">Comment List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
								<th>Username</th>
								<th>Comment</th>
                                <th>Status</th>
								<th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($comment_details) && $comment_details != NULL) {?>
                                <?php $i=0; foreach($comment_details as $comment_detail) {  $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $comment_detail->username;?></td>
										<td><?php echo $comment_detail->body;?></td>
										<td><?php if($comment_detail->status==1){ echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td><?php echo date("Y-m-d",strtotime($comment_detail->created));?></td>
                                        
                                        <td>
										<?php if($comment_detail->status==1){ ?>
											<a onclick="changeStatus(<?php echo $comment_detail->id;?>,'0');" href="javascript:void(0);">Deactivate</a>&nbsp;|&nbsp;
											<?php if($comment_detail->reply_body==""){?>
										
										<a href="<?php echo base_url(); ?>admin/forum/reply_comment/<?php echo $comment_detail->id;?>">Reply</a>
										&nbsp;|&nbsp;
										<?php }else{ ?>
										<a href="javascript:void(0)">Replied</a>
										&nbsp;|&nbsp;
										<?php }
										}else{ ?>
											<a onclick="changeStatus(<?php echo $comment_detail->id;?>,'1');" href="javascript:void(0);">Activate</a>&nbsp;|&nbsp;
										<?php } ?>
										<a href="<?php echo base_url(); ?>admin/forum/edit_comment/<?php echo $comment_detail->id;?>">Edit</a>
										&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="delete_comment(<?php echo $comment_detail->id; ?>)">Delete</a>
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

function delete_comment(id){
	var r = confirm('Are you sure to delete comment?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/forum/delete_comment/'+id;
	}
}

function changeStatus(id, status){
	
	if(status == 1){
		var r = confirm('Are you sure to active comment?');	
		
	}else{
		var r = confirm('Are you sure to deactivate comment?');	
	}
	
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/forum/changeCommentStatus/'+id+'/'+status;
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