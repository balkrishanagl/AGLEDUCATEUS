<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		
		if($session_data['admin_user_type_id']==2 or $session_data['admin_user_type_id']==3){
			redirect('admin/dashboard');
		}
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('user_model');
		$this->load->model('student_model');
		$this->load->model('source_model');
		$this->load->model('fees_model');
		$this->load->model('session_model');
		$this->load->model('city_model');
		$this->load->library('email');
		
	}

	function user_list()
	{
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			//echo '<pre>'; print_r($session_data); die;

		    $header['main_page'] = 'user_list';
		    $header['tab'] = 'user';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'user';
		    $sidebar['main_page'] = 'user_list';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'user_list';
			
			if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
				 $data['all_user_list'] = $this->user_model->get_all_user_list();
			}else{
				 $data['all_user_list'] = $this->user_model->get_user_by_parent_list($session_data['id']);
			}

		   

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/user/user_list',$data);
			$this->load->view('admin/parts/footer',$footer);
		
	}

	function add_user()
	{
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_user';
		    $header['tab'] = 'user';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'user';
		    $sidebar['main_page'] = 'add_user';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_user';

		    $data['all_user_type'] = $this->user_model->get_all_user_type_list();
		    $data['city_data'] = $this->city_model->getAllActiveCityList();
			
			$this->form_validation->set_rules('name','Name','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email|is_unique[admin_user.email]');
			$this->form_validation->set_rules('phone','Phone Number','trim|required|callback_validate_phone_number');
			$this->form_validation->set_rules('user_type','User Type','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('city','User City','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('address','Address','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('pincode','Pincode','strip_tags|trim|required|xss_clean');
			
			if($_SERVER['REQUEST_METHOD']=='POST')
			  {
				  $password = $this->generatePassword();
				  if($this->form_validation->run())
				  {
					  $data_for_insert = array(
						'username'=>$this->input->post('email'),
						'name'=>$this->input->post('name'),
						'email'=>$this->input->post('email'),
						'password'=>MD5($password),
						'city'=>$this->input->post('city'),
						'phone'=>$this->input->post('phone'),
						'address'=>$this->input->post('address'),
						'pincode'=>$this->input->post('pincode'),
						'parent_user_id'=>$session_data['id'],
						'user_type_id'=>$this->input->post('user_type')
						);

					$this->user_model->insert_user_data($data_for_insert);	
					
					/*  Mail to user */
							
							$toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Login Details!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $this->input->post('name');
							$email_data['username'] = $this->input->post('email');
							$email_data['password'] = $password;

							$messageU = $this->load->view('site/email/login_detail',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
					
					$this->session->set_flashdata('success', 'You have added user successfully.');
					redirect('admin/user/user_list/');
				
				  }else{
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/user/add_user',$data);
						$this->load->view('admin/parts/footer',$footer);
				  }
				  
			  }else{
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/user/add_user',$data);
					$this->load->view('admin/parts/footer',$footer);
			  }
			
			
		
	}

	function edit_user($id = NULL)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		if($id == NULL)
		{
			redirect('user/user_list');
		}
		$session_data = $this->session->userdata('admin_user');
	    $data['username'] = $session_data['admin_username'];

	    $header['main_page'] = 'edit_user';
	    $header['tab'] = 'user';
	    $header['username'] =  $data['username'];

	    $sidebar['main_page'] = 'edit_user';
		$sidebar['username'] =  $data['username'];
	    
	    $footer['main_page'] = 'edit_user';
		
		
		 
	    $data['user_data'] = $this->user_model->get_user_data_by_id($id);

	    $data['all_user_type'] = $this->user_model->get_all_user_type_list();
		$data['city_data'] = $this->city_model->getAllActiveCityList();
		
		
			
	    
		if($_SERVER['REQUEST_METHOD']=='POST')
	    {
			
			$uEmail = $this->input->post('email');
			$uName = $this->input->post('username');
			$uId = $this->input->post('user_id');
			
			$adUserEmail = $this->user_model->getAdminUserByEmail($uEmail,$uId);
			$adUser = $this->user_model->getAdminUserByUsername($uName,$uId);
			
			if(sizeof($adUserEmail)>0)
			{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[admin_user.email]');
			}
			else
			{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			}
			
			
			$this->form_validation->set_rules('name','Name','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('phone','Phone Number','trim|required|callback_validate_phone_number');
			$this->form_validation->set_rules('user_type','Select User Type','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('city','Select User City','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('address','Address','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('pincode','Pincode','strip_tags|trim|required|xss_clean');
			
			if($this->form_validation->run())
		    {
				$data_for_update = array(
				'username'=>$this->input->post('email'),
						'name'=>$this->input->post('name'),
						'email'=>$this->input->post('email'),
						'city'=>$this->input->post('city'),
						'phone'=>$this->input->post('phone'),
						'address'=>$this->input->post('address'),
						'pincode'=>$this->input->post('pincode'),
						'user_type_id'=>$this->input->post('user_type'),
						'update_datetime' => date('Y-m-d H:i:s')
				);
				
				$this->user_model->update_user_data($data_for_update,$id);	
				
				$this->session->set_flashdata('success', 'You have updated user successfully.');
				redirect('admin/user/user_list/');

			}else{
				
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/user/edit_user',$data);
				$this->load->view('admin/parts/footer',$footer);
			}
		}else{
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/user/edit_user',$data);
			$this->load->view('admin/parts/footer',$footer);
		}
		
		
	}
	
	
	function student_list()
	{
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'student_list';
		    $header['tab'] = 'user';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'user';
		    $sidebar['main_page'] = 'student_list';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'user_list';

		    $data['all_user_list'] = $this->student_model->get_student_list_manager();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/student/student_list',$data);
			$this->load->view('admin/parts/footer',$footer);
		
	}
	

	function edit_student($id = NULL)
	{
		if($id == NULL)
		{
			redirect('user/user_list');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		
		$session_data = $this->session->userdata('admin_user');
		
	    $data['username'] = $session_data['admin_username'];

	    $header['main_page'] = 'edit_student';
		$header['tab'] = 'user';
		$header['username'] =  $data['username'];
        
	    $sidebar['main_page'] = 'edit_student';
	    $sidebar['username'] =  $data['username'];
	    
	    $footer['main_page'] = 'edit_user';

	    $data['type_id'] = $this->student_model->get_user_type($id);
		$data['options'] = $this->student_model->get_options($id);
		//echo "<pre>"; print_r($data['options']); echo "</pre>"; die;
		$data['source_data'] =  $this->source_model->get_source_detail();
	    $data['user_data'] = $usrDt = $this->student_model->get_student_data_by_id($id);
		//echo $usrDt->course_fee; die;
		$data['coursefees'] = $usrDt->course_fee;
		//echo "<pre>"; print_r($data['user_data']); die;
	    $sesInfo = '';
	    if(isset($usrDt->sourceinformation)){
		    $this->session->set_userdata(array(
	                            'source_information' => $usrDt->sourceinformation,
	                    ));
			$sesInfo = $this->session->userdata('source_information');
		}
		$data['country_list'] = $this->user_model->getCountryList();
		$data['state_list'] = $this->user_model->getStateByCountryID($data['user_data']->country);
		$data['city_list'] = $this->user_model->getCityByStateID($data['user_data']->state);
	    $data['all_user_type'] = $this->user_model->get_all_user_type_list(1);
		$data['user_type'] = $this->fees_model->getAllFees();
		$data['country'] = $this->user_model->getCountry();
		
		
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				
				$stEmail = $this->input->post('student_email');
				$userName = $this->input->post('username');
				
				$resEmail = $this->student_model->getRecordByEmail($stEmail,$id);
				$resUser = $this->student_model->getRecordByUsername($userName,$id);
				//echo "<pre>"; print_r($result); die;
				
			// validations 
			if(sizeof($resEmail)>0)
			{
				$this->form_validation->set_rules('student_email', 'Email', 'required|valid_email|is_unique[users.email]');
			}
			else
			{
				$this->form_validation->set_rules('student_email', 'Email', 'required|valid_email');
			}
			if(sizeof($resUser)>0)
			{
				$this->form_validation->set_rules('username', 'Username', 'strip_tags|trim|required|xss_clean|is_unique[users.username]|callback_alpha_dash_username');
			}
			else
			{
				$this->form_validation->set_rules('username', 'Username', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_username');
			}
			//$this->form_validation->set_rules('student_password', 'Password', 'required');
			
			$this->form_validation->set_rules('student_name', 'First Name', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_space[first_name]');
			
			$this->form_validation->set_rules('student_fathername', 'Father Name', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_space[father_name]');
			$this->form_validation->set_rules('student_gender', 'Gender', 'strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('student_dob', 'DOB', 'strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('student_address', 'Address', 'strip_tags|trim|required|xss_clean');
			//$this->form_validation->set_rules('student_type', 'User Type', 'required');
			//$this->form_validation->set_rules('student_country', 'Country', 'required');
			$this->form_validation->set_rules('source_information', 'Source Of Information', 'required');
			//$this->form_validation->set_rules('student_state', 'State', 'required');
			//$this->form_validation->set_rules('student_city', 'City', 'required');
			//$this->form_validation->set_rules('student_postalcode', 'Pin Code', 'required');
			$this->form_validation->set_rules('student_mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[15]');
			$this->form_validation->set_rules('student_nationality', 'Nationality', 'required');
			$this->form_validation->set_rules('student_amobile', 'Alternate Mobile', '');
			$this->form_validation->set_rules('student_aemail', 'Alternate Email', '');
			$this->form_validation->set_rules('student_website', 'Student Website', '');
			
			if($this->input->post('student_type') == 4 ){
				$this->form_validation->set_rules('student_course', 'Student Course', 'required|callback_alpha_dash_space[course_name]');
				$this->form_validation->set_rules('student_course_year', 'Student Course Year', 'required');
				$this->form_validation->set_rules('student_collegename', 'Student Collage', 'required|callback_alpha_dash_space[college_name]');
				$this->form_validation->set_rules('student_collegeaddress', 'Student Collage Address', 'required');
			}else{
				
				$this->form_validation->set_rules('st_orgname', 'Organization Name', 'required|callback_alpha_dash_space[org_name]');
				$this->form_validation->set_rules('designation', 'Designation', 'required|callback_alpha_dash_space[designation]');
				$this->form_validation->set_rules('st_orgaddress', 'Organization Address', 'required');
			}
			
			if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			}
			
	

			//create error array
			$error_arr = array();
		
			// Displaying Errors In Div
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				
				
			
            $user_id = $this->input->post('user_id');
		    //$password = $this->input->post('student_password');
			if ($this->form_validation->run() == FALSE){
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/student/edit_student',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			$data_for_update = array(
				'first_name' => $this->input->post('student_name'),
				//'last_name' => $this->input->post('student_lastname'),
				'father_name' => $this->input->post('student_fathername'),
				'gender' => $this->input->post('student_gender'),
				'dob' => $this->input->post('student_dob'),
				//'email' => $this->input->post('student_email'),
				'permanent_address' => $this->input->post('student_address'),
				'correspondence_address' => $this->input->post('student_caddress'),
				//'postal_code' => $this->input->post('student_postalcode'),
				'mobile_number' => $this->input->post('student_mobile'),
				'contact_number' => $this->input->post('student_amobile'),
				//'alternate_email' => $this->input->post('student_aemail'),
				'nationality' => $this->input->post('student_nationality'),
				//'country' => $this->input->post('student_country'),
				//'state' => $this->input->post('student_state'),
				//'city' => $this->input->post('student_city'),
				//'website' => $this->input->post('student_website'),
				'sourceinformation' => $this->input->post('source_information'),
				'st_qualification' => $this->input->post('student_qualification'),
				
				);
				
			if($this->input->post('student_type') == 4){
						$data_for_update['about_course'] = $this->input->post('student_course');
						$data_for_update['course_year'] = $this->input->post('student_course_year');
						$data_for_update['college_name'] = $this->input->post('student_collegename');
						$data_for_update['college_address'] = $this->input->post('student_collegeaddress');
					}else{
						
						$data_for_update['organization'] = $this->input->post('st_orgname');
						$data_for_update['designation'] = $this->input->post('designation');
						$data_for_update['organisation_address'] = $this->input->post('st_orgaddress');
						
			}	
			
			if($this->input->post('source_detail')!= null){
							
					$data_for_update['source_detail'] = $this->input->post('source_detail');
			}else{
				
					$data_for_update['source_detail'] = "";
			}
			
			/*if($password != NULL) 
			{
				$data_for_update['password'] = MD5($password);
			}*/
			
			/* Update Count */
			
			$soi_id = $this->input->post('source_information');
			if($sesInfo==$soi_id){ }else{
				$updateCountSoi = $this->source_model->updateCountSoi($soi_id);
				$decrsCountSoi = $this->source_model->decrsCountSoi($sesInfo);
			}
			/* Update Count */

			$user_data = array('email' => $this->input->post('student_email'),'username' => $this->input->post('username'), 'user_type_id' => $this->input->post('student_type'));
			//echo '<pre>'; print_r($user_data); die;
			//echo $id; echo "<br>"; echo $user_id; die;
			$this->student_model->update_student_data($data_for_update,$user_id);	
			$this->student_model->update_user_data($user_data,$id);	
			
			//after successful submission
				$this->session->set_flashdata('success', 'You have Updated Records successfully.');
				redirect('admin/user/student_list');
			
			}
			
			
			}
			else {
						
		$this->load->view('admin/parts/header',$header);
		$this->load->view('admin/parts/sidebar_left',$sidebar);
		$this->load->view('admin/student/edit_student',$data);
		$this->load->view('admin/parts/footer',$footer);
			}
	
	}
	
	// Delete Student list by Id --Manoj Sharma
	function delete_student($id=null,$sts=null)
	{
		if($id!=null){
			$stsArr = array('activated'=>$sts);
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$res = $this->student_model->delStudent($id,$stsArr);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have change status successfully.');
				redirect('admin/user/student_list');
			}
		} else {
			redirect('admin/user/student_list');
		}
		
	}
	
	function manage_role()
	{
    		$session_data = $this->session->userdata('admin_user');
			//echo "<pre>"; print_r($session_data); echo "</pre>"; die;
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_role';
		    $header['tab'] = 'user';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'user';
		    $sidebar['main_page'] = 'manage_role';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_role';

		    $data['allUserType'] = $this->user_model->get_all_user_type_list(1);

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/role/manage_role',$data);
			$this->load->view('admin/parts/footer',$footer);
		
	}
	
	function edit_role($id = NULL)
	{
		if($id == NULL)
		{
			redirect('admin/user/user_list');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		
		$session_data = $this->session->userdata('admin_user');
		
	    $data['username'] = $session_data['admin_username'];

	    $header['main_page'] = 'edit_role';
		$header['tab'] = 'user';
		$header['username'] =  $data['username'];
        
	    $sidebar['main_page'] = 'edit_role';
	    $sidebar['username'] =  $data['username'];
	    
	    $footer['main_page'] = 'edit_role';
		
		$data['id'] = $id;
	    $data['page_access_list'] = $this->user_model->getPageAccessList();
		$data['user_access_list'] = $this->user_model->getUserAccessList($id);
	

			if($_SERVER['REQUEST_METHOD']=='POST'){
				//delete old access
				$this->user_model->deleteUserPageAccessData($id);
				
				//insert new access
				for($i=0;$i<count($_POST['page_access']);$i++){
					
					$data_insert = array(
						'user_type_id' => $id,
						'page_access_id' => $_POST['page_access'][$i],
						'status' => 1,
						'created' => date('Y-m-d H:i:s')
					);
					$this->user_model->addUserPageAccess($data_insert);
				}
				
				//after successful submission
				$this->session->set_flashdata('success', 'You have update page access successfully.');
				redirect('admin/user/manage_role');
			} else {
						
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/role/edit_role',$data);
			$this->load->view('admin/parts/footer',$footer);
			}
	
	}
	
	// Delete Student list by Id --Manoj Sharma
	function delete_role($id=null)
	{
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->student_model->delRole($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted role successfully.');
				redirect('user/manage_role');
			}
		} else {
			redirect('user/manage_role');
		}
		
	}
	
	function delete_user($id=null){
		if($id!=null){
			$delete = $this->user_model->delete_user($id);
			if($id==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted user successfully.');
				redirect('admin/user/user_list');
			}
		}
	}
	
	
	function download_csv()
	{
		
		//$clientTable = $this->Client_model->create_table_name($clientId);
		
		if(!empty($_POST))
		{
			
		
		
		$from = $this->input->post('payment_from');
		$to = $this->input->post('payment_to');	
		//echo $from."<br>";
		//echo $to."<br>";
		$temp = true;
		if($from!='' && $to!='' && $to < $from)
		{
			$this->session->set_userdata('date_error_msg','End date should be greater than Start date');
			$this->session->set_userdata('from',$from);
			$this->session->set_userdata('to',$to);
			$temp = false;
		}
		if($from=='' && $to!='')
		{
			$this->session->set_userdata('date_error_msg','Please select start date');
			$this->session->set_userdata('from',$from);
			$this->session->set_userdata('to',$to);
			$temp = false;
		}
		
		$fromDate = date('Y-m-d',strtotime($from));
		$toDate = date('Y-m-d',strtotime($to));
		$time = date('H:i:s');
		//echo $fromDate.'<br/>';
			if($temp)
			{
				$this->session->unset_userdata('from',$from);
				$this->session->unset_userdata('to',$to);
				$toDte = $toDate.' '.$time; 
				//echo $toDte; die;
				$this->load->dbutil();
				$this->load->helper('file');
				$this->load->helper('download');
				//echo ("select * from ".$clientTable." where created >= '".$fromDate."' AND created <= '".$toDte."'"); die;
				if($from!='' && $to!='')
				$query = $this->db->query("select user_profiles.*,users.username,users.email,users.created,users.user_type_id,users.activated,users.payment_id from users join user_profiles ON users.id=user_profiles.user_id  where users.created >= '".$fromDate."' AND users.created <= '".$toDate."'");
				if($from!='' && $to=='')
				$query = $this->db->query("select user_profiles.*,users.username,users.email,users.created,users.user_type_id,users.activated,users.payment_id from users join user_profiles ON users.id=user_profiles.user_id  where users.created >= '".$fromDate."'");
				if($from=='' && $to=='')
					$query = $this->db->query("select user_profiles.*,users.username,users.email,users.created,users.user_type_id,users.activated,users.payment_id from users join user_profiles ON users.id=user_profiles.user_id");
			
				$delimiter = ",";
				$newline = "\r\n";
				$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
				echo force_download('CSV_Report.csv', $data); die;
			}
			else
			{
				$this->load->library('user_agent');
				if ($this->agent->is_referral())
				{
					redirect($this->agent->referrer());
				}
			}
		}
				//$status='success';
				//$msg='Email Sent Successfully';
	}
	
	
	// Download user data in Excel Format Method
	
	public function download_excel(){
      // get data from databse
      $data = $this->student_model->getdata();
       $this->load->helper('download');
       $this->load->library('PHPReport');
      $template = 'userdata.xlsx';
      //set absolute path to directory with template files
      $templateDir =$_SERVER['DOCUMENT_ROOT'].'/ficci/uploads/tmp/';

      //set config for report
      $config = array(
        'template' => $template,
        'templateDir' => $templateDir
      );


      //load template
      $R = new PHPReport($config);

      $R->load(array(
              'id' => 'student',
              'repeat' => TRUE,
              'data' => $data   
          )
      );
      
	  //echo"<pre>"; print_r($data); die;
      // define output directoy 
      $output_file_dir = $_SERVER['DOCUMENT_ROOT'].'/ficci/uploads/';
     

      $output_file_excel = $output_file_dir  . "userdata.xlsx";
      //download excel sheet with data in /tmp folder
      $result = $R->render('excel', $output_file_excel);
	  
	 $name = 'userdata.xlsx'; 
	 $data1 = file_get_contents($output_file_dir.'/userdata.xlsx');
	  header("Content-Type: application/vnd.ms-excel");
     // header("Content-Disposition: attachment; filename=\"$filename\"");
	 force_download($name,$data1);
     }
	 
	function sendEmail($to,$from,$subject,$message){
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from($from,$this->config->item('Site_name'));
		$this->email->subject($subject);
		$this->email->message($message);
				
		if($this->email->send()){
			return true;
		}else{
			return false;
			
		}
	}
	/* function generatePassword() 
	{
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$password = array(); 
		$alpha_length = strlen($alphabet) - 1; 
		for ($i = 0; $i < 8; $i++) 
		{
			$n = rand(0, $alpha_length);
			$password[] = $alphabet[$n];
		}
		return implode($password); 
	} */
	
	function alpha_dash_space($str,$field) {
		
		//if( ! preg_match("/^([-a-z_ ])+$/i", $str)){ 
		if( ! preg_match("/^[ A-Za-z.]*$/", $str)){ 
		
			if($field == "first_name"){
				$this->form_validation->set_message('alpha_dash_space', 'First Name Field Should Be Valid');
			}elseif($field == "father_name"){
				$this->form_validation->set_message('alpha_dash_space', 'Father Name Field Should Be Valid');
			}elseif($field == "course_name"){
				$this->form_validation->set_message('alpha_dash_space', 'Course Name Field Should Be Valid');
			}elseif($field == "college_name"){
				$this->form_validation->set_message('alpha_dash_space', 'College Name Field Should Be Valid');
			}elseif($field == "org_name"){
				$this->form_validation->set_message('alpha_dash_space', 'Organization Name Field Should Be Valid');
			}elseif($field == "designation"){
				$this->form_validation->set_message('alpha_dash_space', 'Designation Field Should Be Valid');
			}
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	
	function alpha_dash_username($str) {
		
		//if( ! preg_match("/^([-a-z_ ])+$/i", $str)){ 
		if( ! preg_match("/^[ A-Za-z0-9.]*$/", $str)){ 
			$this->form_validation->set_message('alpha_dash_username', 'User Name Field Should Be Valid');
		
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	
	function _validate_phone_number($value) {
		$value = trim($value);
		$match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/';
		$replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
		$return = '($1) $2-$3';
		if (preg_match($match, $value)) {
			return preg_replace($replace, $return, $value);
		} else {
			$this->form_validation->set_message('_validate_phone_number', 'Invalid Phone.');
		return false;
		}
	}
	
	function generatePassword(){
		
		$numeric = str_shuffle(str_repeat('0123456789',5));
		$password = substr($numeric, 0, 5);
		
		
		return $password;
	}
	
	
}
