<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Nationality_model extends CI_Model
{
	function listNat($id=null){
		$this->db->select('*');
        $this->db->from('ficci_nationality');
		$query = $this->db->get();
        return $result = $query->result();
		
		
	}
	
	function getNatByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_nationality');
		  return $result = $q->row();
	}
	
	function getAllActiveNat(){
		$this->db->select('*');
        $this->db->from('ficci_nationality');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	
	function add_nat_data($data)
	{
		$this->db->insert('ficci_nationality',$data);
		return $this->db->insert_id();
	}
	
	
	function updateNat($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_nationality',$data);
		
		return true;
	}
	function statusNat($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_nationality',$status); 
		return true;
	}
	
	
	function deleteNat($id){
		
		$this->db->where('id', $id);
		$this->db->delete('ficci_nationality'); 
		return true;
	}
}
?>