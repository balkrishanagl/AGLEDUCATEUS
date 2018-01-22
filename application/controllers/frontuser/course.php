<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Course extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('course_model'); 
		
	}
	
	function getPageData($slug){
	
		$data['page_data'] = $this->course_model->get_front_page_data($slug);
		
		if(!empty($data['page_data'])){
			$this->load->view('site/parts/header');
			
			if($slug=="training-material"){
				$this->load->view('site/course/training_material',$data);
			}else{
				$this->load->view('site/course/course',$data);
			}
			$this->load->view('site/parts/footer');
			
			
		}else{
			
			show_404();
		}
		
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */