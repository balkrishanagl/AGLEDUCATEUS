<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class nationality extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		$this->load->helper('url');
		$this->load->model("user_model");
		$this->load->model("nationality_model");
		$this->load->model("category_model");
		
	}

	function index()
	{
		redirect('admin/nationality/manage_nationality');
	}
	
	//Method to list quiz - Balkrishan
	function manage_nationality(){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_nationality';
		    $header['tab'] = 'nationality';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'nationality';
		    $sidebar['main_page'] = 'manage_nationality';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_nationality';

		   $data['nat_details'] = $this->nationality_model->listNat();
		   
		   //echo '<pre>'; print_r($data['faq_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/nationality/manage_nationality',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	
	function add_nationality(){
		
		
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'nationality';
		    $header['tab'] = 'nationality';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'nationality';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			//$category['category_detail'] =  $this->category_model->getAllActiveCategory();
			
						
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('nationality_title', 'Nationality Title', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/faq/add_nationality',$category);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					$fileData = array(
						'title' => $this->input->post('nationality_title'),
						'status' => '1',
						//'category_id' => $this->input->post('category'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->nationality_model->add_nat_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Nationality successfully.');
					redirect('admin/nationality/manage_nationality');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/nationality/add_nationality');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	function edit_nationality($id=null){
		
				
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get Faq data
			$data['nat_data'] = $this->nationality_model->getNatByID($id);
			
		    $header['main_page'] = 'nationality';
		    $header['tab'] = 'edit_nationality';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_nationality';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			//$data['category_detail'] =  $this->category_model->getAllActiveCategory();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('nationality_title', 'Nationality title', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/nationality/edit_nationality', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
									
						$fileData = array(
							'title' => $this->input->post('nationality_title'),
							//'category_id' => $this->input->post('category'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
					
						$insert_id = $this->nationality_model->updateNat($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Nationality successfully.');
						redirect('admin/nationality/manage_nationality');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/nationality/edit_nationality', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function delete_nationality($id=null,$status){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> $status);
			
			$res = $this->nationality_model->deleteNat($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Nationality successfully.');
				redirect('admin/nationality/manage_nationality');
			}
		} else {
			redirect('admin/nationality/manage_nationality');
		}
	}
	function status_nationality($id=null,$status){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> $status);
			
			$res = $this->nationality_model->statusNat($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Nationality successfully.');
				redirect('admin/nationality/manage_nationality');
			}
		} else {
			redirect('admin/nationality/manage_nationality');
		}
	}
	
	
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */