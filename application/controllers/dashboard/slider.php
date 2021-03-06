<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller
{
	function __construct()
	{
		
		parent::__construct();

		if(!$this->session->userdata('logged_in'))
    	{
    		//redirect('admin/login', 'refresh');
    	}
    	$this->load->model('slider_model');
		$this->load->model('user_model');
	}
	function manage_slider()
	{
		
		$this->load->model('slider_model');
    		$session_data = $this->session->userdata('logged_in');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_slider';
		    $header['tab'] = 'slider';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'slider';
		    $sidebar['main_page'] = 'manage_slider';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_slider';

		   $data['slider_details'] = $this->slider_model->get_slider_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/slider/manage_slider',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_slider()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('logged_in');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_slider';
		    $header['tab'] = 'slider';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'slider';
		    $sidebar['main_page'] = 'add_slider';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_slider';

		  
		$this->form_validation->set_rules('banner_name', 'Banner Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('img_caption', 'Image Caption', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('banner_content', 'Banner Content', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'callback_valid_url');
		
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
		        $this->load->view('admin/slider/add_slider',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				$banner_image = '';
				
				if($_FILES['banner_image']['name'] != ""){
					$new_banner_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('banner_name'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
							$config['upload_path']   = './uploads/slider'; 
							$config['file_name'] = $new_banner_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 1024; 
							$config['max_width']     = 0; 
							$config['max_height']    = 0;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('banner_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Banner Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$banner_image = "uploads/slider/".$new_banner_name;
							}
				}
				if(isset($error_arr) and count($error_arr)>0){ 
				
				//echo "<pre>"; print_r($error_arr); die;
						
					$data['file_error'] = $error_arr[0];
					
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/slider/add_slider',$data);
					$this->load->view('admin/parts/footer',$footer);	
					//print_r($error_arr); die;
				} else {
					
			$data_addpage = array(
				     	'banner_name' => $this->input->post('banner_name'),
						'img_caption' => $this->input->post('img_caption'),
						'banner_content' => $this->input->post('banner_content'),
						'url' => $this->input->post('url'),
						'status' => $this->input->post('status'),
						'banner_image'=> $banner_image,
							);
			   
			date_default_timezone_set('Asia/Kolkata');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->slider_model->add_slider_data($data_addpage);	
			 
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have added a slider successfully.');
				redirect('admin/slider/add_slider');
			
			}
			  }
		  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/slider/add_slider',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_slider($id = Null)
	{
		
			if($id == NULL)
		{
			redirect('admin/slider/manage_slider');
		}
		
		$data['slider_data'] = $this->slider_model->get_slider_data_by_id($id);
		
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('slider_model');
		
    	$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'edit_slider';
		$header['tab'] = 'slider';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'slider';
		$sidebar['main_page'] = 'esit_slider';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'edit_slider';

		  
  
		$this->form_validation->set_rules('banner_name', 'Banner Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('banner_content', 'Banner Content', 'trim|required|xss_clean');
		$this->form_validation->set_rules('img_caption', 'Image caption', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('status','Status', 'required');
		$this->form_validation->set_rules('url', 'Url', 'callback_valid_url');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/slider/edit_slider',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			       		$banner_image = '';
				
			//	if($data['slider_data']->banner_image==''){
					if(isset($_FILES['banner_image'])&& $_FILES['banner_image']['name']!=''){
							$new_banner_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('banner_name'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
							$config['upload_path']   = './uploads/slider'; 
							$config['file_name'] = $new_banner_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 1024; 
							$config['max_width']     = 0; 
							$config['max_height']    = 0;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('banner_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Banner Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$banner_image = "uploads/slider/".$new_banner_name;
							}
					}
				 else {
					$banner_image = $this->input->post('exist_slide');
				}
				if(isset($error_arr) and count($error_arr)>0){  
					$data['file_error'] = $error_arr[0];
					//print_r($data['file_error']);
					//die;
		    $this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/slider/add_slider',$data);
			$this->load->view('admin/parts/footer',$footer);	
					//print_r($error_arr); die;
				} else {
					
			$data_addpage = array(
				     	'banner_name' => $this->input->post('banner_name'),
						'img_caption' => $this->input->post('img_caption'),
						'banner_content' => $this->input->post('banner_content'),
						'url' => $this->input->post('url'),
						'status' => $this->input->post('status'),
						'banner_image'=> $banner_image,
							);
			   
			date_default_timezone_set('UTC');
		
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->slider_model->update_slider_data($data_addpage,$id);	
			 
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have added a slider successfully.');
				redirect('admin/slider/manage_slider');
			
			}
			  }
		  }
			  
			  else {
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/slider/edit_slider',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_slider($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->slider_model->delete_slider_by_id($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted slider successfully.');
				redirect('admin/slider/manage_slider');
			}
		} else {
			redirect('admin/slider/manage_slider');
		}
		
	}
	
	
	public function valid_url($str)
	{
		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
	}
	
	  
	
}

