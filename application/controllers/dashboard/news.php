<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
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
    	$this->load->model('news_model');
		$this->load->model('user_model');
	}
	function manage_news()
	{
		
		$this->load->model('news_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_news';
		    $header['tab'] = 'news';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'news';
		    $sidebar['main_page'] = 'manage_news';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_news';

		   $data['news_details'] = $this->news_model->get_news_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/news/manage_news',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_news()
	{
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_news';
		    $header['tab'] = 'news';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'news';
		    $sidebar['main_page'] = 'add_news';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_news';

		  
		$this->form_validation->set_rules('news_title', 'News Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('content', 'Detail', 'strip_tags|trim|required|xss_clean');
	
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
		        $this->load->view('admin/news/add_news',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			
			$news_image = '';
						
						if(isset($_FILES['main_image'])){
							
							$new_main_image_name = strtolower(str_replace(" ","-",$this->clean($this->input->post('news_title'))))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							$config['upload_path']   = './uploads/news'; 
							$config['file_name'] = $new_main_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 900; 
							$config['max_height']    = 500;   
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
								
							
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$news_image = "/uploads/news/".$new_main_image_name;
							}
						
						}
			
			if(isset($error_arr) and count($error_arr)>0){  
				$data['file_error'] = $error_arr;
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/news/add_news',$data);
				$this->load->view('admin/parts/footer',$footer);	
				
			}else{
				$data_addpage = array(
				     	'news_title' => $this->input->post('news_title'),
						'content' => $this->input->post('content'),
						'main_image' => $news_image,
						'status' => $this->input->post('status'),
							);
		
		
		   
			date_default_timezone_set('Asia/Kolkata');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
			
			$slug = $this->common_model->unique_slug($this->input->post('news_title'),'edu_news');
			$data_addpage['slug'] = $slug;
			
			$this->news_model->add_news_data($data_addpage);	
			 
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added news successfully.');
				redirect('admin/news/manage_news/');
			  }
			  }
		  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/news/add_news',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_news($id = Null)
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
		$this->load->model('news_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_news';
		    $header['tab'] = 'news';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'news';
		    $sidebar['main_page'] = 'edit_news';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_news';

		  
  
		$this->form_validation->set_rules('news_title', 'News Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('content', 'Detail', 'strip_tags|trim|required|xss_clean');
		
        $this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error" style="color:red;">', '</div>');
		 
		$data['news_data'] = $newsData = $this->news_model->get_news_data_by_id($id);
		
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/news/edit_news',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {

		   $news_image = '';
						
						if($_FILES['main_image']!= null && $_FILES['main_image']['name']!=""){
							
							$new_main_image_name = strtolower(str_replace(" ","-",$this->clean($this->input->post('news_title'))))."_".time()."_".strtolower(str_replace(" ","-",$_FILES["main_image"]['name']));
							
							$config['upload_path']   = './uploads/news'; 
							$config['file_name'] = $new_main_image_name;
							$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
							$config['max_size']      = 200; 
							$config['max_width']     = 900; 
							$config['max_height']    = 500;    
							
							
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('main_image')) {
								
								$error = array('error' => $this->upload->display_errors());
								$error_arr[] = $error['error']."(Main Image)";
								
							} else { 
							
								$data_user = array('upload_data' => $this->upload->data());
								$news_image = "uploads/news/".$new_main_image_name;
							}
						
						}else{
								if($this->input->post('exist_main_image')!=""){
									
									$news_image = $this->input->post('exist_main_image');
								}else{
									
									$news_image="";
								}
							  
						}
		
			if(isset($error_arr) and count($error_arr)>0){
				
			$data['file_error'] = $error_arr;
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/news/edit_news',$data);
			$this->load->view('admin/parts/footer',$footer);	
			} 
			else {
			        $data_update_news = array(
				     'news_title' => $this->input->post('news_title'),
					 'content' => $this->input->post('content'),
					 'main_image' => $news_image,
					 'status' => $this->input->post('status'),
					);
				
		
			if($this->input->post('news_title')!=$newsData->news_title)
				{
					//echo "aaa"; die;
					$slug = $this->common_model->unique_slug($this->input->post('news_title'),'edu_news');
					//echo $slug; die;
					$data_update_news['slug'] =  $slug;
				}
				
			date_default_timezone_set('Asia/Kolkata');
			
		    $data_update_news['updated'] = date('Y/m/d  h:m:s');
	
			$this->news_model->update_news_data($data_update_news,$id);	
			 $data['news_data'] = $this->news_model->get_news_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a news successfully.');
				redirect('admin/news/manage_news/');
			
			}
			  }
			  }
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/news/edit_news',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_news($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=>'0');
			$res = $this->news_model->delete_news_by_id($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted News successfully.');
				redirect('admin/news/manage_news');
			}
		} else {
			redirect('admin/news/manage_news');
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
  
  function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
	
	  
	
}

