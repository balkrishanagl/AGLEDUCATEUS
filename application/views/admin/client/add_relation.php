<!-- Right side column. Contains the navbar and content of the event -->
<aside class="right-side">
    <!-- Content Header (event header) -->
    <section class="content-header">
        <h1>
           Relation
            <small>Add Relation</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/client/relation_list"><i class="fa fa-dashboard"></i> Relations</a></li>
            <li class="active">Add Relation</li>
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
			<?php }else if(validation_errors()){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo validation_errors(); ?>
				</div>
			<?php }else if(isset($duplicate_error) && $duplicate_error != ""){  ?>
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> <?php echo $duplicate_error; ?>
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
                <form id="add_client_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/client/add_relation"  enctype="multipart/form-data">          
                        
						<div class="form-group">
							<label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Team Member</label></label>
							<div class="col-md-8">
								<select class="form-control" name="team_member" id="team_member">
									<option value="">Select Team Member</option>
								<?php foreach($team_members as $team_member){ ?>
									<option value="<?php echo $team_member->id; ?>"><?php echo $team_member->name; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Client</label></label>
							<div class="col-md-8">
								<select class="form-control" name="client" id="client">
								<option value="">Select Client</option>
								<?php foreach($clients as $client){ ?>
									<option value="<?php echo $client->id; ?>"><?php echo $client->client_name; ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
					   
					  <div class="form-group">

                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Status</label></label>

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

                                 <input type="submit" class="btn btn-info br0 on_sending_reg" value="Add" name="submit"/> 

                              </div>

                        </div>
					   
					  
                    </form> 
            </div><!-- ./col -->
    </div>

</section><!-- /.content -->

</aside> 

