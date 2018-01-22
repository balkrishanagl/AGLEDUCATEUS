<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Student_model extends CI_Model
{
	
function __construct(){
parent::__Construct();

$this->db = $this->load->database('default', TRUE,TRUE);
}

	function get_all_user_list()
	{
	 	$q = "select * from users";
			
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	function get_options()
	{
		$this->db->select("*");
		$this->db->from("ficci_options");
		$query = $this->db->get();
		return $query->result();
		
	}
	
	function getStudentData($id)
	{
	 	$q = "select users.*, user_profiles.first_name,user_profiles.user_image_file, user_profiles.mobile_number, user_profiles.city, user_profiles.permanent_address, user_profiles.course_fee, user_profiles.last_name, user_profiles.sourceinformation from users INNER JOIN user_profiles ON user_profiles.user_id=users.id where users.id=".$id;
	
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
	
	function getPaymentByID($id)
	{
	 	$q = "select * from ficci_payment_type where id=".$id;
	
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}

	function get_student_data_by_id($id)
	{
		
	   $q = "select user_profiles.*, users.email ,users.username, users.user_type_id,users.re_exam_payment_id,users.re_exam_payment_status,users.re_exam_reminder_mail_time,users.activated from user_profiles INNER JOIN users ON users.id=user_profiles.user_id where user_profiles.user_id=".$id;
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
	
	//get user type - Balkrishan
	function get_user_type($id)
	{
	 	$q = "select user_type_id from users where id=".$id;
	
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			$result = $query->row();
			return $result->user_type_id;
		}
		else
		{
			return NULL;
		}
	}


	// update student record -- Manoj Sharma
	function update_student_data($data_for_update,$user_id)
	{
		$this->db->where('id',$user_id);
		$query = $this->db->update('user_profiles',$data_for_update);
		return true;
	}
	
	function update_user_data($data_for_update,$user_id)
	{
		$this->db->where('id',$user_id);
		$query = $this->db->update('users',$data_for_update);
		return true;
	}

	// Delete Student data -Manoj Sharma
	function delStudent($id,$status)
	{
		$this->db->where('id', $id);
		$this->db->update('users',$status); 
		return true;
	}
	
	//get payment type
	function getPaymentType(){
		$this->db->select('*');
		$this->db->from('ficci_payment_type');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $result = $query->result();
	}
	
	//insert user payment data
	function insert_user_payment_data($data)
	{
		$this->db->insert('ficci_payment',$data);
		return $this->db->insert_id();
	}
	
	//update student data
	function updateStudentDataByID($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		
	}
	
	/* function get_student_assignments($id=null){
		$this->db->select('ficci_assignments.*');
		$this->db->select('admin_user.username');
		$this->db->from('ficci_assignments');
		$this->db->join('admin_user',"admin_user.id=ficci_assignments.user_id",'inner');
		$this->db->where('ficci_assignments.status',1);
		$this->db->where('ficci_assignments.is_submitted',0);
		$query = $this->db->get();
		
		return $result = $query->result_array();
	} */
	
	function get_student_assignments($id=null){
			//'date_format(now(),"%Y-%m-%d")'; die;
		$this->db->select('ficci_assignments.*');
		$this->db->select('ficci_session.start_on as sessionStart,ficci_session.end_on as sessionEnd');
		$this->db->select('admin_user.username');
		$this->db->from('ficci_assignments');
		$this->db->join('admin_user',"admin_user.id=ficci_assignments.user_id",'inner');
		$this->db->join('ficci_session',"ficci_session.id=ficci_assignments.session_id",'inner');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") >= ficci_session.start_on');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") <= ficci_session.end_on');
		$this->db->where('ficci_assignments.status',1);
		//$this->db->where('ficci_assignments.is_submitted',0);
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $result = $query->result_array();
	}
	
	function get_student_assignment_by_id($id=null){
		$this->db->select('ficci_student_assignment.*');
		$this->db->from('ficci_student_assignment');
		$this->db->where('ficci_student_assignment.id',$id);
		$query = $this->db->get();
		
		return $result = $query->result_array();
	}
	
	//insert user student assignment data
	function insert_student_assignment_data($data)
	{
		$this->db->insert('ficci_student_assignment',$data);
		return $this->db->insert_id();
	}
	
	//update student assignment
	function updateStudentAssignment($data,$id){
		$this->db->where('id',$id);
		$this->db->update('ficci_student_assignment',$data);
		return true;
	}
	
	function get_study_material($id=null){
		$this->db->select('ficci_study_material.*');
		$this->db->select('ficci_session.*');
		$this->db->from('ficci_study_material');
		$this->db->join('ficci_session',"ficci_session.id=ficci_study_material.session_id",'inner');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") >= ficci_session.start_on');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") <= ficci_session.end_on');
		
		$query = $this->db->get();
		
		//echo $this->db->last_query(); die;
		return $result = $query->result_array();
	}
	
	// Method  to Download Excel data 
	
	 function getdata(){

    $this->db->select('u.username,u.email,up.*');
	$this->db->from('users u');
	$this->db->join('user_profiles up','u.id = up.user_id');
	$this->db->where('u.user_type_id','4');
	$this->db->where('u.activated','1');
	return $result = $this->db->get();
 //$this->db->result_array();
       
  }

function get_stdnt_fltr_data($num,$offset,$from,$to){
	$this->db->select('*');
	$this->db->where('activated','1');
	$this->db->where('user_type_id ', '4');
	$this->db->where('created >=', $from);
	$this->db->where('created <=', $to);
	$query = $this->db->get('users',$num,$offset);
	return $query->result();
}

function stuCounts($from=NULL,$to=NULL){
	$this->db->select('COUNT(*) as numrows');
	if($from!='' && $to!=''){
	$this->db->where('created >=', $from);
	$this->db->where('created <=', $to);
	}
	$this->db->where('user_type_id', '4');
	$this->db->where('activated','1');
	$query = $this->db->get('users');
	return $query->row()->numrows;
}
  
  
  function get_student_list()
  {
	$q = "select users.*, user_profiles.first_name, user_profiles.last_name from users INNER JOIN user_profiles ON user_profiles.user_id=users.id where users.user_type_id=4 order by id desc";

	$query = $this->db->query($q);
	if($query -> num_rows() > 0)
	{
	return $query->result();
	}
	else
	{
	return NULL;
	}
}
  
  function getStudentEmailId($user_id){
	  
	$this->db->select('email');
	$this->db->where('id', $user_id);
    $q = $this->db->get('users');
		
		if ($q->num_rows()) {
			
			return $result = $q->row();
		}else{
			
			return false;
		}
	  
  }
  
	function insert_student_ennrollment($enrollment,$user_id)
	{
		$this->db->where('user_id',$user_id);
		$query = $this->db->update('user_profiles',$enrollment);
		return true;
	}
	function getRecordByEmail($uEmail,$userId)
	{
		$this->db->where('email',$uEmail);
		$this->db->where('id !=',$userId);
		$query = $this->db->get('users');
		return $res = $query->result();
		
	}
	function getRecordByUsername($userName,$userId)
	{
		$this->db->where('username',$userName);
		$this->db->where('id !=',$userId);
		$query = $this->db->get('users');
		return $res = $query->result();
		
	}
	
	function getStudentSubmitedAssignment($studentId, $assignmentId){
		$this->db->select('*');
		$this->db->from('ficci_student_assignment');
		$this->db->where('student_id',$studentId);
		$this->db->where('faculty_assignment_id',$assignmentId);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	function get_student_list_manager()
  {
	$q = "select users.*, user_profiles.first_name, user_profiles.last_name from users INNER JOIN user_profiles ON user_profiles.user_id=users.id where users.user_type_id in(4,5,6) order by id desc";

	$query = $this->db->query($q);
	if($query -> num_rows() > 0)
	{
	return $query->result();
	}
	else
	{
	return NULL;
	}
}


	function listRegisterUser($from=null, $to=null, $source=null, $usertype=null, $session=null)
	{

		$this->db->select('users.*');
		$this->db->select('user_profiles.*');
		$this->db->select('admin_user_type.user_type_name');
		$this->db->select('ficci_source_information.name as source');
		$this->db->select('ficci_session.name as session');
		$this->db->from('users');
		$this->db->join('user_profiles','user_profiles.user_id=users.id');
		$this->db->join('admin_user_type','admin_user_type.user_type_id=users.user_type_id','inner');
		$this->db->join('ficci_source_information','ficci_source_information.id=user_profiles.sourceinformation');
		$this->db->join('ficci_session','ficci_session.id=users.session_id','left');

		if($from!=""){
			$this->db->where('DATE_FORMAT(users.created,"%Y-%m-%d") >=',$from);

		}

		if($to!=""){
			$this->db->where('DATE_FORMAT(users.created,"%Y-%m-%d") <=',$to);

		}

		if($source!=""){
			$this->db->where('user_profiles.sourceinformation =',$source);

		}

		if($session!=""){
			$this->db->where('users.session_id =',$session);

		}

		if($usertype!=null){
			$this->db->where('users.user_type_id',$usertype);
		}

		$this->db->where('users.user_type_id in(4,5,6)');
		$this->db->order_by('users.id','desc');
		//$this->db->join('ficci_payment_type','ficci_payment_type.id=ficci_payment.payment_type_id');
		$query = $this->db->get();

		//echo $this->db->last_query(); die;

		return $query->result();

	}
	
	
	
}



?>