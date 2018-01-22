
<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
            Forum
            <small>Add Topic</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/forum/manage_topic"><i class="fa fa-dashboard"></i> Forum</a></li>
            <li class="active">Add Topic</li>
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
                <form id="add_event_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/forum/add_topic">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="event title">Topic Title</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Topic Title" class="form-control input-sm br0" size="30" id="topic_title" value="" name="topic_title" required/>                            
                             
                            </div>
                       </div>

                     

                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="meta title">Description</label></label>
                            <div class="col-md-8">
                             <textarea placeholder="Topic Description" class="form-control input-sm br0"  id="topic_body" value="" name="topic_body" required></textarea> 
                            </div>
                        </div>
						
                        <div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Status</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="status" id="status">
                                   
                            <option value="1">Active</option>
							 <option value="0">Inactive</option>
                               
                               </select>
                                
                            </div>
                        </div>
						

                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add Topic" name="submit"/> 
                              </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    
<!-- Include Date Range Picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date = new Date();
		date.setDate(date.getDate());
		
		var date_input=$('input[name="event_date"]'); //our date input has the name "date"
		//var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			//container: container,
			todayHighlight: true,
			autoclose: true,
			startDate: date,
		})
	})
</script>
