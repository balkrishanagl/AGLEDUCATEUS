<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class course_coverage extends CI_Controller
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
		$this->load->model("course_coverage_model");
		
	}

	function index()
	{
		redirect('admin/key-feature/manage_key_feature');
	}
	
	//Method to list quiz - Balkrishan
	function manage_course_coverage(){
			//$this->load->model('key_features_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_course_coverage';
		    $header['tab'] = 'course_coverage';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'course_coverage';
		    $sidebar['main_page'] = 'manage_course_coverage';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_course_coverage';

		   $data['course_coverage_details'] = $this->course_coverage_model->listCourseCoverage();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/course_coverage/manage_course_coverage',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	//Method to add feature - Balkrishan
	function add_coverage(){
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'course_coverage';
		    $header['tab'] = 'course_coverage';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'course_coverage';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('coverage_title', 'Coverage Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/course_coverage/add_coverage');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					// Icon image upload Start
						
						$icon_image = '';
						
						if($_FILES['icon_image']['name'] != ""){
							
							$new_icon_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('coverage_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/course_coverage/icon'; 
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
								$icon_image = "/uploads/course_coverage/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
					
					// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name'] != ""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('coverage_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							$config['upload_path']   = './uploads/course_coverage'; 
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
								$image = "uploads/course_coverage/".$new_name;
							}
						
						}
						
					// image upload End
					if(count($error_arr) > 0){
					
						
					if(isset($error_arr)){
							
						
						$data['file_error'] = $error_arr;
					
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/course_coverage/add_coverage',$data);
						$this->load->view('admin/parts/footer',$footer);
					}
					//print_r($error_arr); die;
				} else {	
					
					$fileData = array(
						'name' => $this->input->post('coverage_title'),
						'description' => $this->input->post('coverage_content'),
						'icon_image' => $icon_image,
						'image' => $image,
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->course_coverage_model->add_coverage_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Coverage successfully.');
					redirect('admin/course_coverage/manage_course_coverage');
				}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/course_coverage/add_coverage');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	//Method to add quiz - Balkrishan
	function edit_coverage($id=null){
		
				
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get coverage data
			$data['coverage_data'] = $this->course_coverage_model->getCourseCoverageByID($id);
			
		    $header['main_page'] = 'coverage';
		    $header['tab'] = 'edit_coverage';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_coverage';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('coverage_title', 'Coverage Name', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/course_coverage/edit_coverage', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					
						// Icon image upload Start
						
						$icon_image = '';
						
						if($_FILES['icon_image']['name']!=""){
							
							$new_icon_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('coverage_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
							$config['upload_path']   = './uploads/course_coverage/icon'; 
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
								$icon_image = "/uploads/course_coverage/icon/".$new_icon_name;
							}
						
						}
						
					// Icon image upload End
					
					// image upload Start
						
						$image = '';
						
						if($_FILES['image']['name']!=""){
							
							$new_name = strtolower(str_replace(" ","-",preg_replace('/[^A-Za-z0-9\-]/', '',$this->input->post('coverage_title'))))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image"]['name']));
							//echo $new_name; die;
							$config['upload_path']   = './uploads/course_coverage'; 
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
								$image = "uploads/course_coverage/".$new_name;
								//echo $image; die;
							}
						
						}
						
					// image upload End
					
					if(count($error_arr) > 0){
					
						
					if(isset($error_arr)){
							
						
						$data['file_error'] = $error_arr;
					
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/course_coverage/add_coverage',$data);
						$this->load->view('admin/parts/footer',$footer);
					}
					//print_r($error_arr); die;
				} else {	
					
						$fileData = array(
							'name' => $this->input->post('coverage_title'),
							'description' => $this->input->post('coverage_content'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
						if($icon_image)
						$fileData['icon_image'] = $icon_image;
					
						if($image)
						$fileData['image'] = $image;
					
						$insert_id = $this->course_coverage_model->updateCoverage($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Coverage successfully.');
						redirect('admin/course_coverage/manage_course_coverage');
				}
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/course_coverage/edit_coverage', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	

	function delete_course_coverage($id=null){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> '0');
			
			$res = $this->course_coverage_model->deleteCoverage($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted Coverage successfully.');
				redirect('admin/course_coverage/manage_course_coverage');
			}
		} else {
			redirect('admin/course_coverage/manage_course_coverage');
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