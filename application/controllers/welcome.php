<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		/* $this->load->model('user_model');
		$this->load->model('student_model');
		$this->load->model('page_model');
		$this->load->model('news_event_model');
		$this->load->model('course_model');
		$this->load->model('setting_model');
		$this->load->model('testimonial_model');
		$this->load->model('slider_model');
		$this->load->model('subscriber_model');
		$this->load->model('ip_services_model');
		$this->load->model('news_model');
		$this->load->model('key_features_model');
		$this->load->model('setting_model');
		$this->load->model('course_coverage_model');
		$this->load->model('ip_competition_model');
		$this->load->model('testimonial_model');
		$this->load->library('form_validation');
		$this->load->model('source_model');
		$this->load->model('fees_model');
		$this->load->model('session_model');
		$this->load->model('quiz_model'); */
		$this->load->model('slider_model');
		$this->load->model('gallery_model');
		$this->load->model('testimonial_model');
		$this->load->model('faq_model');
		$this->load->model('help_model');
		$this->load->model('participating_colleges_model');
		$this->load->model('page_model');
		$this->load->model('news_event_model');
	}

	function index()
	{
		
		// if (!$this->tank_auth->is_logged_in()) {
		// 	redirect('/auth/login/');
		// } else {
		// 	$data['user_id']	= $this->tank_auth->get_user_id();
		// 	$data['username']	= $this->tank_auth->get_username();
		// 	$this->load->view('welcome', $data);
		// }
		/* $data['slider_details'] = $this->slider_model->get_slider_detail();
		$data['testimonial_data'] =	$this->testimonial_model->get_testimonial_detail();
		$data['about_data'] =  $this->page_model->get_front_page_data('ficci');
		$data['course_page_data'] =  $this->course_model->get_all_page();
		$data['course_coverage'] =  $this->course_coverage_model->get_coverage_home_page();
		$data['ip_competition'] =  $this->ip_competition_model->get_competition_home_page();
		$data['home_data'] =  $this->page_model->get_front_page_data('home');
		$data['event_data'] =  $this->news_event_model->get_event_detail_front();
		
		$curr_session = $this->session_model->getSessionByCurrentDate();	
		
		if(sizeof($curr_session) > 0){
			$data['registration_start'] = $curr_session->register_start_on;
			$data['registration_end'] = $curr_session->register_end_on;
		}
		$data['course_data'] =  $this->course_model->get_course_detail();
		$data['testimonial_data'] =  $this->testimonial_model->get_testimonial_front();*/
		
		$data['slider_details'] = $this->slider_model->get_slider_detail();
		$data['gallery_details'] = $this->gallery_model->getGalleryByType('image');
		$data['testimonial_data'] =	$this->testimonial_model->get_testimonial_detail();
		$data['faq'] = $this->faq_model->getActiveFaq(3);
		$data['help_data'] =	$this->help_model->get_help_detail();
		$data['participating_colleges'] =	$this->participating_colleges_model->get_collage_detail_front(10);
		$data['about_data'] =  $this->page_model->get_front_page_data('about');
		$data['event_data'] =  $this->news_event_model->get_event_detail_front();
			
		
		$this->load->view('site/parts/header');
		$this->load->view('site/main', $data);
		$this->load->view('site/parts/footer');
	}

	
	//Manage user login - Balkrishan
	function user_login(){
		//echo "Test"; die;
		if($this->session->userdata('site_user'))
    	{
    		redirect('student/user_dashboard', 'refresh');
    	}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$data = array();
		
		// Retrieve session data
		$session_set_value = $this->session->all_userdata();

		// Check for remember_me data in retrieved session data
		/*if (isset($session_set_value['remember_me']) && $session_set_value['remember_me'] == "1") {
			redirect('student/user_dashboard');
		
		} else {*/
			
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			 $username = $this->input->post('username');
			 $password = $this->input->post('password');

			
			
			$result = $this->user_model->user_login($username, $password);
			//print_r($result); die;
			if(count($result)>0){
				
				//set remember me
				/*$remember = $this->input->post('remember_me');
				if($remember==1){
					$this->session->set_userdata("remember_me", true);
				}*/
				
				//create session for logged in user
				$this->session->set_userdata('site_user' , array('user_id' => $result->id,
							'username' => $result->username,
							'email' => $result->email,
							'user_type_id' => $result->user_type_id,
							'payment_id' => $result->payment_id,
							'payment_status' => $result->payment_status,
							'course_fee' => $result->course_fee,
							'logged_in' => true,
							'user_type' => 'site')
					);
				
				redirect('student/user_dashboard');
			} else {
				//echo "1";
				//exit();
				$this->session->set_flashdata('error', 'Username/Password does not exist.');
				redirect('welcome/user_login');
			}
		} else {
			$this->load->view('site/parts/header');
			$this->load->view('site/user_login');
			$this->load->view('site/parts/footer');
		}
	//}
	}
	
	//Manage user forget username - Balkrishan
	function user_forget_username(){
		//mail('balkrishan.vyas@adglobal360.com','Hi','Hello');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$data = array();
			
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			$email = $this->input->post('email');
			
			$result = $this->user_model->getUserByEmail($email);
			
			if($result==true){
				$subject = "FICCI - Forget Username";
				$data['email'] = $email;
				$data['site_name'] = 'FICCI';
				$result_username = $this->user_model->getStudentUsernameByEmail($email);
				$data['username'] = $result_username->username;
				$message = $this->load->view('site/email/forget_username',$data, true);
				
				$this->sendEmail($email, $subject, $message);
				echo "0";
				
			} else {
				echo "1";
				
				//$this->session->set_flashdata('error', 'Username/Password does not exist.');
				//redirect('welcome/user_login');
			}
		}
	}
	
	//Manage user forget password - Balkrishan
		function user_forget_password(){
		
		if($this->session->userdata('site_user'))
    	{
    		redirect('student/user_dashboard', 'refresh');
    	}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$data = array();
			
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			$email = $this->input->post('email');
			
			$result = $this->user_model->getUserByEmail($email);
			
						
			if($result==true){
				$subject = "Your account access information - Helpdesk";
				$data['email'] = $email;
				$data['site_name'] = $this->config->item('Sete_name');
				
				$result = $this->user_model->getStudentUsernameByEmail($email);
				$userId = $result->id;
				$userProfile = $this->student_model->getStudentData($userId);
				
				$data['name'] = $userProfile->first_name." ".$userProfile->last_name;
				
				$random_number = rand();
				$data['password'] = $random_number;
								
				//update data to user
				$updateData = array(
					'password' => md5($random_number),
					
				);
				
				$message = $this->load->view('site/email/forget_password',$data, true);
				
				$this->sendEmail($email, $subject, $message);
				
				$this->user_model->updateStudentDataByEmail($updateData,$email);
				
					$this->session->set_flashdata('success', 'Password have been sent to your email id.');
					redirect('/welcome/user_login', 'refresh');
				
			} else {
					$this->session->set_flashdata('error', 'Email Id not found.');
					//redirect('/welcome/user_login', 'refresh');
					redirect('/forget-password', 'refresh');
			}
		}else{
				$this->load->view('site/parts/header');
				$this->load->view('site/forget_password');
				$this->load->view('site/parts/footer');
		}
	}
	
	//function to reset password - Balkrishan
	function reset_password(){
		
		if($this->session->userdata('site_user')){
			
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$data = array();
			
			/* $this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_password', 'Password Confirmation', 'required|matches[password]'); */
			
			// Displaying Errors In Div
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
			//Working with form post data
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				
				/* if ($this->form_validation->run() == FALSE){
					$this->load->view('site/parts/header');
					$this->load->view('site/reset_password',$data);
					$this->load->view('site/parts/footer');
				} else { */
					
					//echo "Now Test"; die;
					
					$session_data = $this->session->userdata('site_user');
					$user_id = $session_data['user_id'];
					
					$password = $this->input->post('user_password');
					
					
					//update user password
					$update_data = array(
						'password' => md5($password),
						'activated' => 1,
						'modified' => date('Y-m-d H:i:s'),
					);
					$update = $this->user_model->update_user($user_id,$update_data);
					
					
					$this->session->set_flashdata('success', 'You have successfully reset your password');
					$this->session->unset_userdata('site_user');
					redirect('welcome/user_login');
					
				//}
				} else {
				$this->load->view('site/parts/header');
				$this->load->view('site/reset_password',$data);
				$this->load->view('site/parts/footer');
			} 
		}else{
			
			$this->session->set_flashdata('error', 'You are not varified for this url.');
			redirect('welcome/user_login');
		}
		
	}
	
	private function set_upload_options()
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = './assets/uploads/documents/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}
	
	//Manage use registration - Balkrishan
	function user_registration()
	{
		$currDate = date('Y-m-d');
		
		$curr_session = $this->session_model->getSessionByCurrentDate();	
		
		//if(sizeof($curr_session) > 0){

		//if($currDate >= $curr_session->register_start_on && $currDate <= $curr_session->register_end_on){
			
			
		
		//echo '<pre>'; print_r($session); die;
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['sourceData'] = $this->source_model->get_source_detailFront();
		$data['fees'] = $this->fees_model->getAllFees();
		
		$error_arr = array();
		
		$data['country'] = $this->user_model->getCountry();
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			
			$sessionStartMonth =  "";
			$sessionEndMonth =  "";
			$sessionYear =  "";
			
			$dob = date_create($this->input->post('student_dob'));
			$dob = date_format($dob,"Y-m-d");
			
			//$isDuplicateRecord = $this->user_model->chkDuplicateUser($this->input->post('uName'));
			$this->form_validation->set_rules('uName','Username','is_unique[users.username]');
			$this->form_validation->set_rules('user_email','Email','valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('user_nationality','Nationality','required');
			$this->form_validation->set_rules('source_information','Source Of information','required');
			$this->form_validation->set_rules('student_dob','Date of birth','required');
			
			if($this->input->post('rdUserType') == 4){
				
				$this->form_validation->set_rules('courseYear','Course Year','required');
			
			}
			
			if( $this->input->post('rdUserType') ==4){
				if (empty($_FILES['stu_card']['name']))
				{
					$this->form_validation->set_rules('stu_card','Id Card','required');
				}
			}
			
			if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			}
			
			if($this->form_validation->run())
			{
				
				//$dt = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
								
				/* $dob = date_create($this->input->post('student_dob'));
				echo $dob; die; */
				
				$documents = '';
				if($_FILES['myfiles']['name'][0])
				{
					$config['upload_path'] = './uploads/documents/';
					$config['allowed_types'] = 'pdf|docs|doc';
					$config['max_size']      = 500; 
					
					$this->load->library('upload', $config);
					$dataInfo = array();
					$files = $_FILES;
					$cpt = count($_FILES['myfiles']['name']);
					$this->upload->initialize($config);
					$docs = '';
					for($i=0; $i<$cpt; $i++)
					{        
						//echo $files['myfiles']['name'][$i];
						$_FILES['myfiles']['name']= $files['myfiles']['name'][$i];
						$_FILES['myfiles']['type']= $files['myfiles']['type'][$i];
						$_FILES['myfiles']['tmp_name']= $files['myfiles']['tmp_name'][$i];
						$_FILES['myfiles']['error']= $files['myfiles']['error'][$i];
						$_FILES['myfiles']['size']= $files['myfiles']['size'][$i];    

						//$this->upload->initialize($this->set_upload_options());
						//$this->upload->do_upload();
						//$dataInfo[] = $this->upload->data();
						if ( ! $this->upload->do_upload('myfiles'))
						{ 
					
							$output = array('error' => $this->upload->display_errors()); 
							$error_arr[] = $output['error']."(Document)";
							$temp = false;
						} 
						else 
						{
							$dataInfo[] = $this->upload->data(); 
							$docs .=$dataInfo[$i]['file_name'].",";
						}
						
					}
					$documents = rtrim($docs,','); 
				}
				
				/* =============== ID Card Upload ==================== */
				
					 
					$dataCard = '';	
					if($_FILES['stu_card']['name']!='')
					{
						
						$config1['upload_path'] = './uploads/stu_card/';
						$config1['allowed_types'] = 'jpg|png|gif|JPEG';
						$config1['max_size']      = 200; 
						$this->load->library('upload', $config1);
						$this->upload->initialize($config1);
						if ( ! $this->upload->do_upload('stu_card'))
						{ 
							
							$output = array('error' => $this->upload->display_errors()); 
							$error_arr[] = $output['error']."(Id Card)";
							$temp = false;
						} 
						else 
						{
							$dataIdCard = array('upload_data' => $this->upload->data()); 
							$dataCard = $dataIdCard['upload_data']['file_name'];
						}
						
					}
					//echo "<pre>"; print_r($_FILES);
					//echo "<pre>"; print_r($dataIdCard['upload_data']['file_name']);	die;
					
				if(count($error_arr)>0){
				
						
					if(isset($error_arr)){
						$data['file_error'] = $error_arr;
						
						
							$this->load->view('site/parts/header',$data);
							$this->load->view('site/user_registration');
							$this->load->view('site/parts/footer');
												
					}
				}else{
						
						
						$password = $this->input->post('user_password');
						$name = $this->input->post('user_fname');
						$idate = date('Y-m-d H:i:s');
						$effectiveDate = date('Y-m-d H:i:s',strtotime("+48 hours", strtotime($idate)));
						$userData = array(
							'username' => $this->input->post('uName'),
							'password' => md5($this->input->post('user_password')),
							'email' => $this->input->post('user_email'),
							'user_type_id' => $this->input->post('rdUserType'),
							'activated' => 1,
							'banned' => 0,
							'ban_reason' => '',
							'last_ip' => '',
							'created' => date('Y-m-d H:i:s'),
							'reminder_mail_time' => $effectiveDate,
						);
						
						$session = $this->session_model->getSessionByCurrentDate();
						
						if(sizeof($session) >0){
							
							$session_id = $session->id;
							$userData['session_id'] = $session_id;
							
							$sessionStartMonth =  date("F", strtotime($session->start_on));
							$sessionEndMonth =  date("F", strtotime($session->end_on));
							$sessionYear =  date("Y", strtotime($session->end_on));
						}
						
						$user_insert_id = $this->user_model->addUserData($userData);
						
						$this->load->model('source_model');
						$this->source_model->updateCountSoi($this->input->post('source_information'));
						
						$userData1 = array(
							'user_id' => $user_insert_id,
							'first_name' => $this->input->post('user_fname'),
							'father_name' => $this->input->post('user_fathername'),
							'gender' => $this->input->post('rdGender'),
							'dob' => $dob,
							'documents' => $documents,
							'id_card' => $dataCard,
							'permanent_address' => $this->input->post('permanent_add'),
							'correspondence_address' => $this->input->post('correspondence_add'),
							'mobile_number' => $this->input->post('mob_no'),
							'contact_number' => $this->input->post('contact_no'),
							'course_fee' => $this->input->post('course_fee'),
							'nationality' => $this->input->post('user_nationality'),
							'qualification' => $this->input->post('rdQualification'),
							'sourceinformation' => $this->input->post('source_information'),
							
						);
						
						
						if($this->input->post('courseName')!= null){
							$userData1['about_course'] = $this->input->post('courseName');
						}
						
						if($this->input->post('courseYear')!= null){
							$userData1['course_year'] = $this->input->post('courseYear');
						}
						
						if($this->input->post('collageName')!= null){
							$userData1['college_name'] = $this->input->post('collageName');
						}
						
						if($this->input->post('collegeAddress')!= null){
							$userData1['college_address'] = $this->input->post('collegeAddress');
						}
						
						if($this->input->post('compnayName')!= null){
							$userData1['organization'] = $this->input->post('compnayName');
						}
						
						if($this->input->post('designation')!= null){
							$userData1['designation'] = $this->input->post('designation');
						}
						
						if($this->input->post('companyAddress')!= null){
							$userData1['organisation_address'] = $this->input->post('companyAddress');
						}
						
						if($this->input->post('source_detail')!= null){
							
							$userData1['source_detail'] = $this->input->post('source_detail');
						}
						
						$insert_id = $this->user_model->addUserProfile($userData1);
						
						$subject =  $this->config->item('Site_name')."- New User Registration";
						$data['email'] = $this->input->post('user_email');
						$data['site_name'] = $this->config->item('Site_name');
						$result = $this->user_model->getUserByLastId($user_insert_id);
						$data['name'] = $name;
						$data['username'] = $result->username;
						$data['password'] = $password;
						$data['sessionStartMonth'] = $sessionStartMonth;
						$data['sessionEndMonth'] = $sessionEndMonth;
						$data['sessionYear'] = $sessionYear;
						$message = $this->load->view('site/email/welcome',$data, true);
						
						$this->sendEmail($data['email'], $subject, $message);
						
						//after successful submission
						$this->session->set_flashdata('success', 'You have registered successfully.');
						redirect('/welcome/user_login', 'refresh');
			}
				
			}
			else
			{
				
				$this->load->view('site/parts/header',$data);
				$this->load->view('site/user_registration');
				$this->load->view('site/parts/footer');
			}
		
		}
		else{
				
		$this->load->view('site/parts/header',$data);
		$this->load->view('site/user_registration');
		$this->load->view('site/parts/footer');
		}
		
	/* }else{
		
		redirect('welcome');
	} */
