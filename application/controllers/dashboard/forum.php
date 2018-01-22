<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
    function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		if(!$this->session->userdata('admin_user'))
    	{
    		redirect('admin/login', 'refresh');
    	}
		
		$this->load->model('user_model');
    	$this->load->model('forum_model');
	}
	function manage_topic()
	{
		
		$this->load->model('forum_model');
		$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'manage_topic';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'manage_topic';
		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'manage_topic';

		$data['topic_details'] = $this->forum_model->getTopics();

		$this->load->view('admin/parts/header',$header);
		$this->load->view('admin/parts/sidebar_left',$sidebar);
		$this->load->view('admin/forum/manage_topic',$data);
		$this->load->view('admin/parts/footer',$footer);    	

	}
	
	function manage_comment()
	{
		
		$this->load->model('forum_model');
		$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];
		
		$header['main_page'] = 'manage_comment';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'manage_comment';
		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'manage_comment';

		$data['comment_details'] = $this->forum_model->getComments();

		$this->load->view('admin/parts/header',$header);
		$this->load->view('admin/parts/sidebar_left',$sidebar);
		$this->load->view('admin/forum/manage_comment',$data);
		$this->load->view('admin/parts/footer',$footer);    	

	}

	function add_topic()
	{
	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'add_topic';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'add_topic';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'add_topic';

		  
		$this->form_validation->set_rules('topic_title', 'Topic Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('topic_body', 'Topic Description', 'strip_tags|trim|required|xss_clean');
		
		
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/forum/add_topic',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} else {
			$topic = array(
				     	'title' => $this->input->post('topic_title'),
						'body' => $this->input->post('topic_body'),
						'status' => $this->input->post('status'),
					);
	
			$this->forum_model->addTopic($topic);	
			 
		
			//after successful submission
			$this->session->set_flashdata('success', 'You have added topic successfully.');
			redirect('admin/forum/add_topic/');
			
			}
		  } else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/forum/add_topic',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_topic($id = Null)
	{
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('forum_model');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'edit_topic';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'edit_topic';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'edit_topic';
  
		$this->form_validation->set_rules('topic_title', 'Topic Title', 'strip_tags|trim|required|xss_clean');
		$this->form_validation->set_rules('topic_body', 'Topic Description', 'strip_tags|trim|required|xss_clean');
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
		        $this->load->view('admin/forum/edit_topic',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} else {
			        $topic = array(
						'title' => $this->input->post('topic_title'),
						'body' => $this->input->post('topic_body'),
						'status' => $this->input->post('status'),
					);
		
				$this->forum_model->updateTopic($topic,$id);	
				$data['topic_data'] = $this->forum_model->getTopicByID($id);
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have updated topic successfully.');
				redirect('admin/forum/manage_topic/');
			}
		} else {
				
			$data['topic_data'] = $this->forum_model->getTopicByID($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/forum/edit_topic',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
		}
		
	}
	
	function edit_comment($id = Null)
	{
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('forum_model');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];

		$header['main_page'] = 'edit_comment';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'edit_comment';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'edit_comment';
  
		$this->form_validation->set_rules('comment_body', 'Comment', 'strip_tags|trim|required|xss_clean');
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
		        $this->load->view('admin/forum/edit_comment',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} else {
			        $topic = array(
						'body' => $this->input->post('comment_body'),
						'status' => $this->input->post('status'),
					);
		
				$this->forum_model->updateComment($topic,$id);	
				$data['comment_data'] = $this->forum_model->getCommentByID($id);
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have updated comment successfully.');
				redirect('admin/forum/manage_comment/');
			}
		} else {
				
			$data['comment_data'] = $this->forum_model->getCommentByID($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/forum/edit_comment',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
		}
		
	}
	
	function reply_comment($id = Null)
	{
	
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('forum_model');
		
    	$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];
		
		$header['main_page'] = 'reply_comment';
		$header['tab'] = 'forum';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'forum';
		$sidebar['main_page'] = 'reply_comment';

		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'reply_comment';
  
		$this->form_validation->set_rules('comment_body', 'Comment', 'strip_tags|trim|required|xss_clean');
        //$this->form_validation->set_rules('status','Status', 'required');
		
		  
		//create error array
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
			  if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/forum/reply_comment',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} else {
			        $topic = array(
						'reply_body' => $this->input->post('comment_body'),
						'reply_user_id' => $session_data['id'],
						'reply_created' => date('Y-m-d H:i:s'),
						//'status' => $this->input->post('status'),
					);
		
				$this->forum_model->updateReplyComment($topic,$id);	
				$comment_data = $this->forum_model->getCommentByID($id);
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have send reply comment successfully.');
				//get student data by id
				$this->load->model('student_model');
				$result = $this->student_model->getStudentData($comment_data->user_id);
				
				$subject = "Discussion at IPForum";
				$data['site_name'] = 'FICCI-CCIPR';
				
				$data['name'] = $result->first_name." ".$result->last_name;
				$data['email'] = $result->email;
				$data['sitelink'] = base_url();
				$message = $this->load->view('site/email/forum_comments',$data, true);
				
				$this->sendEmail($data['email'], $subject, $message);
				
				
				redirect('admin/forum/manage_comment/');
			}
		} else {
				
			$data['comment_data'] = $this->forum_model->getCommentByID($id);
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/forum/reply_comment',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
		}
		
	}
	
	
	
	function delete_topic($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->forum_model->deleteTopicByID($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted topic successfully.');
				redirect('admin/forum/manage_topic');
			}
		} else {
			redirect('admin/forum/manage_topic');
		}
		
	}
	
	function delete_comment($id=null)
	{
		
		if($id!=null){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
			
			$res = $this->forum_model->deleteCommentByID($id);
			
			if($res==true){
				$this->session->set_flashdata('success', 'You have deleted comment successfully.');
				redirect('admin/forum/manage_comment');
			}
		} else {
			redirect('admin/forum/manage_comment');
		}
		
	}
	
	function changeCommentStatus($id=null,$cStatus){
		//echo $id; die;
		if($id!=null){
			$status = array('status'=> $cStatus);
			$active = $this->forum_model->changestatus($id,$status);
			if($active==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have changed status successfully.');
				redirect('admin/forum/manage_comment');
			}
		}
	}
	
	//function to send email - Balkrishan
	function sendEmail($to, $subject, $message){
		//include email library
		$this->load->library('email');
		
		//set email config
		//$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		//$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		
		$this->email->from($this->config->item('FromEmail'), "FICCI-CCIPR");
		$this->email->to($to);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	}
}