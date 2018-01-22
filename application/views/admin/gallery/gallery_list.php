<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Gallery
            <small><a href="<?php echo base_url();?>admin/gallery/add_gallery">Add Gallery</a></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Gallery List</li>
        </ol>
    </section>
     <!-- Main content -->
<section class="content">
<div>
			
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
                    <h3 class="box-title">Gallery List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
								<th>Image</th>
								<th>Type</th>
                                <th>Status</th>
								<th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($galleryList) && $galleryList != NULL) {?>
                                <?php $i=0; foreach($galleryList as $galleries) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $galleries->name;?></td>
										<td>
                                            <?php if($galleries->images != ""){ ?>
                                            <img src="<?php echo base_url().'uploads/gallery/'.$galleries->images ?>" height="100px" width="100px">
                                            <?php }else{ ?>
											<img src="<?php echo base_url().$galleries->video_image; ?>" height="100px" width="100px">
                                            <?php } ?>
                                        </td>
										<td><?php echo $galleries->type; ?></td>
									    
                                        <td><?php echo $galleries->status;?></td>
                                        <td><?php echo $galleries->created;?></td>

                                        <td><a href="<?php echo base_url(); ?>admin/gallery/edit_gallery/<?php echo $galleries->id;?>">Edit</a>
										&nbsp;|&nbsp;<a onclick="delete_gallery(<?php echo $galleries->id;?>);" href="javascript:void(0);">Delete</a>
										&nbsp;|&nbsp;
                                        <?php if($galleries->status=='Active'){ ?>
                                        <a onclick="change_status(<?php echo $galleries->id;?>,'Inactive');" href="javascript:void(0);">Inactive</a>
                                        <?php }else{ ?>
                                        <a onclick="change_status(<?php echo $galleries->id;?>,'Active');" href="javascript:void(0);">Active</a>
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
function delete_gallery(id){
	var r = confirm('are you sure to delete gallery?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/gallery/delete_gallery/"+id;
	}
}
function change_status(id,status){
    var r = confirm('are you sure to status '+status);
    if(r==true){
        window.location.href = "<?php echo base_url(); ?>admin/gallery/update_status/"+id+'/'+status;
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