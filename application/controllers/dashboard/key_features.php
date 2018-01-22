<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class key_features extends CI_Controller
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
		$this->load->model("key_features_model");
		
	}

	function index()
	{
		redirect('admin/key-feature/manage_key_feature');
	}
	
	//Method to list quiz - Balkrishan
	function manage_key_feature(){
			//$this->load->model('key_features_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_key_feature';
		    $header['tab'] = 'key_feature';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'key_feature';
		    $sidebar['main_page'] = 'manage_key_feature';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_key_feature';

		   $data['key_feature_details'] = $this->key_features_model->listKeyFeature();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/key_feature/manage_key_feature',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	//Method to add feature - Balkrishan
	function add_feature(){
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'key_feature';
		    $header['tab'] = 'key_feature';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'key_feature';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('feature_title', 'Feature Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/key_feature/add_feature');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					// Icon image upload Start
						
						$icon_image = '';
						
						if(isset($_FILES['icon_image'])){
							
							$new_icon_name = strtolower(str_replace(" ","-",$this->input->post('feature_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/key_features/icon'; 
							$config['file_name'] = $new_icon_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 1024; 
							$config['max_width']     = 0; 
							$config['max_height']    = 0;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('icon_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Icon Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$icon_image = "/uploads/key_features/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
					
					$fileData = array(
						'name' => $this->input->post('feature_title'),
						'description' => $this->input->post('feature_title'),
						'icon_image' => $icon_image,
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->key_features_model->add_features_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Features successfully.');
					redirect('admin/key-feature/manage_key_feature');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/key_feature/add_feature');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add quiz - Balkrishan
	function edit_feature($id=null){
		
				
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get feature data
			$data['feature_data'] = $this->key_features_model->getFeatureByID($id);
			
		    $header['main_page'] = 'feature';
		    $header['tab'] = 'edit_feature';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_feature';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('feature_title', 'Feature Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/key_feature/edit_feature', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					
						// Icon image upload Start
						
						$icon_image = '';
						
						if(isset($_FILES['icon_image'])){
							
							$new_icon_name = strtolower(str_replace(" ","-",$this->input->post('feature_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/key_features/icon'; 
							$config['file_name'] = $new_icon_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 1024; 
							$config['max_width']     = 0; 
							$config['max_height']    = 0;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('icon_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Icon Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$icon_image = "/uploads/key_features/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
						$fileData = array(
							'name' => $this->input->post('feature_title'),
							'description' => $this->input->post('feature_content'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
						if($icon_image)
						$fileData['icon_image'] = $icon_image;
					
						$insert_id = $this->key_features_model->updateFeature($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated feature successfully.');
						redirect('admin/key-feature/manage_key_feature');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/key_feature/edit_feature', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	

	function delete_key_feature($id=null){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> '0');
			
			$res = $this->key_features_model->deleteFeature($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Feature successfully.');
				redirect('admin/key-feature/manage_key_feature');
			}
		} else {
			redirect('admin/key-feature/manage_key_feature');
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