<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class User extends CI_Controller
{
	function __construct()
	{
		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->model('user_model');
		$this->load->model('client_model');
		$this->load->model('news_event_model');
		$this->load->model('course_model');
	}

	/*function _check_login_ajax()
	{
		$user_id = $this->tank_auth->get_user_id();
		
		if(!isset($user_id) || $user_id == NULL)
		{
			return NULL;
		}
		else
		{
			return $user_id;
		}
	}*/
	

	
	function add_user()
	{
		$status = '';
		$msg = '';
		$href = '';
		$response = '';	

		$this->form_validation->set_rules('username','Username','strip_tags|trim|required|xss_clean|is_unique[admin_user.username]|callback_alpha_dash_username');
		$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email|is_unique[admin_user.email]');
		$this->form_validation->set_rules('password','Password','strip_tags|trim|required|xss_clean|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('cpassword','Confirm Password','strip_tags|trim|required|xss_clean|min_length[4]|max_length[12]|matches[password]');
		$this->form_validation->set_rules('user_type','Select User Type','strip_tags|trim|required|xss_clean');


		if($this->form_validation->run())
		{
			$username = $this->form_validation->set_value('username');
			$email = $this->form_validation->set_value('email');
			$password = $this->form_validation->set_value('password');
			$user_type = $this->form_validation->set_value('user_type');

			$data_for_insert = array(
				'username'=>$username,
				'email'=>$email,
				'password'=>MD5($password),
				'user_type_id'=>$user_type
				);

			$this->user_model->insert_user_data($data_for_insert);	
		
			$status='success';
			$msg='User added Successfully';
		}
		else
		{
			$errors = array();
			  // Loop through $_POST and get the keys
			 foreach ($this->input->post() as $key => $value)
			 {
					// Add the error message for this field
					$errors[$key] = form_error($key,' ',' ');
					
					
			 }
			 
			 //$response['errors'] = array_filter($errors); // Some might be empty
			 
			 $response['errors'] = $errors; // Some might be empty
	
			$status = 'error';
			//$msg = validation_errors(' ', ' ');
		}

		echo json_encode(array('status' => $status, 'msg' => $msg,'href'=>$href,'response'=>$response));
	}


	function edit_user()
	{
		$status = '';
		$msg = '';
		$href = '';
		$response = '';	
		
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
			if(sizeof($adUser)>0)
			{
				$this->form_validation->set_rules('username', 'Username', 'strip_tags|trim|required|xss_clean|is_unique[admin_user.username]|callback_alpha_dash_username');
			}
			else
			{
				$this->form_validation->set_rules('username', 'Username', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_username');
			}
			
		$this->form_validation->set_rules('user_id','Username','strip_tags|trim|required|xss_clean');
		/* $this->form_validation->set_rules('username','Username','strip_tags|trim|required|xss_clean|callback_alpha_dash_username');
		$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email'); */
		$this->form_validation->set_rules('password','Password','strip_tags|trim|xss_clean|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('user_type','Select User Type','strip_tags|trim|required|xss_clean');


		if($this->form_validation->run())
		{
			
			$username = $this->form_validation->set_value('username');
			$email = $this->form_validation->set_value('email');
			$password = $this->form_validation->set_value('password');
			$user_type = $this->form_validation->set_value('user_type');
			$user_id = $this->form_validation->set_value('user_id');

			$data_for_update = array(
				'username'=>$username,
				'email'=>$email,
				'user_type_id'=>$user_type,
				'update_datetime' => date('Y-m-d H:i:s')
				);

			if($password != NULL) 
			{
				$data_for_update['password'] = MD5($password);
			}

			$this->user_model->update_user_data($data_for_update,$user_id);	
			
			$session_data = $this->session->userdata('logged_in');
		    $s_data['id'] = $session_data['id'];

			if($s_data['id'] == $user_id)
			{
		        $this->session->set_userdata('admin_username', $username);
			}
			
			$status='success';
			$msg='Update Successfully';
			$href = base_url().'admin/user/user_list';
		}
		else
		{
			$errors = array();
			  // Loop through $_POST and get the keys
			 foreach ($this->input->post() as $key => $value)
			 {
					// Add the error message for this field
					$errors[$key] = form_error($key,' ',' ');
					
					
			 }
			 
			 //$response['errors'] = array_filter($errors); // Some might be empty
			 //echo '<pre>'; print_r($errors); die;
			 $response['errors'] = $errors; // Some might be empty
	
			$status = 'error';
			//$msg = validation_errors(' ', ' ');
		}

		echo json_encode(array('status' => $status, 'msg' => $msg,'href'=>$href,'response'=>$response));
	}
	
	function formData(){
		
		$form_type = $this->input->post('formName');
		
		if($form_type == "Query Form"){
		
				$this->form_validation->set_rules('Name', 'Name', 'trim|required');
				$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('Phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
				$this->form_validation->set_rules('Subject', 'Query Title', 'trim|required');
				$this->form_validation->set_rules('Query', 'Query', 'trim|required');
				$error_arr = array();
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$form_data = json_encode($_POST);
					$data_array = array('fields_data'=>$form_data,'form_type'=>$form_type,'status'=>'1');
					$data_array['created'] = date('Y/m/d  h:m:s');
					$insertData = $this->user_model->saveFormData($data_array);
				}
				if(!empty($insertData)){
				
				/*  Mail to admin  */
					$to = 'ipcourse@ficci.com';
					$from = $this->input->post('Email');
					$subject = "Query ".$this->config->item('Site_name');
					$message = '<p>Dear Admin ,</p><br>';
					$message .= '<p>New lead has been entered. please find below the details :-</p>';
					$message .= '<ul>';
					$data = json_decode($form_data);
					foreach($data as $key=>$value){
						$message .= '<li>'.$key.' :- '.$value.'</li>';
					}
					$message .= '</ul>';
					$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
					if($sendMailAdmin){
						$msg = "Thank you for showing interest.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to admin end */
				
				/*  Mail to user */
					$toU = $this->input->post('Email');
					$fromU = $this->config->item('FromEmail');
					$subject = "Thank you for your query!";
					$data['site_name'] = 'FICCI';
					$data['name'] = $this->input->post('Name');
					$messageU = $this->load->view('site/email/queryform',$data, true);
					$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
					if($sendMailUser){
						$msg = "Thank you for showing interest.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to user */
					
				}
				echo json_encode(array('msg' => $msg));
		
		}elseif($form_type == "Contact Form"){
			
				$this->form_validation->set_rules('Name', 'Name', 'trim|required');
				$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('Phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
				$this->form_validation->set_rules('Query', 'Message', 'trim|required');
				$error_arr = array();
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$form_data = json_encode($_POST);
					$data_array = array('fields_data'=>$form_data,'form_type'=>$form_type,'status'=>'1');
					$data_array['created'] = date('Y/m/d  h:m:s');
					$insertData = $this->user_model->saveFormData($data_array);
				}
				if(!empty($insertData)){
				
				/*  Mail to admin  */
					$to = $this->config->item('AdminEmail');
					$from = $this->input->post('email');
					$subject = "Contact ".$this->config->item('Site_name');
					$message = '<p>Dear Admin ,</p><br>';
					$message .= '<p>New lead has been entered. please find below the details :-</p>';
					$message .= '<ul>';
					$data = json_decode($form_data);
					foreach($data as $key=>$value){
						$message .= '<li>'.$key.' :- '.$value.'</li>';
					}
					$message .= '</ul>';
					$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
					if($sendMailAdmin){
						$msg = "Thank you for showing interest.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to admin end */
				
				/*  Mail to user */
					$toU = $this->input->post('Email');
					$fromU = $this->config->item('FromEmail');
					
					$subject = "Thank you for your query!";
					$email_data['site_name'] = $this->config->item('Site_name');
					$email_data['name'] = $this->input->post('Name');
					$messageU = $this->load->view('site/email/queryform',$email_data, true);
					$sendMailUser = $this->sendEmail($toU,$fromU,$subject,$messageU);
					
					
					if($sendMailUser){
						$msg = "Thank you for showing interest.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to user */
					
				}
				echo json_encode(array('msg' => $msg));

		}elseif($form_type == "City Exhibition Register"){
			
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('mobile', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
				$this->form_validation->set_rules('user_city', 'City', 'trim|required');
				$this->form_validation->set_rules('user_city', 'City', 'trim|required');
				$this->form_validation->set_rules('qualification', 'Qualification', 'required');
				$this->form_validation->set_rules('course', 'Course', 'required');
				$error_arr = array();
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($_SERVER['REQUEST_METHOD']=='POST'){
					
				$isDuplicateRecord = $this->user_model->chkCityExhibitionUserDuplicate($this->input->post('email'),$this->input->post('exhibition_city'));

					$form_data = json_encode($_POST);
					
				if($isDuplicateRecord == NULL){
					
					$voucher_no = mt_rand(100000, 999999);
					$email_confirmation_code = rand();
					
					$userData = array(
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'mobile' => $this->input->post('mobile'),
							'user_city' => $this->input->post('user_city'),
							'qualification' => $this->input->post('qualification'),
							'course' => $this->input->post('course'),
							'exhibition_city' => $this->input->post('exhibition_city'),
							'voucher_no' => $voucher_no,
							'email_confirmation_code' => $email_confirmation_code
						);
					$userData['created'] = date('Y/m/d  h:m:s');
					$insertData = $this->user_model->saveCityExhibitionRegistration($userData);
					
					$exhibition_data = $this->news_event_model->get_event_data_by_cityid($this->input->post('exhibition_city'));
					$course_data = $this->course_model->get_course_data_by_id($this->input->post('course'));
					
					if(!empty($insertData)){
					
					$msg = "Confirmation email sent to your mail id";
					
					$data = $_POST;
					
					/* Ticket generate start */
						
							/*  $pdf_data['name']=$data['name'];
							 $pdf_data['voucher']=$voucher_no;
							 $pdf_data['location'] = $exhibition_data->location;
							 $pdf_data['city'] = $exhibition_data->city_name;
							 $pdf_data['start_time'] = date('h:i A', strtotime($exhibition_data->start_time));
							 $pdf_data['end_time'] = date('h:i A', strtotime($exhibition_data->end_time));
							 
							 $pdf_data['start_date'] = date("jS",strtotime($exhibition_data->start_date));
							
							if($exhibition_data->end_date !=""){
							  $pdf_data['end_date'] = date("jS",strtotime($exhibition_data->end_date));
							}
							
							$pdf_data['event_month_year'] = date("F Y",strtotime($exhibition_data->start_date));
							$pdf_filename = $voucher_no."_".time()."-download.pdf";
							$ticketUrl = $this->genarate_ticket($pdf_data,$pdf_filename); */
							
						/* Ticket generate end */
						
				
					/*  Mail to admin  */
						
							
							//echo '<pre>'; print_r($data); die;
							
							$name = $data['name'];
							$email = $data['email'];
							$phone = $data['mobile'];
							$user_city = $data['user_city'];
							$city = $exhibition_data->city_name;
							$course = $course_data->name;
							$qualification = $data['qualification'];
														
							$to = $this->config->item('AdminEmail');
							$from = $this->input->post('email');
							$subject = "City Exhibition Registeration ".$this->config->item('Site_name');
							$message = '<p>Dear Admin ,</p><br>';
							$message .= '<p>New lead has been entered. please find below the details :-</p>';
							$message .= '<ul>';
							
							$message .= '<li>Name :- '.$name.'</li>';
							$message .= '<li>Email :- '.$email.'</li>';
							$message .= '<li>Phone :- '.$phone.'</li>';
							$message .= '<li>User City :- '.$user_city.'</li>';
							$message .= '<li>Exhibition City :- '.$city.'</li>';
							$message .= '<li>Course :- '.$course.'</li>';
							$message .= '<li>Qualification :- '.$qualification.'</li>';
				
							
							$message .= '</ul>';
							
							
							$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
							
						/*  Mail to admin end */
						
						
						/*  Mail to user */
							
							/* $toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "City Online registration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $name;
							$email_data['event_name'] = $exhibition_data->name;
							$email_data['start_date'] = date("jS",strtotime($exhibition_data->start_date));
							
							if($exhibition_data->end_date !=""){
							  $email_data['end_date'] = date("jS",strtotime($exhibition_data->end_date));
							}
							
							$email_data['event_month_year'] = date("F Y",strtotime($exhibition_data->start_date));
							
							$email_data['start_time'] = date('h:i A', strtotime($exhibition_data->start_time));
							$email_data['end_time'] = date('h:i A', strtotime($exhibition_data->end_time));
							$email_data['location'] = $exhibition_data->location;
							$email_data['city'] = $exhibition_data->city_name;
							

							$email_data['voucher_number'] = $voucher_no;
							$email_data['ticket_url'] = $ticketUrl;
							$messageU = $this->load->view('site/email/online_register',$email_data, true); */
							
							//echo $messageU; die;
							
							//$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							
							/*  Mail to user for email confirmation*/
							$toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Registration confermation!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $name;
							$email_data['conf_link'] = base_url().'confirmation/?email='.$email.'&type=city_register'.'&code='.$email_confirmation_code;
							
							$messageU = $this->load->view('site/email/register_confirmation',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
					
				}
			}else{
				$msg = "Allready Register!";
			}
		}
				echo json_encode(array('msg' => $msg));
		}elseif($form_type == "Feedback Form"){
			
				$this->form_validation->set_rules('Name', 'Name', 'trim|required');
				$this->form_validation->set_rules('Email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('Phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');
				$this->form_validation->set_rules('Feedback', 'Feedback', 'trim|required');
				
				
				$error_arr = array();
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$form_data = json_encode($_POST);
					$data_array = array('fields_data'=>$form_data,'form_type'=>$form_type,'status'=>'1');
					$data_array['created'] = date('Y/m/d  h:m:s');
					$insertData = $this->user_model->saveFormData($data_array);
				}
				if(!empty($insertData)){
				
				/*  Mail to admin  */
					$to = 'ipcourse@ficci.com';
					$from = $this->input->post('email');
					$subject = "Feedback ".$this->config->item('Site_name');
					
					
					$message = '<p>Dear Admin ,</p><br>';
					$message .= '<p>New lead has been entered. please find below the details :-</p>';
					$message .= '<ul>';
					$data = json_decode($form_data);
					foreach($data as $key=>$value){
						$message .= '<li>'.$key.' :- '.$value.'</li>';
					}
					$message .= '</ul>';
					$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
					if($sendMailAdmin){
						$msg = "Thank you for your feedback.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to admin end */
				
				/*  Mail to user */
					
					$toU = $this->input->post('Email');
					$fromU = $this->config->item('FromEmail');
					/*$subjectU = 'Thank you';
					$messageU = '<h3>Thank you for your feedback.</h3><br>';
					$messageU .= '<p>Our representative will contact you shortly</p>';
					$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);*/
					
					$subjectU = "Thank you for your feedback!";
					$emaildata['site_name'] = $this->config->item('Site_name');
					$emaildata['name'] = $this->input->post('Name');
					$emaildata['topic'] = $this->input->post('Topic');
					
					$messageU = $this->load->view('site/email/feedback_form',$emaildata, true);
					$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
					
					if($sendMailUser){
						$msg = "Thank you for your feedback.";
					}else{
						$msg = "error in sending mail";
					}
				/*  Mail to user */
					
				}
				echo json_encode(array('msg' => $msg));
				
		}
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
	
	
	function generatePassword() 
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
	}
	
	function alpha_dash_space($str) {
		
		if( ! preg_match("/^([-a-z_ ])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'Invalid User Name');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

}

	function alpha_dash_username($str) {
		
		//if( ! preg_match("/^([-a-z_ ])+$/i", $str)){ 
		if( ! preg_match("/^[ A-Za-z0-9.]*$/", $str)){ 
			$this->form_validation->set_message('alpha_dash_username', 'Invalid User Name');
		
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	
	function genarate_ticket($data,$filename){
		$this->load->library('m_pdf');
		$html= $this->load->view('site/pages/ticket',$data, true);
		//echo $html; die;
		$pdfFilePath = "./registration/tickets/".$filename;
		$pdf = $this->m_pdf->load();
		$pdf->WriteHTML($html,2);
		$pdf->Output($pdfFilePath,'F');
		
		return base_url()."registration/tickets/".$filename;
		 
	}
	
}