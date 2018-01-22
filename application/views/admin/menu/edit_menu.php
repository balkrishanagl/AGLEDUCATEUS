<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Menu
            <small>Edit Menu</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url()?>admin/page/manage_page"><i class="fa fa-dashboard"></i> menu</a></li>
            <li class="active">Edit Menu</li>
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
		
                <form id="add_page_form" class="form-horizontal" accept-charset="utf-8" method="post" action="<?php echo base_url(); ?>admin/menu/edit_menu/<?php echo $menu_data->id;?>">          
                        <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="category name">Menu Name</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Menu Name" class="form-control input-sm br0" size="30" id="menu_name" value="<?php  if(isset($menu_data) && $menu_data != ''){ echo $menu_data->name; }?>" name="menu_name"/>                            
								<div class="form_er_msg"><?php echo validation_errors(); ?></div>
                            </div>
                       </div>
					   
					<div class="form-group">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="status">Parent Menu</label></label>
                            <div class="col-md-8">
                               <select class="form-control" name="parent_id" id="parent_id">
								 <option value="">Choose Parent Menu</option>
								<?php foreach($menu as $menulist){ 
										if($menu_data->name != $menulist->name){?>
									<option value="<?php echo $menulist->id; ?>" <?php  if(isset($menu_data) && $menu_data != ''){ if($menu_data->parent_id == $menulist->id){ echo "selected"; } }?>><?php echo $menulist->name; ?></option>
									
										<?php }
										} ?>
                               
                               </select>
                                
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="feature title">link</label></label>
                            <div class="col-md-8">
                                <input type="text" placeholder="Link" class="form-control input-sm br0" size="30" id="link" value="<?php  if(isset($menu_data) && $menu_data != ''){ echo $menu_data->link; }?>" name="link"/>                            
								<div class="form_er_msg"><?php echo validation_errors(); ?></div>
                            </div>
                       </div>   
				
                       <div class="form-group">
                            <label for="cal_event_datetime" class="col-md-4 control-label"><label for="username">Menu Place</label></label>
                            <div class="col-md-5">
                                <input type="radio" id="header" value="header" <?php if($menu_data->type == "header"){ echo 'checked'; }?> name="type"/> Header &nbsp; &nbsp;
                                <input type="radio" id="footer" value="footer" <?php if($menu_data->type == "footer"){ echo 'checked'; }?> name="type"/> Footer
                            </div>
                       </div>
					   
					   <div class="form-group" id="footer_section" style="display: none;">
                            <label for="cal_event_info" class="col-md-4 control-label"><label for="email">Section</label></label>
                            <div class="col-md-5">
							<select class="form-control" name="footer_sections" id="footer_sections">
                                 <option value="about" <?php if($menu_data->footer_section == "about"){ echo 'selected'; }?>>About</option>
								 <option value="events" <?php if($menu_data->footer_section == "events"){ echo 'selected'; }?>>Events</option>
								 <option value="quick links" <?php if($menu_data->footer_section == "quick links"){ echo 'selected'; }?>>Quick Links</option>
							</select>	 
                            </div>
                        </div>
                        
				  <div class="form-group">

                            <label for="cal_testimonial_info" class="col-md-4 control-label"><label for="status">Status</label></label>

                            <div class="col-md-8">

                               <select class="form-control" name="status" id="status">

                                   

                            <option value="1" <?php  if(isset($menu_data) && $menu_data != ''){ if($menu_data->status == 1){ echo "selected"; } }?> >Active</option>

							 <option value="0" <?php  if(isset($menu_data) && $menu_data != ''){ if($menu_data->status == 0){ echo "selected"; } }?> >Inactive</option>

                               

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
$.noConflict();

jQuery(document).ready(function(){
	var type = jQuery("input[name='type']:checked").val();
	
	if(type == 'footer'){
		jQuery('#footer_section').show();
	}else{
		jQuery('#footer_section').hide();
	}
	
	jQuery('#footer').click(function(){

        jQuery('#footer_section').show();
    });
	
	jQuery('#header').click(function(){

        jQuery('#footer_section').hide();
    });
});
</script>   
