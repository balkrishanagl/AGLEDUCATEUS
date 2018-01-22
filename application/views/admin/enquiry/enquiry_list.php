
<!-- DATA TABLES -->
<link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Enquiry
            <!--<small><a href="<?php echo base_url();?>admin/study_material/add_study_material">Add Study Material</a></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Enquiry</li>
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
                    <h3 class="box-title">Enquiry List</h3>
					
				<form method="post" action="<?php echo base_url(); ?>dashboard/enquiry/exportEnquiry">	
					<select size="1" name="formType" style="float:right">
					<?php if(isset($form_type) && $form_type != NULL) {
						
							foreach($form_type as $formType) {
						?>
					
						<option value="<?php echo $formType->form_type;?>"><?php echo $formType->form_type;?></option>
					
					<?php }
					}					?>
					
					</select>
					<button class='btn' style="float:right" id="export_csv">Export to csv</button>
					</form>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Form Type</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($enquiry_list) && $enquiry_list != NULL) {?>
                                <?php $i=0; foreach($enquiry_list as $enquiry) { $i++;
									
									$formData = json_decode($enquiry->fields_data, true);
									
									
								  ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $formData['Name'];?></td>
                                        <td><?php echo $formData['Email'];?></td>
										<?php if(isset($formData['code']) && $formData['code'] != ""){ ?>
											<td><?php echo $formData['code'].$formData['Phone'];?></td>
										<?php }else{ ?>
												<td><?php echo $formData['Phone'];?></td>
										<?php } ?>
										
										<td><?php echo $enquiry->form_type;?></td>
										<td><a href="<?php echo base_url().'admin/enquiry/viewEnquiry/'.$enquiry->id; ?>">View</a> 
										&nbsp  | &nbsp <a onclick="delete_enquery(<?php echo $enquiry->id; ?>)" href="javascript:void(0)">Delete</a>
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

function delete_enquery(id){
	var r = confirm('are you sure to Enquiry data?');
	if(r==true){
		window.location.href = "<?php echo base_url(); ?>admin/enquiry/delete_formData/"+id;
	}
}

 $(function() {
       
        $('#example1').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
			"iDisplayLength": 20
        });
    });

</script>