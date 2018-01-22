<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Assignment_model extends CI_Model
{
	function listAssignment(){
		$this->db->select('*');
		$this->db->from('ficci_assignments');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	function listStudentAssignment($id){
		$this->db->select('ficci_student_assignment.id,SUM(ficci_student_assignment.mark_obtained) as total_marks');
		$this->db->select('users.username');
		$this->db->select('ficci_assignments.filename');
		$this->db->select('ficci_assignments.total_mark');
		$this->db->from('ficci_student_assignment');
		
		$this->db->join('users','users.id=ficci_student_assignment.student_id','inner');
		$this->db->join('ficci_assignments','ficci_assignments.id=ficci_student_assignment.faculty_assignment_id','inner');
		
		$this->db->where('ficci_assignments.user_id',$id);
		$this->db->order_by('id','ASC');
		$this->db->group_by('users.username');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die; 
		return $query->result();
	}
	
	function getAssignmentByID($id){
		$this->db->select('*');
		$this->db->from('ficci_assignments');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
/* 	function getStudentAssignmentByID($id){
		$this->db->select('*');
		$this->db->from('ficci_student_assignment');
		$this->db->where('id',$id);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();

		return $query->result();
	} */
	
	function getStudentAssignmentByID($id){
		$this->db->select('ficci_student_assignment.*');
		$this->db->from('ficci_student_assignment');
		$this->db->join('users','users.id=ficci_student_assignment.student_id','inner');
		$this->db->join('ficci_assignments','ficci_assignments.id=ficci_student_assignment.faculty_assignment_id','inner');
		
		$this->db->where('ficci_assignments.user_id',$id);
		$this->db->order_by('ficci_student_assignment.id','DESC');
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result();
	}
	
	function addAssignment($data){
		$this->db->insert('ficci_assignments',$data);
		return $this->db->insert_id();
	}
	
	function updateAssignment($data,$id){
		$this->db->where('id',$id);
		$this->db->update('ficci_assignments',$data);
		return true;
	}

	function deleteAssignment($id,$status){
		$this->db->where('id', $id);
		$this->db->update('ficci_assignments',$status); 
		return true;
	}
	
	function getStudentAssignmentByStudentId($id){
		$this->db->select('*');
		$this->db->from('ficci_student_assignment');
		$this->db->where('student_id',$id);
		$query = $this->db->get();
	
		return $query->result();
	}
	
	function getStudentAllAssignmentByID($student_id){
		$this->db->select('*');
		$this->db->from('ficci_student_assignment');
		$this->db->where('student_id',$student_id);
		$this->db->order_by('id','DESC');
		$query = $this->db->get();

		return $query->result();
	}
}
?>