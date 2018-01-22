
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Faq
            <small>Edit Faq</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/page/manage_page"><i class="fa fa-dashboard"></i> faq</a></li>
            <li class="active">Edit Faq</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
				<div>
			<?php if(validation_errors()){?>
			
			<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
				</div>
			<?php } ?>
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
		
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/faq/edit_faq/<?php echo $faq_data->id;?>">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="category name">Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Faq Title" class="form-control input-sm br0" size="30" id="faq_title" value="<?php  if(isset($faq_data) && $faq_data != ''){ echo $faq_data->title; }?>" name="faq_title" required/>                            
                             
                            </div>
                       </div>

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="page content">Description</label></label>
                            <div class="col-md-8">
					
                              		<?php echo $this->ckeditor->editor('description',$faq_data->description);?>                             
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="category name">Order No</label></label>
                            <div class="col-md-8">
                                <input type="number" placeholder="Order No" class="form-control input-sm br0" size="30" id="order_no" value="<?php  if(isset($faq_data) && $faq_data != ''){ echo $faq_data->order_no; }?>" name="order_no" required/>                            
                            </div>
                       </div>
					
					
		

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update" name="submit"/> 
                                 <input type="button" class="btn btn-info br0 hide" value="Adding Request..." id="on_sending_req_reg"/>           
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

