<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Question extends CI_Controller
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
		$this->load->model("question_model");
		
	}

	function index()
	{
		redirect('admin/question/manage_question');
	}
	
	//Method to list question - Balkrishan
	function manage_question(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'question';
		    $header['tab'] = 'manage_question';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'question';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			if($session_data['admin_username']!='admin'){
				$data['question_list'] = $this->question_model->listQuestion($session_data['id']);
			} else {
				$data['question_list'] = $this->question_model->listQuestion();
			}
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/question/manage_question', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
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
				
				$this->form_validation->set_rules('quiz_id', 'Quiz Name', 'required');
				if($_FILES['questions_csv']['name']=='')
				{
					//check validation for post data
					
					$this->form_validation->set_rules('title', 'Question Title', 'required');
					$this->form_validation->set_rules('choice_1', 'Choice 1', 'required');
					$this->form_validation->set_rules('choice_2', 'Choice 2', 'required');
					$this->form_validation->set_rules('choice_3', 'Choice 3', 'required');
					$this->form_validation->set_rules('choice_4', 'Choice 4', 'required');
					$this->form_validation->set_rules('correct_choice', 'Correct Choice', 'required');
					
				}
				
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
					
					
				if($_FILES['questions_csv']['name'])
				{
						$arrFileName = explode('.',$_FILES['questions_csv']['name']);
					if($arrFileName[1] == 'csv'){
						$handle = fopen($_FILES['questions_csv']['tmp_name'], "r");
					
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
					  //echo "<pre>"; print_r($col);
					 $col0 = $col[0];
					 $col1 = $col[1];
					 $col2 = $col[2];
					 $col3 = $col[3];
					 $col4 = $col[4];
					 $col5 = $col[5];
					 
					
						$this->db->set('quiz_id',$this->input->post('quiz_id'));
						$this->db->set('title',$col0);
						$this->db->set('choice_1',$col1);
						$this->db->set('choice_2',$col2);
						$this->db->set('choice_3',$col3);
						$this->db->set('choice_4',$col4);
						$this->db->set('correct_choice',$col5);
						$this->db->set('status','1');
						$this->db->set('created',date('Y-m-d H:i:s'));
						$this->db->insert('ficci_question');
					} 
					
					fclose($handle);
					
					} 

				}
				else
				{
					
					
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
					
				}
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
	
	
	//Method to add multipal question - Arun
	
	function add_multipal_question(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$data['user_id'] = $session_data['id'];

		    $header['main_page'] = 'add_multi_question';
		    $header['tab'] = 'add_multi_question';
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
				
				$this->form_validation->set_rules('quiz_id', 'Quiz Name', 'required');
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
					
					
				if($_FILES['questions_csv']['name'])
				{
						$arrFileName = explode('.',$_FILES['questions_csv']['name']);
					if($arrFileName[1] == 'csv'){
						$handle = fopen($_FILES['questions_csv']['tmp_name'], "r");
					
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
					  //echo "<pre>"; print_r($col);
					 $col0 = $col[0];
					 $col1 = $col[1];
					 $col2 = $col[2];
					 $col3 = $col[3];
					 $col4 = $col[4];
					 $col5 = $col[5];
					 
					
						$this->db->set('quiz_id',$this->input->post('quiz_id'));
						$this->db->set('title',$col0);
						$this->db->set('choice_1',$col1);
						$this->db->set('choice_2',$col2);
						$this->db->set('choice_3',$col3);
						$this->db->set('choice_4',$col4);
						$this->db->set('correct_choice',$col5);
						$this->db->set('status','1');
						$this->db->set('created',date('Y-m-d H:i:s'));
						$this->db->insert('ficci_question');
					} 
					
					fclose($handle);
					
					} 

				}
				
					//after successful submission
					$this->session->set_flashdata('success', 'You have added question successfully.');
					redirect('admin/question/manage_question');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/question/add_multi_question',$data);
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
	
	//Method to delete question - Balkrishan
	function delete_question($id=null){
		if($id!=null){
			$delete = $this->question_model->deleteQuestion($id);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted question successfully.');
				redirect('admin/question/manage_question');
			}
		}
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
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */