<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Forum extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('site_user');
		
		if(!$this->session->userdata('site_user'))
    	{
    		redirect('welcome', 'refresh');
    	}
    	$this->load->model('forum_model');
    	$this->load->model('user_model');
		
	}
	
	function index()
	{
		
		$this->load->model('forum_model');
		$session_data = $this->session->userdata('admin_user');
		$session_site_user = $this->session->userdata('site_user');
		$userId = $session_site_user['user_id'];
		$data['all_comment'] = $this->forum_model->getTopicComments($userId);
		//echo '<pre>'; print_r($data['all_comment']); die;
			$this->load->view('site/parts/header');
			$this->load->view('site/forum/topic',$data);
			$this->load->view('site/parts/footer');

	 /*   $data['topics'] = $this->forum_model->getTopics();

		$this->load->view('site/parts/header');
		$this->load->view('site/forum/index',$data);
		$this->load->view('site/parts/footer');    	 */

	}
	
	function topic($id=null)
	{
		if($id!=null){
			$this->load->model('forum_model');
			$session_data = $this->session->userdata('admin_user');
			$session_site_user = $this->session->userdata('site_user');
			$userId = $session_site_user['user_id'];
			
			$data['topic'] = $this->forum_model->getTopicByID($id);
			$data['comment_count'] = $this->forum_model->getTopicCommentCount($id);
			$data['user_count'] = $this->forum_model->getTopicCommentCount($id);
			$data['all_comment'] = $this->forum_model->getTopicComments($userId);
			
			$this->load->view('site/parts/header');
			$this->load->view('site/forum/topic',$data);
			$this->load->view('site/parts/footer');
		} else {
			$this->session->set_flashdata('success', 'You have added comment successfully.');
			redirect('site/forum/index/');
		}

	}
	
	function add_comment()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('site_user');
		
		$this->form_validation->set_rules('comment_body', 'Comment', 'strip_tags|trim|required|xss_clean');
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('site/parts/header');
		        $this->load->view('site/forum/add_comment',$data);
		        $this->load->view('site/parts/footer');
			} 
			else {
				$topic_id = $this->input->post('topic_id');
			$comment = array(
				     	'topic_id' => $topic_id,
						'user_id' => $session_data['user_id'],
						'body' => $this->input->post('comment_body'),
						'status' => 0,
						'created' =>date('Y-m-d H:i:s'),
						'updated' =>date('Y-m-d H:i:s'),
					);
	
			$this->forum_model->addComment($comment);	
			 
		
			//after successful submission
			$this->session->set_flashdata('success', 'You have added comment successfully.');
			redirect('/forum/index/');
			
			}
		  } else {
				
				$this->load->view('site/parts/header');
		        $this->load->view('site/forum/add_comment',$data);
		        $this->load->view('site/parts/footer');	
			
			  }
		
	}
 
}

?>