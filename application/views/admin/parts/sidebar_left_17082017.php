<?php 

$session_data = $this->session->userdata('admin_user');
$user_session_data['id'] = $session_data['id'];
$user_session_data['username'] = $session_data['admin_username'];
$user_session_data['user_type_id'] = $session_data['admin_user_type_id'];
$user_image_file = $session_data['user_image_file'];
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
                <p>Hello, <?php if(isset($username)){ echo $username;} ?></p>
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

            <?php if($user_session_data['user_type_id'] == '1') { //for admin user ?> 
            <li class="treeview <?php if(isset($page) && $page == 'user') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>User</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'user_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/user_list">
                        <i class="fa fa-angle-double-right"></i> User List</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'add_user') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/add_user">
                        <i class="fa fa-angle-double-right"></i> Add User </a>
                    </li>
					<li <?php if(isset($main_page) && $main_page == 'student_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/user/student_list">
                        <i class="fa fa-angle-double-right"></i> Student Manager</a>
                    </li>
                </ul>
            </li>
            <?php }?>
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'assignment') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Assignment</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'assignment_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/assignment/assignment_list">
                        <i class="fa fa-angle-double-right"></i> Assignment List</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'add_assignment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/assignment/add_assignment">
                        <i class="fa fa-angle-double-right"></i> Add Assignment </a>
                    </li>
					<li <?php if(isset($main_page) && $main_page == 'student_assignment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/assignment/student_assignment">
                        <i class="fa fa-angle-double-right"></i> Student Assignment </a>
                    </li>
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
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'study_material') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Study Material</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'assignment_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/study_material/study_material_list">
                        <i class="fa fa-angle-double-right"></i> Study Material List</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'add_assignment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/study_material/add_study_material">
                        <i class="fa fa-angle-double-right"></i> Add Study Material </a>
                    </li>
					
                </ul>
            </li>

            <?php }?>
			
				<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
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
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
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
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
				<li class="treeview <?php if(isset($page) && $page == 'faq') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>FAQ</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					  
					  <li <?php if(isset($main_page) && $main_page == 'add_faq') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/faq/add_faq">
                        <i class="fa fa-angle-double-right"></i>Add FAQ </a>
					 
                      <li <?php if(isset($main_page) && $main_page == 'manage_faq') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/faq/manage_faq">
                        <i class="fa fa-angle-double-right"></i>Manage FAQ </a>
					  </li>
                   
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
				<li class="treeview <?php if(isset($page) && $page == 'nationality') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Nationality</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					  
					  <li <?php if(isset($main_page) && $main_page == 'add_nationality') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/nationality/add_nationality">
                        <i class="fa fa-angle-double-right"></i>Add Nationality </a>
					 
                      <li <?php if(isset($main_page) && $main_page == 'manage_nationality') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/nationality/manage_nationality">
                        <i class="fa fa-angle-double-right"></i>Manage Nationality </a>
					  </li>
                   
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'page') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Page</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'page') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/page/add_page">
                        <i class="fa fa-angle-double-right"></i>Add Page</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_page') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/page/manage_page">
                        <i class="fa fa-angle-double-right"></i>Manage page </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			

			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'quiz') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>MCQ Exam</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'quiz') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/quiz/add_quiz">
                        <i class="fa fa-angle-double-right"></i>Add MCQ Exam</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_quiz') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/quiz/manage_quiz">
                        <i class="fa fa-angle-double-right"></i>Manage MCQ Exam </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'question') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Question</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'question') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/question/add_question">
                        <i class="fa fa-angle-double-right"></i>Add Question</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_question') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/question/manage_question">
                        <i class="fa fa-angle-double-right"></i>Manage Question </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'results') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Results</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li <?php if(isset($main_page) && $main_page == 'result_list') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/student_result/result_list">
                        <i class="fa fa-angle-double-right"></i>Result List </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '3') { //for admin user and faculty ?> 
            <li class="treeview <?php if(isset($page) && $page == 'session') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Session</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'session') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/session/add_session">
                        <i class="fa fa-angle-double-right"></i>Add Session</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_session') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/session/manage_session">
                        <i class="fa fa-angle-double-right"></i>Manage Session </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <li class="treeview <?php if(isset($page) && $page == 'event') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>News And Event</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'event') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/event/add_event">
                        <i class="fa fa-angle-double-right"></i>Add News And Event</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_event') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/event/manage_event">
                        <i class="fa fa-angle-double-right"></i>Manage News And Event </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <li class="treeview <?php if(isset($page) && $page == 'course_coverage') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Course Coverage</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'course_coverage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/course_coverage/add_coverage">
                        <i class="fa fa-angle-double-right"></i>Add Course Coverage</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_course_coverage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/course_coverage/manage_course_coverage">
                        <i class="fa fa-angle-double-right"></i>Manage Course Coverage </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <li class="treeview <?php if(isset($page) && $page == 'ip_competition') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Ip Competition Law</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'ip_competition') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/ip_competition/add_competition">
                        <i class="fa fa-angle-double-right"></i>Add Competition</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_course_coverage') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/ip_competition/manage_ip_competition">
                        <i class="fa fa-angle-double-right"></i>Manage Competition </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			<?php //if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <!--<li class="treeview <?php //if(isset($page) && $page == 'news') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>News And Announcement</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php //if(isset($main_page) && $main_page == 'news') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/news/add_news">
                        <i class="fa fa-angle-double-right"></i>Add News</a>
                    </li>
                    <li <?php //if(isset($main_page) && $main_page == 'manage_news') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/news/manage_news">
                        <i class="fa fa-angle-double-right"></i>Manage News </a>
                    </li>
     
                </ul>
            </li>-->

            <?php //}?>
			
              <?php if($user_session_data['user_type_id'] == '1') { //for admin user   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'course') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Course</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'add_course') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/course/add_course">
                        <i class="fa fa-angle-double-right"></i>Add Course Page </a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_course') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/course/manage_course">
                        <i class="fa fa-angle-double-right"></i>Manage Course Page</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            
			 <?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '7') { //for admin user   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'source_information') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Source of Information</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'add_source') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/source_information/add_source">
                        <i class="fa fa-angle-double-right"></i>Add source Info </a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_source') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/source_information/manage_source">
                        <i class="fa fa-angle-double-right"></i>Manage source Info</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
			
			<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '7') { //for admin user   ?> 
            <li class="treeview <?php if(isset($page) && $page == 'source_registration') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Source of Registration</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'manage_source_registration') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/source_registration/manage_source_registration">
                        <i class="fa fa-angle-double-right"></i>Manage source Reg.</a>
                    </li>
                </ul>
            </li>
            <?php } ?>
			
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
           <li class="treeview <?php if(isset($page) && $page == 'forum') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Forum</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'forum') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/forum/add_topic">
                        <i class="fa fa-angle-double-right"></i>Add Topic</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'manage_topic') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/forum/manage_topic">
                        <i class="fa fa-angle-double-right"></i>Manage Topic </a>
                    </li>
					<li <?php if(isset($main_page) && $main_page == 'manage_comment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/forum/manage_comment">
                        <i class="fa fa-angle-double-right"></i>Manage Comment </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
			
    <?php //if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <!--<li class="treeview <?php //if(isset($page) && $page == 'announcement') {?> active <?php //}?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Announcement</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php //if(isset($main_page) && $main_page == 'announcement') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/announcement/add_announcement">
                        <i class="fa fa-angle-double-right"></i>Add Announcement</a>
                    </li>
                    <li <?php //if(isset($main_page) && $main_page == 'mannage_announcement') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/announcement/manage_announcement">
                        <i class="fa fa-angle-double-right"></i>Manage Announcement </a>
                    </li>
     
                </ul>
            </li>-->

            <?php //}?>
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
            <li class="treeview <?php if(isset($page) && $page == 'slider') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Slider</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
					<li <?php if(isset($main_page) && $main_page == 'add_slider') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/slider/add_slider">
                        <i class="fa fa-angle-double-right"></i>Add Slider</a>
                    </li>
                   					
					  <li <?php if(isset($main_page) && $main_page == 'manage_slider') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/slider/manage_slider">
                        <i class="fa fa-angle-double-right"></i>Manage Slider </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
		<?php if($user_session_data['user_type_id'] == '1' or $user_session_data['user_type_id'] == '2') { //for admin user  ?> 
            <li class="treeview <?php if(isset($page) && $page == 'payment') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Payments</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   <li <?php if(isset($main_page) && $main_page == 'add_payment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/payment/add_payment">
                        <i class="fa fa-angle-double-right"></i>Add Payment</a>
                    </li>
                    <li <?php if(isset($main_page) && $main_page == 'mannage_payment') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/payment/manage_payment">
                        <i class="fa fa-angle-double-right"></i>Manage Payment </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
					
		<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
           <li class="treeview <?php if(isset($page) && $page == 'report') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Reports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<li <?php //if(isset($main_page) && $main_page == 'report') {?> class="active" <?php //}?>>
                        <a href="<?php //echo base_url(); ?>admin/announcement/add_announcement">
                        <i class="fa fa-angle-double-right"></i>Add Announcement</a>
                    </li>-->
                   <li <?php if(isset($main_page) && $main_page == 'payment_report') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/report/payment_report">
                        <i class="fa fa-angle-double-right"></i>Payment Report </a>
                    </li>
					
                    <li <?php if(isset($main_page) && $main_page == 'registration_report') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/report/registration_report">
                        <i class="fa fa-angle-double-right"></i>Registration Report </a>
                    </li>
     
                </ul>
            </li>

            <?php }?>
			
						
		<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
           <li class="treeview <?php if(isset($page) && $page == 'admin_setting') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                   
                    <li <?php if(isset($main_page) && $main_page == 'admin_setting') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/setting/admin_setting">
                        <i class="fa fa-angle-double-right"></i>Manage Settings </a>
                    </li>
					
                </ul>
            </li>

            <?php }?>
			
			<?php if($user_session_data['user_type_id'] == '1') { //for admin user  ?> 
           <li class="treeview <?php if(isset($page) && $page == 'testimonial') {?> active <?php }?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Testimonial</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?php if(isset($main_page) && $main_page == 'testimonial') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/announcement/add_announcement">
                        <i class="fa fa-angle-double-right"></i>Add Announcement</a>
                    </li>
                  
					
					<li <?php if(isset($main_page) && $main_page == 'add_testimonial') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/testimonial/add_testimonial">
                        <i class="fa fa-angle-double-right"></i>Add Testimonial</a>
                    </li>
                   					
					  <li <?php if(isset($main_page) && $main_page == 'manage_testimonial') {?> class="active" <?php }?>>
                        <a href="<?php echo base_url(); ?>admin/testimonial/manage_testimonial">
                        <i class="fa fa-angle-double-right"></i>Manage Testimonial </a>
                    </li>
     
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