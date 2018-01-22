<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class ip_competition_law extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("user_model");
		$this->load->model("ip_competition_model");
		
	}

	function index()
	{
		redirect('admin/ip_competition/manage_ip_competition');
	}
	
	//Method to list quiz - Balkrishan
	function manage_ip_competition(){
			//$this->load->model('key_features_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_ip_competition';
		    $header['tab'] = 'ip_competition';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'ip_competition';
		    $sidebar['main_page'] = 'manage_ip_competition';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_ip_competition';

		   $data['competition_details'] = $this->ip_competition_model->listCompetition();
		   
		   
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/ip_competition/manage_ip_competition',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	//Method to add feature - Balkrishan
	function add_competition(){
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'ip_competition';
		    $header['tab'] = 'ip_competition';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'ip_competition';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('competition_title', 'Competiton Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/ip_competition/add_competition');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					// Icon image upload Start
						
						$icon_image = '';
						
						if($_FILES['icon_image']['name'] != ""){
							
							$new_icon_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('competition_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/ip_competition/icon'; 
							$config['file_name'] = $new_icon_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 100; 
							$config['max_width']     = 100; 
							$config['max_height']    = 100; 
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('icon_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Icon Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$icon_image = "/uploads/ip_competition/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
					
					// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('coverage_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/ip_competition'; 
							$config['file_name'] = $new_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 100; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460;
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image = "uploads/ip_competition/".$new_name;
							}
						
						}
						
					// image upload End
					
					if(count($error_arr) > 0){
					
					//echo '<pre>'; print_r($error_arr); die;
					if(isset($error_arr)){
					$data['file_error'] = $error_arr;
					
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/ip_competition/add_competition',$data);
						$this->load->view('admin/parts/footer',$footer);
					}
					//print_r($error_arr); die;
				} else {		
								
					
					$fileData = array(
						'name' => $this->input->post('competition_title'),
						'description' => $this->input->post('competition_content'),
						'icon_image' => $icon_image,
						'image' => $image,
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->ip_competition_model->add_competition_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Ip Competition successfully.');
					redirect('admin/ip_competition/manage_ip_competition');
				}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/ip_competition/add_competition');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add quiz - Balkrishan
	function edit_competition($id=null){
		
				
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get ip_competition data
			$data['competition_data'] = $this->ip_competition_model->getCompetitionByID($id);
			
		    $header['main_page'] = 'ip_competition';
		    $header['tab'] = 'edit_competition';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_competition';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('competition_title', 'Competition Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/ip_competition/edit_competition', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					
						// Icon image upload Start
						
						$icon_image = '';
						
						if($_FILES['icon_image']['name'] != ""){
							
							$new_icon_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('competition_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/ip_competition/icon'; 
							$config['file_name'] = $new_icon_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 100; 
							$config['max_width']     = 100; 
							$config['max_height']    = 100; 
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('icon_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Icon Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$icon_image = "/uploads/ip_competition/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
					// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('competition_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							//echo $new_name; die;
							$config['upload_path']   = './uploads/ip_competition'; 
							$config['file_name'] = $new_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 100; 
							$config['max_width']     = 620; 
							$config['max_height']    = 460; 
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$image = "uploads/ip_competition/".$new_name;
								//echo $image; die;
							}
						
						}
						
					// image upload End
					
					if(count($error_arr) > 0){
					
						//echo '<pre>'; print_r($error_arr); die;
						if(isset($error_arr)){
						$data['file_error'] = $error_arr;
						
							$this->load->view('admin/parts/header',$header);
							$this->load->view('admin/parts/sidebar_left',$sidebar);
							$this->load->view('admin/ip_competition/edit_competition',$data);
							$this->load->view('admin/parts/footer',$footer);
						}
						//print_r($error_arr); die;
					} else {		
							
					
						$fileData = array(
							'name' => $this->input->post('competition_title'),
							'description' => $this->input->post('competition_content'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
						if($icon_image)
						$fileData['icon_image'] = $icon_image;
					
						if($image)
						$fileData['image'] = $image;
					
						$insert_id = $this->ip_competition_model->updateCompetition($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Coverage successfully.');
						redirect('admin/ip_competition/manage_ip_competition');
				}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/ip_competition/edit_competition', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	

	function delete_competition($id=null){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> '0');
			
			$res = $this->ip_competition_model->deleteCompetition($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Competition successfully.');
				redirect('admin/ip_competition/manage_ip_competition');
			}
		} else {
			redirect('admin/ip_competition/manage_ip_competition');
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
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */