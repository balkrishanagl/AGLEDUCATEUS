<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Registration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		$this->load->helper('url');
		$this->load->model("user_model");
		$this->load->model("register_model");
		//$this->load->model("student_model");
	}
	
	function index()
	{
		redirect('admin/registration/city_exhibition_register_list');
	}
	
	function city_exhibition_register_list(){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'registeration';
		    $header['tab'] = 'city_exhibition_register_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['city_exhibition_register_list'] = $this->register_model->listcityExhibitionRegister();
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/city_exhibition_register_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function view_city_exhibition_register($id){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$header['main_page'] = 'registeration';
		    $header['tab'] = 'city_exhibition_register_list';
			$sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
			$footer['main_page'] = 'dashboard';
			
			
			$data['city_exhibition_register_list'] = $this->register_model->getcityExhibitionRegisterByID($id);
		
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/city_exhibition_register_view', $data);
			$this->load->view('admin/parts/footer',$footer);
		
	}

	function exportcity_exhibition_register(){
		
		   $data = $this->register_model->exportCityExhibitionRegisterData();
		 
		   $this->load->dbutil();
		   $this->load->helper('file');
		   $this->load->helper('download');
		   $delimiter = ",";
		   $newline = "\r\n";
		   $filename = "city_exhibition_registration.csv";
		   $dataFile = $this->dbutil->csv_from_result($data, $delimiter, $newline);
		   force_download($filename, $dataFile);
		   redirect('admin/register/city_exhibition_register_list');
	}
	
	
	
	function online_register_list(){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'registeration';
		    $header['tab'] = 'online_register_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['online_register_list'] = $this->register_model->listOnlineRegister();
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/online_register_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function view_online_register($id){
			
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$header['main_page'] = 'registeration';
		    $header['tab'] = 'online_register_list';
			$sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
			$footer['main_page'] = 'dashboard';
			
			
			$data['online_register_list'] = $this->register_model->getOnlineRegisterByID($id);
			
			
		
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/online_register_view', $data);
			$this->load->view('admin/parts/footer',$footer);
		
	}

	function exportonline_register(){
		
		   $data = $this->register_model->exportonline_register();
		 
		   $this->load->dbutil();
		   $this->load->helper('file');
		   $this->load->helper('download');
		   $delimiter = ",";
		   $newline = "\r\n";
		   $filename = "online_registration.csv";
		   $dataFile = $this->dbutil->csv_from_result($data, $delimiter, $newline);
		   force_download($filename, $dataFile);
		   redirect('admin/register/online_register_list');
	}
	
	
	
	function exhibitior_register_list(){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'registeration';
		    $header['tab'] = 'exhibitior_register_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['exhibitior_register_list'] = $this->register_model->listExhibitorRegister();
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/exhibitior_register_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function view_exhibitor_register($id){
			
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$header['main_page'] = 'registeration';
		    $header['tab'] = 'exhibitior_register_list';
			$sidebar['page'] = 'registeration';
		    $sidebar['username'] =  $data['username'];
			$footer['main_page'] = 'dashboard';
			
			
			$data['exhibitior_register_list'] = $this->register_model->getExhibitorRegisterByID($id);
			
			
		
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/register/exhibitor_register_view', $data);
			$this->load->view('admin/parts/footer',$footer);
		
	}

	function exportexhibitor_register(){
		
		   $data = $this->register_model->exportexhibitor_register();
		 
		   $this->load->dbutil();
		   $this->load->helper('file');
		   $this->load->helper('download');
		   $delimiter = ",";
		   $newline = "\r\n";
		   $filename = "exhibitor_registration.csv";
		   $dataFile = $this->dbutil->csv_from_result($data, $delimiter, $newline);
		   force_download($filename, $dataFile);
		   redirect('admin/register/exhibitior_register_list');
	}
	
	
}
?>