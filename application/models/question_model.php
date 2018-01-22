<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Question_model extends CI_Model
{
	function listQuestion($id=null){
		$this->db->select('ficci_question.*');
		$this->db->select('ficci_quiz.name');
		$this->db->from('ficci_question');
		$this->db->order_by('ficci_question.id','DESC');
		if($id!=null){
			$this->db->where('ficci_quiz.created_by',$id);
		}
		$this->db->join('ficci_quiz','ficci_quiz.id=ficci_question.quiz_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getQuestionByID($id){
		$this->db->select('*');
		$this->db->from('ficci_question');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	//Get Qestion by Quiz
		function getQuestionByQuizID($id){
		$this->db->select('*');
		$this->db->from('ficci_question');
		$this->db->where('quiz_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	function addQuestion($data){
		$this->db->insert('ficci_question',$data);
		return $this->db->insert_id();
	}
	
	function updateQuestion($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_question',$data);
		
		return true;
	}

	function deleteQuestion($id){
		$this->db->where('id', $id);
		$this->db->delete('ficci_question');
		return true;
	}
	
	function getQuizByUser($id=null){
		$this->db->select('*');
		$this->db->from('ficci_quiz');
		if($id!=null){
			$this->db->where('created_by',$id);
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	
	function quiz_Correct_Choice($qid=Null)
	{
		$this->db->select('correct_choice');
		$this->db->from('ficci_question');
		$this->db->where('quiz_id',$qid);
		$query = $this->db->get();
		return $query->result();
	}
}
?>