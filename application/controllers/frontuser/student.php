<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		$session_data = $this->session->userdata('site_user');
		
		if($session_data['user_type']!='site'){
			redirect('welcome/logout');
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('download');
		
    	$this->load->model('user_model');
		$this->load->model('student_model');
		$this->load->model('assignment_model');
		$this->load->model('setting_model');
		$this->load->model('exam_model');
		$this->load->model('quiz_model');
		$this->load->model('question_model');
		$this->load->model('source_model');
		$this->load->model('announcement_model');
		$this->load->model('page_model');
		$this->load->model('fees_model');
		$this->load->model('session_model');
	}

	function user_dashboard(){
		$data = array();
		$session_data = $this->session->userdata('site_user');
		$data['user_id'] = $session_data['user_id'];
		$data['page_data'] = $this->page_model->get_front_page_data('student-dashboard');
		$data['setting_data'] = $this->setting_model->getSettingData();
				
		$data['announcement'] = $this->announcement_model->get_active_announcement();
		$data['user_name'] = $session_data['username'];

		
		$userPayment = $this->user_model->getPaymentStatus($session_data['user_id']);
		
		$data['re_exam'] = $this->quiz_model->getReExams($session_data['user_id']);
		$session_data['payment_status'] = $userPayment[0]->payment_status;
		$session_data['payment_id'] = $userPayment[0]->payment_id;
		$session_data['exam_type'] = 'main';
		if(sizeof($data['re_exam']) > 0){
			$session_data['last_exam_id'] = $data['re_exam'][0]->quiz_id;
			$session_data['re_exam'] = 0;	
			
		}else{
			$session_data['last_exam_id'] = 0; 
			$session_data['re_exam'] = 0;	
			
		}
		
		$this->session->set_userdata('site_user',$session_data);
		
		$data['stuData'] = $this->student_model->getStudentData($session_data['user_id']);
		
		
		
		
		$data['payment_id'] = $session_data['payment_id'];
		$data['payment_status'] = $session_data['payment_status'];
		$pendingQuiz = $this->quiz_model->PendingQuiz($session_data['user_id']);
		
		if(sizeof($pendingQuiz) > 0){
			
			if($pendingQuiz[0]->type == "re-exam"){
					
				$session_data['re_exam'] = 1;
				
			}else{
				$session_data['re_exam'] = 0;
			}
			$this->session->set_userdata('site_user',$session_data);
			
		}
		
		$data['pending_quiz'] = $pendingQuiz;
				
		$this->load->view('site/parts/header');
		$this->load->view('site/user/dashboard',$data);
		$this->load->view('site/parts/footer');
	}
function make_payment(){
		
		$session_data = $this->session->userdata('site_user');
		
		if($session_data['payment_status']==1){
			$this->session->set_flashdata('info', 'Your payment is already varified.');
			redirect('student/user_dashboard');
		}

		if($session_data['payment_id']!=0 and $session_data['payment_status']==0){
			$this->session->set_flashdata('info', 'Your request is pending for admin approval.');
			redirect('student/user_dashboard');
		}
		
		//load required helper, library
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data = array();
		$data['payment_type'] = $this->student_model->getPaymentType();
		
		$user_id = $session_data['user_id'];
		$data['fee'] = $session_data['course_fee'];
		
		$data['user_name'] = $this->session->userdata('username');
		//get student data by id
		$result = $this->student_model->getStudentData($user_id);
		
		//set validation rules
		$this->form_validation->set_rules('chequedate', 'Cheque Date', 'required');
		//$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
		$this->form_validation->set_rules('coursefees', 'Course Fee', 'required|numeric');
		$this->form_validation->set_rules('chequenumber', 'Cheque Number', 'required|alpha_numeric');
		$this->form_validation->set_rules('bankname', 'Bank Name', 'required|callback_customAlpha');
		$this->form_validation->set_rules('branchname', 'Branch Name', 'required|callback_customAlpha');
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$payment_on = date_create($this->input->post('chequedate'));
			$payment_on = date_format($payment_on,"Y/m/d");
			if ($this->form_validation->run() == FALSE){
				$this->load->view('site/parts/header');
				$this->load->view('site/user/make_payment',$data);
				$this->load->view('site/parts/footer');
			} else {
				
				$payment_data = array(
					'user_id' => $user_id,
					'payment_type_id' => $this->input->post('payment_type'),
					'cheque_date' => $this->input->post('chequedate'),
					'payment_on' => $payment_on,
					'course_fee' => $this->input->post('coursefees'),
					'reference_no' => $this->input->post('chequenumber'),
					'bank_name' => $this->input->post('bankname'),
					'exam_type' => 1,
					'branch_name' => $this->input->post('branchname'),
					'status' => 0,
					'created' => date('Y-m-d H:i:s'),
				);
				$coursefees = $this->input->post('coursefees');
				$serviceTax = $this->config->item('ServiceTax');
				$vendorPrice = $this->source_model->get_source_data_by_id($result->sourceinformation);
				
				$paymentType = $vendorPrice->payment_type;
				//echo "<pre>"; print_r($result); die;
				if($paymentType=='percent')
				{
					$vAmt = $vendorPrice->amount;
					$serVicAmt = $coursefees*$serviceTax/100;
					
					$stAmt = $coursefees-$serVicAmt;
					$venAmt = $vAmt*$stAmt/100;
					$grossAmt = $stAmt-$venAmt;
				}
				if($paymentType=='flat')
				{
					$venAmt = $vendorPrice->amount;
					$serVicAmt = $coursefees*$serviceTax/100;
					
					$stAmt = $coursefees-$serVicAmt;
					
					$grossAmt = $stAmt-$venAmt;
				}
				if($paymentType=='fixed_amount')
				{
					$venAmt = $vendorPrice->amount;
					$serVicAmt = '';
					//$coursefees*$serviceTax/100;
					//$stAmt = $coursefees-$serVicAmt;
					//$venAmt = $vAmt*$stAmt/100;
					$grossAmt = $coursefees;
				}
				if($venAmt)					$payment_data['vendor_amount'] = $venAmt;				if($grossAmt)					$payment_data['gross_amount'] = $grossAmt;				if($serVicAmt)					$payment_data['servicetax_amount'] = $serVicAmt;
				//$payment_data['vendor_amount'] = $venAmt;
				//$payment_data['gross_amount'] = $grossAmt;
				//$payment_data['servicetax_amount'] = $serVicAmt;
				
				//echo "<pre>"; print_r($payment_data); die;
				$insert_id = $this->student_model->insert_user_payment_data($payment_data);
				
				$update_user_data = array(
					'payment_id' => $insert_id,
					'payment_status' => 0,					
				);
				
				$this->student_model->updateStudentDataByID($update_user_data, $user_id);
				
				$update_session_data = array(
					'user_id' => $this->session->userdata['site_user']['user_id'],
					'username' => $this->session->userdata['site_user']['username'],
					'email' => $this->session->userdata['site_user']['email'],
					'user_type_id' => $this->session->userdata['site_user']['user_type_id'],
					'course_fee' => $this->session->userdata['site_user']['course_fee'],
					'payment_id' => $insert_id,
					'payment_status' => 0,
					'logged_in' => true,
					'user_type' => 'site'
					
				);
				
				$session_id = $result->session_id;
				$session_data = $this->session_model->getSessionByID($session_id);
				
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
										
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				}
				
				//update session data
				$this->session->set_userdata('site_user',$update_session_data);
				
				$subject = "FICCI Online Course- Payment Details";
				$data['site_name'] = $this->config->item('Site_name');
				//$res_payment = $this->student_model->getPaymentByID($this->input->post('payment_type'));
				
				$data['name'] = $result->first_name." ".$result->last_name;
				$data['email'] = $result->email;
				$data['payment_type'] = $this->input->post('payment_type');
				$data['reference_no'] = $this->input->post('chequenumber');
				$data['payment_date'] = $this->input->post('chequedate');
				$data['bank_name'] = $this->input->post('bankname');
				$data['branch_name'] = $this->input->post('branchname');
				$data['course_fee'] = $this->input->post('coursefees');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				$message = $this->load->view('site/email/payment',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message);
				
				//after successful submission
				$this->session->set_flashdata('success', 'You have successfully submitted your payment information.');
				redirect('student/user_dashboard');
			}
		} else {
			$this->load->view('site/parts/header');
			$this->load->view('site/user/make_payment',$data);
			$this->load->view('site/parts/footer');
		}
	}
	
	//function to send email - Balkrishan
	function sendEmail($to, $subject, $message){
		//include email library
		$this->load->library('email');
		
		//set email config
		//$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		
		$this->email->from($this->config->item('FromEmail'), $this->config->item('Site_name'));
		$this->email->to($to);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	}
	
	function assignments($id=null){
		$data = array();
		$session_data = $this->session->userdata('site_user');
		$data['user_name'] = $session_data['username'];
		$data['payment_id'] = $session_data['payment_id'];
		$data['payment_status'] = $session_data['payment_status'];
		
		$data['assignments'] = $this->student_model->get_student_assignments($id);
		
		$this->load->view('site/parts/header');
		$this->load->view('site/user/assignments',$data);
		$this->load->view('site/parts/footer');
	}
	
	//Method to download a file - Balkrishan
	function download_assignment(){
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			
			if($data = file_get_contents($filename)) {
				force_download($file, $data);
			}else{
				$this->session->set_flashdata('error', 'Assignment not found');
				redirect('student/assignments');
			}
			
		}
	}
	
	function download_study_material(){
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			
			if($data = file_get_contents($filename)) {
				force_download($file, $data);
			}else{
				$this->session->set_flashdata('error', 'Study material not found');
				redirect('student/study_material');
			}
			
		}
	}
	
	//Method to add assignment - Balkrishan
	function submit_assignment($id=null){
		$data['id'] = $id;
		if($this->session->userdata('site_user')){
			$session_data = $this->session->userdata('site_user');
		    $data['user_name'] = $session_data['username'];
			$data['payment_id'] = $session_data['payment_id'];
			$data['payment_status'] = $session_data['payment_status'];
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('filename', 'Filename', 'required');
				//$this->form_validation->set_rules('caption', 'Caption', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('site/parts/header');
					$this->load->view('site/user/submit_assignment');
					$this->load->view('site/parts/footer');
				} else {
					
					$assignment_file='';
					$assignment_size='';
					$assignment_ext='';
					
					//validation for images
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$assignment_file_name = strtolower(str_replace(" ","-",$this->input->post('filename')))."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/assignment_student/'; 
						$config['file_name'] = $assignment_file_name;
						$config['allowed_types'] = 'pdf|doc|docx|DOC|DOCX'; 
						$config['max_size']      = 10000; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$assignment_file = $assignment_file_name;
							$assignment_size = $data_file['upload_data']['file_size'];
							$assignment_ext = $data_file['upload_data']['file_ext'];
						}
					}
				}
				if(isset($error_arr) and count($error_arr)>0){
					$data['file_error'] = $error_arr;
					$this->load->view('site/parts/header');
					$this->load->view('site/user/submit_assignment',$data);
					$this->load->view('site/parts/footer');
					//print_r($error_arr); die;
				} else {
					//echo "<pre>"; print_r($this->session->userdata['site_user']); die;
					$fileData = array(
						'student_id' => $this->session->userdata['site_user']['user_id'],
						'faculty_assignment_id' => $this->input->post('faculty_assignment_id'),
						'filename' => $assignment_file_name,
						'path' => $assignment_file,
						'size' => $assignment_size,
						'type' => $assignment_ext,
						'status' => 1,
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->student_model->insert_student_assignment_data($fileData);
					
					//update assignment status
					$update_id = $this->assignment_model->updateAssignment(array('is_submitted' => 1), $this->input->post('faculty_assignment_id'));
					
					// Send email
					$subject = "Assignment Submission for FICCI Online Course";
					$data['site_name'] = $this->config->item('Site_name');
					
					$result = $this->student_model->getStudentData($this->session->userdata['site_user']['user_id']);
					
					$data['name'] = $result->first_name." ".$result->last_name;
					$data['email'] = $result->email;
					
					$message = $this->load->view('site/email/assignment',$data, true);
					
					$this->sendEmail($data['email'], $subject, $message);
					
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have submit assignment successfully.');
					redirect('student/assignments');
				}
			} else {
				$this->load->view('site/parts/header');
				$this->load->view('site/user/submit_assignment',$data);
				$this->load->view('site/parts/footer');
			}
		} else {

			redirect('welcome', 'refresh');
		}
	}
	
	// function to download a admit card
	
	function study_material($id=null){
		
		$data = array();
		$session_data = $this->session->userdata('site_user');
		$data['user_name'] = $session_data['username'];
		$data['payment_id'] = $session_data['payment_id'];
		$data['payment_status'] = $session_data['payment_status'];
		
		$data['study_material'] = $this->student_model->get_study_material($id);
		//echo '<pre>'; print_r($data['study_material']); die;
		$this->load->view('site/parts/header');
		$this->load->view('site/user/study_material',$data);
		$this->load->view('site/parts/footer');
	}
	
	function download_admit_card(){
		
		$data = array();
		$data['setting_data'] = $this->setting_model->getSettingData();
		if($_SERVER['REQUEST_METHOD']=='POST'){
		$userid = $this->input->post('registration_number');
		$session_data = $this->session->userdata('site_user');		if($userid!=$session_data['email']){			$this->session->set_flashdata('error', 'Please enter your registered email address.');			redirect('student/download_admit_card');		}
		//load required helper, library
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//check validation for post data
		$this->form_validation->set_rules('registration_number', 'Email Address', 'required|valid_email');
		//$this->form_validation->set_rules('caption', 'Caption', 'required');
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('site/parts/header');
			$this->load->view('site/user/download_admit_card',$data);
			$this->load->view('site/parts/footer');
		} else {
		
		$student_detail = $this->exam_model->getExamData($userid);
		//print_r($student_detail->id);
		if(isset($student_detail)&&$student_detail!='')
		{
			$html = "";
			$html.= '<table style="border:1px solid;height:200px; width:400px;" aling="center">';
			$html.= '<tr><td>FICCI-RGNIIPM Online Cretificate Course on IP Protection& Commercilization</td><td></td></tr>';
			$html.= '<tr><td><img src="'.base_url().'/uploads/user/'.$student_detail->user_image_file.'"/></td><td></td></tr>';
			$html.= '<tr><td>Student Name</td><td>'.$student_detail->first_name.'</td></tr>';
			$html.= '<tr><td>Exam name</td><td>'.$student_detail->exam_name.'</td></tr>';
			$html.= '<tr><td>Exam Date</td><td>'.$student_detail->exam_date.'</td></tr>';
			$html.= '<tr><td>Exam Venue</td><td>'.$student_detail->exam_venue.'</td></tr>';
			$html.= '<tr><td>Exam Time</td><td>'.$student_detail->exam_time.'</td></tr>';
			$html.= '</table>';
		
			$this->create_pdf($html,"admin_card_IP_exam.pdf");
			//force_download($name, $text);
		} else {
			$this->session->set_flashdata('error', 'Your Registration number does not match in our database.');
			redirect('student/download_admit_card');
			}
		}
		}
		else {
		$this->load->view('site/parts/header');
		$this->load->view('site/user/download_admit_card',$data);
		$this->load->view('site/parts/footer');
		}
	}
	
	function create_pdf($html_data, $file_name = "") {
        if ($file_name == "") {
            $file_name = 'report' . date('dMY');
        }
        $this->load->library('Pdf');

		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Admit Card IP Course - 2016";
		$obj_pdf->SetTitle($title);
		$obj_pdf->SetHeaderData('', '', $title, 'Federation of Indian Chambers of Commerce and Industry (FICCI)
		Federation House, Tansen Marg, New Delhi - 110 001
		E-mail: ipcourse@ficci.com Contact Numbers: 011-23487477, 23766930');
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
			// we can have any view part here like HTML, PHP etc
			$content = ob_get_contents();
		ob_end_clean();
		$obj_pdf->writeHTML($html_data, true, false, true, false, '');
		$obj_pdf->Output($file_name, 'D');
    }
	
	// Quiz Play method -- Manoj Sharma
	// Quiz Play method -- Manoj Sharma

	 function play_quiz(){
		
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		
		if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		
		$this->session->set_userdata('device_message',"Please use Desktop or laptop to start the exam.");
		
			redirect('student/user_dashboard');
		}
		
		$currDate = date("Y-m-d");
		$session_data = $this->session->userdata('site_user');
		//echo '<pre>'; print_r($session_data); die;
		
		$data['setting_data'] = $this->setting_model->getSettingData();
		
		$data['quiz_data'] = $this->quiz_model->listQuizFront($session_data['exam_type']);
		
		//echo '<pre>'; print_r($data['quiz_data']); die;
		if($this->session->userdata('user_choice'))
		{
		$this->session->unset_userdata('user_choice');
		$this->session->unset_userdata('count');
		}
		$this->load->view('site/parts/header');
		$this->load->view('site/user/play_quiz',$data);
		$this->load->view('site/parts/footer');
	  }

	  function play_quiz_result()
	  {
		//echo "Test"; die;
		$session_data = $this->session->userdata('site_user');
		
		$user_id = $session_data['user_id'];	
		$quizid = $_POST['quizid'];
		
		$data['quiz_data'] = $this->quiz_model->getQuizByID($quizid);
		
		$currTime = date('H:i:s');
		$quizEndTime = date('H:i:s',strtotime($data['quiz_data'][0]->end_time));
		
		if(strtotime($currTime)< strtotime($quizEndTime)){
			
		if(!isset($this->session->userdata['user_choice']))
		{
			$user_choice = array();
			$this->session->set_userdata('user_choice', $user_choice);
		}
		
		$isQuizRunning = $this->quiz_model->isQuizRunning($quizid,$user_id);
		$userAnswer = array();
		if($isQuizRunning){
			if($isQuizRunning[0]->answer != ""){
				$userAnswer = json_decode($isQuizRunning[0]->answer);
				
			}
		}
		
		$user_choice1 =  $this->session->userdata('user_choice');
		
		
		array_push($user_choice1,$_POST['user_choice']);
		$this->session->set_userdata('user_choice', $user_choice1);
		
		//$allAnswer = array_merge($userAnswer , $user_choice1);
		array_push($userAnswer,$_POST['user_choice']);
		$allAnswer = $userAnswer;
		//echo '<pre>'; print_r($allAnswer); die;
		
		
		$user_answer = json_encode($allAnswer);
		
	 	if(!$this->session->userdata('count')){
			$this->session->set_userdata('count',array($_POST['count']));
			$count = $this->session->userdata('count');
			
		} else {
			$this->session->set_userdata('count',array($_POST['count']));
			$count = $this->session->userdata('count');
			$count = $count[0];
		
		}
		
		
		  
		  $count =  $_POST['count']; 
          $uchoice = $_POST['user_choice'];	
          $quesid = $_POST['quesid'];	
		  
		 		  
		  $updateResult = array('answer'=> $user_answer);
		  
		  //echo '<pre>'; print_r($updateResult); 
		  $result = $this->quiz_model->addQuizResult($quizid,$user_id,$updateResult);
		
		  $question_data = $this->question_model->getQuestionByQuizID($quizid);
		  $totalQuestion = count($question_data);
		  //echo '<pre>'; print_r($question_data); die;
		 
		  $quizdata = array(
		  'quiz_id'=>$quizid,
		  'user_id'=>$user_id,
		  'quesid'=>$quesid,
		  'correct_choice' =>$uchoice,
		  );
		  
		  
		  if(isset($count) && $count< $totalQuestion) {
	
			?>
		      <div class="form-right" style="width:100%">
                <div class="form-row" id="quiz_div">
					<div class="form-label"><p><span>Q:<?php echo $count+1;?></span> <?php echo $question_data[$count]->title;?></p></div>
                    <div class="form-input">
                    
                    <ul>
                        <li>
                            <input type="radio"   name="choice" id="quiz1" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_1)){echo $question_data[$count]->choice_1;}?>"/><?php if(isset($question_data[$count]->choice_1)){ ?> <label for="quiz1"> <?php echo $question_data[$count]->choice_1;}?></label>
                        </li>
                        <li>
                            <input type="radio"  name="choice" id="quiz2" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_2)){ echo $question_data[$count]->choice_2;}?>"/><?php if(isset($question_data[$count]->choice_2)){ ?> <label for="quiz2"> <?php echo $question_data[$count]->choice_2;}?></label>
                        </li>
                        <li>
                            <input type="radio"  name="choice" id="quiz3" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_3)){echo $question_data[$count]->choice_3;}?>"/><?php if(isset($question_data[$count]->choice_3)){ ?> <label for="quiz3"> <?php echo $question_data[$count]->choice_3;}?></label>
                        </li>
                        <li>
                            <input type="radio"   name="choice" id="quiz4" class="rdquiz" value="<?php if(isset($question_data[$count]->choice_4)){ echo $question_data[$count]->choice_4;}?>"/><?php if(isset($question_data[$count]->choice_4)){ ?> <label for="quiz4"> <?php echo $question_data[$count]->choice_4;}?></label>
                        </li>
            		</ul>
                    <input type="button" id="btnNextQuestion" onclick="playing_quiz()" value="Next">
                    <input type="hidden" id="count" name="count" value="<?php echo $count+1;?>"/>
                    <input type="hidden" id="quizid" name="quizid" value="<?php echo $question_data[$count]->quiz_id;?>"/>
                    <input type="hidden" id="quesid" name="quesid" value="<?php echo $question_data[$count]->id;?>"/>
					<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>"/>
					<input type="hidden" id="total_question" name="total_question" value="<?php echo count($question_data);?>"/>
					<input type="hidden" id="last_progress" name="last_progress" value="13"/>
					
                    <!--<input type="radio"  onclick="playing_quiz()" name="choice" value="<?php //echo $question_data[$count]->choice_1;?>"/><?php echo $question_data[$count]->choice_1;?>
                    <input type="radio"  onclick="playing_quiz()" name="choice" value="<?php //echo $question_data[$count]->choice_2;?>"/><?php echo $question_data[$count]->choice_2;?>
                    <input type="radio"  onclick="playing_quiz()" name="choice" value="<?php //echo $question_data[$count]->choice_3;?>"/><?php echo $question_data[$count]->choice_3;?>
                    <input type="radio"  onclick="playing_quiz()" name="choice" value="<?php //echo $question_data[$count]->choice_4;?>"/><?php echo $question_data[$count]->choice_4;?>-->
                    </div>
                </div>
			</div>
		  
	  <?php } else
	        {
		      echo "done";
	        }
			
			
         }else{
			 /* $status = array('status'=> 'done');
			 $result = $this->quiz_model->updateResult($quizid,$user_id,$status);
			 redirect('student/quiz_result_page/'.$quizid.'/'.$user_id); */
			 echo "done";
		 }
	  }  
	  
	      function play_quiz_start()
		{
			
		  //$session_data = $this->session->userdata('site_user');
			$user = $this->session->userdata['site_user'];
			//echo '<pre>'; print_r($user); die;
			$user_id = $user['user_id'];
		 
		
		
		
		
		 
		  //echo '<pre>'; print_r($session_data); die;
	      $data['setting_data'] = $this->setting_model->getSettingData();
		  $this->form_validation->set_rules('quiz_name', 'Quiz Name', 'required');
			
		$data['userID'] = $user_id;
		  if($_SERVER['REQUEST_METHOD']=='POST'){
			  
			$quiz_id = $this->input->post('quiz_name');
			
			$data['question_data'] = $this->question_model->getQuestionByQuizID($quiz_id);
			
			if(sizeof($data['question_data'])>0){
				
			 if ($this->session->userdata('re_exam') == FALSE) {
											
				$lastExamDetail = $this->quiz_model->getReExams($user_id);
				
				if(sizeof($lastExamDetail) > 0){
				$user['last_exam_id'] = $lastExamDetail[0]->quiz_id;
				$this->session->set_userdata('site_user',$user);
				
				if($user['re_exam'] == 1){
				
				  $reExamStatus = array('re_exam'=> 0);
				  $update_result = $this->quiz_model->updateResult($user['last_exam_id'],$user_id,$reExamStatus);
			 }
				
			}else{
				$session_data['last_exam_id'] = 0; 
				//$session_data['re_exam'] = 0;	
				
			}
				
			}
			
			}
			
		  //echo $user['user_id']; die;
			  
		
		  if ($this->form_validation->run() == FALSE){ 
				$this->load->view('site/parts/header');
				$this->load->view('site/user/play_quiz',$data);
				$this->load->view('site/parts/footer');
			} else {
				//$quiz_id = $this->input->post('quiz_name');
				
				
				$data['quiz_data'] = $this->quiz_model->getQuizByID($quiz_id);
				//echo '<pre>'; print_r($data['quiz_data']); die;
				//echo $data['quiz_data'][0]->exam_duration; die;
				$quizSessionId = $data['quiz_data'][0]->session_id;
				
				$currTime = date('H:i:s');
				$quizEndTime = date('H:i:s',strtotime($data['quiz_data'][0]->end_time));
				
					
				$data['resume_exam'] = 0;
					
					
					$isQuizRunning = $this->quiz_model->isQuizRunning($quiz_id,$user_id);
										
					if(sizeof($data['question_data'])>0){
					
					if(!$isQuizRunning){
						
						$data_result = array(
								'user_id' => $user_id,
								'quiz_id' => $quiz_id,
								'duration' => 0,
								'session_id' => $quizSessionId,
								'status' => 'pending',
								'created' => date('Y-m-d H:i:s'),
								
							);
						
						if($user['re_exam'] == 1){
							$data_result['exam_type'] = 're-exam';
						}	
				  
						$insertResult = $this->quiz_model->createQuizResult($data_result);
						$data['count'] = 0;
					}else{
						
							if($isQuizRunning[0]->status == 'done'){
								
								$this->session->set_userdata('quiz_message',"You have already attempt this exam");
								redirect('student/user_dashboard');
							}
						
						if(strtotime($currTime)< strtotime($quizEndTime)){
							if($isQuizRunning[0]->duration < $data['quiz_data'][0]->exam_duration){
								
								
								$arrayAnswer = $isQuizRunning[0]->answer;
								
								if(isset($this->session->userdata['count'])){
									$count = $this->session->userdata('count');
									$data['count'] = $count[0];
									
								}else{
									if($arrayAnswer!=""){
										
										$arrayAnswer = json_decode($arrayAnswer);
										
										if(count($arrayAnswer) < count($data['question_data'])){
										$data['count'] = count($arrayAnswer);
										$data['resume_exam'] = 1;
										}else{
											$this->session->set_userdata('quiz_message',"You have already completed this exam");
											redirect('student/user_dashboard');
										}
										
									}else{
										
										$data['count'] = 0;
									}
									
								}
							}else{
								$this->session->set_userdata('quiz_message',"You have already attempt this exam");
								redirect('student/user_dashboard');
							}
						}else{
								 $status = array('status'=> 'done');
								 $result = $this->quiz_model->updateResult($quiz_id,$user_id,$status);
								 redirect('student/quiz_result_page/'.$quiz_id.'/'.$user_id);
						}
					}
					
					}
				
				$data['user_id'] = $user_id;
				$data['exam_duration'] = $data['quiz_data'][0]->exam_duration;
				
				//echo "<pre>"; print_r($data['question_data']); echo "</pre>";
			/* 	if(isset($this->session->userdata['count'])){
					/*$this->session->set_userdata('count',array($_POST['count']));
					$count = $this->session->userdata('count');*/
					/*$count = $this->session->userdata('count');
					$data['count'] = $count[0];
					
				} else {
					
					//$this->session->set_userdata('count',array($_POST['count']));
					$data['count'] = 0;
				} */
		
				$this->load->view('site/parts/header');
				$this->load->view('site/user/quiz_start',$data);
				$this->load->view('site/parts/footer');
			}
		}
		else{
		$data = array();
		$session_data = $this->session->userdata('site_user');
		$data['user_id'] = $session_data['user_id'];
		$data['setting_data'] = $this->setting_model->getSettingData();
		$data['exam_data'] = $this->exam_model->get_exam_detail();
		$data['user_name'] = $session_data['username'];
		$data['payment_id'] = $session_data['payment_id'];
		$data['payment_status'] = $session_data['payment_status'];
		$data['announcement'] = $this->announcement_model->get_active_announcement();
		$data['stuData'] = $this->student_model->getStudentData($session_data['user_id']);
		$this->load->view('site/parts/header');
		$this->load->view('site/user/dashboard',$data);
		$this->load->view('site/parts/footer');
		}
	}
	
	function updateExamDuration(){
		$quizId = $this->input->post('quizId');
		$userId = $this->input->post('userId');
		$data['quiz_data'] = $this->quiz_model->getQuizByID($quizId);
		//echo '<pre>'; print_r($data['quiz_data']); die;
		$currTime = date('H:i:s');
		$quizEndTime = date('H:i:s',strtotime($data['quiz_data'][0]->end_time));
		
		$lastDuration = $this->quiz_model->isQuizRunning($quizId,$userId);
		if(strtotime($currTime)< strtotime($quizEndTime)){
			if($lastDuration[0]->duration < $data['quiz_data'][0]->exam_duration){
				$updatedDuration = $lastDuration[0]->duration + 1;
				//echo $updatedDuration; die;
				$duration = array('duration'=> $updatedDuration);
				$update_duration = $this->quiz_model->updateResult($quizId,$userId,$duration);
				
				if($updatedDuration == $data['quiz_data'][0]->exam_duration ){
					
					echo "Done";
				}
				
			}else{
				
				echo "Done"; 
				exit;
			}
		}else{
			echo "Done"; 
			exit;
		}
		
	}
	
	function quiz_result_page($qid=NUll,$userId=NULL){
		$session_data = $this->session->userdata['site_user'];
		//echo '<pre>'; print_r($session_data); die;
		//echo $session_data['re_exam'];
		$data['about_quiz']=$this->quiz_model->getQuizByID($qid);
		$correct_choice = $this->question_model->quiz_Correct_Choice($qid);
		
		if(sizeof($correct_choice) < 0)
		{
			show_404();
		}
		
		$user_choice = $this->session->userdata('user_choice');
		$userChoiceObj = $this->quiz_model->isQuizRunning($qid,$userId);
		
		if(sizeof($userChoiceObj) > 0){
		$userChoiceDb = json_decode($userChoiceObj[0]->answer);
		}else{
			show_404();
		}
		
		$marks = 0;
		
		//echo '<pre>'; print_r($userChoiceDb); die;
		
		foreach($correct_choice as $choice)
		{
		$choice1[] = $choice->correct_choice;
		}
		
		$userAllAnswer = array();
		if(!empty($user_choice) && !empty($userChoiceDb)){
			$userAllAnswer = array_merge($user_choice, $userChoiceDb);
			$userAllAnswer = array_unique($userAllAnswer);
			$data['rightans']=array_intersect($userAllAnswer,$choice1);
			$data['wrongans']=array_diff($userAllAnswer,$choice1);
			$marks = array_intersect($userAllAnswer,$choice1);
		}elseif(!empty($user_choice)){
			$userAllAnswer = $user_choice;
			$data['rightans']=array_intersect($userAllAnswer,$choice1);
			$data['wrongans']=array_diff($userAllAnswer,$choice1);
			$marks = array_intersect($userAllAnswer,$choice1);
		}elseif(!empty($userChoiceDb)){
			$userAllAnswer = $userChoiceDb;
			$data['rightans']=array_intersect($userAllAnswer,$choice1);
			$data['wrongans']=array_diff($userAllAnswer,$choice1);
			$marks = array_intersect($userAllAnswer,$choice1);
		}
		
		
		//echo '<pre>'; print_r($userAllAnswer); die;
		
		
		
		$studentAssignment = $this->assignment_model->getStudentAssignmentByStudentId($userId);
		 $assignmentMarks = "";
		 foreach($studentAssignment as $assignments){
			 $assignmentMarks +=$assignments->mark_obtained;
		 }
		
		
		
		$finalMarks = count($marks) + $assignmentMarks;
		
		$grade = "";
		$applicable_reexam =0;
		$effectiveDate = "";
		
		if($finalMarks >= 80){
			$grade = "A";
			$data['grade'] = $grade;
		}elseif($finalMarks >= 60 && $finalMarks <=79){
			$grade = "B";
			$data['grade'] = $grade;
		}elseif($finalMarks >= 50 && $finalMarks <=59){
			$grade = "C";
			$data['grade'] = $grade;
		}else{
			$grade = "Failed";
			$data['grade'] = $grade;
			$idate = date('Y-m-d H:i:s');
			$effectiveDate = date('Y-m-d H:i:s',strtotime("+48 hours", strtotime($idate)));
			
			if($session_data['re_exam'] == 1){
				$applicable_reexam = 0;
				
			}else{
				$applicable_reexam = 1;
			}
		}
		
		if($session_data['re_exam'] == 1){
			$marksData = array('marks'=>count($marks),'final_marks'=> $finalMarks,'grade'=> $grade,'assignment_marks'=> $assignmentMarks,'re_exam'=> $applicable_reexam,'exam_type'=> 're-exam');
		}else{
			$marksData = array('marks'=>count($marks),'final_marks'=> $finalMarks,'grade'=> $grade,'assignment_marks'=> $assignmentMarks,'re_exam'=> $applicable_reexam);
		}
		
		
		$update_duration = $this->quiz_model->updateResult($qid,$userId,$marksData);
		
		$update_user_payment_status = array(
					're_exam_payment_id' => 0,
					're_exam_payment_status' => 0,					
				);
			
		if($effectiveDate != ""){
			$update_user_payment_status['re_exam_reminder_mail_time'] = $effectiveDate;
		}
		
		$this->student_model->updateStudentDataByID($update_user_payment_status, $userId);
		
		$result = $this->student_model->getStudentData($userId);
		
		$resultData = $this->quiz_model->getResult($qid,$userId);
		$session = $this->getSessionByQuizId($qid);
		$sessionStartMonth =  date("F", strtotime($session[0]->sessionStart));
		$sessionEndMonth =  date("F", strtotime($session[0]->sessionEnd));
		$sessionYear =  date("Y", strtotime($session[0]->sessionEnd));
			
			$getStudentDetail = $this->student_model->get_student_data_by_id($userId);
			$getReExamFees = $this->fees_model->chkFeeByTypeId($getStudentDetail->user_type_id);
			$reExamFees = $getReExamFees->re_exam_fees;
			
		$subject = "FICCI Online Examination  Result Announcement";
				$data['site_name'] = $this->config->item('Site_name');
								
				$data['name'] = $result->first_name." ".$result->last_name;
				$data['email'] = $result->email;
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				$data['result'] = $resultData[0]->grade;
				$data['re_exam_fees'] = $reExamFees;
				$data['marks_obtaine'] = $resultData[0]->marks;
				$data['assignment_marks'] = $resultData[0]->assignment_marks;
				$data['final_marks'] = $resultData[0]->final_marks ;
				
				$message = $this->load->view('site/email/exam_result',$data, true);
				$this->sendEmail($data['email'], $subject, $message);
		
		
		
		if($grade == "Failed" && $session_data['re_exam'] != 1){
			
						$subject1 = "FICCI Online New session";
						$data1['site_name'] = $this->config->item('Site_name');
						
						$data1['name'] = $getStudentDetail->first_name." ".$getStudentDetail->last_name;
						$data1['email'] = $getStudentDetail->email;
						$data1['re_exam_fees'] = $reExamFees;
						$data1['sessionStartMonth'] = $sessionStartMonth;
						$data1['sessionEndMonth'] = $sessionEndMonth;
						$data1['sessionYear'] = $sessionYear;
						$message1 = $this->load->view('site/email/notification_non_appeared_failed_student',$data1, true);
						
						$this->sendEmail($data1['email'], $subject1, $message1);
		}
	 
        $data['choice1'] = $choice1;
		
		$this->load->view('site/parts/header');
		$this->load->view('site/user/play_quiz_result_page',$data);
		$this->load->view('site/parts/footer');
	}
	
	function updateResultStatus(){
		
		$quizId = $this->input->post('quizId');
		$userId = $this->input->post('userId');
		$status = array('status'=> $this->input->post('status'));
		$update_status = $this->quiz_model->updateResult($quizId,$userId,$status);
		
	}
	
	
	function resume_exam($quizId){
		
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		
			if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			
			$this->session->set_userdata('device_message',"Please use Desktop or laptop to start the exam.");
			
				redirect('student/user_dashboard');
		}
		
			$user = $this->session->userdata['site_user'];
			$user_id = $user['user_id'];
			$data['userID'] = $user_id;
			$quiz_id = $quizId;
			$data['resume_exam'] = 0;
				$data['quiz_data'] = $this->quiz_model->getQuizByID($quiz_id);
				$currTime = date('H:i:s');
				$quizEndTime = date('H:i:s',strtotime($data['quiz_data'][0]->end_time));
	
				$data['question_data'] = $this->question_model->getQuestionByQuizID($quiz_id);
				
					$isQuizRunning = $this->quiz_model->isQuizRunning($quiz_id,$user_id);
					//echo '<pre>'; print_r($isQuizRunning); die;
					
					//echo $isQuizRunning[0]->duration; die;
			
					//echo $quiz_id; die;
					if(sizeof($data['question_data'])>0){
					
					if(!$isQuizRunning){
						
						$data_result = array(
								'user_id' => $user_id,
								'quiz_id' => $quiz_id,
								'status' => 'pending',
								'created' => date('Y-m-d H:i:s'),
								
							);
				  
						$insertResult = $this->quiz_model->createQuizResult($data_result);
					}else{
						
							if($isQuizRunning[0]->status == 'done'){
								
								$this->session->set_userdata('quiz_message',"You have already attempt this exam");
								redirect('student/user_dashboard');
							}
							if(strtotime($currTime)< strtotime($quizEndTime)){
								if($isQuizRunning[0]->duration < $data['quiz_data'][0]->exam_duration){
								//echo "Continue"; die;
								$arrayAnswer = $isQuizRunning[0]->answer;
								
								if($arrayAnswer!=""){
									
										
										$arrayAnswer = json_decode($arrayAnswer);
										
									if(count($arrayAnswer) < count($data['question_data'])){
										
										/* if(isset($this->session->userdata['count'])){
											$data['count'] = $this->session->userdata['count'][0];
										}else{
											$data['count'] = 0;
										} */
										
										$data['count'] = count($arrayAnswer);
										$data['resume_exam'] = 1;
										}else{
											$this->session->set_userdata('quiz_message',"You have already completed this exam");
											redirect('student/user_dashboard');
										}
									}else{
										$data['count'] = 0;
									}
								
								
							}else{
							$this->session->set_userdata('quiz_message',"You have already attempt this exam");
							redirect('student/user_dashboard');
							}
						}else{
								 $status = array('status'=> 'done');
								 $result = $this->quiz_model->updateResult($quiz_id,$user_id,$status);
								 redirect('student/quiz_result_page/'.$quiz_id.'/'.$user_id);
						}
					}
					
					}
				
				$data['user_id'] = $user_id;
				$data['exam_duration'] = $data['quiz_data'][0]->exam_duration;
				
		
		
				$this->load->view('site/parts/header');
				$this->load->view('site/user/quiz_start',$data);
				$this->load->view('site/parts/footer');
		
	}
	
	function getSessionByQuizId($id){
		
		$sessionDetail = $this->quiz_model->getSessionByQuizId($id);
		return $sessionDetail;
		
	  }
	  
	function re_exam(){
		
		$session_data = $this->session->userdata('site_user');
		
		$userPayment = $this->user_model->getPaymentStatus($session_data['user_id']);
		/* $data['re_exam_payment_id'] = $userPayment[0]->re_exam_payment_id;
		$data['re_exam_payment_status'] = $userPayment[0]->re_exam_payment_status; */
		$session_data['re_exam_payment_id'] = $userPayment[0]->re_exam_payment_id;
		$session_data['re_exam_payment_status'] = $userPayment[0]->re_exam_payment_status;
		$session_data['exam_type'] = 're-exam';
		$session_data['re_exam'] = 1;	
		
		$this->session->set_userdata('site_user',$session_data);
		//echo '<pre>'; print_r($session_data); die;
		$data['user_name'] = $session_data['username'];
		$data['stuData'] = $this->student_model->getStudentData($session_data['user_id']);
		$data['re_exam_payment_id'] = $session_data['re_exam_payment_id'];
		$data['re_exam_payment_status'] = $session_data['re_exam_payment_status'];
		
		$this->load->view('site/parts/header');
		$this->load->view('site/user/re_exam',$data);
		$this->load->view('site/parts/footer');
		
		//$data['payment_detail'] = $this->payment-model->get_front_page_data('student-dashboard');
	}  
	
	
	function re_exam_payment(){
		
		$session_data = $this->session->userdata('site_user');
		//echo '<pre>'; print_r($session_data); die;
		$feesData = $this->fees_model->chkFeeByTypeId($session_data['user_type_id']);
		
		 if($session_data['re_exam_payment_status']==1){
			$this->session->set_flashdata('info', 'Your re exam payment is already varified.');
			redirect('student/user_dashboard');
		}

		if($session_data['re_exam_payment_id']!=0 and $session_data['re_exam_payment_status']==0){
			$this->session->set_flashdata('info', 'Your re exam request is pending for admin approval.');
			redirect('student/user_dashboard');
		}
		
		//load required helper, library
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$data = array();
		$data['payment_type'] = $this->student_model->getPaymentType();
		
		$user_id = $session_data['user_id'];
		$data['fee'] = $feesData->re_exam_fees;
		
		$data['user_name'] = $this->session->userdata('username');
		//get student data by id
		$result = $this->student_model->getStudentData($user_id);
		
		//set validation rules
		$this->form_validation->set_rules('chequedate', 'Cheque Date', 'required');
		//$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
		$this->form_validation->set_rules('coursefees', 'Course Fee', 'required|numeric');
		$this->form_validation->set_rules('chequenumber', 'Cheque Number', 'required|alpha_numeric');
		$this->form_validation->set_rules('bankname', 'Bank Name', 'required|callback_customAlpha');
		$this->form_validation->set_rules('branchname', 'Branch Name', 'required|callback_customAlpha');
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		//Working with form post data
		if($_SERVER['REQUEST_METHOD']=='POST'){
			//echo "Test"; die;
			$payment_on = date_create($this->input->post('chequedate'));
			$payment_on = date_format($payment_on,"Y/m/d");
			if ($this->form_validation->run() == FALSE){
				
				$this->load->view('site/parts/header');
				$this->load->view('site/user/make_payment',$data);
				$this->load->view('site/parts/footer');
			} else {
				
				$payment_data = array(
					'user_id' => $user_id,
					'payment_type_id' => $this->input->post('payment_type'),
					'cheque_date' => $this->input->post('chequedate'),
					'payment_on' => $payment_on,
					'course_fee' => $this->input->post('coursefees'),
					'reference_no' => $this->input->post('chequenumber'),
					'bank_name' => $this->input->post('bankname'),
					'branch_name' => $this->input->post('branchname'),
					'exam_type' => 2,
					're_exam_payment_status' => 0,
					'created' => date('Y-m-d H:i:s'),
				);
				$coursefees = $this->input->post('coursefees');
				$serviceTax = $this->config->item('ServiceTax');
				$vendorPrice = $this->source_model->get_source_data_by_id($result->sourceinformation);
				
				$paymentType = $vendorPrice->payment_type;
				//echo "<pre>"; print_r($result); die;
				if($paymentType=='percent')
				{
					$vAmt = $vendorPrice->amount;
					$serVicAmt = $coursefees*$serviceTax/100;
					
					$stAmt = $coursefees-$serVicAmt;
					$venAmt = $vAmt*$stAmt/100;
					$grossAmt = $stAmt-$venAmt;
				}
				if($paymentType=='flat')
				{
					$venAmt = $vendorPrice->amount;
					$serVicAmt = $coursefees*$serviceTax/100;
					
					$stAmt = $coursefees-$serVicAmt;
					
					$grossAmt = $stAmt-$venAmt;
				}
				if($paymentType=='fixed_amount')
				{
					$venAmt = $vendorPrice->amount;
					$serVicAmt = '';
					//$coursefees*$serviceTax/100;
					//$stAmt = $coursefees-$serVicAmt;
					//$venAmt = $vAmt*$stAmt/100;
					$grossAmt = $coursefees;
				}
				
				$payment_data['vendor_amount'] = $venAmt;
				$payment_data['gross_amount'] = $grossAmt;
				$payment_data['servicetax_amount'] = $serVicAmt; 
				
				//echo "<pre>"; print_r($payment_data); die;
				$insert_id = $this->student_model->insert_user_payment_data($payment_data);
				
				$update_user_data = array(
					're_exam_payment_id' => $insert_id,
					're_exam_payment_status' => 0,					
				);
				
				$this->student_model->updateStudentDataByID($update_user_data, $user_id);
				
				$update_session_data = array(
					'user_id' => $this->session->userdata['site_user']['user_id'],
					'username' => $this->session->userdata['site_user']['username'],
					'email' => $this->session->userdata['site_user']['email'],
					'user_type_id' => $this->session->userdata['site_user']['user_type_id'],
					'course_fee' => $this->session->userdata['site_user']['course_fee'],
					'payment_id' => $this->session->userdata['site_user']['payment_id'],
					'payment_status' => $this->session->userdata['site_user']['payment_status'],
					're_exam_payment_id' => $insert_id,
					're_exam_payment_status' => 0,
					'exam_type' => 're_exam',
					'logged_in' => true,
					'user_type' => 'site'
					
				);
				
				//update session data
				/* $this->session->set_userdata('site_user',$update_session_data); */
				
				/* $subject = "FICCI Online Course- Payment Details";
				$data['site_name'] = $this->config->item('Site_name');
				//$res_payment = $this->student_model->getPaymentByID($this->input->post('payment_type'));
				
				$data['name'] = $result->first_name." ".$result->last_name;
				$data['email'] = $result->email;
				$data['payment_type'] = $this->input->post('payment_type');
				$data['reference_no'] = $this->input->post('chequenumber');
				$data['payment_date'] = $this->input->post('chequedate');
				$data['bank_name'] = $this->input->post('bankname');
				$data['branch_name'] = $this->input->post('branchname');
				$data['course_fee'] = $this->input->post('coursefees');
				$message = $this->load->view('site/email/payment',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message); */
				
				//after successful submission
				
				
				$session_id = $result->session_id;
				$session_data = $this->session_model->getSessionByID($session_id);
				
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
										
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				}
				
				//update session data
				$this->session->set_userdata('site_user',$update_session_data);
				
				$subject = "FICCI Online Course- Re-Exam Payment Details";
				$data['site_name'] = $this->config->item('Site_name');
				//$res_payment = $this->student_model->getPaymentByID($this->input->post('payment_type'));
				
				$data['name'] = $result->first_name." ".$result->last_name;
				$data['email'] = $result->email;
				$data['payment_type'] = $this->input->post('payment_type');
				$data['reference_no'] = $this->input->post('chequenumber');
				$data['payment_date'] = $this->input->post('chequedate');
				$data['bank_name'] = $this->input->post('bankname');
				$data['branch_name'] = $this->input->post('branchname');
				$data['course_fee'] = $this->input->post('coursefees');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				$message = $this->load->view('site/email/re_exam_payment',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message);
				
				
				$this->session->set_flashdata('success', 'You have successfully submitted your payment information.');
				redirect('student/re_exam');
			}
		} else {
			$this->load->view('site/parts/header');
			$this->load->view('site/user/re_exam_payment',$data);
			$this->load->view('site/parts/footer');
		} 
	}
	
	function getLastDuration(){
		
		$quizId = $this->input->post('quizId');
		$userId = $this->input->post('userId');
		$data = array();
		$lastDuration = $this->quiz_model->isQuizRunning($quizId,$userId);
		//echo '<pre>'; print_r($lastDuration);
		$duration = $lastDuration[0]->duration;
		$second = $lastDuration[0]->second;
		$data = array('duration'=>$duration,'second'=>$second);
		//echo '<pre>'; print_r($data);
		$data = json_encode($data);
		echo $data;
		exit;
	}
	
	function updateSecond(){
		$quizId = $this->input->post('quizId');
		$userId = $this->input->post('userId');
		
		$lastSecond = $this->quiz_model->isQuizRunning($quizId,$userId);
		
		//if($lastSecond[0]->second < 60){
			//echo $lastSecond[0]->second; die;
			if($lastSecond[0]->second == 60 || $lastSecond[0]->second > 60){
				//echo "Test"; die;
				
				$updatedSecond = 1;
				$second = array('second'=> $updatedSecond);
				$update_second = $this->quiz_model->updateResult($quizId,$userId,$second);
			}else{
				$updatedSecond = $lastSecond[0]->second + 10;
					//echo $updatedDuration;
					//echo $updatedDuration; die;
				$second = array('second'=> $updatedSecond);
				$update_second = $this->quiz_model->updateResult($quizId,$userId,$second);
			
			}
				
			
	//	}
		
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */