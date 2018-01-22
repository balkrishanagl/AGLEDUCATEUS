<?php 

$session_data = $this->session->userdata('admin_user');
$user_session_data['id'] = $session_data['id'];
$user_session_data['username'] = $session_data['admin_username'];
$user_session_data['name'] = $session_data['name'];
$user_session_data['user_type_id'] = $session_data['admin_user_type_id'];
$user_image_file = $session_data['user_image_file'];

$user_access_data = array();

$user_access_data = $this->user_model->getUserAccessList($user_session_data['user_type_id']);

//echo "<pre>"; print_r($user_access_data); echo "</pre>";die;
$user_access_data_array = array();
	foreach($user_access_data as $user_access){
	$user_access_data_array[] = $user_access->page_name;
	}
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
              <?php if(isset($user_image_file) && $user_image_file!='')
							{?>
                               <img src="<?php echo base_url();?>uploads/adminuser/<?php echo $user_image_file;?>" height="100" width="100"/>
							<?php }
							else{ ?>
								<img src="<?php echo base_url();?>uploads/adminuser/no_image.jpg"/>
							<?php } ?>    </div>
            <div class="pull-left info">
                <p>Hello, <?php echo $user_session_data['name']; ?></p>
                <p>User Type : <?php echo get_user_type_name($user_session_data['user_type_id']);?></p>

                <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li <?php if(isset($page) && $page == 'dashboard') {?> class="active" <?php }?>>
                <a href="<?php echo base_url();?>admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php //if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '7') { //for admin user 
				if(in_array('user_list',$user_access_data_array) || in_array('add_user',$user_access_data_array)) {
			?> 
            <li class="treeview <?php if(isset($page) && $page == 'user') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('user_list',$user_access_data_array) || in_array('add_user',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'user_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/user_list">
                        <i class="fa fa-angle-double-right"></i> User List</a>
                    </li>
				<?php }?>	
				<?php if(in_array('add_user',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_user') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/add_user">
                        <i class="fa fa-angle-double-right"></i> Add User </a>
                    </li>
				<?php } ?>
				
				<?php if(in_array('add_user',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_user') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/manage_role">
                        <i class="fa fa-angle-double-right"></i> Manage Role </a>
                    </li>
				<?php } ?>
				
					<!--<li <?php //if(isset($main_page) && $main_page == 'student_list') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/user/student_list">
                        <i class="fa fa-angle-double-right"></i> Student Manager</a>
                    </li>-->
                </ul>
            </li>
            <?php }?>
			
			<?php if(in_array('menu_list',$user_access_data_array) || in_array('add_menu',$user_access_data_array)) { ?>
            <li class="treeview <?php if(isset($page) && $page == 'manage_menu') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Menu</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('menu_list',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_menu') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/menu/manage_menu">
                        <i class="fa fa-angle-double-right"></i> Menu List</a>
                    </li>
				<?php } ?>
				<?php if(in_array('add_menu',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_menu') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/menu/add_menu">
                        <i class="fa fa-angle-double-right"></i> Add Menu </a>
                    </li>
				<?php } ?>
					<!--<li <?php //if(isset($main_page) && $main_page == 'student_list') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/user/student_list">
                        <i class="fa fa-angle-double-right"></i> Student Manager</a>
                    </li>-->
                </ul>
            </li>
            <?php }?>
			
			<?php if(in_array('manage_client',$user_access_data_array) || in_array('add_client',$user_access_data_array) || in_array('relation_list',$user_access_data_array) || in_array('add_relation',$user_access_data_array)) { ?>
            <li class="treeview <?php if(isset($page) && $page == 'client') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Client</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('manage_client',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_client') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/client/manage_client">
                        <i class="fa fa-angle-double-right"></i> Client List</a>
                    </li>
				<?php } ?>
				<?php if(in_array('add_client',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_menu') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/client/add_client">
                        <i class="fa fa-angle-double-right"></i> Add Client </a>
                    </li>
				<?php } ?>
				
				<?php if(in_array('relation_list',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_menu') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/client/relation_list">
                        <i class="fa fa-angle-double-right"></i> Relation List</a>
                    </li>
				<?php } ?>
				
				<?php if(in_array('add_relation',$user_access_data_array)) { ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_menu') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/client/add_relation">
                        <i class="fa fa-angle-double-right"></i> Add Relation</a>
                    </li>
				<?php } ?>
					
                </ul>
            </li>
            <?php }?>
			
			
			<?php if(in_array('manage_history',$user_access_data_array) || in_array('add_educatus_history',$user_access_data_array)) { ?>
            <li class="treeview <?php if(isset($page) && $page == 'educatus_history') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Educatus history</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('manage_history',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_history') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/history/manage_history">
                        <i class="fa fa-angle-double-right"></i> History</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('add_educatus_history',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_history') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/history/add_history">
                        <i class="fa fa-angle-double-right"></i> Add History </a>
                    </li>
				<?php } ?>	
                </ul>
            </li>
            <?php }?>
			
			
			<?php //if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <!--<li class="treeview <?php //if(isset($page) && $page == 'study_material') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Study Material</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php //if(isset($main_page) && $main_page == 'assignment_list') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/study_material/study_material_list">
                        <i class="fa fa-angle-double-right"></i> Study Material List</a>
                    </li>
                    <li <?php //if(isset($main_page) && $main_page == 'add_assignment') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/study_material/add_study_material">
                        <i class="fa fa-angle-double-right"></i> Add Study Material </a>
                    </li>
					
                </ul>
            </li>-->

            <?php //}?>
			
			<?php //if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '7') { //for admin user and faculty ?> 
            <!--<li class="treeview <?php// if(isset($page) && $page == 'study_material') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Study Material</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php //if(isset($main_page) && $main_page == 'assignment_list') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/study_material/study_material_list">
                        <i class="fa fa-angle-double-right"></i> Study Material List</a>
                    </li>
                    <li <?php //if(isset($main_page) && $main_page == 'add_assignment') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/study_material/add_study_material">
                        <i class="fa fa-angle-double-right"></i> Add Study Material </a>
                    </li>
					
                </ul>
            </li>-->

            <?php //}?>

			
			<?php if(in_array('manage_city',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($main_page) && $main_page == 'manage_city') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>City</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
				
				 <ul class="treeview-menu">
                    					
					<li <?php if(isset($main_page) && $main_page == 'manage_city') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/city/manage_city">
                        <i class="fa fa-angle-double-right"></i> Manage City</a>
                    </li>
                   
                </ul>
				
                
            </li>

            <?php }?>
			
				<?php if(in_array('subscriber_list',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($page) && $page == 'subscriber') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Subscriber</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'subscriber_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/subscriber/subscriber_list">
                        <i class="fa fa-angle-double-right"></i> Subscriber List</a>
                    </li>
                   
                </ul>
            </li>

            <?php }?>
			
				<?php if(in_array('city_exhibition_register_list',$user_access_data_array) || in_array('online_register_list',$user_access_data_array) || in_array('exhibitior_register_list',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($page) && $page == 'registeration') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Registration</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('city_exhibition_register_list',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'city_exhibition_register_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/register/city_exhibition_register_list">
                        <i class="fa fa-angle-double-right"></i> City Registration List</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('online_register_list',$user_access_data_array)){ ?>
					<li <?php if(isset($main_page) && $main_page == 'online_register_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/register/online_register_list">
                        <i class="fa fa-angle-double-right"></i> Online Registration List</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('exhibitior_register_list',$user_access_data_array)){ ?>
					<li <?php if(isset($main_page) && $main_page == 'exhibitior_register_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/register/exhibitior_register_list">
                        <i class="fa fa-angle-double-right"></i> Exhibitor Registration List</a>
                    </li>
				<?php } ?>	
                   
                </ul>
            </li>

            <?php }?>
			
		<?php if(in_array('manage_gallery',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($page) && $page == 'gallery') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Gallery</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'manage_gallery') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/gallery/manage_gallery">
                        <i class="fa fa-angle-double-right"></i> Gallery List</a>
                    </li>
                   
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('enquiry_list',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($page) && $page == 'enquiry') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Enquiry</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'enquiry_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/enquiry/enquiry_list">
                        <i class="fa fa-angle-double-right"></i> Enquiry List</a>
                    </li>
                   
                </ul>
            </li>

            <?php }?>
			
			<?php //if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
				<!--<li class="treeview <?php //if(isset($page) && $page == 'category') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					  
					  <li <?php //if(isset($main_page) && $main_page == 'add_category') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/category/add_category">
                        <i class="fa fa-angle-double-right"></i>Add Category </a>
					 
                      <li <?php //if(isset($main_page) && $main_page == 'manage_category') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/category/manage_category">
                        <i class="fa fa-angle-double-right"></i>Manage Category </a>
					  </li>
                   
                </ul>
            </li>-->

            <?php //}?>
			
			<?php if(in_array('manage_faq',$user_access_data_array) || in_array('add_faq',$user_access_data_array)) { ?> 
				<li class="treeview <?php if(isset($page) && $page == 'faq') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>FAQ</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					  <?php if(in_array('add_faq',$user_access_data_array)){ ?>
					  <li <?php if(isset($main_page) && $main_page == 'add_faq') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/faq/add_faq">
                        <i class="fa fa-angle-double-right"></i>Add FAQ </a>
					 </li>
					  <?php } ?>
					  <?php if(in_array('manage_faq',$user_access_data_array)){ ?>
                      <li <?php if(isset($main_page) && $main_page == 'manage_faq') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/faq/manage_faq">
                        <i class="fa fa-angle-double-right"></i>Manage FAQ </a>
					  </li>
					  <?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php //if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '7') { //for admin user and faculty ?> 
            <!--<li class="treeview <?php //if(isset($page) && $page == 'manage_fees') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Course Fee Manager</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php //if(isset($main_page) && $main_page == 'add_fees') {?> class="active" <?php//}?>>
                        <a href="<?php //echo base_url(); ?>admin/fees/add_fees">
                        <i class="fa fa-angle-double-right"></i>Add Course Fee</a>
                    </li>
                    <li <?php //if(isset($main_page) && $main_page == 'manage_fees') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/fees/manage_fees">
                        <i class="fa fa-angle-double-right"></i>Manage Course Fee </a>
                    </li>
     
                </ul>
            </li>-->

            <?php //}?>
			
			<?php if(in_array('manage_page',$user_access_data_array) || in_array('add_page',$user_access_data_array)) { ?> 
            <li class="treeview <?php if(isset($page) && $page == 'page') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Page</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('add_page',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'page') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/page/add_page">
                        <i class="fa fa-angle-double-right"></i>Add Page</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('manage_page',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_page') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/page/manage_page">
                        <i class="fa fa-angle-double-right"></i>Manage page </a>
                    </li>
				<?php } ?>	
     
                </ul>
            </li>

            <?php }?>
			

					
			<?php if(in_array('manage_event',$user_access_data_array) || in_array('add_event',$user_access_data_array)) { ?> 
            <li class="treeview <?php if(isset($page) && $page == 'event') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Exhibition</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('add_event',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'event') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/event/add_event">
                        <i class="fa fa-angle-double-right"></i>Add Exhibition</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('manage_event',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_event') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/event/manage_event">
                        <i class="fa fa-angle-double-right"></i>Manage Exhibition </a>
                    </li>
				<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_news',$user_access_data_array) || in_array('add_news',$user_access_data_array)) { ?> 
            <li class="treeview <?php if(isset($page) && $page == 'news') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>News</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('manage_news',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_news') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/news/add_news">
                        <i class="fa fa-angle-double-right"></i>Add News</a>
                    </li>
				<?php } ?>	
				<?php if(in_array('add_news',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_news') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/news/manage_news">
                        <i class="fa fa-angle-double-right"></i>Manage News </a>
                    </li>
				<?php } ?>	
     
                </ul>
            </li>

            <?php }?>
		
              <?php if(in_array('manage_course',$user_access_data_array) || in_array('add_course',$user_access_data_array)) {   ?> 
				<li class="treeview <?php if(isset($page) && $page == 'course') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Course</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('add_course',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_course') {?> class="active" <?php }?>>
                        <a href="<?php //echo base_url(); ?>admin/course/add_course">
                        <i class="fa fa-angle-double-right"></i>Add Course Page </a>
                    </li>
				<?php } ?>	
				<?php if(in_array('manage_course',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_course') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/course/manage_course">
                        <i class="fa fa-angle-double-right"></i>Manage Course Page</a>
                    </li>
				<?php } ?>	
                </ul>
            </li>
            <?php } ?>
			
			 <?php if(in_array('manage_source',$user_access_data_array) || in_array('add_source',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'source_information') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Source of Information</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
				<?php if(in_array('add_source',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'add_source') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/source_information/add_source">
                        <i class="fa fa-angle-double-right"></i>Add source Info </a>
                    </li>
				<?php } ?>	
				<?php if(in_array('manage_source',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'manage_source') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/source_information/manage_source">
                        <i class="fa fa-angle-double-right"></i>Manage source Info</a>
                    </li>
				<?php } ?>	
                </ul>
            </li>
            <?php } ?>
  
			<?php if(in_array('manage_slider',$user_access_data_array) || in_array('add_slider',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'slider') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Slider</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_slider',$user_access_data_array)){ ?>
					<li <?php if(isset($main_page) && $main_page == 'add_slider') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/slider/add_slider">
                        <i class="fa fa-angle-double-right"></i>Add Slider</a>
                    </li>
                   	<?php } ?>	
					<?php if(in_array('manage_slider',$user_access_data_array)){ ?>					
					  <li <?php if(isset($main_page) && $main_page == 'manage_slider') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/slider/manage_slider">
                        <i class="fa fa-angle-double-right"></i>Manage Slider </a>
                    </li>
					<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_participat_collage',$user_access_data_array) || in_array('add_participat_collage',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'participat_collage') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Participat Collages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_participat_collage',$user_access_data_array)){ ?>		
					<li <?php if(isset($main_page) && $main_page == 'add_participat_collage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/participat_collage/add_participat_collage">
                        <i class="fa fa-angle-double-right"></i>Add Participat Collage</a>
                    </li>
                   	<?php } ?>	
					<?php if(in_array('manage_participat_collage',$user_access_data_array)){ ?>					
					  <li <?php if(isset($main_page) && $main_page == 'manage_participat_collage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/participat_collage/manage_participat_collage">
                        <i class="fa fa-angle-double-right"></i>Manage Participat Collage </a>
                    </li>
					<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_dream_collage',$user_access_data_array) || in_array('add_dream_collage',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'dream_collage') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Dream Collages</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_dream_collage',$user_access_data_array)){ ?>					
					
					<li <?php if(isset($main_page) && $main_page == 'add_dream_collage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/dream_collage/add_dream_collage">
                        <i class="fa fa-angle-double-right"></i>Add Dream Collage</a>
                    </li>
                   	<?php } ?>	
					<?php if(in_array('manage_dream_collage',$user_access_data_array)){ ?>										
					  <li <?php if(isset($main_page) && $main_page == 'manage_dream_collage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/dream_collage/manage_dream_collage">
                        <i class="fa fa-angle-double-right"></i>Manage Dream Collage </a>
                    </li>
					<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_universities',$user_access_data_array) || in_array('add_universities',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'universities') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Universities</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_universities',$user_access_data_array)){ ?>										
					<li <?php if(isset($main_page) && $main_page == 'add_universities') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/universities/add_universities">
                        <i class="fa fa-angle-double-right"></i>Add University</a>
                    </li>
                   	<?php } ?>	
					<?php if(in_array('manage_universities',$user_access_data_array)){ ?>															
					  <li <?php if(isset($main_page) && $main_page == 'manage_universities') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/universities/manage_universities">
                        <i class="fa fa-angle-double-right"></i>Manage Universities </a>
                    </li>
					<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_email_template',$user_access_data_array) || in_array('add_email_template',$user_access_data_array) || in_array('send_bulk_email',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'email_template') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Email Template</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_email_template',$user_access_data_array)){ ?>															
					<li <?php if(isset($main_page) && $main_page == 'add_template') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/email_template/add_template">
                        <i class="fa fa-angle-double-right"></i>Add Template</a>
                    </li>
                   	<?php } ?>	
					
					<?php if(in_array('manage_email_template',$user_access_data_array)){ ?>															
					  <li <?php if(isset($main_page) && $main_page == 'manage_email_templates') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/email_template/manage_email_templates">
                        <i class="fa fa-angle-double-right"></i>Manage Template </a>
                    </li>
					<?php } ?>
					
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('send_bulk_email',$user_access_data_array) || in_array('bulk_email_history',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'bulk') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Bulk Email</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('send_bulk_email',$user_access_data_array)){ ?>															
					<li <?php if(isset($main_page) && $main_page == 'send_bulk_email') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/bulk/send_bulk_email">
                        <i class="fa fa-angle-double-right"></i>Send Bulk Email</a>
                    </li>
                   	<?php } ?>	
					
					<?php if(in_array('bulk_email_history',$user_access_data_array)){ ?>															
					  <li <?php if(isset($main_page) && $main_page == 'bulk_email_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/bulk/bulk_email_history">
                        <i class="fa fa-angle-double-right"></i>Email History </a>
                    </li>
					<?php } ?>
					
                </ul>
            </li>

            <?php }?>

			<?php if(in_array('manage_help',$user_access_data_array) || in_array('add_help',$user_access_data_array)) {   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'help') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Help</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if(in_array('add_help',$user_access_data_array)){ ?>															
					<li <?php if(isset($main_page) && $main_page == 'add_help') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/help/add_help">
                        <i class="fa fa-angle-double-right"></i>Add Help</a>
                    </li>
                   	<?php } ?>	
					
					<?php if(in_array('manage_help',$user_access_data_array)){ ?>															
					  <li <?php if(isset($main_page) && $main_page == 'manage_help') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/help/manage_help">
                        <i class="fa fa-angle-double-right"></i>Manage Help </a>
                    </li>
					<?php } ?>
                </ul>
            </li>

            <?php }?>
			  
	
		<?php if(in_array('manage_counselor',$user_access_data_array) || in_array('add_counselor',$user_access_data_array)) {   ?> 
           <li class="treeview <?php if(isset($page) && $page == 'counselor') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Counselor</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                 <?php if(in_array('add_counselor',$user_access_data_array)){ ?>															
					<li <?php if(isset($main_page) && $main_page == 'add_counselor') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/counselor/add_counselor">
                        <i class="fa fa-angle-double-right"></i>Add Counselor</a>
                    </li>
				 <?php } ?>		
				
				<?php if(in_array('manage_counselor',$user_access_data_array)){ ?>
					  <li <?php if(isset($main_page) && $main_page == 'manage_counselor') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/counselor/manage_counselor">
                        <i class="fa fa-angle-double-right"></i>Manage Counselor </a>
                    </li>
				<?php } ?>
                </ul>
            </li>

            <?php }?>
			
			<?php if(in_array('manage_testimonial',$user_access_data_array) || in_array('add_testimonial',$user_access_data_array)) {   ?> 
           <li class="treeview <?php if(isset($page) && $page == 'testimonial') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Testimonial</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                 <?php if(in_array('add_testimonial',$user_access_data_array)){ ?>
					<li <?php if(isset($main_page) && $main_page == 'add_testimonial') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/testimonial/add_testimonial">
                        <i class="fa fa-angle-double-right"></i>Add Testimonial</a>
                    </li>
				 <?php } ?>		
				
				 <?php if(in_array('manage_testimonial',$user_access_data_array)){ ?>
					  <li <?php if(isset($main_page) && $main_page == 'manage_testimonial') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/testimonial/manage_testimonial">
                        <i class="fa fa-angle-double-right"></i>Manage Testimonial </a>
                    </li>
				 <?php } ?>
                </ul>
            </li>

            <?php }?>
			
						
		<?php if(in_array('admin_setting',$user_access_data_array)) {   ?> 
           <li class="treeview <?php if(isset($page) && $page == 'admin_setting') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <?php if(in_array('admin_setting',$user_access_data_array)){ ?>
                    <li <?php if(isset($main_page) && $main_page == 'admin_setting') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/setting/admin_setting">
                        <i class="fa fa-angle-double-right"></i>Manage Settings </a>
                    </li>
				   <?php } ?>
                </ul>
            </li>

            <?php }?>
			
			
			
			<?php //if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <!--<li class="treeview <?php //if(isset($page) && $page == 'exam') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Exam</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<li <?php //if(isset($main_page) && $main_page == 'exam') {?> class="active" <?php //}?>>
                        <a href="<?php// echo base_url(); ?>admin/announcement/add_announcement">
                        <i class="fa fa-angle-double-right"></i>Add Announcement</a>
                    </li>-->
                  
					
					<!--<li <?php //if(isset($main_page) && $main_page == 'add_exam') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/exam/add_exam">
                        <i class="fa fa-angle-double-right"></i>Add Exam</a>
                    </li>
                   					
					  <li <?php //if(isset($main_page) && $main_page == 'manage_exam') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/exam/manage_exam">
                        <i class="fa fa-angle-double-right"></i>Manage Exam </a>
                    </li>
     
                </ul>
            </li>-->

            <?php //}?>
			
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                </ul>
            </li> -->
            <!-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="badge pull-right bg-red">3</small>
                </a>
            </li> -->
            <!-- <li>
                <a href="pages/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="badge pull-right bg-yellow">12</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                    <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                    <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                    <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                    <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                    <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                    <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                </ul>
            </li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>