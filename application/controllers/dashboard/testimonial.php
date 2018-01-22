<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends CI_Controller
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
    	$this->load->model('testimonial_model');
		$this->load->model('user_model');
	}
	function manage_testimonial()
	{
		
		$this->load->model('testimonial_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_testimonial';
		    $header['tab'] = 'testimonial';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'testimonial';
		    $sidebar['main_page'] = 'manage_testimonial';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_testimonial';

		   $data['testimonial_details'] = $this->testimonial_model->get_testimonial_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/testimonial/manage_testimonial',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_testimonial()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_testimonial';
		    $header['tab'] = 'testimonial';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'testimonial';
		    $sidebar['main_page'] = 'add_testimonial';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_testimonial';

		  
		$this->form_validation->set_rules('testimonial_title', 'testimonial Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('testimonial_description', 'Description', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('testimonial_designation', 'Designation', 'strip_tags|trim|required|xss_clean');
		
		
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
		        $this->load->view('admin/testimonial/add_testimonial',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('testimonial_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/testimonial'; 
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
								$image = "uploads/testimonial/".$new_name;
							}
						
						}
						
					// image upload End
					
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/testimonial/add_testimonial',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			$data_addpage = array(
				     	'title' => $this->input->post('testimonial_title'),
						'designation' => $this->input->post('testimonial_designation'),
						'description' => $this->input->post('testimonial_description'),
						'image' => $image,
					
						'status' => $this->input->post('status'),
							);
		
		
		   
			date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->testimonial_model->add_testimonial_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added testimonial successfully.');
				redirect('admin/testimonial/add_testimonial/');
			
			}
		  }
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/testimonial/add_testimonial',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_testimonial($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/testimonial/manage_testimonial');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('testimonial_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_testimonial';
		    $header['tab'] = 'testimonial';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'testimonial';
		    $sidebar['main_page'] = 'esit_testimonial';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_testimonial';

		  
  
		$this->form_validation->set_rules('testimonial_title', 'testimonial Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('testimonial_description', 'Description', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('testimonial_designation', 'Designation', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('testimonial_date', 'Date', '');
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		$data['testimonial_data'] = $this->testimonial_model->get_testimonial_data_by_id($id);
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/testimonial/edit_testimonial',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('testimonial_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/testimonial'; 
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
								$image = "uploads/testimonial/".$new_name;
								
							}
						
						}
						
					// image upload End
					
			
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/testimonial/edit_testimonial',$data);
					$this->load->view('admin/parts/footer',$footer);	
				}
				
					//print_r($error_arr); die;
				} else {		
				
			        $data_update_testimonial = array(
				    'title' => $this->input->post('testimonial_title'),
				    'description' => $this->input->post('testimonial_description'),
					'designation' => $this->input->post('testimonial_designation'),
					'status' => $this->input->post('status'),
					);
		
		
			if($image)
				$data_update_testimonial['image'] = $image;
			
			
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->testimonial_model->update_testimonial_data($data_update_testimonial,$id);	
			 $data['testimonial_data'] = $this->testimonial_model->get_testimonial_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a testimonial successfully.');
				redirect('admin/testimonial/manage_testimonial/');
			
			}
		  }
			  }else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/testimonial/edit_testimonial',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_testimonial($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->testimonial_model->delete_testimonial_by_id($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted testimonial successfully.');
				redirect('admin/testimonial/manage_testimonial');
			}
		} else {
			redirect('admin/testimonial/manage_testimonial');
		}
		
	}
	
	  
	
}

