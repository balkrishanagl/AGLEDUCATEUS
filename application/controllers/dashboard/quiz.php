<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Quiz extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("user_model");
		$this->load->model("quiz_model");
		$this->load->model("session_model");
		
	}

	function index()
	{
		redirect('admin/quiz/manage_quiz');
	}
	
	//Method to list quiz - Balkrishan
	function manage_quiz(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'quiz';
		    $header['tab'] = 'manage_quiz';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'quiz';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			if($session_data['admin_username']!='admin'){
				$data['quiz_list'] = $this->quiz_model->listQuiz($session_data['id']);
			} else {
				$data['quiz_list'] = $this->quiz_model->listQuiz();
			}
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/quiz/manage_quiz', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	function compareDate() {
		
		
	  $startDate = strtotime($_POST['exam_date2']);
	  $endDate = strtotime($_POST['exam_date3']);

	  if ($endDate >= $startDate)
		return True;
	  else {
		$this->form_validation->set_message('compareDate', '%s should be greater than Contract Start Date.');
		return False;
	  }
	}
	//Method to add quiz - Balkrishan
	function add_quiz(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'quiz';
		    $header['tab'] = 'add_quiz';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'quiz';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			$session['session_detail'] =  $this->session_model->getAllActiveSession();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$count_session_quiz = $this->quiz_model->getTotalQuizBySession($this->input->post('session'));
				
				//if($count_session_quiz > 3){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('quizname', 'Exam Name', 'required');
				$this->form_validation->set_rules('exam_type', 'Exam Type', 'required');
				$this->form_validation->set_rules('exam_duration', 'Exam Duration', 'required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('exam_date', 'Exam Date 1st', 'required');
				
				//$this->form_validation->set_rules('exam_start_time', 'Exam Start time IInd', 'required');
				//$this->form_validation->set_rules('exam_end_time', 'Exam End time IInd', 'required');
				
				
				
				if($this->input->post('exam_date2'))
				{
					$this->form_validation->set_rules('exam_start_time2', 'Exam Start time IInd', 'required');
					$this->form_validation->set_rules('exam_end_time2', 'Exam End time IInd', 'required');
					
				}
				if($this->input->post('exam_date3'))
				{
					$this->form_validation->set_rules('exam_start_time3', 'Exam Start time IIIrd', 'required');
					$this->form_validation->set_rules('exam_end_time3', 'Exam End time IIIrd', 'required');
					
				}
				
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($this->form_validation->run()){
					
				if($count_session_quiz < 3){
					$fileData = array(
						'name' => $this->input->post('quizname'),
						'session_id' => $this->input->post('session'),
						'exam_date' => $this->input->post('exam_date'),
						'start_time' => date('H:i:s',strtotime($this->input->post('exam_start_time'))),
						'end_time' => date('H:i:s',strtotime($this->input->post('exam_end_time'))),
						'type' => $this->input->post('exam_type'),
						'exam_duration' => $this->input->post('exam_duration'),
						'status' => $this->input->post('status'),
						'created_by' => $session_data['id'],
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->quiz_model->addQuiz($fileData);
					//======== Second Exam
					if($this->input->post('exam_date2'))
					{
						$fileData1 = array(
							'name' => $this->input->post('quizname'),
							'session_id' => $this->input->post('session'),
							'exam_date' => $this->input->post('exam_date2'),
							'start_time' => date('H:i:s',strtotime($this->input->post('exam_start_time2'))),
							'end_time' => date('H:i:s',strtotime($this->input->post('exam_end_time2'))),
							'type' => $this->input->post('exam_type'),
							'exam_duration' => $this->input->post('exam_duration'),
							'status' => $this->input->post('status'),
							'created_by' => $session_data['id'],
							'created' => date('Y-m-d H:i:s'),
						);
						$insert_id = $this->quiz_model->addQuiz($fileData1);
					}
					//============== Third Exam
					if($this->input->post('exam_date3')!='')
					{
						$fileData2 = array(
							'name' => $this->input->post('quizname'),
							'session_id' => $this->input->post('session'),
							'exam_date' => $this->input->post('exam_date3'),
							'start_time' => date('H:i:s',strtotime($this->input->post('exam_start_time3'))),
							'end_time' => date('H:i:s',strtotime($this->input->post('exam_end_time3'))),
							'type' => $this->input->post('exam_type'),
							'exam_duration' => $this->input->post('exam_duration'),
							'status' => $this->input->post('status'),
							'created_by' => $session_data['id'],
							'created' => date('Y-m-d H:i:s'),
						);
						$insert_id = $this->quiz_model->addQuiz($fileData2);
					}
					
					
					
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added exam successfully.');
					redirect('admin/quiz/add_quiz');
					}else{
						$this->session->set_flashdata('error', 'You can add maximum 3 exam in a session.');
						redirect('admin/quiz/add_quiz');
					}
					
				} else {
					
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/quiz/add_quiz',$session);
					$this->load->view('admin/parts/footer',$footer);
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/quiz/add_quiz',$session);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add quiz - Balkrishan
	function edit_quiz($id=null){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get quiz data
			$data['quiz'] = $this->quiz_model->getQuizByID($id);
			
			//echo '<pre>'; print_r($data['quiz']); die;
			
		    $header['main_page'] = 'quiz';
		    $header['tab'] = 'edit_quiz';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'quiz';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			$data['session_detail'] =  $this->session_model->getAllActiveSession();
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				//$count_session_quiz = $this->quiz_model->getTotalQuizBySession($this->input->post('session'));
				
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('quizname', 'Exam Name', 'required');
				$this->form_validation->set_rules('exam_type', 'Exam Type', 'required');
				$this->form_validation->set_rules('exam_duration', 'Exam Duration', 'required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('exam_date', 'Exam Date 1st', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($this->form_validation->run()){
					
					
					$fileData = array(
							'name' => $this->input->post('quizname'),
							'session_id' => $this->input->post('session'),
							'exam_date' => $this->input->post('exam_date'),
							'start_time' => date('H:i:s',strtotime($this->input->post('exam_start_time'))),
							'status' => $this->input->post('status'),
							'end_time' => date('H:i:s',strtotime($this->input->post('exam_end_time'))),
							'type' => $this->input->post('exam_type'),
							'exam_duration' => $this->input->post('exam_duration'),
							'created_by' => $session_data['id'],
							'updated' => date('Y-m-d H:i:s'),
						);
						//echo "<pre>"; print_r($fileData); die;
						$insert_id = $this->quiz_model->updateQuiz($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated quiz successfully.');
						redirect('admin/quiz/manage_quiz');
					/*}else{
						$this->session->set_flashdata('error', 'You can add maximum 3 quiz in a session.');
						redirect('admin/quiz/edit_quiz/'.$id);
						
					}*/
					
				} else {
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/quiz/edit_quiz', $data);
						$this->load->view('admin/parts/footer',$footer);
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/quiz/edit_quiz', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to delete quiz - Balkrishan
	function delete_quiz($id=null){
		if($id!=null){
			$delete = $this->quiz_model->deleteQuiz($id);
			if($id==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted quiz successfully.');
				redirect('admin/quiz/manage_quiz');
			}
		}
	}
	
	//Method to download a file - Balkrishan
	function download_quiz(){
		
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			$data = file_get_contents($filename);
			force_download($file, $data);
			
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */