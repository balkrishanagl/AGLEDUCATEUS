<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class faq extends CI_Controller
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
		$this->load->model("faq_model");
		//$this->load->model("category_model");
		
	}

	function index()
	{
		redirect('admin/faq/manage_faq');
	}
	
	//Method to list quiz - Balkrishan
	function manage_faq(){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_faq';
		    $header['tab'] = 'faq';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'faq';
		    $sidebar['main_page'] = 'manage_faq';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_faq';

		   $data['faq_details'] = $this->faq_model->listFaq();
		   
		   //echo '<pre>'; print_r($data['faq_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/faq/manage_faq',$data);
			$this->load->view('admin/parts/footer',$footer);    	
	}
	
	
	function add_faq(){
		
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'faq';
		    $header['tab'] = 'faq';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'faq';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			
			//$category['category_detail'] =  $this->category_model->getAllActiveCategory();
			
						
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('faq_title', 'Faq Title', 'required');
				$this->form_validation->set_rules('order_no', 'Order Number', 'required|is_unique[edu_faq.order_no]');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/faq/add_faq');
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
					$faqslug = str_replace(" ","-",$this->input->post('faq_title'));
					$faqslug = strtolower($faqslug);
					
					$fileData = array(
						'title' => $this->input->post('faq_title'),
						'description' => $this->input->post('description'),
						'order_no' => $this->input->post('order_no'),
						//'category_id' => $this->input->post('category'),
						'created' => date('Y-m-d H:i:s'),
					);
					
					$insert_id = $this->faq_model->add_faq_data($fileData);
					
					//after successful submission
					$this->session->set_flashdata('success', 'You have added Faq successfully.');
					redirect('admin/faq/manage_faq');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/faq/add_faq');
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	
	function edit_faq($id=null){
		
				
		$path = '../assets/admin/js/ckfinder';
		$width = '500px';
		$this->editor($path, $width);
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			
			//get Faq data
			$data['faq_data'] = $this->faq_model->getFaqByID($id);
			
		    $header['main_page'] = 'faq';
		    $header['tab'] = 'edit_faq';
		    $header['username'] =  $data['username'];
		    $sidebar['page'] = 'edit_faq';
		    $sidebar['username'] =  $data['username'];
		    $footer['main_page'] = 'dashboard';
			//$data['category_detail'] =  $this->category_model->getAllActiveCategory();
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//load required helper, library
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
				
				//check validation for post data
				$this->form_validation->set_rules('faq_title', 'Faq title', 'required');
				$orderNo = $this->input->post('order_no');
				
				$faqOrderNo = $this->faq_model->getorderIDByFaqId($id,$orderNo);
				
				
				if(sizeof($faqOrderNo)>0)
				$this->form_validation->set_rules('order_no', 'Order Number', 'required|is_unique[edu_faq.order_no]');
				else
					$this->form_validation->set_rules('order_no', 'Order Number', 'required');
				
				//create error array
				$error_arr = array();
				
				// Displaying Errors In Div
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				
				if ($this->form_validation->run() == FALSE){
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/faq/edit_faq', $data);
					$this->load->view('admin/parts/footer',$footer);
				} else {
					
									
						$fileData = array(
							'title' => $this->input->post('faq_title'),
							'description' => $this->input->post('description'),
							'order_no' => $this->input->post('order_no'),
							//'category_id' => $this->input->post('category'),
							'updated' => date('Y-m-d H:i:s'),
						);
						
					
						$insert_id = $this->faq_model->updateFaq($fileData, $id);
						//after successful submission
						$this->session->set_flashdata('success', 'You have updated Faq successfully.');
						redirect('admin/faq/manage_faq');
				}
			} else {
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/faq/edit_faq', $data);
				$this->load->view('admin/parts/footer',$footer);
			}
		} else {

			redirect('admin/login', 'refresh');
		}
	}
	
	function delete_faq($id=null,$status1){
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			$status = array('status'=> $status1);
			
			$res = $this->faq_model->deleteFaq($id,$status);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have update status successfully.');
				redirect('admin/faq/manage_faq');
			}
		} else {
			redirect('admin/faq/manage_faq');
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