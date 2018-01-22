<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class participating_colleges extends CI_Controller
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
    	$this->load->model('participating_colleges_model');
		$this->load->model('user_model');
	}
	function manage_participat_collage()
	{
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'manage_participat_collage';
		    $header['tab'] = 'participat_collage';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'participat_collage';
		    $sidebar['main_page'] = 'manage_participat_collage';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_participat_collage';

		   $data['collage_details'] = $this->participating_colleges_model->get_collage_detail();
		   

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/participat_collage/manage_participat_collage',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_participat_collage()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_participat_collage';
		    $header['tab'] = 'participat_collage';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'participat_collage';
		    $sidebar['main_page'] = 'add_participat_collage';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_participat_collage';

	//by aglram	  
	
	//end by aglram	  	
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
				$this->form_validation->set_rules('collage_title', 'Collage Title', 'strip_tags|trim|required|xss_clean');
				
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/participat_collage/add_participat_collage',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

			// Main image upload Start
						
						$collage_image = '';
						
						if(isset($_FILES['main_image'])){
							
							$new_collage_image_name = time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							$config['upload_path']   = './uploads/participat_collage'; 
							$config['file_name'] = $new_collage_image_name;
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
								$collage_image = "/uploads/participat_collage/".$new_collage_image_name;
							}
						
						}
						
			
		
			if(isset($error_arr) and count($error_arr)>0){  
				$data['file_error'] = $error_arr;
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/participat_collage/add_participat_collage',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			} else {
			$data_addpage = array(
				     	'name' => $this->input->post('collage_title'),
				     	'main_image' => $collage_image,
						'created' => date('Y/m/d  h:m:s'),
						);
			
		   
			//date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->participating_colleges_model->add_collage_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added participat collage successfully.');
				//redirect('admin/event/add_event/');
				redirect('admin/participat_collage/manage_participat_collage/');
			
			}
			  }
			  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/participat_collage/add_participat_collage',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_participat_collage($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/event/manage_event');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_participat_collage';
		    $header['tab'] = 'participat_collage';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'participat_collage';
		    $sidebar['main_page'] = 'edit_participat_collage';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_participat_collage';

		  
		$data['participat_collage_data'] = $evnData =  $this->participating_colleges_model->get_collage_data_by_id($id);
	
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			
			
			$this->form_validation->set_rules('collage_title', 'Collage Title', 'strip_tags|trim|required|xss_clean');
			
			  
			if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/participat_collage/edit_participat_collage',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

		   // Main image upload Start
						
						$collage_main_image = '';
						
						if($_FILES['main_image']!= null && $_FILES['main_image']['name']!=""){
							$new_main_image_name = time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							
							$config['upload_path']   = './uploads/participat_collage'; 
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
								$collage_main_image = "uploads/participat_collage/".$new_main_image_name;
							}
						
						}else{
								if($this->input->post('exist_main_image')!=""){
									
									$collage_main_image = $this->input->post('exist_main_image');
								}else{
									
									$collage_main_image="";
								}
							  
						}
						
							
							
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/participat_collage/edit_participat_collage',$data);
					$this->load->view('admin/parts/footer',$footer);
					}
					
				}else {
						$data_update_event = array(
						 'name' => $this->input->post('collage_title'),
						 'main_image' => $collage_main_image,
						);
			
					 
			date_default_timezone_set('UTC');
	
			$this->participating_colleges_model->update_collage_data($data_update_event,$id);	
			 $data['participat_collage_data'] = $this->participating_colleges_model->get_collage_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a participat collage successfully.');
				redirect('admin/participat_collage/manage_participat_collage/');
			
			}
			  }
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/participat_collage/edit_participat_collage',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_participat_collage($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->participating_colleges_model->delete_collage_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deactivate participat collage successfully.');
				redirect('admin/participat_collage/manage_participat_collage');
			}
		}
		
	}
	
	function active_participat_collage($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '1');
			$delete = $this->participating_colleges_model->delete_collage_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active participating college successfully.');
				redirect('admin/participat_collage/manage_participat_collage');
			}
		}
		
	}

	
 	function alpha_dash_space($str) {
		
		if( ! preg_match("/^([-a-z_ \"#$%&'()*+,\-.\\:\/;=?@^_])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'The Partner Title Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}	
	

	

//end by aglram

}

?>