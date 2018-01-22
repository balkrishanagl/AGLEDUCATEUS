<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class universities extends CI_Controller
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
    	$this->load->model('universities_model');
		$this->load->model('user_model');
	}
	function manage_universities()
	{
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'manage_universities';
		    $header['tab'] = 'universities';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'universities';
		    $sidebar['main_page'] = 'manage_universities';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_universities';

		   $data['universities_details'] = $this->universities_model->get_universities_detail();
		   

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/universities/manage_universities',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_universities()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_universities';
		    $header['tab'] = 'universities';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'universities';
		    $sidebar['main_page'] = 'add_universities';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_universities';

	//by aglram	  
	
	//end by aglram	  	
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		  
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
				$this->form_validation->set_rules('title', 'University Name', 'strip_tags|trim|required|xss_clean');
				
				
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/universities/add_universities',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

			// Main image upload Start
						
						$university_image = '';
						
						if(isset($_FILES['main_image'])){
							
							$new_university_image_name = time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							$config['upload_path']   = './uploads/universities'; 
							$config['file_name'] = $new_university_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$university_image = "/uploads/universities/".$new_university_image_name;
							}
						
						}
						
			
		
			if(isset($error_arr) and count($error_arr)>0){  
				$data['file_error'] = $error_arr;
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/universities/add_universities',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			} else {
			$data_addpage = array(
				     	'name' => $this->input->post('title'),
				     	'image' => $university_image
						);
			
		   
			//date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->universities_model->add_universities_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added Univesity successfully.');
				//redirect('admin/event/add_event/');
				redirect('admin/universities/manage_universities/');
			
			}
			  }
			  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/universities/add_universities',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_universities($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/event/manage_event');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_universities';
		    $header['tab'] = 'universities';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'universities';
		    $sidebar['main_page'] = 'edit_universities';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_universities';

		  
		$data['universities_data'] = $this->universities_model->get_universities_data_by_id($id);
		
	
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			
			
			$this->form_validation->set_rules('title', 'Collage Title', 'strip_tags|trim|required|xss_clean');
			
			
			  
			if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/universities/edit_universities',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

		   // Main image upload Start
						
						$university_main_image = '';
						
						if($_FILES['main_image']!= null && $_FILES['main_image']['name']!=""){
							$new_main_image_name = time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							
							$config['upload_path']   = './uploads/universities'; 
							$config['file_name'] = $new_main_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;    
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$university_main_image = "uploads/universities/".$new_main_image_name;
							}
						
						}else{
								if($this->input->post('exist_main_image')!=""){
									
									$university_main_image = $this->input->post('exist_main_image');
								}else{
									
									$university_main_image="";
								}
							  
						}
						
							
							
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/universities/edit_universities',$data);
					$this->load->view('admin/parts/footer',$footer);
					}
					
				}else {
						$data_update_event = array(
						 'name' => $this->input->post('title'),
						 'image' => $university_main_image,
						);
			
					 
			//date_default_timezone_set('UTC');
			$data_addpage['updated'] = date('Y/m/d  h:m:s');
			$this->universities_model->update_universities_data($data_update_event,$id);	
			 $data['universities_data'] = $this->universities_model->get_universities_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a University successfully.');
				redirect('admin/universities/manage_universities/');
			
			}
			  }
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/universities/edit_universities',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_universities($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->universities_model->delete_universities_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deactivate university successfully.');
				redirect('admin/universities/manage_universities');
			}
		}
		
	}
	
	function active_universities($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> 'Active');
			$delete = $this->universities_model->delete_universities_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active university successfully.');
				redirect('admin/universities/manage_universities');
			}
		}
		
	}

	
 	function alpha_dash_space($str) {
		
		if( ! preg_match("/^([-a-z_ \"#$%&'()*+,\-.\\:\/;=?@^_])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'The Title Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}	
	

	

//end by aglram

}

?>