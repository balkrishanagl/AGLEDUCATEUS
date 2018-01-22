<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class session extends CI_Controller
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
		$this->load->model("session_model");
				
	}

	function index()
	{
		echo "Test"; die;
		redirect('admin/session/manage_session');
	}
	
	//Method to list quiz - Balkrishan
	function manage_session(){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_session';
		    $header['tab'] = 'session';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'session';
		    $sidebar['main_page'] = 'manage_session';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_session';

		   $data['session_details'] = $this->session_model->listSession();
		   
		   //echo '<pre>'; print_r($data['faq_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/session/manage_session',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	
	function add_session(){
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'session';
		    $header['tab'] = 'session';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'session';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			//$category['category_detail'] =  $this->category_model->getAllActiveCategory();
			
						
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('session_name', 'Session Name', 'required');
				$this->form_validation->set_rules('session_start_on','Session Start Date','is_unique[ficci_session.start_on]|required');
				$this->form_validation->set_rules('session_end_on','Session End Date','is_unique[ficci_session.end_on]|required');
				$this->form_validation->set_rules('registration_start_on','Registration Start Date','is_unique[ficci_session.register_start_on]|required');
				$this->form_validation->set_rules('registration_end_on','Registration End Date','is_unique[ficci_session.register_end_on]|required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($this->form_validation->run())
				{
					$fileData = array(
						'name' => $this->input->post('session_name'),
						'start_on' => $this->input->post('session_start_on'),
						'end_on' => $this->input->post('session_end_on'),
						'register_start_on' => $this->input->post('registration_start_on'),
						'register_end_on' => $this->input->post('registration_end_on'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->session_model->add_session_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Session successfully.');
					redirect('admin/session/manage_session');
					
					
				} else {
					
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/session/add_session');
					$this->load->view('admin/parts/footer',$footer);			
					
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/session/add_session');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	function edit_session($id=null){
		
				
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get Faq data
			$data['session_detail'] = $this->session_model->getSessionByID($id);
			
		    $header['main_page'] = 'session';
		    $header['tab'] = 'edit_session';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_session';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			//$data['category_detail'] =  $this->category_model->getAllActiveCategory();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$startDate = $this->input->post('session_start_on');
				$endDate = $this->input->post('session_end_on');
				$chkStartDate = $this->session_model->getSessionByID_date('start',$startDate,$id);
				$chkEndDate = $this->session_model->getSessionByID_date('end',$endDate,$id);
				
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				
				$this->form_validation->set_rules('session_name', 'Session Name', 'required');
				
				if(sizeof($chkStartDate)>0)
				{
					$this->form_validation->set_rules('session_start_on', 'Session Start Date', 'required');
				}else{
					$this->form_validation->set_rules('session_start_on','Session Start Date','is_unique[ficci_session.start_on]');
				}
				
				if(sizeof($chkEndDate)>0)
				{
					$this->form_validation->set_rules('session_end_on', 'Session End Date', 'required');
				}else{
					$this->form_validation->set_rules('session_end_on','Session End Date','is_unique[ficci_session.end_on]');
				}
				
				$this->form_validation->set_rules('registration_start_on','Registration Start Date','required');
				$this->form_validation->set_rules('registration_end_on','Registration End Date','required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if($this->form_validation->run()){
					
				$fileData = array(
							'name' => $this->input->post('session_name'),
							'start_on' => $this->input->post('session_start_on'),
							'end_on' => $this->input->post('session_end_on'),
							'register_start_on' => $this->input->post('registration_start_on'),
							'register_end_on' => $this->input->post('registration_end_on'),
							'modified' => date('Y-m-d H:i:s'),
						);
						
					
						$insert_id = $this->session_model->updateSession($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Session successfully.');
						redirect('admin/session/manage_session');
						
					
				} else {
					
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/session/edit_session', $data);
						$this->load->view('admin/parts/footer',$footer);			
						
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/session/edit_session', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function delete_session($id=null,$status1){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> $status1);
			
			$res = $this->session_model->deleteSession($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have update status successfully.');
				redirect('admin/session/manage_session');
			}
		} else {
			redirect('admin/session/manage_session');
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
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */