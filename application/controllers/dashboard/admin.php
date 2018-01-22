<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model("user_model");
		$this->load->model("city_model");
		$this->load->helper('download');
	}

	function index()
	{
		redirect('admin/login');
	}

	function login()
	{
		if($this->session->userdata('admin_user'))
	    {
	    	//If no session, redirect to login page
	      redirect('admin/user/user_list', 'refresh');
	    }
	    else
	    {
	    	$this->load->view('admin/login');
	    }
	}

	function dashboard()
	{
		
		if($this->session->userdata('admin_user'))
    	{
			
    		$session_data = $this->session->userdata('admin_user');
			
		    $data['username'] = $session_data['admin_username'];
		    $data['name'] = $session_data['name'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'dashboard';
		    $header['tab'] = 'dashboard';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'dashboard';
		    $sidebar['username'] =  $data['username'];
		   // $sidebar['name'] =  $data['name'];
		    
		    $footer['main_page'] = 'dashboard';

		    if($data['user_type_id'] == '1') // admin
		    {
		    	$view_load = 'admin/dashboard/dashboard_admin';
		    }
		    else if($data['user_type_id'] == '2') // account
		    {
		    	
		    	$view_load = 'admin/dashboard/dashboard_account';
		    }
		    else if($data['user_type_id'] == '3') // content
		    {
		    	$view_load = 'admin/dashboard/dashboard_content';
		    } 
			else if($data['user_type_id'] == '7') // content
		    {
		    	$view_load = 'admin/dashboard/dashboard_admin';
		    }else {
				redirect('admin/login');
			}


			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view($view_load);
			$this->load->view('admin/parts/footer',$footer);
		}
		else
		{
			redirect('admin/login', 'refresh');
		}
	}
	
	function verifylogin()
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
      $this->load->view('admin/login');
    }
    else
    {
      //Go to private area
      redirect('admin/user/user_list', 'refresh');
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
	$username = $this->clean($username);
    
    //query the database
    $row_data = $this->user_model->login($username, $password);
    
    if($row_data)
    {
      $sess_array = array();

      $user_data = $this->user_model->get_user_data_by_id($row_data->id);
	//echo '<pre>'; print_r($user_data); die;
      $sess_array = array(
          'id' => $row_data->id,
          'admin_username' => $row_data->username,
          'name' => $row_data->name,
          'admin_user_type_id' => $user_data->user_type_id,
		  'create_datetime' => $user_data->create_datetime,
		  'user_type' => $user_data->user_type_slug,
		  'logged_in' => true,
		  'user_image_file' => $user_data->user_image_file,
        );
        $this->session->set_userdata('admin_user', $sess_array);
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }
  
  // User Profile Manoj sharma
	
	function user_profile($id=Null)
	{
		
		    $session_data = $this->session->userdata('admin_user');
			
		if($session_data){					
		    $data['username'] = $session_data['admin_username'];
			 $data['userid'] = $session_data['id'];
			 
			
		   $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'dashboard';
		    $header['tab'] = 'dashboard';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'dashboard';
		    $sidebar['username'] =  $data['username'];
		    //$sidebar['name'] =  $data['name'];
		    
		    $footer['main_page'] = 'dashboard';
			$data['admin_user_data'] = $userData = $this->user_model->get_user_data_by_id($id);
			$this->form_validation->set_rules('name','Name','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('phone','Phone Number','trim|required|callback_validate_phone_number');
			$this->form_validation->set_rules('user_password', 'Password', 'trim');
			$this->form_validation->set_rules('user_cpassword', 'Password Confirmation', 'trim|matches[user_password]');
			$this->form_validation->set_rules('city','User City','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('address','Address','strip_tags|trim|required|xss_clean');
			$this->form_validation->set_rules('pincode','Pincode','strip_tags|trim|required|xss_clean');
		
			//create error array
		$error_arr = array();
		$data['city_data'] = $this->city_model->getAllActiveCityList();
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				if ($this->form_validation->run() == FALSE){ 
				$this->load->view('site/parts/header');
				$this->load->view('site/user_profile',$data);
				$this->load->view('site/parts/footer');
			}
			else{
				$user_image_file = "";
				
				if($_FILES['user_image_file']['name']!=''){
					$config['upload_path']   ='./uploads/adminuser/'; 
					$config['allowed_types'] = 'gif|jpg|png'; 
					$config['max_size']      = 1024; 
					$config['max_width']     = 0; 
					$config['max_height']    = 0;  
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('user_image_file')) {
						$error = array('error' => $this->upload->display_errors());
						$error_arr[] = $error['error']."(User Image)";
					} else { 
						$data_user = array('upload_data' => $this->upload->data());
						$user_image_file = $data_user['upload_data']['orig_name'];
					}
				} else {
					$user_image_file = $session_data['user_image_file'];
				}
				
				if(isset($error_arr) and count($error_arr)>0){  
					$data['file_error'] = $error_arr;
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/dashboard/user_profile',$data);
					$this->load->view('admin/parts/footer',$footer);
					
				}
				else{
					
				$userData1 = array();
				
				$userData1 = array(
				
					 'name'=>$this->input->post('name'),
					 'city'=>$this->input->post('city'),
					 'phone'=>$this->input->post('phone'),
					 'address'=>$this->input->post('address'),
					 'pincode'=>$this->input->post('pincode'),
					 
				);
				
				if($user_image_file)
					$userData1['user_image_file'] = $user_image_file;
				
				$sess_array = array(
				  'id' => $session_data['id'],
				  'admin_username' => $session_data['admin_username'],
				  'name' => $session_data['name'],
				  'admin_user_type_id' => $session_data['admin_user_type_id'],
				  'create_datetime' => $session_data['create_datetime'],
				  'user_type' => $userData->user_type_slug,
				  'logged_in' => true,
				  'user_image_file' => $user_image_file,
				);
				$this->session->set_userdata('admin_user', $sess_array);
				
				if($this->input->post('user_password'))
					$userData1['password'] = md5($this->input->post('user_password'));
				if(sizeof($userData1)>0)
					$this->user_model->update_user_data($userData1,$id);
			
				//after successful submission
			$this->session->set_flashdata('success', 'You have Updated successfully.');
			redirect('admin/user_profile/'.$id);
			//$this->load->view('admin/parts/header',$header);
			//$this->load->view('admin/parts/sidebar_left',$sidebar);
			//$this->load->view('admin/dashboard/user_profile',$data);
			//$this->load->view('admin/parts/footer',$footer);
				
				}
				
			}
				
			}
			else
			{
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/dashboard/user_profile',$data);
			$this->load->view('admin/parts/footer',$footer);
			}
		}else{
			redirect('admin/login', 'refresh');
		}
	}
	
	function logout()
	{
	    $this->session->unset_userdata('admin_user');
	    //session_destroy();
	    redirect('admin/login', 'refresh');
 	}
	
	function clean($string) {
		
		$chReplace   = array("'", "=", "#", "$", "&");
		
	   $string = str_replace($chReplace, '', $string); // Replaces all spaces with hyphens.

	   //return preg_replace('/^[A-Za-z0-9_~\-@\$%\&*\(\)]+$/', '', $string); // Removes special chars.
	   return $string;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */