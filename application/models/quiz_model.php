<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Quiz_model extends CI_Model
{
	function listQuiz($id=null){
		$this->db->select('ficci_quiz.*');
		$this->db->select('ficci_session.start_on as sessionStart,ficci_session.end_on as sessionEnd,ficci_session.name as session');
		$this->db->select('admin_user.username');
		$this->db->from('ficci_quiz');
		if($id!=null){
			$this->db->where('created_by',$id);
		}
		$this->db->join('admin_user','admin_user.id=ficci_quiz.created_by');
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->order_by('id','desc');

		$query = $this->db->get();
 
		return $query->result();
		
		
	}
	
	function listQuizFront($type){
		//$now = 'date_format(DATE_ADD(now(),INTERVAL "5:30" HOUR_MINUTE ),"%l:%i %p")';
		//$now = 'date_format(now(),"%l:%i %p")';
		//$now = 'date_format(now(),"%H:%i:%s")';
		//$now = 'date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%H:%i:%s")';
		$now = 'date_format(DATE_ADD(now(),INTERVAL "5:30" HOUR_MINUTE ),"%H:%i:%s")';
		$this->db->select('ficci_quiz.*');
		$this->db->select('ficci_session.start_on as sessionStart,ficci_session.end_on as sessionEnd');
		$this->db->select('admin_user.username');
		$this->db->from('ficci_quiz');
		
		$this->db->join('admin_user','admin_user.id=ficci_quiz.created_by');
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") >= ficci_session.start_on');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") <= ficci_session.end_on');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") = ficci_quiz.exam_date');
		$this->db->where($now.' >= ficci_quiz.start_time');
		$this->db->where($now.' <= ficci_quiz.end_time');
		$this->db->where('ficci_quiz.type',$type);
		$this->db->where('ficci_quiz.status',1);

		$query = $this->db->get();
		//echo  $this->db->last_query(); die;
		
		
		return $query->result();
		
		
	}
	
	function getQuizByID($id){
		$this->db->select('*');
		$this->db->from('ficci_quiz');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function addQuiz($data){
		$this->db->insert('ficci_quiz',$data);
		return $this->db->insert_id();
	}
	
	function updateQuiz($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_quiz',$data);
		
		return true;
	}

	function deleteQuiz($id){
		$this->db->where('id', $id);
		$this->db->delete('ficci_quiz');
		return true;
	}
	
	
	function getTotalQuizBySession($session){
		
		$this->db->select('COUNT(*)');
		$this->db->from('ficci_quiz');
		
		
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->where('ficci_quiz.session_id',$session);
		$this->db->where('ficci_quiz.status',1);

		$query = $this->db->get();
		$result  = $query->row_array();
		$count = $result['COUNT(*)'];
		return $count;
		
	}
	
	function createQuizResult($data){
		$this->db->insert('ficci_exam_result',$data);
		return $this->db->insert_id();
	}
	
	function isQuizRunning($quizId,$userId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$userId);
		$query = $this->db->get();
		return $query->result();
		
	}
	
	function updateResult($quiz_id,$user_id,$data){
		
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('ficci_exam_result',$data);
		
		return true;
	}
	
	function addQuizResult($quiz_id,$user_id,$data){
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('user_id',$user_id);
		$this->db->update('ficci_exam_result',$data);
		return true;
	}
	
	/* function PendingQuiz($userId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('user_id',$userId);
		$this->db->where('status','pending');
		$this->db->where('duration <',60);
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
		
	} */
	
	function PendingQuiz($userId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->join('ficci_quiz','ficci_quiz.id=ficci_exam_result.quiz_id');
		$this->db->where('ficci_exam_result.user_id',$userId);
		$this->db->where('ficci_exam_result.status','pending');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") = ficci_quiz.exam_date');
		$this->db->where('ficci_exam_result.duration <',60);
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
		
	}
	
	function getReExams($userId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->join('ficci_quiz','ficci_quiz.id=ficci_exam_result.quiz_id');
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->where('ficci_exam_result.user_id',$userId);
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") >= ficci_session.start_on');
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") <= ficci_session.end_on');
		$this->db->where('ficci_exam_result.re_exam',1);
		
				
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
		
	}
	
	
	function getSessionByQuizId($id=null){
		$this->db->select('ficci_session.start_on as sessionStart,ficci_session.end_on as sessionEnd');
		$this->db->from('ficci_quiz');
		
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->where('ficci_quiz.id',$id);

		$query = $this->db->get();
		/* $str = $this->db->last_query();
		echo $str; die; */
		return $query->result();
		
		
	}
	
	function getResult($id,$user_id){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('quiz_id',$id);
		$this->db->where('user_id',$user_id);
		$this->db->where('status','done');
		
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	function allResultList($from=null,$to=null,$type=null){
		
		$this->db->select('ficci_quiz.*');
		$this->db->select('ficci_session.start_on as sessionStart,ficci_session.end_on as sessionEnd');
		$this->db->select('user_profiles.first_name,user_profiles.last_name');
		$this->db->select('ficci_exam_result.*');
		$this->db->from('ficci_quiz');
	
		$this->db->join('ficci_session','ficci_session.id=ficci_quiz.session_id');
		$this->db->join('ficci_exam_result','ficci_exam_result.quiz_id=ficci_quiz.id');
		$this->db->join('user_profiles','user_profiles.user_id=ficci_exam_result.user_id');
		
		if($from!=null){
			$this->db->where('ficci_exam_result.created >=',$from);
		}
		
		if($to!=null){
			$this->db->where('ficci_exam_result.created <=',$to);
		}
		
		if($type!=null){
			$this->db->where('ficci_exam_result.exam_type =',$type);
		}

		$query = $this->db->get();
 
		return $query->result();
		
	}
	function getFinalMarksByid($Iid)
	{
		$this->db->select('final_marks,grace_marks');
		$this->db->where('id',$Iid);
		$query = $this->db->get('ficci_exam_result');
		return $res = $query->row();
	}
	function updatemarks($graceMarks,$Iid)
	{
		$this->db->where('id',$Iid);
		$this->db->update('ficci_exam_result',$graceMarks);
	}
	/* For Cron */
	
	function getAllQuizForCron(){
		$this->db->select('*');
		$this->db->from('ficci_quiz');
		//$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	function isQuizRunnings($quizId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('quiz_id',$quizId);
		$this->db->where('status','pending');
		//$this->db->where('user_id',$userId);
		$query = $this->db->get();
		return $query->result();
	}
	function updateResults($quiz_id,$exr_id,$data){
		
		$this->db->where('quiz_id',$quiz_id);
		$this->db->where('id',$exr_id);
		$this->db->update('ficci_exam_result',$data);
		return true;
	}
	
	function getResultBySessionId($sessionId=null){
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('session_id',$sessionId);
		$this->db->where('exam_type','main');

		$query = $this->db->get();

		return $query->result();
		
		
	}
	
	function getExpiredQuizBySessionId($sessionId){
		
		$this->db->select('*');
		$this->db->from('ficci_quiz');
		$this->db->where('session_id',$sessionId);
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") > exam_date');
		$this->db->where('type','main');
		$this->db->where('status','1');

		$query = $this->db->get();

		return $query->result();
		
	}
	
	function getStudentResult($quizId,$studentId){
		
		$this->db->select('*');
		$this->db->from('ficci_exam_result');
		$this->db->where('quiz_id',$quizId);
		$this->db->where('user_id',$studentId);
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
		
	}
	
	function getSessionFailedStudent($session){
		
		$this->db->select('ficci_exam_result.*');
		$this->db->from('ficci_exam_result');
		$this->db->join('ficci_quiz','ficci_quiz.id=ficci_exam_result.quiz_id');
		$this->db->where('ficci_exam_result.session_id',$session);
		$this->db->where('ficci_exam_result.exam_type', 'main');
		$this->db->where('ficci_exam_result.re_exam',1);
		$this->db->where('date_format(DATE_ADD(now(),INTERVAL "12:30" HOUR_MINUTE ),"%Y-%m-%d") > ficci_quiz.exam_date');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
		
	}
	
}
?>