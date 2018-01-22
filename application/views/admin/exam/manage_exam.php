<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the exam -->
<aside class="right-side">
    <!-- Content Header (exam header) -->
    <section class="content-header">
        <h1>
          Manage Exam
            <small><a href="<?php echo base_url();?>admin/exam/add_exam">Add exam</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">exam List</li>
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
                    <h3 class="box-title">exam List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Exam Name</th>
                                <th>Exam Date</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($exam_details) && $exam_details != NULL) {?>
                                <?php $i=0; foreach($exam_details as $exam_detail) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $exam_detail->exam_name;?></td>
                                        <td><?php echo date("Y-m-d",strtotime($exam_detail->exam_date));?></td>
                                        <td><?php if($exam_detail->status==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
                                        <td><a href="<?php echo base_url(); ?>admin/exam/edit_exam/<?php echo $exam_detail->id;?>">Edit</a>
										&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="delete_exam(<?php echo $exam_detail->id; ?>)">Delete</a>
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

function delete_exam(id){
	var r = confirm('Are you sure to delete exam?');
	if(r==true){
		window.location.href = '<?php echo base_url(); ?>admin/exam/delete_exam/'+id;
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