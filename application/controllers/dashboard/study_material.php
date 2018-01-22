<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
session_start(); //we need to call PHP's session object to access it through CI
class study_material extends CI_Controller
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
		$this->load->model("study_material_model");
		$this->load->model("student_model");
		$this->load->model("session_model");
		
	}

	function index()
	{
		redirect('admin/study_material/study_material_list');
	}
	
	//Method to list study_material - Balkrishan
	function study_material_list(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'study_material';
		    $header['tab'] = 'study_material_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'study_material';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['study_material_list'] = $this->study_material_model->liststudy_material();
			
			//echo "<pre>"; print_r($data['study_material_list']); die;
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/study_material/study_material_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}

	
	
	//Method to add study_material - Manoj Sharma
	function add_study_material(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'study_material';
		    $header['tab'] = 'add_study_material';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'study_material';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			$session['session_detail'] =  $this->session_model->getAllActiveSession();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('coursename', 'coursename', 'session', 'Session', 'required');
								
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/study_material/add_study_material');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$study_material_file='';
										
					//validation for images
					
					
					if(isset($_FILES['file'])){
						$study_file_name = time()."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/study_material/'; 
						$config['file_name'] = $study_file_name;
						$config['allowed_types'] = 'pdf|doc|docx|DOC|DOCX';
						$config['max_size']      = 100000;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$study_material_file = $study_file_name;
							$study_material_size = $data_file['upload_data']['file_size'];
							$study_material_ext = $data_file['upload_data']['file_ext'];
						}
					}
				
				if(isset($error_arr) and count($error_arr)>0){
					$session['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/study_material/add_study_material', $session);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					
					$fileData = array(
						'course' => $this->input->post('coursename'),
						'study_material' => $study_material_file,
						'session_id' => $this->input->post('session'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->study_material_model->addstudy_material($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Study Material successfully.');
					redirect('admin/study_material/study_material_list');
			} 
			}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/study_material/add_study_material', $session);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add study_material - Balkrishan
	function edit_study_material($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get study_material data
			$data['study_material'] = $this->study_material_model->getstudy_materialByID($id);
			
		    $header['main_page'] = 'study_material';
		    $header['tab'] = 'edit_study_material';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'study_material';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			$data['session_detail'] =  $this->session_model->getAllActiveSession();
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('coursename', 'course', 'required');
							
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/study_material/edit_study_material', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$study_material_file='';
					$study_material_size='';
					$study_material_ext='';
					
					//validation for images
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$study_file_name = time()."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/study_material/'; 
						$config['file_name'] = $study_file_name;
						$config['allowed_types'] = 'pdf|doc|docx|DOC|DOCX'; 
						$config['max_size']      = 100000;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$study_material_file = $study_file_name;
							$study_material_size = $data_file['upload_data']['file_size'];
							$study_material_ext = $data_file['upload_data']['file_ext'];
						}
					}
				}
				if(isset($error_arr) and count($error_arr)>0){
					$data['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/study_material/edit_study_material', $data);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					if(isset($_FILES['file']) and $_FILES['file']['name']!=''){
						$fileData = array(
							'course' => $this->input->post('coursename'),
							'study_material' => $study_material_file,
							'session_id' => $this->input->post('session'),
							'modified' => date('Y-m-d H:i:s'),
						);
						$insert_id = $this->study_material_model->updatestudy_material($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Study Material successfully.');
						redirect('admin/study_material/study_material_list');
					} else {
						$fileData = array(
							'course' => $this->input->post('coursename'),
							'session_id' => $this->input->post('session'),
							'modified' => date('Y-m-d H:i:s'),
						);
						$update_id = $this->study_material_model->updatestudy_material($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Study Material successfully.');
						redirect('admin/study_material/study_material_list');
					}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/study_material/edit_study_material', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to mark study_material - Balkrishan
	function mark_study_material($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get study_material data
			$data['study_material'] = $this->student_model->get_student_study_material_by_id($id);
			
		    $header['main_page'] = 'study_material';
		    $header['tab'] = 'edit_study_material';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'study_material';
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
					$this->load->view('admin/study_material/mark_study_material', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$fileData = array(
						'mark_obtained' => $this->input->post('mark'),
					);
					$update_id = $this->student_model->updateStudentstudy_material($fileData, $id);
					//after successful submission
					$this->session->set_flashdata('success', 'You have updated Study Material successfully.');
					redirect('admin/study_material/student_study_material');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/study_material/mark_study_material', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to delete study_material - Balkrishan
	function delete_study_material($id=null){
		if($id!=null){
			$delete = $this->study_material_model->deletestudy_material($id);
			if($id==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted Study Material successfully.');
				redirect('admin/study_material/study_material_list');
			}
		}
	}
	
	//Method to download a file - Balkrishan
	function download_study_material(){
		
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