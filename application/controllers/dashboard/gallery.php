<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class gallery extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==''){
			redirect('admin/login');
		}
		
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model("user_model");
		$this->load->model("gallery_model");
		$this->load->model('city_model');
		
	}

	function index()
	{
		redirect('admin/gallery/manage_gallery');
	}
	
	
	function manage_gallery(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'gallery';
		    $header['tab'] = 'manage_gallery';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'gallery';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['galleryList'] = $this->gallery_model->list_gallery();
			
			//echo "<pre>"; print_r($data['study_material_list']); die;
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/gallery/gallery_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}

	
	
	//Method to add study_material - Manoj Sharma
	function add_gallery(){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'gallery';
		    $header['tab'] = 'add_gallery';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'gallery';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			$session = '';
			
			$data['city_detail'] =  $this->city_model->getAllActiveCityList();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
								
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					//echo "Test"; die;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/gallery/add_gallery',$data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					$galleryFile='';
										
					//validation for images
					
					
					if($_FILES["file"]['name']!=''){
						$gallery = time()."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/gallery/'; 
						$config['file_name'] = $gallery;
						$config['allowed_types'] = 'jpg|JPEG|png|gif';
						$config['max_size']      = 500; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
							
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$galleryFile = $data_file['upload_data']['file_name'];
							
						}
					}
					
					
					$videoImageFile='';
										
					//validation for images
					
					
					if($_FILES["video_image"]['name']!=''){
						
						$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('name'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["video_image"]['name']));
						//echo $new_name; die;
						$config['upload_path']   = './uploads/gallery/video/'; 
						$config['file_name'] = $new_name;
						$config['allowed_types'] = 'jpg|JPEG|png|gif';
						$config['max_size']      = 500; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('video_image')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$videoImageFile = "uploads/gallery/video/".$new_name;
							
						}
					}
				
				if(isset($error_arr) and count($error_arr)>0){
					$data['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/gallery/add_gallery', $data);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					
					$fileData = array(
						'name' => $this->input->post('name'),
						'type' => $this->input->post('type'),
						'city' => $this->input->post('city'),
						'city_type' => $this->input->post('city_type'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					if(isset($galleryFile))
					{
						$fileData['images'] = $galleryFile;
					}
					if(isset($videoImageFile))
					{
						$fileData['video_image'] = $videoImageFile;
					}
					
					if($this->input->post('video'))
					{
						$fileData['video'] = $this->input->post('video');
					}
					


					$insert_id = $this->gallery_model->add_gallery($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Gallery successfully.');
					redirect('admin/gallery/manage_gallery');
			} 
			}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/gallery/add_gallery', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function edit_gallery($id=null){
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			$data['city_detail'] =  $this->city_model->getAllActiveCityList();
			//get study_material data
			$data['galleryData'] = $this->gallery_model->get_gallery_ByID($id);
			
		    $header['main_page'] = 'excellence';
		    $header['tab'] = 'add_excellence';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'excellence';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('name', 'name', 'trim|required');
							
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/gallery/edit_gallery', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					if($_FILES["file"]['name']!=''){
						$gallery = time()."_".strtolower(str_replace(" ","-",$_FILES["file"]['name']));
						$config['upload_path']   = './uploads/gallery/'; 
						$config['file_name'] = $gallery;
						$config['allowed_types'] = 'jpg|JPEG|png|gif';
						$config['max_size']      = 500; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('file')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$galleryFile = $data_file['upload_data']['file_name'];
							
						}
					}
					
					$videoImageFile='';
										
					//validation for images
					
					
					$videoImageFile='';
										
					//validation for images
					
					
					if($_FILES["video_image"]['name']!=''){
						
						$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('name'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["video_image"]['name']));
						//echo $new_name; die;
						$config['upload_path']   = './uploads/gallery/video/'; 
						$config['file_name'] = $new_name;
						$config['allowed_types'] = 'jpg|JPEG|png|gif';
						$config['max_size']      = 500; 
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('video_image')) {
							$error = array('error' => $this->upload->display_errors());
							$error_arr[] = $error['error'];
						} else { 
							$data_file = array('upload_data' => $this->upload->data());
							$videoImageFile = "uploads/gallery/video/".$new_name;
							
						}
					}
					
				}
				if(isset($error_arr) and count($error_arr)>0){
					$data['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/gallery/edit_gallery', $data);
					$this->load->view('admin/parts/footer',$footer);
					//print_r($error_arr); die;
				} else {
					

						$fileData = array(
						'name' => $this->input->post('name'),
						'city' => $this->input->post('city'),
						'city_type' => $this->input->post('city_type'),
						'created' => date('Y-m-d H:i:s'),
						);
						
						if(isset($galleryFile))
						{
							$fileData['images'] = $galleryFile;
						}
						
						if(isset($videoImageFile))
						{
							$fileData['video_image'] = $videoImageFile;
						}
						
						if($this->input->post('video'))
						{
							$fileData['video'] = $this->input->post('video');
						}
						


						$update_id = $this->gallery_model->update_gallery($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated gallery successfully.');
						redirect('admin/gallery/manage_gallery');
					
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/gallery/edit_gallery', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	//Method to delete study_material - Balkrishan
	function delete_gallery($id=null){
		if($id!=null){
			$delete = $this->gallery_model->delete_gallery($id);
			if($id==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deleted Gallery successfully.');
				redirect('admin/gallery/manage_gallery');
			}
		}
	}
	function update_status($id=null,$status){
		if($id!=null){
			$delete = $this->gallery_model->updateStatus($id,$status);
				//after successful submission
				$this->session->set_flashdata('success', 'You have status change successfully.');
				redirect('admin/gallery/manage_gallery');
			
		}
	}
	
	function getCityByType($type){
		
		if(isset($_POST['city'])){
			$selectedCity = $_POST['city'];
		}
		
		
		$cityDetail = $this->city_model->get_city_data_by_type($type);
		
		foreach($cityDetail as $city){
			
		if(isset($selectedCity)){	
			if($selectedCity == $city->id){
				echo '<option value="'.$city->id.'" selected>'.$city->city_name.'</option>';
			}else{
				echo '<option value="'.$city->id.'">'.$city->city_name.'</option>';
			}
		}else{
			
			echo '<option value="'.$city->id.'">'.$city->city_name.'</option>';
		}
		}
		
		
		
	}
	
	function alpha_dash_space($str) {

		if( ! preg_match("/^([-a-z_ \"#$%&'()*+!,\-.\\:\/;=?@^_])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'The Name Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */