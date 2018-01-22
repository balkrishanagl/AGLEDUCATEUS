<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Payment extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$session_data = $this->session->userdata('admin_user');
		
		if($session_data['admin_user_type_id']==3){
			redirect('admin/dashboard');
		}
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("user_model");
		$this->load->model("student_model");
		$this->load->model("payment_model");
		$this->load->model('source_model');
		$this->load->model('session_model');
		
	}

	function index()
	{
		redirect('admin/payment/manage_payment');
	}
	
	//Method to list payment - Balkrishan
	function manage_payment(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'payment';
		    $header['tab'] = 'manage_payment';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'payment';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'payment';
			/*if($session_data['admin_username']!='admin'){
				$data['question_list'] = $this->question_model->listQuestion($session_data['id']);
			} else {*/
				$data['session_data'] = $this->session_model->getAllActiveSession();
				$data['payment_list'] = $this->payment_model->listPayment(null,null,null,null,null,null,null,1);
			//}
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/payment/manage_payment', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function manage_re_exam_payment(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'payment';
		    $header['tab'] = 'manage_re_exam_payment';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'payment';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'payment';
			/*if($session_data['admin_username']!='admin'){
				$data['question_list'] = $this->question_model->listQuestion($session_data['id']);
			} else {*/
				$data['session_data'] = $this->session_model->getAllActiveSession();
				$data['payment_list'] = $this->payment_model->listPayment(null,null,null,null,null,null,null,2);
			//}
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/payment/manage_re_exam_payment', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	//Method to add question - Arun
	function add_payment($Iid=NULL){
		
		if($this->session->userdata('admin_user')==''){
			redirect('admin/login', 'refresh');
		}
			$data['studentList'] = $this->student_model->get_student_list();
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$data['user_id'] = $session_data['id'];

		    $header['main_page'] = 'payment';
		    $header['tab'] = 'add_payment';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'payment';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'payment';
			$data['payment_type'] = $this->payment_model->getPaymentType();
			if($Iid)
			{
				$data['payDetail']= $this->payment_model->getPaymentDetailByID($Iid);
				
				$data['type'] = 'Edit';
			}
			else
			{
				$data['type'] = 'Add';
				$data['payDetail']= '';
			}
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('student_id', 'Student', 'trim|required');
				$this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required');
				$this->form_validation->set_rules('chequenumber', 'Reference', 'trim|required|is_numeric');
				$this->form_validation->set_rules('chequedate', 'Cheque Date', 'trim|required');
				$this->form_validation->set_rules('coursefees', 'Course Fees', 'trim|required');
				$this->form_validation->set_rules('bankname', 'Bank Name', 'trim|required');
				$this->form_validation->set_rules('branchname', 'Branch Name', 'trim|required');
				
				
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run()){
					
					
					$user_id = $this->input->post('student_id');
					$fileData = array(
						'user_id' => $this->input->post('student_id'),
						'payment_type_id' => $this->input->post('payment_type'),
						'reference_no' => $this->input->post('chequenumber'),
						'cheque_date' => date("m/d/Y",strtotime($this->input->post('chequedate'))),
						'course_fee' => $this->input->post('coursefees'),
						'bank_name' => $this->input->post('bankname'),
						'branch_name' => $this->input->post('branchname'),
						'status' => '0',
					);
					$result = $this->student_model->getStudentData($user_id);
					$coursefees = $this->input->post('coursefees');
					$serviceTax = $this->config->item('ServiceTax');
					$vendorPrice = $this->source_model->get_source_data_by_id($result->sourceinformation);
					 
					 
					$paymentType = $vendorPrice->payment_type;
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
						$serVicAmt = '0.00';
						//$coursefees*$serviceTax/100;
						//$stAmt = $coursefees-$serVicAmt;
						//$venAmt = $vAmt*$stAmt/100;
						$grossAmt = $coursefees;
					}
					//Added by Me after discussion with Vipul
					$serVicAmt = $coursefees*$serviceTax/100;

					$fileData['vendor_amount'] = $venAmt;
					$fileData['gross_amount'] = $grossAmt;
					$fileData['servicetax_amount'] = $serVicAmt;
					
					
					if($Iid)
					{
						$fileData['updated'] =  date('Y-m-d H:i:s');
						$fileData['payment_on'] =  date('Y-m-d');
						$this->payment_model->updatePayment($fileData,$Iid);
						$this->session->set_flashdata('success', 'You have updated payment successfully.');
					}
					else
					{
						$fileData['created'] =  date('Y-m-d H:i:s');
						$insert_id = $this->payment_model->addPayment($fileData);
						$update_user_data = array(
						'payment_id' => $insert_id,
						'payment_status' => 0,					
						);
					
						$this->student_model->updateStudentDataByID($update_user_data, $user_id);
						$this->session->set_flashdata('success', 'You have added payment successfully.');
					}
					//after successful submission
					
					redirect('admin/payment/manage_payment');
				}
			} 
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/payment/add_payment',$data);
			$this->load->view('admin/parts/footer',$footer);
			
		
	}
	
	
	
	
	
	//Method to get course fee by student id - Arun
	function get_data_by_id()
	{
		$Iid = $this->input->post('studentid');
		$studentData = $this->student_model->get_student_data_by_id($Iid);
		echo $studentData->course_fee;
	}
	//Method to add question - Balkrishan
	function add_question(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$data['user_id'] = $session_data['id'];

		    $header['main_page'] = 'question';
		    $header['tab'] = 'add_question';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'question';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			//get quiz for user
			if($data['username']!='admin'){
				$data['quiz_list'] = $this->question_model->getQuizByUser($data['user_id']);
			} else {
				$data['quiz_list'] = $this->question_model->getQuizByUser();
			}
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('quiz_id', 'Quiz Name', 'required');
				$this->form_validation->set_rules('title', 'Question Title', 'required');
				$this->form_validation->set_rules('choice_1', 'Choice 1', 'required');
				$this->form_validation->set_rules('choice_2', 'Choice 2', 'required');
				$this->form_validation->set_rules('choice_3', 'Choice 3', 'required');
				$this->form_validation->set_rules('choice_4', 'Choice 4', 'required');
				$this->form_validation->set_rules('correct_choice', 'Correct Choice', 'required');
				$this->form_validation->set_rules('status', 'Question Status', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/question/add_question');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					
					$fileData = array(
						'quiz_id' => $this->input->post('quiz_id'),
						'title' => $this->input->post('title'),
						'choice_1' => $this->input->post('choice_1'),
						'choice_2' => $this->input->post('choice_2'),
						'choice_3' => $this->input->post('choice_3'),
						'choice_4' => $this->input->post('choice_4'),
						'correct_choice' => $this->input->post('correct_choice'),
						'status' => $this->input->post('status'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->question_model->addQuestion($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added question successfully.');
					redirect('admin/question/add_question');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/question/add_question',$data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add question - Balkrishan
	function edit_question($id=null){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get question data
			$data['question'] = $this->question_model->getQuestionByID($id);
			
		    $header['main_page'] = 'question';
		    $header['tab'] = 'edit_question';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'question';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			//get quiz for user
			if($data['username']!='admin'){
				$data['quiz_list'] = $this->question_model->getQuizByUser($data['user_id']);
			} else {
				$data['quiz_list'] = $this->question_model->getQuizByUser();
			}
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('quiz_id', 'Quiz Name', 'required');
				$this->form_validation->set_rules('title', 'Question Title', 'required');
				$this->form_validation->set_rules('choice_1', 'Choice 1', 'required');
				$this->form_validation->set_rules('choice_2', 'Choice 2', 'required');
				$this->form_validation->set_rules('choice_3', 'Choice 3', 'required');
				$this->form_validation->set_rules('choice_4', 'Choice 4', 'required');
				$this->form_validation->set_rules('correct_choice', 'Correct Choice', 'required');
				$this->form_validation->set_rules('status', 'Question Status', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/question/edit_question', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
						$fileData = array(
							'quiz_id' => $this->input->post('quiz_id'),
							'title' => $this->input->post('title'),
							'choice_1' => $this->input->post('choice_1'),
							'choice_2' => $this->input->post('choice_2'),
							'choice_3' => $this->input->post('choice_3'),
							'choice_4' => $this->input->post('choice_4'),
							'correct_choice' => $this->input->post('correct_choice'),
							'status' => $this->input->post('status'),
							'updated' => date('Y-m-d H:i:s'),
						);
						$insert_id = $this->question_model->updateQuestion($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated question successfully.');
						redirect('admin/question/manage_question');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/question/edit_question', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add multiple question - Arun
	function add_multiple_payment(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$data['user_id'] = $session_data['id'];

		    $header['main_page'] = 'add_multi_payment';
		    $header['tab'] = 'add_multi_payment';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'payment';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//$this->form_validation->set_rules('quiz_id', 'Quiz Name', 'required');
				//$this->form_validation->set_rules('status', 'Question Status', 'required');
				
				//create error array
				//$error_arr = array();
				
				// Displaying Errors In Div
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				
					
					
				if($_FILES['payment_csv']['name'])
				{
						$arrFileName = explode('.',$_FILES['payment_csv']['name']);
					if($arrFileName[1] == 'csv'){
						$handle = fopen($_FILES['payment_csv']['tmp_name'], "r");
					
					$i = 0;			
					 
					 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
									//echo "<pre>"; print_r($data);
					$num = count($data); 
							if($i==0) { $i++; continue; }  // to exclude first row in the csv file.
								 
			 		// $recipients = '';
					for ($c=0; $c < $num; $c++) 
					 {
				          $col[$c] = $data[$c];
						 // $csvrecipients.= $col[$c].","; 

							// $temp = false;
							//echo $col[$c]."<br>";
					  }
					 // echo "<pre>"; print_r($col);
					 $col0 = trim($col[0]);
					 $col1 = $col[1];
					 $col2 = $col[2];
					 $col3 = $col[3];
					 $col4 = $col[4];
					 $col5 = $col[5];
					 $col6 = $col[6];
					 
					 
					 $this->db->select('users.email,user_profiles.user_id,user_profiles.sourceinformation,ficci_source_information.amount,ficci_source_information.payment_type');
					 $this->db->where('users.email',$col0);
					 $this->db->join('user_profiles','users.id=user_profiles.user_id');
					 $this->db->join('ficci_source_information','ficci_source_information.id=user_profiles.sourceinformation');
					 $query = $this->db->get('users');
					
					 $row = $query->row();
					if(sizeof($row)>0)
					{
						$fileData = array(
							'user_id' => $row->user_id,
							'payment_type_id' => $col1,
							'reference_no' => $col4,
							'cheque_date' => $col2,
							'course_fee' => $col3,
							'bank_name' => $col5,
							'branch_name' => $col6,
							'status' => '0',
						);
						$result = $this->student_model->getStudentData($row->user_id);
						$coursefees = $col3;
						$serviceTax = $this->config->item('ServiceTax');
						$vendorPrice = $this->source_model->get_source_data_by_id($result->sourceinformation);
						 //echo "<pre>"; print_r($vendorPrice); 
						 
						$paymentType = $vendorPrice->payment_type;
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
						
						$fileData['vendor_amount'] = $venAmt;
						$fileData['gross_amount'] = $grossAmt;
						$fileData['servicetax_amount'] = $serVicAmt;
						$fileData['created'] =  date('Y-m-d H:i:s');
						
						$insert_id = $this->payment_model->addPayment($fileData);
						
						$update_user_data = array(
						'payment_id' => $insert_id,
						'payment_status' => 0,					
						);
					
						$this->student_model->updateStudentDataByID($update_user_data, $row->user_id);
						
						
					}
					//echo "<pre>"; print_r($row); 
					
						//$this->db->set('quiz_id',$this->input->post('quiz_id'));
						//$this->db->set('title',$col0);
						//$this->db->set('choice_1',$col1);
						//$this->db->set('choice_2',$col2);
						//$this->db->set('choice_3',$col3);
						//$this->db->set('choice_4',$col4);
						//$this->db->set('correct_choice',$col5);
						//$this->db->set('status','1');
						//$this->db->set('created',date('Y-m-d H:i:s'));
						//$this->db->insert('ficci_question');
					} 
					//die();
					fclose($handle);
					
					} 

				}
				
					//after successful submission
					$this->session->set_flashdata('success', 'You have added payment successfully.');
					redirect('admin/payment/manage_payment');
				}
			 else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/payment/add_multi_payment',$data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	
	
	//Method to delete question - Balkrishan
	function delete_payment($id=null){
		if($id!=null){
			$delete = $this->payment_model->deletePayment($id);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted payment successfully.');
				redirect('admin/payment/manage_payment');
			}
		}
	}
	
	//Method to change payment status - Balkrishan
	function update_status($user_id,$id,$status){
		
		
		$new_status = null;
		if($id!=null){
			if($status==1){
				$new_status=0;
			}
			if($status==0){
				$new_status=1;
			}
			$paymentDetail = $this->payment_model->getPaymentTypeDetail($id);
			
			$update_payment = $this->payment_model->updatePayment(array('status'=>$new_status), $id);
			$update_user = $this->student_model->update_user_data(array('payment_status'=>$new_status), $user_id);
			
			$userEmail = $this->student_model->getStudentEmailId($user_id);
			$userData = $this->student_model->getStudentData($user_id);
			//echo '<pre>'; print_r($userData); die;
			$session_id = $userData->session_id;
			
			
			
			
			if($new_status == 1){
				
				$session_data = $this->session_model->getSessionByID($session_id);
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
					
					$ennrollment = $this->config->item('Course_name').'-'.$this->generateEnnrollment();
					
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				}
				
				
				
				$update_ennrollment = $this->student_model->insert_student_ennrollment(array('enrollment_no'=>$ennrollment), $user_id);
				$subject = "FICCI Online Course- Account Activation & Enrollment Number";
				$data['email'] = $userEmail->email;
				$data['name'] = $userData->first_name.' '.$userData->last_name;
				$data['courseFee'] = $userData->course_fee;
				$data['ennrollment_number'] = $ennrollment;
				$data['referenceno'] = $paymentDetail->reference_no;
				$data['payment_type'] = $paymentDetail->payment_type_id;
				$data['site_name'] = $this->config->item('Site_name');
				$data['course_name'] = $this->config->item('Course_name');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				
				$from = $this->config->item('FromEmail');
				
				$message = $this->load->view('site/email/get_enrollment',$data, true);
				
				$this->sendEmail($data['email'], $from, $subject, $message);
			}
			
			//after successful submission
			$this->session->set_flashdata('success', 'You have updated payment status successfully.');
			redirect('admin/payment/manage_payment');
		}
	}
	
	
		function update_multi_status(){
		
		  $new_status = $this->input->post('pid');
		  $pay_id = $this->input->post('val');
		  
		 		 
		  foreach($pay_id as $pay){ 
				
			 $payment_detail = $this->payment_model->getPaymentByID($pay);
			 $paymentDetail = $this->payment_model->getPaymentTypeDetail($id);
			 
			 $userId = $payment_detail[0]->user_id;
			 
				$userEmail = $this->student_model->getStudentEmailId($userId);
				$userData = $this->student_model->getStudentData($userId);
				//echo '<pre>'; print_r($userData); die;
				$session_id = $userData->session_id;
			
			 $update_payment = $this->payment_model->updatePayment(array('status'=>$new_status), $pay);
			 $update_user = $this->student_model->update_user_data(array('payment_status'=>$new_status), $userId);
			 
			 if($new_status == 1){
				 
				$session_data = $this->session_model->getSessionByID($session_id);
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
					
					$ennrollment = $this->config->item('Course_name').'-'.$this->generateEnnrollment();
					
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				}
				
				
				
				$update_ennrollment = $this->student_model->insert_student_ennrollment(array('enrollment_no'=>$ennrollment), $user_id);
				$subject = "FICCI Online Course- Account Activation & Enrollment Number";
				$data['email'] = $userEmail->email;
				$data['name'] = $userData->first_name.' '.$userData->last_name;
				$data['courseFee'] = $userData->course_fee;
				$data['ennrollment_number'] = $ennrollment;
				$data['referenceno'] = $paymentDetail->reference_no;
				$data['payment_type'] = $paymentDetail->payment_type_id;
				$data['site_name'] = $this->config->item('Site_name');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				$data['course_name'] = $this->config->item('Course_name');
				
				$from = $this->config->item('FromEmail');
				
				$message = $this->load->view('site/email/get_enrollment',$data, true);
				
				$this->sendEmail($data['email'], $from, $subject, $message);
			 }
			
           }
		 
			//echo "true";
			
			//after successful submission
			$this->session->set_flashdata('success', 'You have updated payment status successfully.');
			redirect('admin/payment/manage_payment');
		
	}
	
	
	function update_reExamPaymentstatus($user_id,$id,$status){
		
		
		$new_status = null;
		if($id!=null){
			if($status==1){
				$new_status=0;
			}
			if($status==0){
				$new_status=1;
			}
			$paymentDetail = $this->payment_model->getPaymentTypeDetail($id);
			//echo '<pre>'; print_r($paymentDetail); die;
			//echo $new_status; die;
			$update_payment = $this->payment_model->updatePayment(array('re_exam_payment_status'=>$new_status), $id);
			$update_user = $this->student_model->update_user_data(array('re_exam_payment_status'=>$new_status), $user_id);
			//echo $update_payment; die;
			$userEmail = $this->student_model->getStudentEmailId($user_id);
			$userData = $this->student_model->getStudentData($user_id);
			//echo '<pre>'; print_r($userData); die;
			$session_id = $userData->session_id;
			
			
			
			
			if($new_status == 1){
				
				$session_data = $this->session_model->getSessionByID($session_id);
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
					
					//$ennrollment = $this->generateEnnrollment();
					
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				}
				
				
				
				//$update_ennrollment = $this->student_model->insert_student_ennrollment(array('enrollment_no'=>$ennrollment), $user_id);
				/* $subject = "FICCI Online Course- Account Activation & Enrollment Number";
				$data['email'] = $userEmail->email;
				$data['name'] = $userData->first_name.' '.$userData->last_name;
				$data['courseFee'] = $userData->course_fee;
				$data['ennrollment_number'] = $ennrollment;
				$data['referenceno'] = $paymentDetail->reference_no;
				$data['payment_type'] = $paymentDetail->payment_type_id;
				$data['site_name'] = $this->config->item('Site_name');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear; 
				
				$message = $this->load->view('site/email/get_enrollment',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message);*/
			}
			
			//after successful submission
			$this->session->set_flashdata('success', 'You have updated payment status successfully.');
			redirect('admin/payment/manage_re_exam_payment');
		}
	}
	
	
	function update_multi_reexam_status(){
		
		  $new_status = $this->input->post('pid');
		  $pay_id = $this->input->post('val');
		  
		  //echo $new_status; die;
		 		 
		  foreach($pay_id as $pay){ 
				
			 $payment_detail = $this->payment_model->getPaymentByID($pay);
			 //$paymentDetail = $this->payment_model->getPaymentTypeDetail($id);
			 
			 $userId = $payment_detail[0]->user_id;
			 
				/* $userEmail = $this->student_model->getStudentEmailId($userId);
				$userData = $this->student_model->getStudentData($userId); */
				//echo '<pre>'; print_r($userData); die;
				/* $session_id = $userData->session_id; */
			
			 $update_payment = $this->payment_model->updatePayment(array('re_exam_payment_status'=>$new_status), $pay);
			 $update_user = $this->student_model->update_user_data(array('re_exam_payment_status'=>$new_status), $userId);
			 
			/*  if($new_status == 1){
				 
				$session_data = $this->session_model->getSessionByID($session_id);
				if(sizeof($session_data) > 0){
				
					$sessionStartMonth =  date("F", strtotime($session_data->start_on));
					$sessionEndMonth =  date("F", strtotime($session_data->end_on));
					$sessionYear =  date("Y", strtotime($session_data->end_on));
					
					//$ennrollment = $this->generateEnnrollment();
					
				}else{
					$sessionStartMonth =  "";
					$sessionEndMonth =  "";
					$sessionYear =  "";
				} */
				
				
				
				//$update_ennrollment = $this->student_model->insert_student_ennrollment(array('enrollment_no'=>$ennrollment), $user_id);
				/* $subject = "FICCI Online Course- Account Activation & Enrollment Number";
				$data['email'] = $userEmail->email;
				$data['name'] = $userData->first_name.' '.$userData->last_name;
				$data['courseFee'] = $userData->course_fee;
				$data['ennrollment_number'] = $ennrollment;
				$data['referenceno'] = $paymentDetail->reference_no;
				$data['payment_type'] = $paymentDetail->payment_type_id;
				$data['site_name'] = $this->config->item('Site_name');
				$data['sessionStartMonth'] = $sessionStartMonth;
				$data['sessionEndMonth'] = $sessionEndMonth;
				$data['sessionYear'] = $sessionYear;
				
				$message = $this->load->view('site/email/get_enrollment',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message); */
			 //}
			
           }
		 
			//echo "true";
			
			//after successful submission
			$this->session->set_flashdata('success', 'You have updated payment status successfully.');
			redirect('admin/payment/manage_re_exam_payment');
		
	}
	
	
	//Method to download a file - Balkrishan
	function download_question(){
		
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			$data = file_get_contents($filename);
			force_download($file, $data);
			
		}
	}
	
	function generateEnnrollment(){
		
		//$alpha   = str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZ',4));
		$numeric = str_shuffle(str_repeat('0123456789',6));
		$enrollment = substr($numeric, 0, 6);
		//$code = str_shuffle($code);
		
		return $enrollment;
	}
	
	function sendEmail($to, $from, $subject, $message){
		//include email library
		$this->load->library('email');
		
		//set email config
		//$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		
		$this->email->from($from,$this->config->item('Site_name'));
		$this->email->to($to);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	}
	
	
function filter_payment(){
	$session = null;
	if(isset($_POST['session_value']) and $_POST['session_value']!=''){
		$session = $_POST['session_value'];
	}
	
	$filter_data = $this->payment_model->listPayment(null,null,null,null,null,$session,null,1);
	
	if(isset($filter_data) && $filter_data != NULL) {
				$i=0; 
				$result = '';
				$status = '';
				$examType = '';
				$data = array();
				foreach($filter_data as $filterData) { 
				$chk = "<input type='checkbox' id='pay_id' value='".$filterData->id."' name='select_option[]' />";
				$action = "<a href=".site_url().'admin/payment/edit_payment/'.$filterData->id.">Edit</a> |";
				if($filterData->status == "1"){
					$status = 'Active';
					
					$action.="Payment Verified";
				}else{
					$status = "Inactive";
					$action.= "<a onclick=change_status(".$filterData->user_id.','.$filterData->id.','.$filterData->status.'); href=javascript:void(0);>Active</a>';
				}
				
				$action.= "&nbsp;|&nbsp;<a onclick=delete_payment(".$filterData->id.'); href=javascript:void(0);>Delete</a>';
				if($filterData->exam_type == 1){
					$examType = "Main";
				}else{
					$examType = "Re-Exam";
				}
				
				 $regDate = date("d/m/Y", strtotime($filterData->created));
				
				$i++;
				
				
				$data[] = array($chk,$i,$filterData->session,$filterData->username,$filterData->payment_type_id,$filterData->cheque_date,$filterData->course_fee,$filterData->vendor_amount,$filterData->servicetax_amount,$filterData->gross_amount,
								$filterData->reference_no,$filterData->bank_name,$filterData->branch_name,$status,$action);
				
			}
				//echo $result; die;
				echo json_encode($data);
			}else{
				
				/* $result = "";
				echo $result; die; */
				
				$data = array();
				echo json_encode($data);
			}
}


function filter_re_exam_payment(){
	$session = null;
	if(isset($_POST['session_value']) and $_POST['session_value']!=''){
		$session = $_POST['session_value'];
	}
	
	$filter_data = $this->payment_model->listPayment(null,null,null,null,null,$session,null,2);
	
	if(isset($filter_data) && $filter_data != NULL) {
				$i=0; 
				$result = '';
				$status = '';
				$examType = '';
				$data = array();
				foreach($filter_data as $filterData) { 
				$chk = "<input type='checkbox' id='pay_id' value='".$filterData->id."' name='select_option[]' />";
				$action = "<a href=".site_url().'admin/payment/edit_payment/'.$filterData->id.">Edit</a> |";
				if($filterData->re_exam_payment_status == "1"){
					$status = 'Active';
					
					$action.="Payment Verified";
				}else{
					$status = "Inactive";
					$action.= "<a onclick=change_status(".$filterData->user_id.','.$filterData->id.','.$filterData->status.'); href=javascript:void(0);>Active</a>';
				}
				
				$action.= "&nbsp;|&nbsp;<a onclick=delete_payment(".$filterData->id.'); href=javascript:void(0);>Delete</a>';
				if($filterData->exam_type == 1){
					$examType = "Main";
				}else{
					$examType = "Re-Exam";
				}
				
				 $regDate = date("d/m/Y", strtotime($filterData->created));
				
				$i++;
				
				
				$data[] = array($chk,$i,$filterData->session,$filterData->username,$filterData->payment_type_id,$filterData->cheque_date,$filterData->course_fee,$filterData->vendor_amount,$filterData->servicetax_amount,$filterData->gross_amount,
								$filterData->reference_no,$filterData->bank_name,$filterData->branch_name,$status,$action);
				
			}
				//echo $result; die;
				echo json_encode($data);
			}else{
				
				/* $result = "";
				echo $result; die; */
				
				$data = array();
				echo json_encode($data);
			}
}
	
	
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */