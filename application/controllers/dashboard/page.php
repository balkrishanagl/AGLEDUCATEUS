<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller
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
    	$this->load->model('page_model');
		$this->load->model('user_model');
	}
	function manage_page()
	{
		$this->load->model('page_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_page';
		    $header['tab'] = 'page';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'page';
		    $sidebar['main_page'] = 'manage_page';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_page';

		   $data['page_details'] = $this->page_model->get_page_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/page/manage_page',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_page()
	{
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_page';
		    $header['tab'] = 'page';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'page';
		    $sidebar['main_page'] = 'add_page';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_page';

		  
		$this->form_validation->set_rules('page_title', 'Page Title', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_space');
		$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required|xss_clean');
	
		$this->form_validation->set_rules('page_meta_title', 'Meta Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_keyword', 'Meta Keyword', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_description', 'Meta Description', 'strip_tags|trim|required|xss_clean');
        $this->form_validation->set_rules('status','Status', 'required');
		
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/page/add_page',$data);
		        $this->load->view('admin/parts/footer',$footer);
			}else {
				
					// Banner image upload Start
						
						$banner_image = '';
						
						if($_FILES['banner_image']['name'] !=""){
							
							$new_banner_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
							$config['upload_path']   = './uploads/pages/banner'; 
							$config['file_name'] = $new_banner_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('banner_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Banner Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$banner_image = "uploads/pages/banner/".$new_banner_name;
							}
						
						}
						
					// Banner image upload End
				
					// Page image upload Start
					$page_image = '';
						
						
						if($_FILES['page_image']['name'] !=""){
							
							$newname = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["page_image"]['name']));
							$config['upload_path']   = './uploads/pages/'; 
							$config['file_name'] = $newname;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 300; 
							$config['max_width']     = 620; 
							$config['max_height']    = 600;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('page_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Page Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$page_image = "uploads/pages/".$newname;
							}
						
						}
						// Page image upload End
						
					if(count($error_arr) > 0){
						
						
						
					if(isset($error_arr)){	
						$data['file_error'] = $error_arr;
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/page/add_page',$data);
						$this->load->view('admin/parts/footer',$footer);	
					}
					}else{
						
					$data_addpage = array(
								'page_title' => $this->input->post('page_title'),
								'page_content' => $this->input->post('page_content'),
								'banner_image' => $banner_image,
								'page_image' => $page_image,
								'page_meta_title' => $this->input->post('page_meta_title'),
								'page_meta_kaywords' => $this->input->post('page_meta_keyword'),
								'page_meta_description' => $this->input->post('page_meta_description'),
								'page_status' => $this->input->post('status'),
								);
				
				
					$pageslug = str_replace(" ","-",$this->input->post('page_title'));
					$pageslug = strtolower($pageslug);
					date_default_timezone_set('Asia/Kolkata');
					$data_addpage['page_slug'] =  $pageslug;
					$data_addpage['created'] = date('Y/m/d  h:m:s');
			
					$this->page_model->add_page_data($data_addpage);	
					 
				
					//after successful submission
						$this->session->set_flashdata('success', 'You have added a page successfully.');
						redirect('admin/page/manage_page/');
					
					}		
			}
			  }else {
				
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/page/add_page',$data);
					$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_page($id = Null)
	{
			if($id == NULL)
		{
			redirect('page/manage_page');
		}
	
			$path = '../assets/admin/js/ckfinder';
			$width = '500px';
			$this->editor($path, $width);
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->model('page_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_page';
		    $header['tab'] = 'page';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'page';
		    $sidebar['main_page'] = 'esit_page';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_page';

		  
		$this->form_validation->set_rules('page_title', 'Page Title', 'strip_tags|trim|required|xss_clean|callback_alpha_dash_space');
		$this->form_validation->set_rules('page_content', 'Page Content', 'trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_title', 'Meta Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_keyword', 'Meta Keyword', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('page_meta_description', 'Meta Description', 'strip_tags|trim|required|xss_clean');
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		//$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		  $data['page_data'] = $this->page_model->get_page_data_by_id($id);
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/page/edit_page',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
			// Banner image upload Start
						
						$banner_image = '';
						
						
						if($_FILES['banner_image']['name'] !=""){
							
							
							$new_banner_name = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["banner_image"]['name']));
							$config['upload_path']   = 'uploads/pages/banner'; 
							$config['file_name'] = $new_banner_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 500; 
							$config['max_width']     = 1650; 
							$config['max_height']    = 500;  
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('banner_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Banner Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$banner_image = "uploads/pages/banner/".$new_banner_name;
							}
						
						}
						
					// Banner image upload End
				
					// Page image upload Start
					$page_image = '';
						
						
						if($_FILES['page_image']['name'] !=""){
							
							$newname = strtolower(str_replace(" ","-",$this->input->post('page_title')))."_".time().'_'.strtolower(str_replace(" ","-",$_FILES["page_image"]['name']));
							$config['upload_path']   = 'uploads/pages/'; 
							$config['file_name'] = $newname;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 300; 
							$config['max_width']     = 620; 
							$config['max_height']    = 600; 
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('page_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Page Image)";
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$page_image = "uploads/pages/".$newname;
							}
						
						}
						// Page image upload End
						
	
							
							
				if(count($error_arr) > 0){
						
						
						
					if(isset($error_arr)){	
						$data['file_error'] = $error_arr;
						$this->load->view('admin/parts/header',$header);
						$this->load->view('admin/parts/sidebar_left',$sidebar);
						$this->load->view('admin/page/edit_page',$data);
						$this->load->view('admin/parts/footer',$footer);	
					}
					}else{	
						
					$data_update_page = array(
				     	'page_title' => $this->input->post('page_title'),
						'page_content' => $this->input->post('page_content'),
						'page_meta_title' => $this->input->post('page_meta_title'),
						'page_meta_kaywords' => $this->input->post('page_meta_keyword'),
						'page_meta_description' => $this->input->post('page_meta_description'),
						'page_status' => $this->input->post('status'),
					);
					
					if($this->input->post('map_url'))
						$data_update_page['map_url'] = $this->input->post('map_url');
					
					if($this->input->post('video_url')){
						$data_update_page['video_url'] = $this->input->post('video_url');
					}else{
						$data_update_page['video_url'] = "";
					}
					if($this->input->post('mission'))
						$data_update_page['mission'] = $this->input->post('mission');
					
					if($this->input->post('apply_stap1'))
						$data_update_page['apply_stap1'] = $this->input->post('apply_stap1');
					
					if($this->input->post('apply_stap2'))
						$data_update_page['apply_stap2'] = $this->input->post('apply_stap2');
					
					if($this->input->post('apply_stap3'))
						$data_update_page['apply_stap3'] = $this->input->post('apply_stap3');
					
					if($this->input->post('eligibility_criteria'))
						
						$eligibility_arr =  $this->input->post('eligibility_criteria');
						  $ec = array();
						  
						  for($i=0; $i<count($eligibility_arr); $i++){
							 if($this->input->post('eligibility_criteria')[$i] !=""){ 
								$ec[] = array($this->input->post('eligibility_criteria')[$i]);  
							 }
						  }
						  $ec_json = json_encode($ec,true);
						  
						  $data_update_page['eligibility_criteria'] = $ec_json;
					
					if($banner_image != ""){
						$data_update_page['banner_image'] = $banner_image;
					}
						
					
					if($page_image != ""){
						$data_update_page['page_image'] = $page_image;
					}
					
							
					$pageslug = str_replace(" ","-",$this->input->post('page_title'));
					$pageslug = strtolower($pageslug);
					date_default_timezone_set('Asia/Kolkata');
					$data_addpage['page_slug'] =  $pageslug;
					$data_addpage['updated'] = date('Y/m/d  h:m:s');
		
					$this->page_model->update_page_data($data_update_page,$id);	
					 $data['page_data'] = $this->page_model->get_page_data_by_id($id);
		
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a page successfully.');
				redirect('admin/page/manage_page/');
			
			}
			  }
		  } 
			  else {
				
			
			//echo "<pre>"; print_r($data['page_data']); die;	
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/page/edit_page',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_page($id=null,$status1)
	{
		 
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('page_status'=> $status1);
			
			$res = $this->page_model->delete_page_by_id($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have updated status successfully.');
				redirect('admin/page/manage_page');
			}
		} else {
			redirect('admin/page/manage_page');
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
		
			$this->form_validation->set_message('alpha_dash_space', 'The Page Name Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
  
	
}

