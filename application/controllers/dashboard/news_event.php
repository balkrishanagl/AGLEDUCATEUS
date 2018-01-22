<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_Event extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('news_event_model');
		$this->load->model('user_model');
		$this->load->model('city_model');
		$this->load->model('dream_colleges_model');
		$this->load->model('course_model');
		$this->load->model('universities_model');
	}
	function manage_event()
	{
		
		$this->load->model('news_event_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'manage_event';
		    $header['tab'] = 'event';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'event';
		    $sidebar['main_page'] = 'manage_event';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_event';

		   $data['event_details'] = $this->news_event_model->get_event_detail();
		   //echo '<pre>'; print_r($data['event_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/event/manage_event',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_event()
	{
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_event';
		    $header['tab'] = 'event';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'event';
		    $sidebar['main_page'] = 'add_event';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_event';
			
			$data['city_detail'] =  $this->city_model->getAllActiveCityList();
			$data['dream_collage'] =  $this->dream_colleges_model->get_collage_list();
			$data['course'] =  $this->course_model->get_course_list();
			$data['universities'] =  $this->universities_model->get_universities_list();

		  //echo '<pre>'; print_r($city['city_detail']); die;
		/* $this->form_validation->set_rules('event_title', 'Event Title', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_space');
		$this->form_validation->set_rules('event_content', 'Content', 'strip_tags|trim|required|xss_clean');
		
		
		$this->form_validation->set_rules('event_start_date', 'Start Date', 'required'); */
		//$this->form_validation->set_rules('event_end_date', 'End Date', 'required');
        
		
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  $dreamCollage = json_encode($this->input->post('dream_collage'), true);
			  $courses = json_encode($this->input->post('course'), true);
			  $universities = json_encode($this->input->post('universities'), true);
			  
				$this->form_validation->set_rules('event_title', 'Title', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('event_content', 'Content', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('type', 'Type', 'required');
				$this->form_validation->set_rules('location', 'Location', 'required');
				$this->form_validation->set_rules('map', 'Map', 'required');
				$this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
				$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
				$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
				
				if($this->input->post('type') == "Event"){
					$this->form_validation->set_rules('event_start_date', 'Event Start Date', 'required');
				}
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/event/add_event',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				
			// Thumb Image Upload Start
			
			$event_thumb_image = '';
						
						if(isset($_FILES['thumb_image'])){
							
							$new_thumb_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["thumb_image"]['name']));
							$config['upload_path']   = './uploads/event/thumb'; 
							$config['file_name'] = $new_thumb_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('thumb_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Thumb Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_thumb_image = "/uploads/event/thumb/".$new_thumb_image_name;
							}
						
						}
			

			// Main image upload Start
						
						$event_main_image = '';
						
						if(isset($_FILES['main_image'])){
							
							$new_main_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							$config['upload_path']   = './uploads/event'; 
							$config['file_name'] = $new_main_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_main_image = "/uploads/event/".$new_main_image_name;
							}
						
						}
						
			// Event images upload Start
					/*$event_images = array();
					if(isset($_FILES['event_images'])){
						
						$imagesCount = count($_FILES['event_images']['name']);
						//echo $_FILES['event_images']['name'][2]; die;
						
						for($i = 0; $i < $imagesCount; $i++){
							$_FILES['event_image']['name'] = $_FILES['event_images']['name'][$i];
							$_FILES['event_image']['type'] = $_FILES['event_images']['type'][$i];
							$_FILES['event_image']['tmp_name'] = $_FILES['event_images']['tmp_name'][$i];
							$_FILES['event_image']['error'] = $_FILES['event_images']['error'][$i];
							$_FILES['event_image']['size'] = $_FILES['event_images']['size'][$i]; 
							
							$new_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".strtolower(str_replace(" ","-",$_FILES["event_image"]['name']));
							$config_image['upload_path']   = './uploads/event'; 
							$config_image['file_name'] = $new_image_name;
							$config_image['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config_image['max_size']      = 1024; 
							$config_image['max_width']     = 0; 
							$config_image['max_height']    = 0;
							
							$this->load->library('upload', $config_image);
							$this->upload->initialize($config_image);
							if ( ! $this->upload->do_upload('event_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Event Images)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_images[] = "/uploads/event/".$new_image_name;
							}
							
						}
					}
							$event_images = json_encode($event_images, true);*/
							
		
			if(isset($error_arr) and count($error_arr)>0){  
				$data['file_error'] = $error_arr;
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/event/add_event',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			} else {
				
				$cityId = $this->input->post('city');
				$existData = $this->news_event_model->chkExhibitionByCityId($cityId);
				
				$cityData = $this->city_model->get_city_data_by_id($this->input->post('city'));
				$slug = str_replace(" ","-",$cityData->city_name);
				$slug = strtolower($slug);
				
			if(sizeof($existData) > 0){
				
				//echo $this->input->post('event_title'); die;
				$data_addpage = array(
				     	'name' => $this->input->post('event_title'),
						'event_content' => $this->input->post('event_content'),
						'main_image' => $event_main_image,
						'thumb_image' => $event_thumb_image,
						'city' => $this->input->post('city'),
						'location' => $this->input->post('location'),
						'map' => $this->input->post('map'),
						'dream_collage' => $dreamCollage,
						'course' => $courses,
						'universities' => $universities,
						'meta_title' => $this->input->post('meta_title'),
						'meta_kaywords' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'start_time' => date('H:i:s',strtotime($this->input->post('event_start_time'))),
						'end_time' => date('H:i:s',strtotime($this->input->post('event_end_time'))),
						//'event_images' => $event_images,
						/* 'start_date' => $this->input->post('event_start_date'),
						'end_date' => $this->input->post('event_end_date'), */
						'created_by' => $data['username'],
						'created' => date('Y/m/d  h:m:s'),
						);
						
			
				
				if($this->input->post('event_start_date')!=""){				
					$data_addpage['start_date'] = $this->input->post('event_start_date');
				}
				if($this->input->post('event_end_date')!=""){
					$data_addpage['end_date'] = $this->input->post('event_end_date');
				}
				
				
				$data_addpage['slug'] =  $slug;
			   
							
				$data_addpage['updated'] = date('Y/m/d  h:m:s');
		
				$this->news_event_model->update_event_data($data_addpage,$existData->id);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added event successfully.');
				//redirect('admin/event/add_event/');
				redirect('admin/event/manage_event/');
			}else{
				
				
				$data_addpage = array(
				     	'name' => $this->input->post('event_title'),
						'event_content' => $this->input->post('event_content'),
						'main_image' => $event_main_image,
						'thumb_image' => $event_thumb_image,
						'city' => $this->input->post('city'),
						'type' => $this->input->post('type'),
						'location' => $this->input->post('location'),
						'map' => $this->input->post('map'),
						'dream_collage' => $dreamCollage,
						'course' => $courses,
						'universities' => $universities,
						'meta_title' => $this->input->post('meta_title'),
						'meta_kaywords' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'start_time' => date('H:i:s',strtotime($this->input->post('event_start_time'))),
						'end_time' => date('H:i:s',strtotime($this->input->post('event_end_time'))),
						//'event_images' => $event_images,
						/* 'start_date' => $this->input->post('event_start_date'),
						'end_date' => $this->input->post('event_end_date'), */
						'created_by' => $data['username'],
						'created' => date('Y/m/d  h:m:s'),
						);
						
			
				
				if($this->input->post('event_start_date')!=""){				
					$data_addpage['start_date'] = $this->input->post('event_start_date');
				}
				if($this->input->post('event_end_date')!=""){
					$data_addpage['end_date'] = $this->input->post('event_end_date');
				}
						
				
				$data_addpage['slug'] =  $slug;
			   
				
				$data_addpage['updated'] = date('Y/m/d  h:m:s');
		
				$this->news_event_model->add_event_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added event successfully.');
				//redirect('admin/event/add_event/');
				redirect('admin/event/manage_event/');
				
			}
			
			
			}
			  }
			  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/event/add_event',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_event($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/event/manage_event');
		}
	
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('news_event_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_event';
		    $header['tab'] = 'event';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'event';
		    $sidebar['main_page'] = 'esit_event';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_event';

		$data['city_detail'] =  $this->city_model->getAllActiveCityList();
		$data['event_data'] = $this->news_event_model->get_event_data_by_id($id);
		$data['universities'] =  $this->universities_model->get_universities_list();
		
		$this->form_validation->set_rules('event_title', 'Event Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('event_content', 'Content', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('map', 'Map', 'required');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'required');
		$this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required');
		$this->form_validation->set_rules('meta_description', 'Meta Description', 'required');
		
		
		
		$this->form_validation->set_rules('event_start_date', 'Start Date', 'required');
		/*$this->form_validation->set_rules('event_end_date', 'End Date', 'required'); */
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['dream_collage'] =  $this->dream_colleges_model->get_collage_list();
		$data['course'] =  $this->course_model->get_course_list();
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  $dreamCollage = json_encode($this->input->post('dream_collage'), true);
			  $courses = json_encode($this->input->post('course'), true);
			  $universities = json_encode($this->input->post('universities'), true);
			  
			  //echo '<pre>'; print_r($this->input->post('exist_event_image'));
			  //echo '<pre>'; print_r($this->input->post('event_images')); die;
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/event/edit_event',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				
			// Thumb image upload Start
						
						$event_thumb_image = '';
						
						if($_FILES['thumb_image']!= null && $_FILES['thumb_image']['name']!=""){
							$new_thumb_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["thumb_image"]['name']));
							
							$config['upload_path']   = './uploads/event/thumb'; 
							$config['file_name'] = $new_thumb_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;    
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('thumb_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Thumb Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_thumb_image = "uploads/event/thumb/".$new_thumb_image_name;
							}
						
						}else{
								if($this->input->post('exist_main_image')!=""){
									
									$event_thumb_image = $this->input->post('exist_main_image');
								}else{
									
									$event_thumb_image="";
								}
							  
						}
						

		   // Main image upload Start
						
						$event_main_image = '';
						
						if($_FILES['main_image']!= null && $_FILES['main_image']['name']!=""){
							$new_main_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							
							$config['upload_path']   = './uploads/event'; 
							$config['file_name'] = $new_main_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;    
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_main_image = "uploads/event/".$new_main_image_name;
							}
						
						}else{
								if($this->input->post('exist_main_image')!=""){
									
									$event_main_image = $this->input->post('exist_main_image');
								}else{
									
									$event_main_image="";
								}
							  
						}
						
			// Event images upload Start
					/*$updatedImages = array();
					$event_images = array();
					if($_FILES['event_images'] !=null && $_FILES['event_images']['name'][0]!=""){
						
						//echo '<pre>'; print_r($_FILES['event_images']); die;
						
						$imagesCount = count($_FILES['event_images']['name']);
						//echo $_FILES['event_images']['name'][2]; die;
						
						for($i = 0; $i < $imagesCount; $i++){
						
							$_FILES['event_image']['name'] = $_FILES['event_images']['name'][$i];
							$_FILES['event_image']['type'] = $_FILES['event_images']['type'][$i];
							$_FILES['event_image']['tmp_name'] = $_FILES['event_images']['tmp_name'][$i];
							$_FILES['event_image']['error'] = $_FILES['event_images']['error'][$i];
							$_FILES['event_image']['size'] = $_FILES['event_images']['size'][$i]; 
							
							$new_image_name = strtolower(str_replace(" ","-",$this->input->post('event_title')))."_".strtolower(str_replace(" ","-",$_FILES["event_image"]['name']));
							$config_image['upload_path']   = './uploads/event'; 
							$config_image['file_name'] = $new_image_name;
							$config_image['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config_image['max_size']      = 1024; 
							$config_image['max_width']     = 0; 
							$config_image['max_height']    = 0;
							
							$this->load->library('upload', $config_image);
							$this->upload->initialize($config_image);
							if ( ! $this->upload->do_upload('event_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Event Images)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$event_images[] = "uploads/event/".$new_image_name;
								
								if(!empty($this->input->post('exist_event_image'))){
								
								$updatedImages = array_merge($event_images,$this->input->post('exist_event_image'));
								$updatedImages = json_encode($updatedImages, true);
								}else{
									//echo '<pre>'; print_r($updatedImages); die;
									$updatedImages = $event_images;
									$updatedImages = json_encode($updatedImages, true);
									
								}
							}
							
						}
					}else{
						
							if(!empty($this->input->post('exist_event_image'))){
								//echo $this->input->post('exist_event_image'); die;
								$updatedImages = $this->input->post('exist_event_image');
								$updatedImages = json_encode($updatedImages, true);
								
							}else{
								
								$updatedImages = "";
							}
					}*/
					
					
					
							
							
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/event/edit_event',$data);
					$this->load->view('admin/parts/footer',$footer);
					}
					
				}else {
						$data_update_event = array(
						 'name' => $this->input->post('event_title'),
						 'event_content' => $this->input->post('event_content'),
						 'main_image' => $event_main_image,
						 'thumb_image' => $event_thumb_image,
						 //'event_images' => $updatedImages,
						 'location' => $this->input->post('location'),
						 'dream_collage' => $dreamCollage,
						 'course' => $courses,
						 'universities' => $universities,
						 'meta_title' => $this->input->post('meta_title'),
						 'meta_kaywords' => $this->input->post('meta_keyword'),
						 'meta_description' => $this->input->post('meta_description'),
						 'start_time' => date('H:i:s',strtotime($this->input->post('event_start_time'))),
						 'end_time' => date('H:i:s',strtotime($this->input->post('event_end_time'))),
						 'map' => $this->input->post('map'),
						 'start_date' => $this->input->post('event_start_date'),
						 'end_date' => $this->input->post('event_end_date'),
						 'created_by' => $data['username'],
						);
			
		
		 
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->news_event_model->update_event_data($data_update_event,$id);	
			 $data['event_data'] = $this->news_event_model->get_event_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a event successfully.');
				redirect('admin/event/manage_event/');
			
			}
			  }
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/event/edit_event',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_event($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->news_event_model->delete_event_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deactivate event successfully.');
				redirect('admin/event/manage_event');
			}
		}
		
	}
	
	function active_event($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '1');
			$delete = $this->news_event_model->delete_event_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active event successfully.');
				redirect('admin/event/manage_event');
			}
		}
		
	}
	
	function getCityByType($type){
		
		$cityDetail = $this->city_model->get_city_data_by_type($type);
		
		foreach($cityDetail as $city){
			
			echo '<option value="'.$city->id.'">'.$city->city_name.'</option>';
			
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
		
			$this->form_validation->set_message('alpha_dash_space', 'The Event Title Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}	
	
}

