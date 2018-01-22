<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Source_information extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
	   
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
    	$this->load->model('source_model');
		$this->load->model('user_model');
	}
	function manage_source()
	{
		    $this->load->model('source_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_source';
		    $header['tab'] = 'source';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'source_information';
		    $sidebar['main_page'] = 'manage_source';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_source';

		    $data['source_details'] = $this->source_model->get_source_detail();
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_information/manage_source',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}
	public function valid_url($str)
	{
		return (filter_var($str, FILTER_VALIDATE_URL) !== FALSE);
	}
	function add_source()
	{
		
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'add_source';
		$header['tab'] = 'source';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'source';
		$sidebar['main_page'] = 'add_source';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'add_source';
		$data['all_user_type'] = $this->user_model->get_all_user_type_list(2);
		
		//$this->form_validation->set_rules('website_url', 'Website URL', 'strip_tags|trim|required|xss_clean|callback_valid_url');
		$this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('status','Status', 'required');
		//$this->form_validation->set_rules('usertype','User type', 'trim|required');
		$this->form_validation->set_rules('payment_type','Payment type', 'trim|required');
		$this->form_validation->set_rules('order_no', 'Order Number', 'required|is_unique[edu_source_information.order_no]');
		
		if($this->input->post('payment_type')=='percent')
			$this->form_validation->set_rules('payment_share','Payment share', 'required|is_numeric|greater_than[1]|less_than[101]');
		else
			$this->form_validation->set_rules('payment_share','Payment share', 'required|is_numeric');
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		{	  
		  if ($this->form_validation->run() == FALSE){
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_information/add_source',$data);
			$this->load->view('admin/parts/footer',$footer);
			
		} 
			else {
			
			$userType = $this->input->post('usertype');
			$userT = '';
			for($i=0;isset($userType[$i]);$i++)
			{
				$userT.= $userType[$i].',';
			}	
			
			$data_addsource = array(
			'website_url' => $this->input->post('website_url'),
			'name' => $this->input->post('name'),
			'usertype' => rtrim($userT,','),
			'payment_type' => $this->input->post('payment_type'),
			'amount' => $this->input->post('payment_share'),
			'count' => 0,
			'status' => $this->input->post('status'),
			'order_no' => $this->input->post('order_no'),
			);
			
			if($this->input->post('other_option')!=null){
				$data_addsource['other_option_applicable'] = $this->input->post('other_option');
			}
	
        					
			 date_default_timezone_set('UTC');
		
		     $data_addsource['created'] = date('Y-m-d h:m:s');
	
			 $this->source_model->add_source_data($data_addsource);	
			
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added source of information successfully.');
				redirect('admin/source_information/add_source/');
			
			
			}
		}
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_information/add_source',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_source($id = Null)
	{
		
			if($id == NULL)
		{
			//redirect('admin/source/manage_source');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('source_model');
		
		$data['source_data'] = $this->source_model->get_source_data_by_id($id);
		$data['all_user_type'] = $this->user_model->get_all_user_type_list(2);
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_source';
		    $header['tab'] = 'source';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'source';
		    $sidebar['main_page'] = 'edit_source';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_source';

		//$this->form_validation->set_rules('website_url', 'Website URL', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('name', 'Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('status','Status', 'required');
		//$this->form_validation->set_rules('usertype','User type', 'trim|required');
		$this->form_validation->set_rules('payment_type','Payment type', 'trim|required');
		if($this->input->post('payment_type')=='percent')
			$this->form_validation->set_rules('payment_share','Payment share', 'required|is_numeric|greater_than[1]|less_than[101]');
		else
			$this->form_validation->set_rules('payment_share','Payment share', 'required|is_numeric');
		
		
		$orderNo = $this->input->post('order_no');
				
		$sourceOrderNo = $this->source_model->getorderIDBySourceId($id,$orderNo);
				
				
		if(sizeof($sourceOrderNo)>0)
			$this->form_validation->set_rules('order_no', 'Order Number', 'required|is_unique[edu_source_information.order_no]');
		else
			$this->form_validation->set_rules('order_no', 'Order Number', 'required');
				  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			 // echo $this->input->post('other_option'); die;
			 // echo $this->input->post('other_option'); die;
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/source_information/edit_source',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			
			$userType = $this->input->post('usertype');
			$userT = '';
			for($i=0;isset($userType[$i]);$i++)
			{
				$userT.= $userType[$i].',';
			}
			
			$data_update_source = array(
			'website_url' => $this->input->post('website_url'),
			'name' => $this->input->post('name'),
			'amount' => $this->input->post('payment_share'),
			'usertype' => rtrim($userT,','),
			'payment_type' => $this->input->post('payment_type'),
			'status' => $this->input->post('status'),
			'order_no' => $this->input->post('order_no'),
			);
			
			if($this->input->post('other_option')!=null){
				$data_update_source['other_option_applicable'] = 1;
			}else{
				$data_update_source['other_option_applicable'] = 0;
			}
			
			if($this->input->post('count'))
				$data_update_source['count'] = $this->input->post('count');
			
			//echo "<pre>"; print_r($data_update_source); die;
			date_default_timezone_set('UTC');
		
		    $data_update_source['updated'] = date('Y-m-d h:m:s');
	
			$this->source_model->update_source_data($data_update_source,$id);	
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a source of information successfully.');
				redirect('admin/source_information/manage_source/');
			
			}
			  }
			  
			  else {
				
			$data['source_data'] = $this->source_model->get_source_data_by_id($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/source_information/edit_source',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_source($id=null)
	{
		
      if($id!=null){
	
	  $session_data = $this->session->userdata('admin_user');
	  $data['username'] = $session_data['admin_username'];
	
	  $res = $this->source_model->delete_source_by_id($id);
	
	  if($res==true){
		$this->session->set_flashdata('success', 'You have deleted source of information successfully.');
		redirect('admin/source_information/manage_source');
	}
    } else {
	redirect('admin/source_information/manage_source');
    }
	

	}
	
	  
	
}

