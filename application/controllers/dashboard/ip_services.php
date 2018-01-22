<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ip_services extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2 or $session_data['admin_user_type_id']==3){
			redirect('admin/dashboard');
		}
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('ip_services_model');
		$this->load->model('user_model');
	}
	function manage_ip_services()
	{
		$this->load->model('ip_services_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_ip_services';
		    $header['tab'] = 'ip_services';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'ip_services';
		    $sidebar['main_page'] = 'manage_ip_services';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_ip_services';

		   $data['page_details'] = $this->ip_services_model->get_ip_services_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/ip_services/manage_ip_services',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_ip_services()
	{
	 $path = '../assets/admin/js/ckfinder';
    $width = '500px';
    $this->editor($path, $width);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_ip_services';
		    $header['tab'] = 'ip_services';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'ip_services';
		    $sidebar['main_page'] = 'add_ip_services';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_ip_services';

		  
		$this->form_validation->set_rules('page_title', 'Page Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('extra_content', 'Extra Content', 'trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_title', 'Meta Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_keyword', 'Meta Keyword', '');
		$this->form_validation->set_rules('page_meta_description', 'Meta Description', '');
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
		        $this->load->view('admin/ip_services/add_ip_services',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				$banner_image = '';
				
				if(isset($_FILES['banner_image'])){
					
					$new_banner_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
					
					$config['upload_path']   = './uploads/ip_services/banner'; 
					$config['file_name'] = $new_banner_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 1024; 
					$config['max_width']     = 0; 
					$config['max_height']    = 0;  
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('banner_image')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(User Image)";
					} else { 
						$data_user = array('upload_data' => $this->upload->data());
						$banner_image = "uploads/ip_services/banner/".$new_banner_name;
					}
				}
				
				$icon_image = '';
				
				if(isset($_FILES['icon_image'])){
					$new_icon_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
					$config1['upload_path']   = './uploads/ip_services/icon'; 
					$config1['file_name'] = $new_icon_name;
					$config1['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config1['max_size']      = 1024; 
					$config1['max_width']     = 0; 
					$config1['max_height']    = 0;  
					$this->load->library('upload', $config1);
					$this->upload->initialize($config1);
					if ( ! $this->upload->do_upload('icon_image')) {
						$error1 = array('error' => $this->upload->display_errors());
						$error_arr1[] = $error1['error']."(Icon Image)";
					} else { 
						$data_user1 = array('upload_data' => $this->upload->data());
						$icon_image = "uploads/ip_services/icon/".$new_icon_name;
					}
				}
				
				$image_1 = '';
				
				if(isset($_FILES['image_1'])){
					$new_image1_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image_1"]['name']));
					$config2['upload_path']   = './uploads/ip_services'; 
					$config2['file_name'] = $new_image1_name;
					$config2['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config2['max_size']      = 1024; 
					$config2['max_width']     = 0; 
					$config2['max_height']    = 0;  
					$this->load->library('upload', $config2);
					$this->upload->initialize($config2);
					if ( ! $this->upload->do_upload('image_1')) {
						$error2 = array('error' => $this->upload->display_errors());
						$error_arr2[] = $error2['error']."(Image Image)";
					} else { 
						$data_user2 = array('upload_data' => $this->upload->data());
						$image_1 = "uploads/ip_services/".$new_image1_name;
					}
				}
				
				$image_2 = '';
				
				if(isset($_FILES['image_2'])){
					$new_image2_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image_2"]['name']));
					$config3['upload_path']   = './uploads/ip_services'; 
					$config3['file_name'] = $new_image2_name;
					$config3['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config3['max_size']      = 1024; 
					$config3['max_width']     = 0; 
					$config3['max_height']    = 0;  
					$this->load->library('upload', $config3);
					$this->upload->initialize($config3);
					if ( ! $this->upload->do_upload('image_2')) {
						$error3 = array('error' => $this->upload->display_errors());
						$error_arr3[] = $error3['error']."(Image Image)";
					} else { 
						$data_user3 = array('upload_data' => $this->upload->data());
						$image_2 = "uploads/ip_services/".$new_image2_name;
					}
				}
				
			$allImages = [];
			
			$allImages = array('icon_image'=>$icon_image, 'banner_image'=>$banner_image, 'image_1'=>$image_1, 'image_2'=>$image_2);
			$allImages = json_encode($allImages, true);
			
			$data_addpage = array(
				     	'page_title' => $this->input->post('page_title'),
						'page_content' => $this->input->post('page_content'),
						'extra_content' => $this->input->post('extra_content'),
						'page_meta_title' => $this->input->post('page_meta_title'),
						'page_meta_kaywords' => $this->input->post('page_meta_keyword'),
						'page_meta_description' => $this->input->post('page_meta_description'),
						'images' => $allImages,
						'page_status' => $this->input->post('status'),
							);
		
		
		    $pageslug = str_replace(" ","-",$this->input->post('page_title'));
			$pageslug = strtolower($pageslug);
			date_default_timezone_set('Asia/Kolkata');
			$data_addpage['page_slug'] =  $pageslug;
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->ip_services_model->add_ip_services_data($data_addpage);	
			 
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have added a ip services successfully.');
				redirect('admin/ip_services/manage_ip_services/');
			
			}
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/ip_services/add_ip_services',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_ip_services($id = Null)
	{
			if($id == NULL)
		{
			redirect('page/manage_ip_services');
		}
	
		 $path = '../assets/admin/js/ckfinder';
         $width = '500px';
         $this->editor($path, $width);
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 $this->load->model('ip_services_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_ip_services';
		    $header['tab'] = 'ip_services';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'ip_services';
		    $sidebar['main_page'] = 'esit_ip_services';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_ip_services';

		  
		$this->form_validation->set_rules('page_title', 'Page Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('extra_content', 'Extra Content', 'trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_title', 'Meta Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_keyword', 'Meta Keyword', '');
		$this->form_validation->set_rules('page_meta_description', 'Meta Description', '');
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				
				$data['page_data'] = $this->ip_services_model->get_ip_services_data_by_id($id);				
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/ip_services/edit_ip_services',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			$banner_image = '';
				
				if(isset($_FILES['banner_image'])){
					
					
					
					$new_banner_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
					
					$config['upload_path']   = './uploads/ip_services/banner'; 
					$config['file_name'] = $new_banner_name;
					$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config['max_size']      = 1024; 
					$config['max_width']     = 0; 
					$config['max_height']    = 0;  
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('banner_image')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(User Image)";
					} else { 
						$data_user = array('upload_data' => $this->upload->data());
						$banner_image = "uploads/ip_services/banner/".$new_banner_name;
					}
				}
				
				$icon_image = '';
				
				if(isset($_FILES['icon_image'])){
					$new_icon_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["icon_image"]['name']));
					$config1['upload_path']   = './uploads/ip_services/icon'; 
					$config1['file_name'] = $new_icon_name;
					$config1['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config1['max_size']      = 1024; 
					$config1['max_width']     = 0; 
					$config1['max_height']    = 0;  
					$this->load->library('upload', $config1);
					$this->upload->initialize($config1);
					if ( ! $this->upload->do_upload('icon_image')) {
						$error1 = array('error' => $this->upload->display_errors());
						$error_arr1[] = $error1['error']."(Icon Image)";
					} else { 
						$data_user1 = array('upload_data' => $this->upload->data());
						$icon_image = "uploads/ip_services/icon/".$new_icon_name;
					}
				}
				
				$image_1 = '';
				
				if(isset($_FILES['image_1'])){
					$new_image1_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image_1"]['name']));
					$config2['upload_path']   = './uploads/ip_services'; 
					$config2['file_name'] = $new_image1_name;
					$config2['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config2['max_size']      = 1024; 
					$config2['max_width']     = 0; 
					$config2['max_height']    = 0;  
					$this->load->library('upload', $config2);
					$this->upload->initialize($config2);
					if ( ! $this->upload->do_upload('image_1')) {
						$error2 = array('error' => $this->upload->display_errors());
						$error_arr2[] = $error2['error']."(Image Image)";
					} else { 
						$data_user2 = array('upload_data' => $this->upload->data());
						$image_1 = "uploads/ip_services/".$new_image1_name;
					}
				}
				
				$image_2 = '';
				
				if(isset($_FILES['image_2'])){
					$new_image2_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["image_2"]['name']));
					$config3['upload_path']   = './uploads/ip_services'; 
					$config3['file_name'] = $new_image2_name;
					$config3['allowed_types'] = 'gif|jpg|png|jpeg'; 
					$config3['max_size']      = 1024; 
					$config3['max_width']     = 0; 
					$config3['max_height']    = 0;  
					$this->load->library('upload', $config3);
					$this->upload->initialize($config3);
					if ( ! $this->upload->do_upload('image_2')) {
						$error3 = array('error' => $this->upload->display_errors());
						$error_arr3[] = $error3['error']."(Image Image)";
					} else { 
						$data_user3 = array('upload_data' => $this->upload->data());
						$image_2 = "uploads/ip_services/".$new_image2_name;
					}
				}
				
					$allImages_json = "";
					
					$allImages_json = $this->input->post('image_json_data');
					$allImages_arr = json_decode($allImages_json, true);
			
			
			        $data_update_page = array(
				     	'page_title' => $this->input->post('page_title'),
						'page_content' => $this->input->post('page_content'),
						'extra_content' => $this->input->post('extra_content'),
						'page_meta_title' => $this->input->post('page_meta_title'),
						'page_meta_kaywords' => $this->input->post('page_meta_keyword'),
						'page_meta_description' => $this->input->post('page_meta_description'),
						'page_status' => $this->input->post('status'),
						);
						
						
						if($banner_image)
							$allImages_arr['banner_image'] = $banner_image;
						if($icon_image)
							$allImages_arr['icon_image'] = $icon_image;
						if($image_1)
							$allImages_arr['image_1'] = $image_1;
						if($image_2)
							$allImages_arr['image_2'] = $image_2;
						
			$allImages_arr = json_encode($allImages_arr, true);
			
		    $pageslug = str_replace(" ","-",$this->input->post('page_title'));
			$pageslug = strtolower($pageslug);
			
			date_default_timezone_set('Asia/Kolkata');
			$data_update_page['page_slug'] =  $pageslug;
		    $data_update_page['updated'] = date('Y/m/d  h:m:s');
			$data_update_page['images'] =  $allImages_arr;

			$this->ip_services_model->update_ip_services_data($data_update_page,$id);	
			 $data['page_data'] = $this->ip_services_model->get_ip_services_data_by_id($id);
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a ip services successfully.');
				redirect('admin/ip_services/manage_ip_services/');
			
			}
			  }
			  
			  else {
				
				$data['page_data'] = $this->ip_services_model->get_ip_services_data_by_id($id);
				//echo "<pre>"; print_r($data['page_data']); die;	
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/ip_services/edit_ip_services',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			
			  }
		//echo '<pre>'; print_r($data); die;
	}
	
	function delete_ip_services($id=null)
	{
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('page_status'=> '0');
			$res = $this->ip_services_model->delete_ip_services_by_id($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted ip services successfully.');
				redirect('admin/ip_services/manage_ip_services');
			}
		} else {
			redirect('admin/ip_services/manage_ip_services');
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

