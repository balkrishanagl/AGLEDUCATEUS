
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Fees
            <small>Edit Fees</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/fees/manage_fees"><i class="fa fa-dashboard"></i> fees</a></li>
            <li class="active">Edit Fees</li>
        </ol>
    </section>

     <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-8 col-xs-10">
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
			<?php } else if($this->session->flashdata('warning')){  ?>
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
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/fees/edit_fees/<?php echo $fees_detail->id; ?>">          
                  
					   <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="feature title">Fees</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Fees Amount" class="form-control input-sm br0" id="fees" value="<?php echo $fees_detail->fees; ?>" name="fees" required/>                            
								<div class="form_er_msg"><?php echo validation_errors(); ?></div>
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="feature title">Re Exam Fees</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Re Exam Fees Amount" class="form-control input-sm br0" id="re_exam_fees" value="<?php echo $fees_detail->re_exam_fees; ?>" name="re_exam_fees" required/>                            
								<div class="form_er_msg"><?php echo validation_errors(); ?></div>
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Status</label></label>
                            <div class="col-md-5">
                               <select class="form-control input-sm br0" name="status">
							   <option <?php if($fees_detail->status==1){echo "selected=selected";}?> value="1">Active</option>
							   <option <?php if($fees_detail->status==0){echo "selected=selected";}?> value="0">Inactive</option>
							   </select>
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

<script>
allowedContent: {
    img: {
       attributes: '!src, alt', // src is required
       styles: 'height, width'
    }
}

</script>