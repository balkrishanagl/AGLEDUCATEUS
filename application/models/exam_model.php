<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class Exam_model extends CI_model
{
		function add_exam_data($data)
	{
		$this->db->insert('ficci_exam',$data);
		return $this->db->insert_id();
	}
	
	
	function get_exam_detail()
	{
		 $this->db->select('*');
        $this->db->from('ficci_exam');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_exam_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_exam');
		  return $result = $q->row();
	}
	
	
	function update_exam_data($data_update_exam,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_exam',$data_update_exam);	
		
	}
	
	
	function delete_exam_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('ficci_exam'); 
		return true;
	}
	
	function getExamData($id)
	{
		$q = "select ficci_exam.*, users.email, user_profiles.first_name, user_profiles.last_name, user_profiles.user_image_file from ficci_exam INNER JOIN user_profiles ON user_profiles.exam_id=ficci_exam.id INNER JOIN users ON users.id=user_profiles.user_id where users.email='".$id."'";
	
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			//echo "<pre>"; print_r($query->row()); die;
			return $query->row();
		}
		else
		{
			return NULL;
		}
		
	}
	
}


?>