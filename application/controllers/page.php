<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->load->model('page_model');
		$this->load->library("pagination");
		$this->load->model('news_model');
		$this->load->model('faq_model');
		$this->load->model('course_model');
		$this->load->model('news_event_model');
		$this->load->model('educatus_history_model');
		$this->load->model('counselor_model');
		$this->load->model('gallery_model');
		$this->load->model('dream_colleges_model');
		$this->load->model('universities_model');
		$this->load->model('source_model');
		$this->load->model('register_model');
		$this->load->model('news_model');
		//error_reporting(E_ALL);
		$this->load->library('Ajax_pagination');
		$this->load->library('email');
		$this->perPage = 3;
	}
	

	function getPageData($slug=null){
	
	
		if($slug == null){
			$slug = "about-us";
		} 
		$data['slug'] = 'about-us'; 
		$data['page_data'] = $this->page_model->get_front_page_data($slug);
		
		if(!empty($data['page_data'])){
			$this->load->view('site/parts/header');
			
			if($slug=="about-us"){
				
				$this->load->view('site/pages/about_us',$data);
			}else{
				
				$this->load->view('site/pages/about_page',$data);
			}
			
			
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
		
	}
	
	
	
		
	function getContactUs(){

	
		$data['page_data'] = $this->page_model->get_front_page_data('contact-us');
		
		$data['slug'] = 'contact-us'; 
		if(!empty($data['page_data'])){
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/contact_us',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
		
	}
	
	function getAboutUs(){

	
		$data['page_data'] = $this->page_model->get_front_page_data('about');
		$data['history_data'] = $this->educatus_history_model->get_history_detail_front(3);
		
		//echo '<pre>'; print_r($data['history_data']); die;
		
		$data['slug'] = 'about'; 
		if(!empty($data['page_data'])){
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/about_us',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
		
	}
	
		
	function disclaimer()
	{
		$data['page_data'] = $this->page_model->get_front_page_data('disclaimer');
		
		
		if(!empty($data['page_data'])){
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/disclaimer',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
		
	}
	
	function terms()
	{
	
		$data['page_data'] = $this->page_model->get_front_page_data('terms');
		
		
		if(!empty($data['page_data'])){
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/terms',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
	}
	
	
	
	function feedback()
	{
		//$data['setting_data'] = $this->setting_model->getSettingData();
			
		//$data['page_data'] =  $this->page_model->get_front_page_data('feedback');
		//$data['event_data'] = $this->page_model->get_front_event_data();
		//$data['right_data'] = $this->load->view('site/parts/right.php','',true);
		//$data['announcement_data'] = $this->page_model->get_front_announcement_data();
		$this->load->view('site/parts/header');
		$this->load->view('site/pages/feedback');
		$this->load->view('site/parts/footer');
	}
	
	function getInternships(){

	
		$data['page_data'] = $this->page_model->get_front_page_data('internship');
		
		
		if(!empty($data['page_data'])){
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/common',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
		
	}
	
	
	function getNewsEventDetail($slug){
		
		$data['page_data'] =  $this->page_model->get_front_page_data('news-events');
		$data['news_event_detail'] = $this->news_event_model->get_news_event_data($slug);
		//echo '<pre>'; print_r($data['news_event_detail']); die;
		if(!empty($data['news_event_detail'])){
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/news_event_detail',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
	}
	
	function news_events(){
		
		$data['page_data'] =  $this->page_model->get_front_page_data('news-events');
		$data['news_event'] = $this->news_event_model->get_all_news_events();
		if(!empty($data['news_event'])){
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/news_event',$data);
			$this->load->view('site/parts/footer');
			
		}else{
			
			show_404();
		}
	}
	
	
	/*function online_registration()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['sourceData'] = $this->source_model->get_source_detail_front();
		$data['page_data'] = $this->page_model->get_front_page_data('online-register');
		$data['course_data'] = $this->course_model->get_course_list();
		$data['exhibition_city_data'] = $this->news_event_model->getExhibitionCity();
		
		$error_arr = array();
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			
			$this->form_validation->set_rules('email','Email','valid_email|callback_check_duplicate_online_user');
			
			
			/* if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			} */
			
			/*if($this->form_validation->run())
			{
				
			
						
						$fullname = $this->input->post('salut').' '.$this->input->post('fname').' '.$this->input->post('lname');
						$mobile = $this->input->post('code').$this->input->post('phone');
						$userData = array(
							'name' => $fullname,
							'email' => $this->input->post('email'),
							'mobile' => $mobile,
							'alt_mobile' => $this->input->post('aphone'),
							'intrested_city ' => $this->input->post('city'),
							'course ' => $this->input->post('course'),
							'qualification ' => $this->input->post('qualification'),
							'percentage ' => $this->input->post('percentage'),
							'app_jee' => $this->input->post('rdjee'),
							'source' => $this->input->post('source'),
							'created' => date('Y-m-d H:i:s'),
							
						);
						
						$user_insert_id = $this->register_model->add_online_register($userData);
						
						$this->load->model('source_model');
						$this->source_model->updateCountSoi($this->input->post('source'));
						
						/* 
						
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
						
						$this->sendEmail($data['email'], $subject, $message); */
						
						//after successful submission
						//$this->session->set_flashdata('success', 'You have registered successfully.');
						
						//redirect($this->agent->referrer());
//						redirect('/success-online-register', 'refresh');
						
			
				
			/*}
			else
			{
				
				$this->load->view('site/parts/header',$data);
				$this->load->view('site/pages/online_register', $data);
				$this->load->view('site/parts/footer');
			}
		
		}
		else{
				
		$this->load->view('site/parts/header');
		$this->load->view('site/pages/online_register', $data);
		$this->load->view('site/parts/footer');
		}
		
	/* }else{
		
		redirect('welcome');
	} */
//}
		
				
	
	/*}*/
	
	
	function online_registration()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['sourceData'] = $this->source_model->get_source_detail_front();
		$data['page_data'] = $this->page_model->get_front_page_data('online-register');
		$data['course_data'] = $this->course_model->get_course_list();
		$data['exhibition_city_data'] = $this->news_event_model->getExhibitionCity();
		
		$error_arr = array();
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			
			$this->form_validation->set_rules('email','Email','valid_email|callback_check_duplicate_online_user');
			
			
			/* if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			} */
			
			if($this->form_validation->run())
			{
				
			
						$voucher_no = mt_rand(100000, 999999);
						$email_confirmation_code = rand();
						$user_email = $this->input->post('email');
						
						$fullname = $this->input->post('salut').' '.$this->input->post('fname').' '.$this->input->post('lname');
						$mobile = $this->input->post('code').$this->input->post('phone');
						$userData = array(
							'name' => $fullname,
							'email' => $this->input->post('email'),
							'mobile' => $mobile,
							'alt_mobile' => $this->input->post('aphone'),
							'intrested_city ' => $this->input->post('city'),
							'course ' => $this->input->post('course'),
							'qualification ' => $this->input->post('qualification'),
							'percentage ' => $this->input->post('percentage'),
							'app_jee' => $this->input->post('rdjee'),
							'source' => $this->input->post('source'),
							'voucher_no' => $voucher_no,
							'email_confirmation_code' => $email_confirmation_code,
							'created' => date('Y-m-d H:i:s'),
							
						);
						//echo $this->input->post('city'); die;
						$exhibition_data = $this->news_event_model->get_event_data_by_cityid($this->input->post('city'));
						$course_data = $this->course_model->get_course_data_by_id($this->input->post('course'));
						$source_data = $this->source_model->get_source_data_by_id($this->input->post('source'));
												
						$user_insert_id = $this->register_model->add_online_register($userData);
						
						$this->load->model('source_model');
						$this->source_model->updateCountSoi($this->input->post('source'));
						$data = $_POST;
						/* 
						
						/* Ticket generate start */
						
							/*  $pdf_data['name']=$data['salut'].' '.$data['fname'].' '.$data['lname'];
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
						
							
							
							$name = $data['salut'].' '.$data['fname'].' '.$data['lname'];
							$email = $data['email'];
							$phone = $data['code'].$data['phone'];
							$alt_phone = $data['aphone'];
							$city = $exhibition_data->city_name;
							$course = $course_data->name;
							$qualification = $data['qualification'];
							$percentage = $data['percentage'];
							$jee = $data['rdjee'];
							$source = $source_data->name;
							
							$to = $this->config->item('AdminEmail');
							$from = $this->input->post('email');
							$subject = "Registeration ".$this->config->item('Site_name');
							$message = '<p>Dear Admin ,</p><br>';
							$message .= '<p>New lead has been entered. please find below the details :-</p>';
							$message .= '<ul>';
							
							$message .= '<li>Name :- '.$name.'</li>';
							$message .= '<li>Email :- '.$email.'</li>';
							$message .= '<li>Phone :- '.$phone.'</li>';
							$message .= '<li>Alternate phone :- '.$alt_phone.'</li>';
							$message .= '<li>City :- '.$city.'</li>';
							$message .= '<li>Course :- '.$course.'</li>';
							$message .= '<li>Qualification :- '.$qualification.'</li>';
							$message .= '<li>Percentage :- '.$percentage.'</li>';
							$message .= '<li>Appeared Jee :- '.$jee.'</li>';
							$message .= '<li>Source :- '.$source.'</li>';
							
							
							$message .= '</ul>';
							
							
							$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
							
						/*  Mail to admin end */
						
						/*  Mail to user for email confirmation*/
							$toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Registration confermation!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $fullname;
							$email_data['conf_link'] = base_url().'confirmation/?email='.$user_email.'&type=online'.'&code='.$email_confirmation_code;
							
							$messageU = $this->load->view('site/email/register_confirmation',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							
						
						/*  Mail to user */
							/* $toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Online registration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $fullname;
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
							$email_data['ticket_url'] = $ticketUrl;
							

							$email_data['voucher_number'] = $voucher_no;
							$messageU = $this->load->view('site/email/online_register',$email_data, true); */
							
							//echo $messageU; die;
							
							//$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							redirect('/success-online-register', 'refresh');
						
			
				
			}
			else
			{
				
				$this->load->view('site/parts/header',$data);
				$this->load->view('site/pages/online_register', $data);
				$this->load->view('site/parts/footer');
			}
		
		}
		else{
				
		$this->load->view('site/parts/header');
		$this->load->view('site/pages/online_register', $data);
		$this->load->view('site/parts/footer');
		}
		
	/* }else{
		
		redirect('welcome');
	} */
//}
		
				
	
	}
	
	
	function exhibitior_registration()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data['page_data'] = $this->page_model->get_front_page_data('online-register');
		$data['exhibition_city_data'] = $this->news_event_model->getExhibitionCity();
		
		$error_arr = array();
		
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$exhibition_data = $this->news_event_model->get_event_data_by_cityid($this->input->post('city'));
			
			$this->form_validation->set_rules('email','Email','valid_email|callback_check_duplicate_exhibitor_user');
			
			
			/* if($this->input->post('chk_otheroption') !=0){
				$this->form_validation->set_rules('source_detail','Source Detail','required');
			} */
			
			if($this->form_validation->run())
			{
				
			
						$voucher_no = mt_rand(100000, 999999);
						$email_confirmation_code = rand();
						$user_email = $this->input->post('email');
						
						$fullname = $this->input->post('salut').' '.$this->input->post('fname').' '.$this->input->post('lname');
						$contact = $this->input->post('code').$this->input->post('phone');
						$userData = array(
							'contact_person' => $fullname,
							'email' => $this->input->post('email'),
							'designation' => $this->input->post('designation'),
							'contact' => $contact,
							'intrested_city ' => $this->input->post('city'),
							'university_collage' => $this->input->post('university'),
							'university_collage_address' => $this->input->post('university_address'),
							'message' => $this->input->post('message'),
							'voucher_no' => $voucher_no,
							'email_confirmation_code' => $email_confirmation_code,
							'created' => date('Y-m-d H:i:s'),
							
						);
						
						$user_insert_id = $this->register_model->add_exhibitor_register($userData);
						$data = $_POST;
						
						/* Ticket generate start */
						/* 
							 $pdf_data['name']=$data['salut'].' '.$data['fname'].' '.$data['lname'];
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
						
							
							
							$name = $data['salut'].' '.$data['fname'].' '.$data['lname'];
							$email = $data['email'];
							$phone = $data['code'].$data['phone'];
							$city = $exhibition_data->city_name;
							$university = $data['university'];
							$university_add = $data['university_address'];
							$message_user = $data['message'];
							
							
							$to = $this->config->item('AdminEmail');
							$from = $this->input->post('email');
							$subject = "Exhibitor Registeration ".$this->config->item('Site_name');
							$message = '<p>Dear Admin ,</p><br>';
							$message .= '<p>New lead has been entered. please find below the details :-</p>';
							$message .= '<ul>';
							
							$message .= '<li>Name :- '.$name.'</li>';
							$message .= '<li>Email :- '.$email.'</li>';
							$message .= '<li>Phone :- '.$phone.'</li>';
							$message .= '<li>City :- '.$city.'</li>';
							$message .= '<li>University/College :- '.$university.'</li>';
							$message .= '<li>University/College Address :- '.$university_add.'</li>';
							$message .= '<li>Message :- '.$message_user.'</li>';
							
							
							$message .= '</ul>';
							
							//echo $message; die;
							$sendMailAdmin = $this->sendEmail($to,$from,$subject,$message);
							
						/*  Mail to admin end */
						
						
						/*  Mail to user for email confirmation*/
							$toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Registration confermation!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $fullname;
							$email_data['conf_link'] = base_url().'confirmation/?email='.$user_email.'&type=exhibitor'.'&code='.$email_confirmation_code;
							
							$messageU = $this->load->view('site/email/register_confirmation',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							//echo $messageU; die;
						
						/*  Mail to user */
						
						/*  Mail to user */
							/* $toU = $this->input->post('email');
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Exhibitor registration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $fullname;
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
						
						redirect('/success-exhibitor-register', 'refresh');
						
			
				
			}
			else
			{
				
				$this->load->view('site/parts/header',$data);
				$this->load->view('site/pages/register_exhibitor', $data);
				$this->load->view('site/parts/footer');
			}
		
		}
		else{
				
		$this->load->view('site/parts/header');
		$this->load->view('site/pages/register_exhibitor', $data);
		$this->load->view('site/parts/footer');
		}
		
	/* }else{
		
		redirect('welcome');
	} */
//}
		
				
	
	}
	
	public function success_online_register() {
	   $this->session->set_flashdata('success', 'Confirmation email sent to your mail id');
	   redirect('/online-register', 'refresh');
	}


	public function success_exhibitor_register() {
	   $this->session->set_flashdata('success', 'Confirmation email sent to your mail id');
	   redirect('/exhibitor-register', 'refresh');
	}



function check_duplicate_online_user() {
    $email = $this->input->post('email');// get fiest name
    $city = $this->input->post('city');// get last name
    $this->db->select('id');
    $this->db->from('edu_online_registration');
    $this->db->where('email', $email);
    $this->db->where('intrested_city', $city);
    $query = $this->db->get();
    $num = $query->num_rows();
    if ($num > 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function check_duplicate_exhibitor_user() {
    $email = $this->input->post('email');// get fiest name
    $city = $this->input->post('city');// get last name
    $this->db->select('id');
    $this->db->from('edu_exhibitor_registration');
    $this->db->where('email', $email);
    $this->db->where('intrested_city', $city);
    $query = $this->db->get();
    $num = $query->num_rows();
    if ($num > 0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function confirmation(){
	if(isset($_GET['email']) and isset($_GET['type']) and isset($_GET['code'])){
		
		if($_GET['type'] == 'online'){
			
			$check_user = $this->register_model->getOnlineUserByEmailCode($_GET['email'],$_GET['code']);
			
			if($check_user){
				
				$update_data = array(
							'status' => '1',
							'email_confirmation_code' => '',
							'updated' => date('Y-m-d H:i:s'),
						);
						
				$update = $this->register_model->updateOnlineregisterByEmailCode($update_data, $_GET['email'], $_GET['code']);
						
				$exhibition_data = $this->news_event_model->get_event_data_by_cityid($check_user->intrested_city);	
				$course_data = $this->course_model->get_course_data_by_id($check_user->course);
				$source_data = $this->source_model->get_source_data_by_id($check_user->source);
				
				/* Ticket generate start */
						
							 $pdf_data['name']=$check_user->name;
							 $pdf_data['voucher']=$check_user->voucher_no;
							 $pdf_data['location'] = $exhibition_data->location;
							 $pdf_data['city'] = $exhibition_data->city_name;
							 $pdf_data['start_time'] = date('h:i A', strtotime($exhibition_data->start_time));
							 $pdf_data['end_time'] = date('h:i A', strtotime($exhibition_data->end_time));
							 
							 $pdf_data['start_date'] = date("jS",strtotime($exhibition_data->start_date));
							
							if($exhibition_data->end_date !=""){
							  $pdf_data['end_date'] = date("jS",strtotime($exhibition_data->end_date));
							}
							
							$pdf_data['event_month_year'] = date("F Y",strtotime($exhibition_data->start_date));
							$pdf_filename = $check_user->voucher_no."_".time()."_download.pdf";
							$ticketUrl = $this->genarate_ticket($pdf_data,$pdf_filename);
							
			/* Ticket generate end */
			
			/*  Mail to user */
							
							$toU = $check_user->email;
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Online registration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $check_user->name;
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
							$email_data['ticket_url'] = $ticketUrl;
							

							$email_data['voucher_number'] = $check_user->voucher_no;
							$messageU = $this->load->view('site/email/online_register',$email_data, true); 
							//echo $messageU; die;
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);	
							$this->session->set_flashdata('success', 'You have registered successfully.');
							redirect('online-register');
							
			}
			//echo '<pre>'; print_r($check_user); die;
		}elseif($_GET['type'] == 'exhibitor'){
			//echo "Test"; die;
			
			$check_user = $this->register_model->getExhibitorUserByEmailCode($_GET['email'],$_GET['code']);
			
			if($check_user){
				
				$update_data = array(
							'status' => '1',
							'email_confirmation_code' => '',
							'updated' => date('Y-m-d H:i:s'),
						);
						
				$update = $this->register_model->updateExhibitorregisterByEmailCode($update_data, $_GET['email'], $_GET['code']);
						
				$exhibition_data = $this->news_event_model->get_event_data_by_cityid($check_user->intrested_city);	
				
				
				/* Ticket generate start */
						
							 $pdf_data['name']=$check_user->contact_person;
							 $pdf_data['voucher']=$check_user->voucher_no;
							 $pdf_data['location'] = $exhibition_data->location;
							 $pdf_data['city'] = $exhibition_data->city_name;
							 $pdf_data['start_time'] = date('h:i A', strtotime($exhibition_data->start_time));
							 $pdf_data['end_time'] = date('h:i A', strtotime($exhibition_data->end_time));
							 
							 $pdf_data['start_date'] = date("jS",strtotime($exhibition_data->start_date));
							
							if($exhibition_data->end_date !=""){
							  $pdf_data['end_date'] = date("jS",strtotime($exhibition_data->end_date));
							}
							
							$pdf_data['event_month_year'] = date("F Y",strtotime($exhibition_data->start_date));
							$pdf_filename = $check_user->voucher_no."_".time()."_download.pdf";
							$ticketUrl = $this->genarate_ticket($pdf_data,$pdf_filename);
							
			/* Ticket generate end */
			
			/*  Mail to user */
							
							$toU = $check_user->email;
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "Exhibitor registration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $check_user->contact_person;
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
							

							$email_data['voucher_number'] = $check_user->voucher_no;
							$email_data['ticket_url'] = $ticketUrl;
							$messageU = $this->load->view('site/email/online_register',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							$this->session->set_flashdata('success', 'You have registered successfully.');
							redirect('exhibitor-register');
							
			}
		
							
			}elseif($_GET['type'] == 'city_register'){
				
				$check_user = $this->register_model->getCityRegisterUserByEmailCode($_GET['email'],$_GET['code']);
				
				if($check_user){
					
						$update_data = array(
							'status' => '1',
							'email_confirmation_code' => '',
							'updated' => date('Y-m-d H:i:s'),
						);
						
				$update = $this->register_model->updateCityregisterByEmailCode($update_data, $_GET['email'], $_GET['code']);
						
				$exhibition_data = $this->news_event_model->get_event_data_by_cityid($check_user->exhibition_city);	
				
				
				/* Ticket generate start */
						
							 $pdf_data['name']=$check_user->name;
							 $pdf_data['voucher']=$check_user->voucher_no;
							 $pdf_data['location'] = $exhibition_data->location;
							 $pdf_data['city'] = $exhibition_data->city_name;
							 $pdf_data['start_time'] = date('h:i A', strtotime($exhibition_data->start_time));
							 $pdf_data['end_time'] = date('h:i A', strtotime($exhibition_data->end_time));
							 
							 $pdf_data['start_date'] = date("jS",strtotime($exhibition_data->start_date));
							
							if($exhibition_data->end_date !=""){
							  $pdf_data['end_date'] = date("jS",strtotime($exhibition_data->end_date));
							}
							
							$pdf_data['event_month_year'] = date("F Y",strtotime($exhibition_data->start_date));
							$pdf_filename = $check_user->voucher_no."_".time()."_download.pdf";
							$ticketUrl = $this->genarate_ticket($pdf_data,$pdf_filename);
							
			/* Ticket generate end */
			
			/*  Mail to user */
							
							$toU = $check_user->email;
							$fromU = $this->config->item('FromEmail');
							
							$subjectU = "City Exhibition Registeration for expo!";
							$email_data['site_name'] = $this->config->item('Site_name');
							$email_data['name'] = $check_user->name;
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
							

							$email_data['voucher_number'] = $check_user->voucher_no;
							$email_data['ticket_url'] = $ticketUrl;
							$messageU = $this->load->view('site/email/online_register',$email_data, true);
							
							//echo $messageU; die;
							
							$sendMailUser = $this->sendEmail($toU,$fromU,$subjectU,$messageU);
							
							$slug = $exhibition_data->slug;
							$this->session->set_flashdata('success', 'You have registered successfully.');
							redirect('exhibition/'.$slug);
				}
			}else{
				show_404();
			}
			//echo '<pre>'; print_r($check_user); die;
		}
		
	}

	
	function get_page_data($slug){
		//echo $slug; die;
		$data['page_data'] = $this->page_model->get_front_page_data($slug);
		
		
		//echo '<pre>'; print_r($data['history_data']); die;
		
		//$data['slug'] = 'about'; 
		if(!empty($data['page_data'])){
			
			if($slug == "about"){
				
				$data['history_data'] = $this->educatus_history_model->get_history_detail_front(3);
				
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/about_us',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "scholarship"){
				
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/scholarship',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "counselling"){
				
				$data['counseller_data'] = $this->counselor_model->get_counselor_front();
				//echo '<pre>'; print_r($data['counseller_data']); die;
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/counselling',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "faq"){
				
				$data['faq_data'] = $this->faq_model->getAllActiveFaq();
				//echo '<pre>'; print_r($data['faq_data']); die;
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/faq',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "gallery"){
				
				$this->load->library('pagination');
				$config['base_url'] = base_url().'gallery/';
				$config['total_rows'] = count($this->gallery_model->getAlldata());
				$config['per_page'] = 1;
				$data['per_page'] = 1;
				$this->pagination->initialize($config);		
				$currentpage=(!$currentpage)?1:$currentpage;
				$config['currentpage']=$currentpage;		
				if($currentpage!="")
				{
					$offset =($currentpage-1)*$config['per_page'];
				}		
				if($config['total_rows']>0)
				{
					$data['paging']=$this->paging($config);
				}
				
				$data['year'] = $this->gallery_model->get_year_month();
				//echo '<pre>'; print_r($data['year']); die;
				//$data['faq_data'] = $this->faq_model->getAllActiveFaq();
				//echo '<pre>'; print_r($data['faq_data']); die;
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/gallery',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "exhibitions"){
				
				$data['exhibitions_data'] = $this->news_event_model->get_domestic_events_front();
								
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/exhibition_list',$data);
				$this->load->view('site/parts/footer');
			}elseif($slug == "international-presence"){
				
				$data['international_presence'] = $this->news_event_model->get_international_events_front();
				
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/international_presence',$data);
				$this->load->view('site/parts/footer');
			}
		}else{
			
			show_404();
		}
		
	}
	
	function list_news($currentpage=NULL){
		//echo "Test"; die;
		//echo $currentpage; die;
		
			/* 	//$this->load->library('pagination');
				$this->load->library('Ajax_pagination');
				$config['base_url'] = base_url().'news/';
				$config['total_rows'] = count($this->news_model->get_front_page_news());
				$config['per_page'] = 3;
				$data['per_page'] = 3;
				$this->pagination->initialize($config);		
				$currentpage=(!$currentpage)?1:$currentpage;
				$config['currentpage']=$currentpage;		
				if($currentpage!="")
				{
					$offset =($currentpage-1)*$config['per_page'];
				}		
				if($config['total_rows']>0)
				{
					$data['paging']=$this->paging($config);
				}
				
			
				$data['news_data'] = $this->news_model->get_front_page_news($config['per_page'],$offset);
				$data['news_year'] = $this->news_model->getNewsYear();
				$data['news_month'] = $this->news_model->getNewsMonth();
				//echo '<pre>'; print_r($data['news_month_year']); die;
				//echo $data['news_month_year'][0]['Year']; die;
				//$data['news_data'] = $this->news_model->get_front_page_news();
				$this->load->view('site/parts/header');
				$this->load->view('site/pages/news',$data);
				$this->load->view('site/parts/footer'); */
				
				
				
		$data['page_data'] = $this->page_model->get_front_page_data('news-and-announcements');
		
		$page = $this->input->post('page');
		//echo $page; die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->news_model->get_front_page_news());
        //echo $totalRec; die;
        //pagination configuration
        $config['target']      = '#newsData';
        $config['base_url']    = base_url().'paginat-news';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
		
				$data['news_data'] = $this->news_model->get_front_page_news($this->perPage,$offset);
				$data['news_year'] = $this->news_model->getNewsYear();
				$data['news_month'] = $this->news_model->getNewsMonth();
				
				if(!$page){
				$this->load->view('site/parts/header');
				
				$this->load->view('site/pages/news',$data);
				}else{
				/* 	$html = "";
				foreach($data['news_data'] as $news){
					
				if(strlen($news->content)>165){
						$news_pos = strpos($news->content, ' ', 165);
						$news_cnt = substr($news->content,0,$news_pos );
						$news_content = strip_tags($news_cnt).'...';
					}else{
							$news_content = strip_tags($news->content);
					} 
					
					$html.= '<li>
					  <div class="left_img"> <img src="'.base_url().$news->main_image.'" alt="'.$news->news_title.'"> </div>
					  <div class="right_cont"><h4>'.$news->news_title.'</h4><div class="dates">'.date('d F Y', strtotime($news->created)).'</div>'.$news_content.'<a href="'.base_url().'post/'.$news->slug.'" class="btn2">Know More</a> </div>
					</li>';
				}
				echo $html; */
				
				$this->load->view('site/pages/filter_news', $data);
				}
				if(!$page){
				$this->load->view('site/parts/footer');
				}
	}

	function filter_news(){
		 $year = $_POST['year'];
		 $month = $_POST['month'];
		 $isSearch = $_POST['is_search'];
		
		if(isset($isSearch) && $isSearch=="1"){
			$this->session->unset_userdata('year');
			$this->session->unset_userdata('month');
		}
		 if(!empty($year)){
			$this->session->set_userdata('year', $year);
		 }
		 if(!empty($month)){
			$this->session->set_userdata('month', $month);
		 }
		 
		$page = $this->input->post('page');
		
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        
        $totalRec = count($this->news_model->get_front_page_news(NULL,NULL,$this->session->userdata('year'),$this->session->userdata('month')));
       
        $config['target']      = '#newsData';
        $config['base_url']    = base_url().'filter_news';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
		$config['cur_page']    =  $offset;
        $this->ajax_pagination->initialize($config);
		
		
				$data['news_data'] = $this->news_model->get_front_page_news($this->perPage,$offset,$this->session->userdata('year'),$this->session->userdata('month'));
				$data['news_year'] = $this->news_model->getNewsYear();
				$data['news_month'] = $this->news_model->getNewsMonth();
				$this->load->view('site/pages/filter_news', $data);
			
	}
	
		function ajaxPaginationData(){
		
		
        $page = $this->input->post('page');
		
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->news_model->get_front_page_news());
        //echo $totalRec; die;
        //pagination configuration
        $config['target']      = '#newsData';
        $config['base_url']    = base_url().'paginat-news';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    =  $offset;
        $this->ajax_pagination->initialize($config);
		//echo $this->perPage; die;
		//echo $offset; die;
				$data['news_data'] = $this->news_model->get_front_page_news($this->perPage,$offset);
			//	echo '<pre>'; print_r($data['news_data']); echo '</pre>'; 
				$data['news_year'] = $this->news_model->getNewsYear();
				$data['news_month'] = $this->news_model->getNewsMonth();
				//echo '<pre>'; print_r($data['news_month_year']); die;
				//echo $data['news_month_year'][0]['Year']; die;
				//$data['news_data'] = $this->news_model->get_front_page_news();
				
					
					$this->load->view('site/pages/filter_news', $data, false);
				/* 	$html = "";
				foreach($data['news_data'] as $news){
					
				if(strlen($news->content)>165){
						$news_pos = strpos($news->content, ' ', 165);
						$news_cnt = substr($news->content,0,$news_pos );
						$news_content = strip_tags($news_cnt).'...';
					}else{
							$news_content = strip_tags($news->content);
					} 
					
					$html.= '<li>
					  <div class="left_img"> <img src="'.base_url().$news->main_image.'" alt="'.$news->news_title.'"> </div>
					  <div class="right_cont"><h4>'.$news->news_title.'</h4><div class="dates">'.date('d F Y', strtotime($news->created)).'</div>'.$news_content.'<a href="news-details.html" class="btn2">Know More</a> </div>
					</li>';
				}
				echo $html; */
				
				
				
        
        //get the posts data
        /* $data['posts'] = $this->post->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        
        //load the view
        $this->load->view('posts/ajax-pagination-data', $data, false); */
    }
	
	function exhibition_detail($slug){
		//echo $slug; die;
		$data['exhibition_data'] = $this->news_event_model->get_event_detail_by_slug($slug);
		if(!empty($data['exhibition_data'])){
			$data['cityId'] = $cityId = $data['exhibition_data']->city;
			$data['gallery_data']  = $this->gallery_model->get_gallery_by_city($cityId);
			$data['dream_collage']  = $this->dream_colleges_model->get_collage_data_by_city($cityId);
			$data['course_data'] = $this->course_model->get_course_list();
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/exhibition',$data);
			$this->load->view('site/parts/footer');
		}else{
			show_404();
		}	
	}
	
	function news_detail($slug){
		
		 $data['news_data'] = $this->news_model->get_news_by_slug($slug);
		 $data['most_viewed_news_data'] = $this->news_model->get_most_viewd(4);
		//echo '<pre>'; print_r($data['most_viewed_news_data']); die;
		if(!empty($data['news_data'])){
			
			$this->add_news_count($slug);	
			
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/news_detail',$data);
			$this->load->view('site/parts/footer');
		}else{
			show_404();
		}	
	}
	

	function add_news_count($slug)
	{
		$this->load->helper('cookie');
		$check_visitor = $this->input->cookie(urldecode($slug), FALSE);
		$ip = $this->input->ip_address();
	
		if ($check_visitor == false) {
			$cookie = array(
				"name"   => urldecode($slug),
				"value"  => "$ip",
				"expire" =>  time() + 7200,
				"secure" => false
			);
			$this->input->set_cookie($cookie);
			$this->news_model->update_views_counter(urldecode($slug));
		}
	}
	
	
	
	 
	
	//======================= Pagination ==========================//
	public function paging($config)
	{
		$total_pages=ceil($config['total_rows']/$config['per_page']);
		
		$total_pages=ceil($config['total_rows']/$config['per_page']);
		
		$start=max($config['currentpage']-intval($config['per_page']/2), 1);
		$end=$start+$config['per_page']-1;
		//echo $start.'And'.$end; die;
		if($config['currentpage']==1)
		{
			if($config['total_rows']>$config['per_page'])
			{
			  $showing='1-'.$config['per_page'];
			}
			else
			{
				$showing='1-'.$config['total_rows'];
			}
		}
		else
		{
			$showing=((($config['currentpage']-1)*$config['per_page'])+1).'-';
			if(($config['currentpage']*$config['per_page'])>$config['total_rows'])
			{
				$showing.=$config['total_rows'];
			}
			else
			{
			$showing.=($config['currentpage']*$config['per_page']);
			}
		}
		
		
		
			//$output='<ul class="pagination"><li><a class="page-numbers" href="'.$config['base_url'].'1">First</a></li>';
		$output='';
		if($config['currentpage']>1)
		{		   
			
				$output.='<li><a class="page-numbers" href="'.$config['base_url'].($config['currentpage']-1).'">Prev</a></li>';
		}
		else
		{
			
			$output.='<li class="disabled"><a class="prev page-numbers">Prev</a></li>';
		}
		
		//$output .='<li>';
		for ($i=$start;$i<=$end && $i<= $total_pages;$i++) {
			if($i==$config['currentpage']) {
				$output .= '<li class="active"><a> <span class="page-numbers">'.$i.'</span></a></li>';
			} else {
				
				
					$output .= '<li><a href="'.$config['base_url'].$i.'" tabindex="0"><span class="page-numbers">'.$i.'</span></a></li>';
			}
		}
		//$output .='</li>';
		
		
	   if($total_pages>$config['currentpage'])
	   {		 	
		  	
				$output.='<li><a class="next page-numbers" href="'.$config['base_url'].($config['currentpage']+1).'">Next</a></li>';
		}
	   else
	   {
	   
		$output.='<li class="disabled"><a class="next page-numbers">Next</a></li>';	
	   }
	   
	   		//$output.='<li><a class="next page-numbers" href="'.$config['base_url'].$total_pages.'">Last</a><li></ul>';
	   	
	   return $output;
	}
	

	
	function search(){
		
		
		$search_query = $this->input->get('query');
				
		$data['search_news_data'] =  $this->news_model->getNewsBySearch($search_query);
		$data['search_events_data'] =  $this->news_event_model->getEventBySearch($search_query);
		$data['total'] = intval(count($data['search_news_data'])) + intval(count($data['search_events_data']));
		
		
			$this->load->view('site/parts/header');
			$this->load->view('site/pages/search',$data);
			$this->load->view('site/parts/footer');
	
	}
	
	/* function sendEmail($to, $subject, $message){
		
		
		$this->load->library('email');
		
		$config['mailpath'] = 'text';
		$config['charset'] = 'utf-8';
		
		$this->email->initialize($config);
		
		
		$this->email->from($this->config->item('FromEmail'), $this->config->item('Site_name'));
		$this->email->to($to);
		

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	} */
	
	
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */