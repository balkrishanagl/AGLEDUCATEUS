<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the course -->
<aside class="right-side">
    <!-- Content Header (course header) -->
    <section class="content-header">
        <h1>
            Course
            <small><a href="<?php echo base_url();?>admin/course/add_course">Add Course</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Course List</li>
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
    <h3 class="box-title">Course List</h3>
	</div><!-- /.box-header -->
	

	<div class="box-body table-responsive">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr No</th>
		<th>Course</th>		<th>Created Date</th>
		<th>Status</th>
		<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php if(isset($course_details) && $course_details != NULL) {?>
			<?php $i=0; foreach($course_details as $course_detail) { $i++;?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $course_detail->name;?></td>			<td><?php echo $course_detail->created;?></td>
			<td><?php if($course_detail->status=='Active'){ echo "Active"; } else { echo "Inactive"; } ?></td>
			<td><a href="<?php echo base_url(); ?>admin/course/edit_course/<?php echo $course_detail->id;?>">Edit</a>
			<?php if($course_detail->status=='Active'){ ?>			|<a href="javascript:void(0);" onclick="delete_course(<?php echo $course_detail->id ?>)">Inactive</a>			<?php }else{ ?>			&nbsp;|&nbsp;<a href="javascript:void(0);" onclick="active_course(<?php echo $course_detail->id ?>)">Active</a>			<?php } ?>
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
function delete_course(id){	var r = confirm('Are you sure to deactivate?');	if(r==true){		window.location.href = '<?php echo base_url(); ?>admin/course/delete_course/'+id;	}}function active_course(id){	var r = confirm('Are you sure to active?');	if(r==true){		window.location.href = '<?php echo base_url(); ?>admin/course/active_course/'+id;	}}
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