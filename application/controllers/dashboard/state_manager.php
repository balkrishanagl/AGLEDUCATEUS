<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class State_manager extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
	   
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('state_model');
		$this->load->model('user_model');
		$this->load->model('tool_model');
	}
	function manage_state()
	{
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_state';
		    $header['tab'] = 'state';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'state';
		    $sidebar['main_page'] = 'manage_state';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_state';

		    $data['state_details'] = $this->state_model->get_state_detail();
		    // echo "<pre>"; print_r($data['city_details']); echo "</pre>";die;
            $data['state_data'] = $this->tool_model->getStateData();
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/state/manage_state',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_state()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

        $data['state_data'] = $this->tool_model->getStateData();
		$header['main_page'] = 'add_state';
		$header['tab'] = 'state';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'state';
		$sidebar['main_page'] = 'add_state';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'add_state';

		
		$this->form_validation->set_rules('state_name', 'State Name', 'strip_tags|trim|required|xss_clean');
		//$this->form_validation->set_rules('mba_text','State', 'required');
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		{			  
		  if ($this->form_validation->run() == FALSE){
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/state/add_state',$data);
			$this->load->view('admin/parts/footer',$footer);
			
		} 
			else {
						
            $data_addcity = array(
			'state_name' => $this->input->post('state_name'),
			
			);
			    
	
			 $this->state_model->add_state_data($data_addcity);
			
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added State text successfully.');
				redirect('admin/state/add_state/');
			
			
			}
		}
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/state/add_state',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_state($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/city/manage_city');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		//$data['city_data'] = $this->city_model->get_city_data_by_id($id);

        $data['state_data'] = $this->tool_model->getStateData();
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_state';
		    $header['tab'] = 'state';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'state';
		    $sidebar['main_page'] = 'edit_state';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_state';

	  
	   	$this->form_validation->set_rules('state_name', 'State Name', 'strip_tags|trim|required|xss_clean');
		
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/state/edit_state',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

			$data_update_city = array(
			'state_name' => $this->input->post('state_name'),
			
			);
	
			$this->state_model->update_state_data($data_update_city,$id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a state successfully.');
				redirect('admin/state/manage_state/');
			
			}
			  }
			  
			  else {
				
			$data['stateDetail'] = $this->state_model->get_state_data_by_id($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/state/edit_state',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_state($id=null)
	{
		
      if($id!=null){
	
	  $session_data = $this->session->userdata('admin_user');
	  $data['username'] = $session_data['admin_username'];
	
	  $res = $this->state_model->delete_state_by_id($id);
	
	  if($res==true){
		$this->session->set_flashdata('success', 'You have deleted state successfully.');
		redirect('admin/state/manage_state');
	}
    } else {
	redirect('admin/state/manage_state');
    }

	}
	
	  
	
}

