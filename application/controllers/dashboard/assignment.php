<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Assignment extends CI_Controller
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
		$this->load->model("assignment_model");
		$this->load->model("student_model");
		$this->load->model("session_model");
		
	}

	function index()
	{
		redirect('admin/assignment/assignment_list');
	}
	
	//Method to list assignment - Balkrishan
	function assignment_list(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'assignment_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['assignment_list'] = $this->assignment_model->listAssignment();
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/assignment/assignment_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to list student assignment - Balkrishan
	function student_assignment(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'student_assignment';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['student_assignment'] = $this->assignment_model->listStudentAssignment($session_data['id']);
			//echo '<pre>'; print_r($data['student_assignment']); die;
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/assignment/student_assignment', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to list student assignment - Balkrishan
	function view_assignment($id=null){
		$data['id'] = $id;
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'view_assignment';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['studentAssignments'] = $this->assignment_model->getStudentAssignmentByID($session_data['id']);
			//echo '<pre>'; print_r($data['student_assignment']); die;
			/* $student = $this->assignment_model->getStudentAssignmentByID($id);
			$studentId = $student[0]->student_id;
			$data['studentAssignments'] = $this->assignment_model->getStudentAllAssignmentByID($studentId); */
			
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/assignment/view_assignment', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add assignment - Balkrishan
	function add_assignment(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'add_assignment';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			$session['session_detail'] =  $this->session_model->getAllActiveSession();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('filename', 'Filename', 'required');
				$this->form_validation->set_rules('caption', 'Caption', 'required');
				$this->form_validation->set_rules('status', 'Status', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/assignment/add_assignment',$session);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$assignment_file='';
					$assignment_size='';
					$assignment_ext='';
					
					//validation for images
					
					if($_FILES['file']['name']!=''){
						$assignment_file_name = strtolower(str_replace(" ","-",$this->input->post('filename')))."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/assignment_faculty/'; 
						$config['file_name'] = $assignment_file_name;
						$config['allowed_types'] = 'pdf|doc|docx|DOC|DOCX';
						$config['max_size']      = 200; 
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
					$session['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/assignment/add_assignment', $session);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					
					$fileData = array(
						'user_id' => $this->session->userdata['admin_user']['id'],
						'filename' => $assignment_file_name,
						'path' => $assignment_file,
						'size' => $assignment_size,
						'type' => $assignment_ext,
						'status' => $this->input->post('status'),
						'caption' => $this->input->post('caption'),
						'session_id' => $this->input->post('session'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->assignment_model->addAssignment($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added assignment successfully.');
					redirect('admin/assignment/add_assignment');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/assignment/add_assignment',$session);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add assignment - Balkrishan
	function edit_assignment($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get assignment data
			$data['assignment'] = $this->assignment_model->getAssignmentByID($id);
			
		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'edit_assignment';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			$data['session_detail'] =  $this->session_model->getAllActiveSession();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('filename', 'Filename', 'required');
				$this->form_validation->set_rules('caption', 'Caption', 'required');
				$this->form_validation->set_rules('status', 'Status', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/assignment/edit_assignment', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$assignment_file='';
					$assignment_size='';
					$assignment_ext='';
					
					//validation for images
					if($_FILES['file']['name']!=''){
						$assignment_file_name = strtolower(str_replace(" ","-",$this->input->post('filename')))."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						
						$config['upload_path']   ='./uploads/assignment_faculty/'; 
						$config['file_name'] = $assignment_file_name;
						$config['allowed_types'] = 'pdf|doc|docx|DOC|DOCX'; 
						$config['max_size']      = 200; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
							//echo $_SERVER['DOCUMENT_ROOT']; die;
							//echo '<pre>'; print_r($error_arr); die;
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
					
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/assignment/edit_assignment', $data);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$fileData = array(
							'filename' => $assignment_file_name,
							'path' => $assignment_file,
							'size' => $assignment_size,
							'type' => $assignment_ext,
							'status' => $this->input->post('status'),
							'caption' => $this->input->post('caption'),
							'session_id' => $this->input->post('session'),
							'updated' => date('Y-m-d H:i:s'),
						);
						$insert_id = $this->assignment_model->updateAssignment($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated assignment successfully.');
						redirect('admin/assignment/assignment_list');
					} else {
						$fileData = array(
							'filename' => $this->input->post('filename'),
							'caption' => $this->input->post('caption'),
							'status' => $this->input->post('status'),
							'session_id' => $this->input->post('session'),
							'updated' => date('Y-m-d H:i:s'),
						);
						$update_id = $this->assignment_model->updateAssignment($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated assignment successfully.');
						redirect('admin/assignment/assignment_list');
					}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/assignment/edit_assignment', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to mark assignment - Balkrishan
	function mark_assignment($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get assignment data
			$data['assignment'] = $this->student_model->get_student_assignment_by_id($id);
			
		    $header['main_page'] = 'assignment';
		    $header['tab'] = 'edit_assignment';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'assignment';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('mark', 'Mark', 'required|numeric|less_than[100]');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/assignment/mark_assignment', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$fileData = array(
						'mark_obtained' => $this->input->post('mark'),
					);
					$update_id = $this->student_model->updateStudentAssignment($fileData, $id);
					//after successful submission
					$this->session->set_flashdata('success', 'You have updated assignment successfully.');
					redirect('admin/assignment/view_assignment/'.$id);
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/assignment/mark_assignment', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to delete assignment - Balkrishan
	function delete_assignment($id=null){
		if($id!=null){
			$stsArr = array('status'=>'0');
			$delete = $this->assignment_model->deleteAssignment($id,$stsArr);
			if($id==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted assignment successfully.');
				redirect('admin/assignment/assignment_list');
			}
		}
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
				redirect('assignment/assignment_list');
			}
			
		}
	}
	
	function download_student_assignment(){
		
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			
			if($data = file_get_contents($filename)) {
				force_download($file, $data);
			}else{
				$this->session->set_flashdata('error', 'Assignment not found');
				redirect('assignment/view_assignment');
			}
			
			
			/* $data = file_get_contents($filename);
			force_download($file, $data); */
			
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */