
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Subscriber
            <small>Edit Subscriber</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/subscriber/subscriber_list"><i class="fa fa-dashboard"></i> Subscriber</a></li>
            <li class="active">Edit Subscriber</li>
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
		
                <form id="add_user_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/subscriber/edit_subscriber/<?php echo $subscriber[0]->id; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Name</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="subsname" value="<?php if($subscriber[0]->name!=''){ echo $subscriber[0]->name;} else { echo set_value('subsname');} ?>" name="subsname" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>

                       <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Email</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="email" value="<?php if($subscriber[0]->email!=''){ echo $subscriber[0]->email;} else { echo set_value('email'); } ?>" name="email" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
					   
					    <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Number</label></label>
                            <div class="col-md-5">
                                <input type="text" placeholder="Filename" class="form-control input-sm br0" size="30" id="number" value="<?php if($subscriber[0]->number!=''){ echo $subscriber[0]->number; }else { echo set_value('number'); } ?>" name="number" required/>                            
                                <span class="form_er_msg" id="error_username"></span>
                            </div>
                       </div>
                       
                        <div class="form-group">
                            <label for="full_name" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Update Subscriber" name="submit"/> 
                            </div>
                        </div>
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside>    

<script type="text/javascript">

$(document).ready(function(){

	
	var isProcessing = false;  

     
});
</script>