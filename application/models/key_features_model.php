<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class key_features_model extends CI_Model
{
	function listKeyFeature($id=null){
		$this->db->select('*');
        $this->db->from('ficci_key_features');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getFeatureByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_key_features');
		  return $result = $q->row();
	}
	
	
	function add_features_data($data)
	{
		$this->db->insert('ficci_key_features',$data);
		return $this->db->insert_id();
	}
	
	
	function updateFeature($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_key_features',$data);
		
		return true;
	}

	function get_feature_detail()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->from('ficci_key_features');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getFeaturesBySearch($search){
		
		$this->db->select('name,description');
		$this->db->where('status', '1');
		$this->db->like('name', $search);
        $this->db->from('ficci_key_features');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
	
	function deleteFeature($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_key_features',$status); 
		return true;
	}
}
?>