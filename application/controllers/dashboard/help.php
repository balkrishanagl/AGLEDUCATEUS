<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller
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
    	$this->load->model('help_model');
		$this->load->model('user_model');
	}
	function manage_help()
	{
		
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_help';
		    $header['tab'] = 'help';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'help';
		    $sidebar['main_page'] = 'manage_help';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_help';

		   $data['help_details'] = $this->help_model->get_help_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/help/manage_help',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_help()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_help';
		    $header['tab'] = 'help';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'help';
		    $sidebar['main_page'] = 'add_help';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_help';

		  
		$this->form_validation->set_rules('help_title', 'Help Title', 'strip_tags|trim|required|xss_clean');
		
		
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
		        $this->load->view('admin/help/add_help',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('help_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/help'; 
							$config['file_name'] = $new_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;    
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image = "uploads/help/".$new_name;
							}
						
						}
						
					// image upload End
					
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/help/add_help',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			$data_addpage = array(
				     	'title' => $this->input->post('help_title'),
						'image' => $image,
					
						'status' => $this->input->post('status'),
							);
		
		
		   
			date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->help_model->add_help_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added help successfully.');
				redirect('admin/help/add_help/');
			
			}
		  }
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/help/add_help',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_help($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/testimonial/manage_testimonial');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
				
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_help';
		    $header['tab'] = 'help';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'help';
		    $sidebar['main_page'] = 'edit_help';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_help';

		  
  
		$this->form_validation->set_rules('help_title', 'Help Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		$data['help_data'] = $this->help_model->get_help_data_by_id($id);
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/help/edit_help',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('help_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/help'; 
							$config['file_name'] = $new_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image = "uploads/help/".$new_name;
								
							}
						
						}
						
					// image upload End
					
			
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/help/edit_help',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			        $data_update_help = array(
				    'title' => $this->input->post('help_title'),
					'status' => $this->input->post('status'),
					);
		
		
			if($image)
				$data_update_testimonial['image'] = $image;
			
			
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->help_model->update_help_data($data_update_help,$id);	
			 $data['testimonial_data'] = $this->help_model->get_help_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a help successfully.');
				redirect('admin/help/manage_help/');
			
			}
		  }
			  }else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/help/edit_help',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_help($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->help_model->delete_help_by_id($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted help successfully.');
				redirect('admin/help/manage_help');
			}
		} else {
			redirect('admin/help/manage_help');
		}
		
	}
	
	  
	
}

