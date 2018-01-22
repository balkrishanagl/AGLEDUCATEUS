<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Setting extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$session_data = $this->session->userdata('admin_user');
		
		if($session_data['admin_user_type_id']==3){
			redirect('admin/dashboard');
		}
		
		$this->load->model("setting_model");
		$this->load->model('user_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
	}

	
	//Method to update Setting - Manoj Sharma
	function admin_setting(){
	
	if($this->session->userdata('admin_user')){
		
			$this->load->library('form_validation');
			
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			$data['get_setting_data'] = $this->setting_model->getSettingData();
			
		    $header['main_page'] = 'admin_setting';
		    $header['tab'] = 'payment_report';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'admin_setting';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'admin_setting';
			
		$this->form_validation->set_rules('fb_url', 'Facebook Url', 'callback_valid_url');
		$this->form_validation->set_rules('header_logo_url_1', 'Header 1 Logo Url', 'callback_valid_url');
		$this->form_validation->set_rules('header_logo_url_2', 'Header 2 Logo Url', 'callback_valid_url');
		$this->form_validation->set_rules('twitter_url', 'Twitter Url', 'callback_valid_url');
		/* $this->form_validation->set_rules('youtube_url', 'Youtube Url', 'callback_valid_url');
		$this->form_validation->set_rules('pinterest_url', 'Pinterest Url', 'callback_valid_url'); */
		$this->form_validation->set_rules('footer_logo_url_1', 'Footer 1 Logo Url', 'callback_valid_url');
		$this->form_validation->set_rules('footer_logo_url_2', 'Footer 2 Logo Url', 'callback_valid_url');
		
			
		$error_arr = array();	  
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			
		   if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/setting/admin_setting', $data);
				$this->load->view('admin/parts/footer',$footer);
		}else {
			//Header Logo 1 upload Start
						
			$header_logo1 = '';
						
				if($_FILES['upload_header_logo_1']['name'] != ""){
					
					
					$header_logo1 = strtolower(str_replace(" ","-",$_FILES["upload_header_logo_1"]['name']));
					
					if(file_exists("uploads/images/".$header_logo1)){
						
						unlink("uploads/images/".$header_logo1);
					}
					
					$config['upload_path']   = './uploads/images'; 
					$config['file_name'] = $header_logo1;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 200; 
					$config['max_width']     = 400; 
					$config['max_height']    = 150;   
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('upload_header_logo_1')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(Header Logo1)";
						//echo '<pre>'; print_r($error_arr); die;
					}else{ 
							$data_user = array('upload_data' => $this->upload->data());
							$header_logo1 = "uploads/images/".$header_logo1;
					}
				}
				
				//Header Logo 2 upload Start
						
			$header_logo2 = '';
						
				if($_FILES['upload_header_logo_2']['name'] != ""){
					
					$header_logo2 = strtolower(str_replace(" ","-",$_FILES["upload_header_logo_2"]['name']));
					
					if(file_exists("uploads/images/".$header_logo2)){
						
						unlink("uploads/images/".$header_logo2);
					}
					
					
					$config['upload_path']   = './uploads/images'; 
					$config['file_name'] = $header_logo2;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 200; 
					$config['max_width']     = 400; 
					$config['max_height']    = 150;  
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('upload_header_logo_2')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(Header Logo2)";
						//echo '<pre>'; print_r($error_arr); die;
					}else{ 
							$data_user = array('upload_data' => $this->upload->data());
							$header_logo2 = "uploads/images/".$header_logo2;
					}
				}
				
				//Footer Logo 1 upload Start
						
			$footer_logo1 = '';
						
				if($_FILES['upload_footer_logo_1']['name'] != ""){
					
					$footer_logo1 = strtolower(str_replace(" ","-",$_FILES["upload_footer_logo_1"]['name']));
					
					if(file_exists("uploads/images/".$footer_logo1)){
						
						unlink("uploads/images/".$footer_logo1);
					}
					
					$config['upload_path']   = './uploads/images'; 
					$config['file_name'] = $footer_logo1;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 200; 
					$config['max_width']     = 400; 
					$config['max_height']    = 150;  
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('upload_footer_logo_1')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(Footer Logo1)";
						//echo '<pre>'; print_r($error_arr); die;
					}else{ 
							$data_user = array('upload_data' => $this->upload->data());
							$footer_logo1 = "uploads/images/".$footer_logo1;
					}
				}
				
				//Footer Logo 2 upload Start
						
			$footer_logo2 = '';
						
				if($_FILES['upload_footer_logo_2']['name'] != ""){
					
					$footer_logo2 = strtolower(str_replace(" ","-",$_FILES["upload_footer_logo_2"]['name']));
					
					if(file_exists("uploads/images/".$footer_logo2)){
						
						unlink("uploads/images/".$footer_logo2);
					}
					
					
					$config['upload_path']   = './uploads/images'; 
					$config['file_name'] = $footer_logo2;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 200; 
					$config['max_width']     = 400; 
					$config['max_height']    = 150;  
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('upload_footer_logo_2')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(Footer Logo1)";
						//echo '<pre>'; print_r($error_arr); die;
					}else{ 
							$data_user = array('upload_data' => $this->upload->data());
							$footer_logo2 = "uploads/images/".$footer_logo2;
					}
				}
				
				$email_logo = '';
				
					if($_FILES['upload_email_logo']['name'] != ""){
					
					
					$email_logo= strtolower(str_replace(" ","-",$_FILES["upload_email_logo"]['name']));
					
					
					if(file_exists("uploads/images/".$email_logo)){
						
						unlink("uploads/images/".$email_logo);
					}
					
					$config['upload_path']   = './uploads/images'; 
					$config['file_name'] = $email_logo;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 200; 
					$config['max_width']     = 400; 
					$config['max_height']    = 150;   
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('upload_email_logo')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(Email Logo)";
						//echo '<pre>'; print_r($error_arr); die;
					}else{ 
							$data_user = array('upload_data' => $this->upload->data());
							$email_logo = "uploads/images/".$email_logo;
					}
				}
			
			//echo $header_logo1_path; die;
			//echo '<pre>'; print_r($error_arr); die;
			if(count($error_arr) > 0){
					
				$temp = false;
					//echo '<pre>'; print_r($error_arr); die;
				if(isset($error_arr)){
					//echo "Current Data"; die;
					$data['file_error'] = $error_arr;
					//echo '<pre>'; print_r($data['file_error']); die;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/setting/admin_setting', $data);
					$this->load->view('admin/parts/footer',$footer);
				}
					//print_r($error_arr); die;
				}else{
					
				  foreach($_POST as $key=>$value){
					  
					  
						
					if($key == "header_logo_1"){
							
							if($header_logo1){
								
								$value = $header_logo1;
								
							}
							
					}elseif($key == "header_logo_2"){
							
							if($header_logo2){
								
								$value = $header_logo2;
								
							}
					}elseif($key == "footer_logo_1"){
							
							if($footer_logo1){
								
								$value = $footer_logo1;
								
							}
					}elseif($key == "footer_logo_2"){
							
							if($footer_logo2){
								
								$value = $footer_logo2;
								
							}
					}elseif($key == "email_logo"){
							
							if($email_logo){
								
								$value = $email_logo;
								
							}
						}
					$temp = true;	
					
						$data_update_setting =
						array(
						 'value' => $value,
						 );
						//echo '<pre>'; print_r($data_update_setting); die;
						//echo "Test"; die;
						$this->setting_model->update_setting_data($data_update_setting,$key);
						

						$this->session->set_flashdata('success', 'You have updated Settings successfully.');
						 //redirect('admin/setting/admin_setting/');
					   
				  }
				  
			  }
			  if($temp == true){
				  
				  redirect('admin/setting/admin_setting/');
			  }
				
			  
			
		
			//after successful submission
		}		
		}else{
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/setting/admin_setting', $data);
			$this->load->view('admin/parts/footer',$footer);

			}
	}
		else {
				redirect('admin/login', 'refresh');
			}
				
	
	}
	
	public function valid_url($str)
	{
		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
	}
}
