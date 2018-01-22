<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class counselor extends CI_Controller
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
    	$this->load->model('counselor_model');
		$this->load->model('user_model');
	}
	function manage_counselor()
	{			
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_counselor';
		    $header['tab'] = 'counselor';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'counselor';
		    $sidebar['main_page'] = 'manage_counselor';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_counselor';

		   $data['counselor_details'] = $this->counselor_model->get_counselor_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/counselor/manage_counselor',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_counselor()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_counselor';
		    $header['tab'] = 'counselor';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'counselor';
		    $sidebar['main_page'] = 'add_counselor';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_counselor';

		  
		$this->form_validation->set_rules('title', 'Counselor Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('designation', 'Designation', 'strip_tags|trim|required|xss_clean');		$this->form_validation->set_rules('website', 'Website URL', 'strip_tags|trim|xss_clean|callback_valid_url');
		
		
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
		        $this->load->view('admin/counselor/add_counselor',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/counselor'; 
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
								$image = "uploads/counselor/".$new_name;
							}
						
						}
						
					// image upload End
					
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/counselor/add_counselor',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			$data_addpage = array(
				     	'title' => $this->input->post('title'),						'designation' => $this->input->post('designation'),						'description' => $this->input->post('description'),						'website' => $this->input->post('website'),						'phone' => $this->input->post('phone'),						'skills' => $this->input->post('skills'),						'image' => $image,						'status' => $this->input->post('status'),
							);
		
		
		   
			date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->counselor_model->add_counselor_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added counselor successfully.');
				redirect('admin/counselor/add_counselor/');
			
			}
		  }
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/counselor/add_counselor',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_counselor($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/testimonial/manage_testimonial');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_counselor';
		    $header['tab'] = 'counselor';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'counselor';
		    $sidebar['main_page'] = 'edit_counselor';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_counselor';

		$this->form_validation->set_rules('title', 'Counselor Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('designation', 'Designation', 'strip_tags|trim|required|xss_clean');		$this->form_validation->set_rules('website', 'Website URL', 'strip_tags|trim|xss_clean|callback_valid_url');
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		$data['counselor_data'] = $this->counselor_model->get_counselor_data_by_id($id);
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/counselor/edit_counselor',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('testimonial_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/counselor'; 
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
								$image = "uploads/counselor/".$new_name;
								
							}
						
						}
						
					// image upload End
					
			
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/counselor/edit_counselor',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			        $data_update_testimonial = array(
				    'title' => $this->input->post('title'),					'description' => $this->input->post('description'),					'designation' => $this->input->post('designation'),					'website' => $this->input->post('website'),					'phone' => $this->input->post('phone'),					'skills' => $this->input->post('skills'),					'status' => $this->input->post('status'),
					);
		
		
			if($image)
				$data_update_testimonial['image'] = $image;
			
			
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->counselor_model->update_counselor_data($data_update_testimonial,$id);	
			 $data['testimonial_data'] = $this->counselor_model->get_counselor_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a counselor successfully.');
				redirect('admin/counselor/manage_counselor/');
			
			}
		  }
			  }else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/counselor/edit_counselor',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_counselor($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->counselor_model->delete_counselor_by_id($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted counselor successfully.');
				redirect('admin/counselor/manage_counselor');
			}
		} else {
			redirect('admin/counselor/manage_counselor');
		}
		
	}		public function valid_url($str)	{		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);	}
	
	  
	
}

