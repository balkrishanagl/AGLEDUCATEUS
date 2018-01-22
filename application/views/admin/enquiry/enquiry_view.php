<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Enquiry
            <small>View</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/enquiry/enquiry_list"><i class="fa fa-dashboard"></i>Enquiry</a></li>
            <li class="active">Enquiry view</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
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

	               <?php if(isset($enquiry_data) && $enquiry_data != NULL) {?>
				   
                      <?php foreach($enquiry_data as $enquiry) {;
							$formData = json_decode($enquiry->fields_data, true);
								foreach($formData as $key => $form) { ?>
								<div class="form-group">
									<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php  if($key == "formName"){ echo "Form Type"; }else{ echo $key; } ?></label></label>
									<div class="col-md-8">
										
										<label for="cal_exam_datetime" class="col-md-4 control-label"><label for="exam title"><?php echo $form ?></label></label>
									 
									</div>
							   </div>
					 <?php }
					}
				   }?>
                    
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    
