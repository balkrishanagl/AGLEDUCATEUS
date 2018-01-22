<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class study_material_model extends CI_Model
{
	function liststudy_material(){
		$this->db->select('*');
		$this->db->from('ficci_study_material');
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	function getstudy_materialByID($id){
		$this->db->select('*');
		$this->db->from('ficci_study_material');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	function addstudy_material($data){
		$this->db->insert('ficci_study_material',$data);
		return $this->db->insert_id();
	}
	
	function updatestudy_material($data,$id){
		$this->db->where('id',$id);
		$this->db->update('ficci_study_material',$data);
		return true;
	}

	function deletestudy_material($id){
		$this->db->where('id', $id);
		$this->db->delete('ficci_study_material');
		return true;
	}
}
?>