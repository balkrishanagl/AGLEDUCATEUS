<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2 or $session_data['admin_user_type_id']==3){
			redirect('admin/dashboard');
		}
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('announcement_model');
		$this->load->model('user_model');
	}
	function manage_announcement()
	{
		
		$this->load->model('announcement_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_announcement';
		    $header['tab'] = 'announcement';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'announcement';
		    $sidebar['main_page'] = 'manage_announcement';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_announcement';

		   $data['announcement_details'] = $this->announcement_model->get_announcement_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/announcement/manage_announcement',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_announcement()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_announcement';
		    $header['tab'] = 'announcement';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'announcement';
		    $sidebar['main_page'] = 'add_announcement';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_announcement';

		  
		$this->form_validation->set_rules('announcement_title', 'announcement Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('announcement_description', 'Description', 'strip_tags|trim|required|xss_clean');
		
		$this->form_validation->set_rules('announcement_date', 'Date', '');
        $this->form_validation->set_rules('status','Status', 'required');
		
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/announcement/add_announcement',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			$data_addpage = array(
				     	'title' => $this->input->post('announcement_title'),
						'description' => $this->input->post('announcement_description'),
						'status' => $this->input->post('status'),
						'created' =>  date('Y/m/d  h:m:s'),
							);
		
		
		   
			
	
			$this->announcement_model->add_announcement_data($data_addpage);	
			 
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have added a announcement successfully.');
				redirect('admin/announcement/manage_announcement');
				/* $this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/announcement/manage_announcement');
		        $this->load->view('admin/parts/footer',$footer); */
			
			}
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/announcement/add_announcement',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_announcement($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/announcement/manage_announcement');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('announcement_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_announcement';
		    $header['tab'] = 'announcement';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'announcement';
		    $sidebar['main_page'] = 'esit_announcement';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_announcement';

		  
  
		$this->form_validation->set_rules('announcement_title', 'announcement Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('announcement_description', 'Description', 'strip_tags|trim|required|xss_clean');
		
		$this->form_validation->set_rules('announcement_date', 'Date', '');
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/announcement/edit_announcement',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			        $data_update_announcement = array(
				     'title' => $this->input->post('announcement_title'),
						'description' => $this->input->post('announcement_description'),
						'status' => $this->input->post('status'),
						'updated' =>  date('Y/m/d  h:m:s'),
							);
		
		
		 
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->announcement_model->update_announcement_data($data_update_announcement,$id);	
			 $data['announcement_data'] = $this->announcement_model->get_announcement_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a announcement successfully.');
			/*	$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/announcement/edit_announcement',$data);
		        $this->load->view('admin/parts/footer',$footer); */				redirect('admin/announcement/manage_announcement');
			
			}
			  }
			  
			  else {
				
			$data['announcement_data'] = $this->announcement_model->get_announcement_data_by_id($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/announcement/edit_announcement',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_announcement($id=null, $status)
	{
	
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> $status);
			
			$res = $this->announcement_model->delete_announcement_by_id($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have updated status successfully.');
				redirect('admin/announcement/manage_announcement');
			}
		} else {
			redirect('admin/announcement/manage_announcement');
		}
		
	}
	
	  
	
}

