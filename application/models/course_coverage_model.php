<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class course_coverage_model extends CI_Model
{
	function listCourseCoverage($id=null){
		$this->db->select('*');
        $this->db->from('ficci_course_coverage');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getCourseCoverageByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_course_coverage');
		  return $result = $q->row();
	}
	
	
	function add_coverage_data($data)
	{
		$this->db->insert('ficci_course_coverage',$data);
		return $this->db->insert_id();
	}
	
	
	function updateCoverage($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_course_coverage',$data);
		
		return true;
	}

	function get_coverage_detail()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->from('ficci_course_coverage');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getCoverageBySearch($search){
		
		$this->db->select('name,description');
		$this->db->where('status', '1');
		$this->db->like('name', $search);
        $this->db->from('ficci_course_coverage');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
	
	function deleteCoverage($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_course_coverage',$status); 
		return true;
	}
	
	function get_coverage_home_page()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->limit(6);
		$this->db->from('ficci_course_coverage');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}
?>