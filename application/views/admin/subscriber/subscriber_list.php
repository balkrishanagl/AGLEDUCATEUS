<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Subscriber
            <!--<small><a href="<?php echo base_url();?>admin/study_material/add_study_material">Add Study Material</a></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Subscriber</li>
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
                    <h3 class="box-title">Subscriber List</h3>
					<!--<button class='btn' style="float:right" id="export_csv">Export to csv</button>-->
					<form method="post" action="<?php echo base_url(); ?>dashboard/subscriber/exportData">	
                    <select name="subsStatus" id="subsStatus" style="float:right" onchange="exprtSubSts()">
                        <option value="">Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
					<button class='btn' style="float:right" id="export_csv">Export to csv</button>
					</form>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Email</th>
								<th>Status</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($subscriber_list) && $subscriber_list != NULL) {?>
                                <?php $i=0; foreach($subscriber_list as $subscribers) { $i++;?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $subscribers->email;?></td>
										<td><?php if($subscribers->status==1) { echo "Active"; } else { echo "Inactive"; } ?></td>
									    <td>
											<?php if($subscribers->status==1){?>
											<a onclick="unsubscribe_user(<?php echo $subscribers->id;?>);" href="javascript:void(0);">Unsubscribe |</a>
											<?php }else{ ?>
											<a onclick="subscribe_user(<?php echo $subscribers->id;?>);" href="javascript:void(0);">Subscribe |</a>
											<?php } ?>
											<a onclick="delete_subscribe(<?php echo $subscribers->id;?>);" href="javascript:void(0);">Delete</a>
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
function delete_subscribe(id){
	var r = confirm('are you sure to Delete?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/subscriber/delete_subscriber/"+id;
	}
}

function unsubscribe_user(id){
	var r = confirm('are you sure to Unsubscribe?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/subscriber/unsubscribe/"+id;
	}
}

function subscribe_user(id){
	var r = confirm('are you sure to Subscribe?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/subscriber/active_subscriber/"+id;
	}
}

function exprtSubSts(){
    var sts = $('#subsStatus').val();
    if(sts==''){
        alert('Please select a status first.');
        $('#subsStatus').focus();
        return false;
    }else if(sts=='1'){
        $('#exprtBtn').attr('href','<?php echo base_url(); ?>ajax/subscribe/exprtSubscrb/1');
    }else if(sts=='0'){
        $('#exprtBtn').attr('href','<?php echo base_url(); ?>ajax/subscribe/exprtSubscrb/0');
    }
}

$(document).ready(function(){
    $('#export_csv').click(function(){
        var sts = $('#subsStatus').val();
        if(sts==''){
            alert('Please select a status first');
            return false;
        }
    });
	

});
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