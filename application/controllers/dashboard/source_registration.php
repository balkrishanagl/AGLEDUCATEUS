<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Source_registration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
	   
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('source_model');
		$this->load->model('user_model');
	}
	function manage_source_registration()
	{
		    
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_source_registration';
		    $header['tab'] = 'source_reg';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'source_information';
		    $sidebar['main_page'] = 'manage_source_registration';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_source_registration';

		    $data['source_details'] = $this->source_model->get_source_detail();
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_registration/manage_source_registration',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function edit_source_registration($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/source/manage_source');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('source_model');
		
		$data['source_data'] = $this->source_model->get_source_data_by_id($id);
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_source_registration';
		    $header['tab'] = 'source_information';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'source_information';
		    $sidebar['main_page'] = 'edit_source_registration';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_source_registration';

		//$this->form_validation->set_rules('website_url', 'Website URL', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('count', 'Count', 'strip_tags|trim|required|xss_clean');
		
				  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/source_registration/edit_source_registration',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			
			$data_update_source = array(
				'count' => $this->input->post('count'),
			);
			
			
						 
			date_default_timezone_set('UTC');
		
		    $data_update_source['updated'] = date('Y-m-d h:m:s');
	
			$this->source_model->update_source_data($data_update_source,$id);	
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a source of registration successfully.');
				redirect('admin/source_registration/manage_source_registration/');
			
			}
			  }
			  
			  else {
				
			$data['source_data'] = $this->source_model->get_source_data_by_id($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_registration/edit_source_registration',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_source($id=null)
	{
		
      if($id!=null){
	
	  $session_data = $this->session->userdata('admin_user');
	  $data['username'] = $session_data['admin_username'];
	
	  $res = $this->source_model->delete_source_by_id($id);
	
	  if($res==true){
		$this->session->set_flashdata('success', 'You have deleted source of information successfully.');
		redirect('admin/source/manage_source');
	}
    } else {
	redirect('admin/source_information/manage_source');
    }

	}
	
	  
	
}

