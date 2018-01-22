<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Controller
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
    	$this->load->model('exam_model');
		$this->load->model('user_model');
	}
	function manage_exam()
	{
		
		$this->load->model('exam_model');
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'manage_exam';
		    $header['tab'] = 'exam';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'exam';
		    $sidebar['main_page'] = 'manage_exam';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_exam';

		   $data['exam_details'] = $this->exam_model->get_exam_detail();

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/exam/manage_exam',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_exam()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_exam';
		    $header['tab'] = 'exam';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'exam';
		    $sidebar['main_page'] = 'add_exam';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_exam';

		  
		$this->form_validation->set_rules('exam_name', 'exam Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('exam_date', 'Exam Date', 'required');
		$this->form_validation->set_rules('exam_time', 'Exam Time', 'required');
		$this->form_validation->set_rules('exam_venue', 'Exam Venue', 'required');
		$this->form_validation->set_rules('exam_admit_card_start_date', 'Exam Admit card Start Date', 'required');
		$this->form_validation->set_rules('exam_admit_card_end_date','Exam Admit card End Date', 'required');
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
		        $this->load->view('admin/exam/add_exam',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			$data_addexam = array(
				     	'exam_name' => $this->input->post('exam_name'),
						'exam_date' => $this->input->post('exam_date'),
						'exam_time' => $this->input->post('exam_time'),
						'exam_venue' => $this->input->post('exam_venue'),
						'exam_admit_card_start_date' => $this->input->post('exam_admit_card_start_date'),
					    'exam_admit_card_end_date' => $this->input->post('exam_admit_card_end_date'),
						'status' => $this->input->post('status'),
							);
		
				   
			date_default_timezone_set('UTC');
		
		    $data_addpage['created'] = date('Y/m/d  h:m:s');
	
			$this->exam_model->add_exam_data($data_addexam);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added exam successfully.');
				redirect('admin/exam/add_exam/');
			
			}
			  }
			  
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/exam/add_exam',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_exam($id = Null)
	{
		
			if($id == NULL)
		{
			redirect('admin/exam/manage_exam');
		}
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('exam_model');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_exam';
		    $header['tab'] = 'exam';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'exam';
		    $sidebar['main_page'] = 'esit_exam';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_exam';

		  
  
		$this->form_validation->set_rules('exam_name', 'Exam Name', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('exam_date', 'Exam Date', 'required');
		$this->form_validation->set_rules('exam_time', 'Exam Time', 'required');
		$this->form_validation->set_rules('exam_venue', 'Exam Venue', 'required');
		$this->form_validation->set_rules('exam_admit_card_start_date', 'Exam Admit card Start Date', 'required');
		$this->form_validation->set_rules('exam_admit_card_end_date','Exam Admit card End Date', 'required');
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
		        $this->load->view('admin/exam/edit_exam',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			        $data_update_exam = array(
				   'exam_name' => $this->input->post('exam_name'),
						'exam_date' => $this->input->post('exam_date'),
						'exam_time' => $this->input->post('exam_time'),
						'exam_venue' => $this->input->post('exam_venue'),
						'exam_admit_card_start_date' => $this->input->post('exam_admit_card_start_date'),
					    'exam_admit_card_end_date' => $this->input->post('exam_admit_card_end_date'),
						'status' => $this->input->post('status'),
							);
		
		
		 
			date_default_timezone_set('UTC');
			
		    $data_addpage['updated'] = date('Y/m/d  h:m:s');
	
			$this->exam_model->update_exam_data($data_update_exam,$id);	
			 $data['exam_data'] = $this->exam_model->get_exam_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated a exam successfully.');
				redirect('admin/exam/manage_exam/');
			
			}
			  }
			  
			  else {
				
			$data['exam_data'] = $this->exam_model->get_exam_data_by_id($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/exam/edit_exam',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_exam($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->exam_model->delete_exam_by_id($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted exam successfully.');
				redirect('admin/exam/manage_exam');
			}
		} else {
			redirect('admin/exam/manage_exam');
		}
		
	}
	
	  
	
}

