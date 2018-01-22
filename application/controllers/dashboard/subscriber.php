<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Subscriber extends CI_Controller
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
		$this->load->model("subscriber_model");
		$this->load->model("student_model");
		
	}

	function index()
	{
		redirect('admin/subscriber/subscriber_list');
	}
	
	//Method to list subscriber - Balkrishan
	function subscriber_list(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'subscriber';
		    $header['tab'] = 'subscriber_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'subscriber';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['subscriber_list'] = $this->subscriber_model->listsubscriber();
			
			//echo "<pre>"; print_r($data['subscriber_list']); die;
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/subscriber/subscriber_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}

	
	
	//Method to add subscriber - Balkrishan
	function edit_subscriber($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get subscriber data
			$data['subscriber'] = $this->subscriber_model->getsubscriberByID($id);
			
		    $header['main_page'] = 'subscriber';
		    $header['tab'] = 'edit_subscriber';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'subscriber';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('subsname', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('number', 'Number', 'required');
							
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/subscriber/edit_subscriber', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
								
					$fileData = array(
							'name' => $this->input->post('subsname'),
							'email' => $this->input->post('email'),
							'number' => $this->input->post('number'),
				
							'updated' => date('Y-m-d H:i:s'),
						);
						$update_id = $this->subscriber_model->updatesubscriber($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated subscriber successfully.');
						redirect('admin/subscriber/subscriber_list');
					}
				
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/subscriber/edit_subscriber', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to mark subscriber - Balkrishan
	function mark_subscriber($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get subscriber data
			$data['subscriber'] = $this->student_model->get_student_subscriber_by_id($id);
			
		    $header['main_page'] = 'subscriber';
		    $header['tab'] = 'edit_subscriber';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'subscriber';
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
					$this->load->view('admin/subscriber/mark_subscriber', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$fileData = array(
						'mark_obtained' => $this->input->post('mark'),
					);
					$update_id = $this->student_model->updateStudentsubscriber($fileData, $id);
					//after successful submission
					$this->session->set_flashdata('success', 'You have updated subscriber successfully.');
					redirect('admin/subscriber/student_subscriber');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/subscriber/mark_subscriber', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to delete subscriber
	function delete_subscriber($id=null){
		//echo $id; die;
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->subscriber_model->delete_subscribe($id);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted subscriber successfully.');
				redirect('admin/subscriber/subscriber_list');
			}
		}
	}
	
	function unsubscribe($id=null){
		//echo $id; die;
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->subscriber_model->unsubscriber($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have unsubscribe successfully.');
				redirect('admin/subscriber/subscriber_list');
			}
		}
	}
	
	//Method to active subscriber
	function active_subscriber($id=null){
		//echo $id; die;
		if($id!=null){
			$status = array('status'=> '1');
			$active = $this->subscriber_model->activesubscriber($id,$status);
			if($active==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active subscriber successfully.');
				redirect('admin/subscriber/subscriber_list');
			}
		}
	}
	
	//Method to download a file - Balkrishan
	function download_subscriber(){
		
		if(isset($_GET['path']) and $_GET['path']!=''){
			
			$filename = $_GET['path'];
			$file = $_GET['filename'];
			$data = file_get_contents($filename);
			force_download($file, $data);
			
		}
	}
	
	//Method to export data in csv
	
	function exportData(){
		
		  $status = $this->input->post('subsStatus');
		  //echo $status; die;
		   $data = $this->subscriber_model->getSubcribeDataByStatus($status);
		  // echo '<pre>'; print_r($data); die;
		   $this->load->dbutil();
		   $this->load->helper('file');
		   $this->load->helper('download');
		   $delimiter = ",";
		   $newline = "\r\n";
		   $filename = "subcriberdata.csv";
		   $dataFile = $this->dbutil->csv_from_result($data, $delimiter, $newline);
		   force_download($filename, $dataFile);
		   redirect('admin/subscriber/subscriber_list');
		
		
		
	}
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */