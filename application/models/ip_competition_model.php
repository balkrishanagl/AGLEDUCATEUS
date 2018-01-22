<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class ip_competition_model extends CI_Model
{
	function listCompetition($id=null){
		$this->db->select('*');
        $this->db->from('ficci_ip_competition_law');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getCompetitionByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_ip_competition_law');
		  return $result = $q->row();
	}
	
	
	function add_competition_data($data)
	{
		$this->db->insert('ficci_ip_competition_law',$data);
		return $this->db->insert_id();
	}
	
	
	function updateCompetition($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_ip_competition_law',$data);
		
		return true;
	}

	function get_competition_detail()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->from('ficci_ip_competition_law');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getCompetitionBySearch($search){
		
		$this->db->select('name,description');
		$this->db->where('status', '1');
		$this->db->like('name', $search);
        $this->db->from('ficci_ip_competition_law');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
	
	function deleteCompetition($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_ip_competition_law',$status); 
		return true;
	}
	
	function get_competition_home_page()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->limit(4);
		$this->db->from('ficci_ip_competition_law');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}
?>