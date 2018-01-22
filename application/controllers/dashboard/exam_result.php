<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class exam_result extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$session_data = $this->session->userdata('admin_user');
		if($session_data['admin_user_type_id']==2){
			redirect('admin/dashboard');
		}
		
		$this->load->helper('url');
		$this->load->model("quiz_model");
		$this->load->model("enquiry_model");
		$this->load->model("student_model");
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	
	function index()
	{
		redirect('admin/exam_result/result_list');
	}
	
	function result_list(){
		
		if($this->session->userdata('admin_user')){
			$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
		    $data['user_type_id'] = $session_data['admin_user_type_id'];

		    $header['main_page'] = 'Result';
		    $header['tab'] = 'result_list';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'result';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'dashboard';
			
			$data['result_list'] = $this->quiz_model->allResultList();
			//echo '<pre>'; print_r($data['result_list']); die;
			$data['form_type'] = $this->enquiry_model->getFormType();		
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/exam_result/result_list', $data);
			$this->load->view('admin/parts/footer',$footer);
		} else {
			redirect('admin/login', 'refresh');
		}
	}
	
	function add_grace_marks($Iid)
	{
		
		$session_data = $this->session->userdata('admin_user');
		$data['username'] = $session_data['admin_username'];
		$data['user_type_id'] = $session_data['admin_user_type_id'];

		$header['main_page'] = 'Result';
		$header['tab'] = 'result_list';
		$header['username'] =  $data['username'];

		$sidebar['page'] = 'result';
		$sidebar['username'] =  $data['username'];
		
		$footer['main_page'] = 'dashboard';
		$rec = $this->quiz_model->getFinalMarksByid($Iid);
		
		$graceMarks = $rec->grace_marks;
		
		if(!empty($_POST))
		{
			$this->form_validation->set_rules('grace_marks', 'Grace Marks', 'required|is_numeric|greater_than[0]|less_than[51]');
			if ($this->form_validation->run())
			{	
				$finalMarks = $rec->final_marks;
				
				if($graceMarks!=""){
					
					$finalMark = $finalMarks-$graceMarks;
					$finalMark = $finalMark+$this->input->post('grace_marks');
				}else{
					$finalMark = $finalMarks+$this->input->post('grace_marks');
				}
				
				
				
				$grade = "";
				if($finalMark >= 80){
					$grade = "A";
					
				}elseif($finalMark >= 60 && $finalMark <=79){
					$grade = "B";
					
				}elseif($finalMark >= 50 && $finalMark <=59){
					$grade = "C";
					
				}else{
					$grade = "Failed";
					
				}
				
				
				
				$data_graceMarks = array(
					'grace_marks' => $this->input->post('grace_marks'),
					'final_marks' => $finalMark,
					'grade' => $grade,
					);
				$this->quiz_model->updatemarks($data_graceMarks,$Iid);	
				
				$this->session->set_flashdata('success', 'You have update grace marks.');
				redirect('admin/student_result/result_list');
			}
		}
		$this->load->view('admin/parts/header',$header);
		$this->load->view('admin/parts/sidebar_left',$sidebar);
		$this->load->view('admin/exam_result/add_grace_marks', $data);
		$this->load->view('admin/parts/footer',$footer);
	}
	function download_csv()
	{
		
		//$clientTable = $this->Client_model->create_table_name($clientId);
		
		
		
		$from = $this->input->post('result_from');
		$to = $this->input->post('result_to');	
		//echo $from."<br>";
		//echo $to."<br>";
		$temp = true;
		if($from!='' && $to!='' && $to < $from)
		{
			$this->session->set_userdata('date_error_msg','End date should be greater than Start date');
			$this->session->set_userdata('from',$from);
			$this->session->set_userdata('to',$to);
			$temp = false;
		}
		if($from=='' && $to!='')
		{
			$this->session->set_userdata('date_error_msg','Please select start date');
			$this->session->set_userdata('from',$from);
			$this->session->set_userdata('to',$to);
			$temp = false;
		}
		
		$fromDate = date('Y-m-d',strtotime($from));
		$toDate = date('Y-m-d',strtotime($to));
		$time = date('H:i:s');
		//echo $fromDate.'<br/>';
			if($temp)
			{
				$this->session->unset_userdata('from',$from);
				$this->session->unset_userdata('to',$to);
				$toDte = $toDate.' '.$time; 
				//echo $toDte; die;
				$this->load->dbutil();
				$this->load->helper('file');
				$this->load->helper('download');
				//echo ("select * from ".$clientTable." where created >= '".$fromDate."' AND created <= '".$toDte."'"); die;
				//if($from!='' && $to!='')
				//$query = $this->db->query("select user_profiles.*,users.username,users.email,users.created,users.user_type_id,users.activated,users.payment_id from users join user_profiles ON users.id=user_profiles.user_id  where users.created >= '".$fromDate."' AND users.created <= '".$toDate."'");
				//if($from!='' && $to=='')
				//$query = $this->db->query("select user_profiles.*,users.username,users.email,users.created,users.user_type_id,users.activated,users.payment_id from users join user_profiles ON users.id=user_profiles.user_id  where users.created >= '".$fromDate."'");
				
				$this->db->select('ficci_quiz.name as ExamName,ficci_quiz.exam_date as ExamDate');
				$this->db->select('ficci_session.start_on as SessionStart,ficci_session.end_on as SessionEnd');
				$this->db->select('user_profiles.first_name as StudentName');
				$this->db->select('ficci_exam_result.marks,ficci_exam_result.duration,ficci_exam_result.assignment_marks,ficci_exam_result.final_marks,ficci_exam_result.grade,ficci_exam_result.status,ficci_exam_result.exam_type');
				$this->db->from('ficci_quiz');
	
				
				if($from!=""){
					$this->db->where('ficci_quiz.exam_date >=',$from);
					
				}
				
				if($to!=""){
					$this->db->where('ficci_quiz.exam_date <=',$to);
					
				}
				$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
				$this->db->join('ficci_exam_result','ficci_exam_result.quiz_id=ficci_quiz.id');
				$this->db->join('user_profiles','user_profiles.user_id=ficci_exam_result.user_id');

				$query = $this->db->get();
				
			
				$delimiter = ",";
				$newline = "\r\n";
				$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
				echo force_download('Result_Report.csv', $data); die;
			}
			else
			{
				$this->load->library('user_agent');
				if ($this->agent->is_referral())
				{
					redirect($this->agent->referrer());
				}
			}
		
				//$status='success';
				//$msg='Email Sent Successfully';
	}
	
	
	function filter_result(){
		
		$from=null;
		$to=null;
		$type = null;
		
		if($this->session->userdata('admin_user')){
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				if(isset($_POST['type']) and $_POST['type']!=''){
					
					$type = $_POST['type'];
					
				}
				
				if(isset($_POST['fromdt']) and $_POST['fromdt']!=''){
				
				$from = $_POST['fromdt'];
				$from = date_create($from);
				$from = date_format($from,"Y-m-d");
				
				}
			
				if(isset($_POST['todt']) and $_POST['todt']!=''){
					$to = $_POST['todt'];
					$to = date_create($to);
					$to = date_format($to,"Y-m-d");
				}
				
				$filter_data = $this->quiz_model->allResultList($from, $to, $type);
				//echo '<pre>'; print_r($filter_data); die;
				if(isset($filter_data) && $filter_data != NULL) {
					$i=1; 
					$result = '';
					$status = '';
					$data = array();
					foreach($filter_data as $filterData) { 
					$student_name = $filterData->first_name.' '.$filterData->last_name;
					
					if($filterData->status == 'done'){
						$status = "Completed";
					}else{
						$status = "Pending";
					}
					
					
					$action = "<a href=".base_url().'admin/student_result/add_grace_marks/'.$filterData->id.">Edit</a>";
					//echo $action; die;
					$data[] = array($i,$filterData->type,$student_name,$filterData->name,$filterData->exam_date,$filterData->sessionStart,
									$filterData->sessionEnd,$filterData->duration,$filterData->marks,$filterData->assignment_marks,
									$filterData->grace_marks,$filterData->final_marks,$filterData->grade,$status,$action);
					
					
					$i++;
					
					
				}
				
				echo json_encode($data);
				
				}else{
					
					/* $result = "";
					echo $result; die; */
					
					$data = array();
					echo json_encode($data);
				}
			}
		}
	}
	
	
	
	
	
	
}
?>