//}
		
				
	
	}
	
	function thankyou()
	{
		
		
		if($this->session->userdata('site_user'))
    	{
    		redirect('welcome/user_login', 'refresh');
    	}
		$this->load->view('site/parts/header');
		$this->load->view('site/thankyou');
		$this->load->view('site/parts/footer');
	}
	
	//Manage use user profile - Manoj Sharma
	function user_profile($id=Null)
	{
	
		$data['setting_data'] = $this->setting_model->getSettingData();
		$data['user_details'] = $this->user_model->listFrontUser($id);
		
		//echo '<pre>'; print_r($data['user_details']); die;
		
		$data['sourceData'] = $this->source_model->get_source_detail();
	
		
		//load required helper, library
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//fetch required data
	
		$data['user_type'] = $this->user_model->get_all_user_type_list(2);
		
		//Set rules for form validation
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
	
		
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			
			//$dt = $this->input->post('year').'-'.$this->input->post('month').'-'.$this->input->post('date');
			
			//$dob = date('Y-m-d', strtotime($dt)); 
			
			$dob = date_create($this->input->post('student_dob'));
			$dob = date_format($dob,"Y-m-d");
			
			$this->form_validation->set_rules('user_nationality','Nationality','required');
			$this->form_validation->set_rules('source_information','Source Of information','required');
			$this->form_validation->set_rules('student_dob','Date of birth','required');
			
			if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			}
				
			
			if($this->form_validation->run())
			{
					
					$dataImg = '';	
					if($_FILES['user_image']['name']!='')
					{
						
						$config['upload_path'] = './uploads/user_image/';
						$config['allowed_types'] = 'jpg|png|gif|JPEG';
						$config1['max_size']      = 200;
						$this->load->library('upload', $config);
						//$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('user_image'))
						{ 
							
							$output['error'] = array('error' => $this->upload->display_errors()); 
							$error_arr[] = $output['error']."(User Profile Picture)";
							$temp = false;
						} 
						else 
						{
							$dataimg = array('upload_data' => $this->upload->data()); 
							$dataImg = $dataimg['upload_data']['file_name'];
						}
						
					}
					
				if(count($error_arr)>0){
				
						
					if(isset($error_arr)){
						$data['file_error'] = $error_arr;
						
							$this->load->view('site/parts/header',$data);
							$this->load->view('site/user_profile',$data);
							$this->load->view('site/parts/footer');
												
					}
				}else{	
					//echo $dataImg; die;
					$userData1 = array(
						'first_name' => $this->input->post('user_fname'),
						'father_name' => $this->input->post('user_fathername'),
						'gender' => $this->input->post('rdGender'),
						'dob' => $dob,
						'permanent_address' => $this->input->post('permanent_add'),
						'correspondence_address' => $this->input->post('correspondence_add'),
						'mobile_number' => $this->input->post('mob_no'),
						'contact_number' => $this->input->post('contact_no'),
						'nationality' => $this->input->post('user_nationality'),
						'qualification' => $this->input->post('rdQualification'),
						'sourceinformation' => $this->input->post('source_information'),
						'user_image_file' => $dataImg,
						
					);
					
						if($this->input->post('source_detail')!= null){
							
							$userData1['source_detail'] = $this->input->post('source_detail');
						}else{
							$userData1['source_detail'] = "";
						}
					
					
					$this->user_model->UpdateUserProfile($userData1,$id);
					
					
				
					//after successful submission
					$this->session->set_flashdata('success', 'You have Updated Profile successfully.');
					redirect('student/user_dashboard');
			
				}
			}
			else
			{
				$this->load->view('site/parts/header',$data);
				$this->load->view('site/user_profile',$data);
				$this->load->view('site/parts/footer');
			}
		}else {
				
				$this->load->view('site/parts/header');
				$this->load->view('site/user_profile',$data);
				$this->load->view('site/parts/footer');
			}
	}
	
	//Ajax call for get fee according to user type selected - Balkrishan
	function getUserTypeFee(){
		$type_id = $_POST['type'];
		$result = $this->user_model->getUserTypeFee($type_id);
		echo $result[0]->fees;
	}
	
	//Ajax call for get state list according to country selected - Balkrishan
	function getStateList(){
		$country_id = $_POST['country_id'];
		$result = $this->user_model->getStateByCountryID($country_id);
		$html = '<option value="">-Select State-</option>';
		
		foreach($result as $res){
			$html .= '<option value="'.$res->id.'">'.$res->state_name.'</option>';
		}
		echo $html;
	}
	
	//Ajax call for get City list according to state selected - Balkrishan
	function getCityList(){
		$state_id = $_POST['state_id'];
		$result = $this->user_model->getCityByStateID($state_id);
		$html = '<option value="">-Select City-</option>';
		
		foreach($result as $res){
			$html .= '<option value="'.$res->id.'">'.$res->city_name.'</option>';
		}
		echo $html;
	}
	
	//Check email address
	function checkEmailAddress(){
		$email = $_POST['email'];
			$result = $this->user_model->getUserByEmail($email);
			echo $result;
	}
	
	
	
	function logout(){
		//$this->session->sess_destroy('site_user');
		$this->session->unset_userdata('count');
		$this->session->unset_userdata('site_user');
		redirect('welcome/index');
	}
	
	function subscriber()
	{
		
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
			
					$subscriberData = array(
						
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'number' => $this->input->post('number'),
						
						'created' => date('Y-m-d H:i:s'),
					);
					
					
					$insert_id_subsciber = $this->subscriber_model->addsubscriberData($subscriberData);
					echo "1";
					//after successful submission
					//echo $this->session->set_flashdata('success', 'You have Subscribe successfully.');
					
				
	}
	
	function export_user(){
		
		   $data = $this->user_model->exportUser();
		  // echo '<pre>'; print_r($data); die;
		   $this->load->dbutil();
		   $this->load->helper('file');
		   $this->load->helper('download');
		   $delimiter = ",";
		   $newline = "\r\n";
		   $filename = "register_user.csv";
		   $dataFile = $this->dbutil->csv_from_result($data, $delimiter, $newline);
		   force_download($filename, $dataFile);
		   redirect('admin/report/registration_report');
	}
	
	// Reminder Mail
	
	//function to send email - Balkrishan
	function sendEmail($to, $subject, $message){
		
		//$this->load->library('parser');
		
		//include email library
		$this->load->library('email');
		
		//set email config
		//$config['protocol'] = 'mail';
		$config['mailpath'] = 'text';
		$config['charset'] = 'utf-8';
		//$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
				
		//$config['protocol'] = 'mail';
		//$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;

		//$this->email->initialize($config);
		
		$this->email->from($this->config->item('FromEmail'), $this->config->item('Site_name'));
		$this->email->to($to);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	}

       function show_404()
        {
		
              $data['slider_details'] = $this->slider_model->get_slider_detail();
		//$data['testimonial_data'] =	$this->testimonial_model->get_testimonial_detail();
		$data['about_data'] =  $this->page_model->get_front_page_data('ficci');
		/* $data['course_page_data'] =  $this->course_model->get_all_page();
		$data['course_coverage'] =  $this->course_coverage_model->get_coverage_home_page();
		$data['ip_competition'] =  $this->ip_competition_model->get_competition_home_page(); */
		$data['home_data'] =  $this->page_model->get_front_page_data('home');
		//$data['event_data'] =  $this->news_event_model->get_event_detail_front();
		//echo '<pre>'; print_r($data['event_data']); die;
			
		//echo '<pre>'; print_r($data['copyright']); die;
		//$data['course_data'] =  $this->course_model->get_course_detail();
		$data['testimonial_data'] =  $this->testimonial_model->get_testimonial_front();
		
		
		$this->load->view('site/parts/header');
		$this->load->view('show_404',$data);
		$this->load->view('site/parts/footer');


        }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */