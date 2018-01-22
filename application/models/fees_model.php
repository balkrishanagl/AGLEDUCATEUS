<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Fees_model extends CI_Model
{
	function listfees($id=null){
		$this->db->select('user_type_fees.*');
		$this->db->select('admin_user_type.user_type_name');
        $this->db->from('user_type_fees');
		$this->db->join('admin_user_type','admin_user_type.user_type_id=user_type_fees.user_type_id');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getfeesByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('user_type_fees');
		  return $result = $q->row();
	}
	
		
	
	function add_fees_data($data)
	{
		$this->db->insert('user_type_fees',$data);
		return $this->db->insert_id();
	}
	
	
	function updatefees($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('user_type_fees',$data);
		
		return true;
	}
	
	function chkFeeByTypeId($id){
		
		$this->db->select('*');
		$this->db->where('user_type_id', $id);
        $q = $this->db->get('user_type_fees');
		
		return $result = $q->row();
		
	}

	
	
	function deleteCategory($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_categories',$status); 
		return true;
	}
	
	function getAllFees(){
		$this->db->select('user_type_fees.*');
		$this->db->select('admin_user_type.user_type_name');
        $this->db->from('user_type_fees');
		$this->db->join('admin_user_type','admin_user_type.user_type_id=user_type_fees.user_type_id');
		$this->db->where('user_type_fees.status', 1);
        $query = $this->db->get();
        return $result = $query->result();
	}
}
?>