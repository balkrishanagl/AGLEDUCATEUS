<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the course -->
<aside class="right-side">
    <!-- Content Header (course header) -->
    <section class="content-header">
        <h1>
            Bulk Email History
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Bulk Email History</li>
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
    <h3 class="box-title">Bulk Email History</h3>
	</div><!-- /.box-header -->
	

	<div class="box-body table-responsive">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
		<th>Sr No</th>
		<th>Email Template</th>		<th>Recepients</th>		<th>CSV</th>		<th>Date</th>
		</tr>
		</thead>
		<tbody>
		<?php if(isset($email_history) && $email_history != NULL) {?>
			<?php $i=0; foreach($email_history as $emails_history) { $i++;								if($emails_history->recipients !=""){					$recepArr = json_decode($emails_history->recipients);					$recepients = implode(',', $recepArr);				}else{					$recepients = '';				}										?>
		<tr>
			<td><?php echo $i;?></td>
			<td><?php echo $emails_history->email_title;?></td>			<td><?php echo $recepients;?></td>			<?php if($emails_history->file !=""){ ?>				<td><a href="<?php echo base_url().$emails_history->file; ?>" download>Download CSV</a></td>			<?php }else{?>			<td>--</td>			<?php } ?>			<td><?php echo $emails_history->created;?></td>
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