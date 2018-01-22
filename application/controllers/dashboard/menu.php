<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class menu extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data){
			
			if($session_data['admin_user_type_id']==2){
				redirect('admin/dashboard');
			}
			
			$this->load->helper('url');
			$this->load->helper('download');
			$this->load->model("user_model");
			$this->load->model("menu_model");
		}else{
			redirect('admin/login', 'refresh');
		}
		
	}

	function index()
	{
		redirect('admin/category/manage_category');
	}
	
	//Method to list quiz - Balkrishan
	function manage_menu(){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_menu';
		    $header['tab'] = 'menu';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'manage_menu';
		    $sidebar['main_page'] = 'manage_menu';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_menu';

		   $data['menu_details'] = $this->menu_model->listMenu();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/menu/manage_menu',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	
	function add_menu(){
		
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'manage_menu';
		    $header['tab'] = 'menu';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'add_menu';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			$data['menu'] = $this->menu_model->getAllActiveMenu();
			//echo '<pre>'; print_r($data['menu']); die;
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
				$this->form_validation->set_rules('link', 'Url', 'callback_valid_url');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/menu/add_menu',$data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					/* $categoryslug = str_replace(" ","-",$this->input->post('category_name'));
					$categoryslug = strtolower($categoryslug); */
					
					$fileData = array(
						'name' => $this->input->post('menu_name'),
						'link' => $this->input->post('link'),
						'created' => date('Y-m-d H:i:s'),
						'status' => $this->input->post('status'),
					);
					
					if($this->input->post('type') != ""){
						$fileData['type'] = $this->input->post('type'); 
					}
					
					if($this->input->post('footer_sections') != ""){
						$fileData['footer_section'] = $this->input->post('footer_sections'); 
					}
					
					if($this->input->post('parent_id') != ""){
						
						$fileData['parent_id'] = $this->input->post('parent_id'); 
					}
					
					$insert_id = $this->menu_model->add_menu_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added menu successfully.');
					redirect('admin/menu/manage_menu');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/menu/add_menu',$data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	function edit_menu($id=null){
		
				
				
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get menu data
			$data['menu_data'] = $this->menu_model->getMenuByID($id);
			
		    $header['main_page'] = 'manage_menu';
		    $header['tab'] = 'edit_menu';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_menu';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			$data['menu'] = $this->menu_model->getAllActiveMenu();
			//echo '<pre>'; print_r($data['menu']); die;
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
				$this->form_validation->set_rules('link', 'Url', 'callback_valid_url');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/menu/edit_menu', $data);
					$this->load->view('admin/parts/footer',$footer);
					
				} else {
					
									
						$fileData = array(
							'name' => $this->input->post('menu_name'),
							'link' => $this->input->post('link'),
							'created' => date('Y-m-d H:i:s'),
							'status' => $this->input->post('status'),
						);
						
					if($this->input->post('type') != ""){
						$fileData['type'] = $this->input->post('type'); 
					}
					
					if($this->input->post('footer_sections') != ""){
						$fileData['footer_section'] = $this->input->post('footer_sections'); 
					}
					
					if($this->input->post('type') == "header"){
						$fileData['footer_section'] = "";
					}
						
					if($this->input->post('parent_id') != ""){
						
						$fileData['parent_id'] = $this->input->post('parent_id'); 
					}
					
						$insert_id = $this->menu_model->updateMenu($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated menu successfully.');
						redirect('admin/menu/manage_menu');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/menu/edit_menu', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function delete_menu($id=null){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> '0');
			
			$res = $this->menu_model->deleteMenu($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted menu successfully.');
				redirect('admin/menu/manage_menu');
			}
		} else {
			redirect('admin/menu/manage_menu');
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
		
			$this->form_validation->set_message('alpha_dash_space', 'The Category Name Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	
	public function valid_url($str)
	{
		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */