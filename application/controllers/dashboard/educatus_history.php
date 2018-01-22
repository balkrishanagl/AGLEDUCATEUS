<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class educatus_history extends CI_Controller
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
    	$this->load->model('educatus_history_model');
		$this->load->model('user_model');
	}
	function manage_history()
	{
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'manage_history';
		    $header['tab'] = 'educatus_history';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'educatus_history';
		    $sidebar['main_page'] = 'manage_history';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_history';

		   $data['history_details'] = $this->educatus_history_model->get_history_detail();
		   

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/history/manage_history',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_history()
	{
		//echo "Test"; die;
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_history';
		    $header['tab'] = 'educatus_history';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'educatus_history';
		    $sidebar['main_page'] = 'add_history';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_history';

	//by aglram	  
	
	//end by aglram	  	
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			// echo "Post"; die;
			  
				$this->form_validation->set_rules('title_1', 'Title 1', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('title_2', 'Title 2', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('detail_1', 'Detail 1', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('detail_2', 'Detail 2', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('year','Year', 'required');
				
			  if ($this->form_validation->run() == FALSE){
				//  echo "hmm"; die;
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/history/add_history',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

			// Main image upload Start
						
						$image1 = '';
						
						if(isset($_FILES['image_1'])){
							
							$new_image1_name = time()."_".strtolower(str_replace(" ","-",$_FILES["image_1"]['name']));
							$config['upload_path']   = './uploads/history'; 
							$config['file_name'] = $new_image1_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image_1')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image1 = "/uploads/history/".$new_image1_name;
							}
						
						}
						
						
						$image2 = '';
						
						if(isset($_FILES['image_2'])){
							
							$new_image2_name = time()."_".strtolower(str_replace(" ","-",$_FILES["image_2"]['name']));
							$config['upload_path']   = './uploads/history'; 
							$config['file_name'] = $new_image2_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image_2')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image2 = "/uploads/history/".$new_image2_name;
							}
						
						}
						
			
		
			if(isset($error_arr) and count($error_arr)>0){  
			//echo "Error"; die;
				$data['file_error'] = $error_arr;
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/history/add_history',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			} else {
			$data_addpage = array(
						'year' => $this->input->post('year'),
				     	'title_1' => $this->input->post('title_1'),
				     	'title_2' => $this->input->post('title_2'),
				     	'detail_1' => $this->input->post('detail_1'),
				     	'detail_2' => $this->input->post('detail_2'),
				     	'image_1' => $image1,
				     	'image_2' => $image2,
						'created' => date('Y/m/d  h:m:s'),
						);
			
		   
			//date_default_timezone_set('UTC');
		//echo '<pre>'; print_r($data_addpage); die;
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->educatus_history_model->add_history_data($data_addpage);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added history successfully.');
				//redirect('admin/event/add_event/');
				redirect('admin/history/manage_history/');
			
			}
			  }
			  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/history/add_history',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_history($id = Null)
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
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_history';
		    $header['tab'] = 'educatus_history';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'educatus_history';
		    $sidebar['main_page'] = 'edit_history';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_history';

		  
		$data['history_data'] = $evnData =  $this->educatus_history_model->get_history_data_by_id($id);
	
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			
			
				$this->form_validation->set_rules('title_1', 'Title 1', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('title_2', 'Title 2', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('detail_1', 'Detail 1', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('detail_2', 'Detail 2', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('year','Year', 'required');
			
			  
			if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/history/edit_history',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

		   // Main image upload Start
						
						$image1 = '';
						
						if($_FILES['image_1']!= null && $_FILES['image_1']['name']!=""){
														
							$new_image1_name = time()."_".strtolower(str_replace(" ","-",$_FILES["image_1"]['name']));
							$config['upload_path']   = './uploads/history'; 
							$config['file_name'] = $new_image1_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image_1')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image1 = "/uploads/history/".$new_image1_name;
							}
						
						}else{
								if($this->input->post('exist_image1')!=""){
									
									$image1 = $this->input->post('exist_image1');
								}else{
									
									$image1="";
								}
							  
						}
						
						
						$image2 = '';
						
						if($_FILES['image_2']!= null && $_FILES['image_2']['name']!=""){
														
							$new_image2_name = time()."_".strtolower(str_replace(" ","-",$_FILES["image_2"]['name']));
							$config['upload_path']   = './uploads/history'; 
							$config['file_name'] = $new_image2_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image_2')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image2 = "/uploads/history/".$new_image2_name;
							}
						
						}else{
								if($this->input->post('exist_image2')!=""){
									
									$image2 = $this->input->post('exist_image2');
								}else{
									
									$image2="";
								}
							  
						}
						
							
							
			if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/history/edit_history',$data);
					$this->load->view('admin/parts/footer',$footer);
					}
					
				}else {
						$data_update_event = array(
							'title_1' => $this->input->post('title_1'),
							'title_2' => $this->input->post('title_2'),
							'detail_1' => $this->input->post('detail_1'),
							'detail_2' => $this->input->post('detail_2'),
							'image_1' => $image1,
							'image_2' => $image2,
							
						);
			
					 
			date_default_timezone_set('UTC');
	
			$this->educatus_history_model->update_history_data($data_update_event,$id);	
			 $data['history_data'] = $this->educatus_history_model->get_history_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated history successfully.');
				redirect('admin/history/manage_history/');
			
			}
			  }
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/history/edit_history',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_history($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->educatus_history_model->delete_history_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deactivate history successfully.');
				redirect('admin/history/manage_history');
			}
		}
		
	}
	
	function active_history($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '1');
			$delete = $this->educatus_history_model->delete_history_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active history successfully.');
				redirect('admin/history/manage_history');
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
	

	

//end by aglram

}

?>