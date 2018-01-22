<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class fees_manager extends CI_Controller
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
		$this->load->model("fees_model");
		$this->load->model("user_model");
		
	}

	function index()
	{
		redirect('admin/fees_manager/manage_fees');
	}
	
	//Method to list quiz - Balkrishan
	function manage_fees(){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_fees';
		    $header['tab'] = 'manage_fees';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'manage_fees';
		    $sidebar['main_page'] = 'manage_fees';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_fees';

		   $data['fees_details'] = $this->fees_model->listfees();
		   //echo '<pre>'; print_r($data['fees_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/fees_manager/manage_fees',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	
	function add_fees(){
		
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'add_fees';
		    $header['tab'] = 'add_fees';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'manage_fees';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'add_fees';
			
			$data['user_type'] = $this->user_model->get_all_user_type_list(2);
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				
				
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('fees', 'Fees', 'required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('re_exam_fees', 'Re Exam Fees', 'required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('user_type', 'User Type', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/fees_manager/add_fees',$data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					$userType = $this->input->post('user_type');
				$chkDataExist = $this->fees_model->chkFeeByTypeId($userType);
				
				if(sizeof($chkDataExist) > 0){
					
						$fileData = array(
							'fees' => $this->input->post('fees'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
					
						$insert_id = $this->fees_model->updatefees($fileData, $chkDataExist->id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated fees successfully.');
						redirect('admin/fees/manage_fees');
				}else{
					
						$fileData = array(
						'user_type_id' => $this->input->post('user_type'),
						'fees' => $this->input->post('fees'),
						're_exam_fees' => $this->input->post('re_exam_fees'),
						'created' => date('Y-m-d H:i:s'),
						);
					
					$insert_id = $this->fees_model->add_fees_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Fees successfully.');
					redirect('admin/fees/manage_fees');
					
				}
					
										
				
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/fees_manager/add_fees',$data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	function edit_fees($id=null){
		
				
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get category data
			$header['main_page'] = 'edit_fees';
		    $header['tab'] = 'edit_fees';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'manage_fees';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'edit_fees';
			$data['fees_detail'] = $this->fees_model->getfeesByID($id);
			//echo '<pre>'; print_r($data['fees_detail']); die;
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('fees', 'Fees', 'required|is_numeric|greater_than[0]');
				$this->form_validation->set_rules('re_exam_fees', 'Re Exam Fees', 'required|is_numeric|greater_than[0]');
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/fees_manager/edit_fees', $data);
					$this->load->view('admin/parts/footer',$footer);
					
				} else {
					
									
						$fileData = array(
							'fees' => $this->input->post('fees'),
							're_exam_fees' => $this->input->post('re_exam_fees'),
							'status' => $this->input->post('status'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
					
						$insert_id = $this->fees_model->updatefees($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated fees successfully.');
						redirect('admin/fees/manage_fees');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/fees_manager/edit_fees', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function delete_category($id=null){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> '0');
			
			$res = $this->category_model->deleteCategory($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Category successfully.');
				redirect('admin/category/manage_category');
			}
		} else {
			redirect('admin/category/manage_category');
		}
	}
	
	 function editor($path,$width) {
    //Loading Library For Ckeditor
    $this->load->library('ckeditor');
    $this->load->library('ckFinder');
    //configure base path of ckeditor folder 
    $this->ckeditor->basePath = base_url().'/assets/admin/js/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';		$this->ckeditor-> config['allowedContent'] = 'true';	$this->ckeditor-> config['removeFormatAttributes'] = ''; 
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    //configure ckfinder with ckeditor config 
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
	
	function alpha_dash_space($str) {
		
		if( ! preg_match("/^([-a-z_ ])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'The Category Name Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */