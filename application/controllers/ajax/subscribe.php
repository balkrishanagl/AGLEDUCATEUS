<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->library('form_validation');
	}
	
	function subcribeUser(){
		
		$msg = '';
		$this->form_validation->set_rules('email','Email','trim|required|xss_clean|valid_email');
		$this->load->model('subscriber_model');
		
		if($this->form_validation->run())
		{
			
			$isDuplicateRecord = $this->subscriber_model->chkSubscriberDuplicate($this->input->post('email'));
			
			//echo '<pre>'; print_r($isDuplicateRecord); die;
			if($isDuplicateRecord == NULL){
				
				$email = $this->form_validation->set_value('email');
				$insertData = array(
									'email' => $this->input->post('email'),
									'created' => date('Y-m-d H:i:s'),
								);
								
								
				$this->subscriber_model->addsubscriberData($insertData);
				
								
					/*  Mail to user */
					$to = $this->input->post('email');
					$from = $this->config->item('FromEmail');
					$subject = "News Letter ".$this->config->item('Site_name');
					$data['site_name'] = $this->config->item('Site_name');
					$data['name'] = $this->input->post('name');
					$message = $this->load->view('site/email/newsletter',$data, true);
					
					//echo $message; die;
					$sendMailUser = $this->sendEmail($to,$from,$subject,$message);
					
					if($sendMailUser){
						
						$msg = "Thank you for subscribe.";
						
					}else{
						$msg = "error in sending mail";
					}
					/*  Mail to user */
			}
			else{
				
				$msg = "Allready Subscribed!";
			}
			
	}
	
	echo json_encode(array('msg' => $msg));
}
	
	
	function sendEmail($to,$from,$subject,$message){
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from($from,$this->config->item('Site_name'));
		$this->email->subject($subject);
		$this->email->message($message);
				
		if($this->email->send()){
			return true;
		}else{
			return false;
			
		}
	}
	
}
?>