<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Enquiry extends CI_Controller
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
		$this->load->model("enquiry_model");
		$this->load->model("student_model");
	}
	
	function index()
	{
		redirect('admin/enquiry/enquiry_list');
	}
	
	function enquiry_list(){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'Enquiry';
		    $header['tab'] = 'enquiry_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'enquiry';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['enquiry_list'] = $this->enquiry_model->listenquiry();
			$data['form_type'] = $this->enquiry_model->getFormType();		
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/enquiry/enquiry_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function viewEnquiry($id){
			
			$session_data = $this->session->userdata('admin_user');
			$data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];
			$header['main_page'] = 'Enquiry';
		    $header['tab'] = 'enquiry_list';
			$sidebar['page'] = 'enquiry';
		    $sidebar['username'] =  $data['username'];
			$footer['main_page'] = 'dashboard';
			
			
			$data['enquiry_data'] = $this->enquiry_model->getenquiryByID($id);
		
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/enquiry/enquiry_view', $data);
			$this->load->view('admin/parts/footer',$footer);
		
	}
	
	function delete_formData($id=null){
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->enquiry_model->deleteData($id,$status);
			if($delete==true){
				$this->session->set_flashdata('success', 'You have deleted Enquiry successfully.');
				redirect('admin/enquiry/enquiry_list');
			}
		}
	}

	function exportEnquiry(){
		
		//$formType = urldecode($sts);
		$formType = $this->input->post('formType');
		
		$this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = strtolower(str_replace(" ","-",$formType));
        $query = "SELECT fields_data FROM ficci_formdata where form_type ='".$formType."'";
        $result = $this->db->query($query);
        $fData = $result->result();

		$field_arr = array();
		$data_arr = array();
		$cnt = 0;
		$i = 0;
        foreach($fData as $fdt){
        	$json = json_decode($fdt->fields_data);
			//echo '<pre>'; print_r($json); die;
        	foreach($json as $key => $value){
	        	if($cnt==0){
	    			$field_arr[] = $key;
	    			$data_arr[$cnt][] = $value;
	        	} else {
	        		$data_arr[$cnt][]= $value;
	        	}
				$i++;
	        }
        	
        	$cnt++;
        }
    
		
			header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=".$filename.".csv");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');
			
			fputcsv($handle,$field_arr);
			
            foreach ($data_arr as $data) {
                fputcsv($handle, $data);
            }
                fclose($handle);
            exit;
	}
	
	
}
?>