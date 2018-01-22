<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Menu_model extends CI_Model
{
	function listMenu($id=null){
		$this->db->select('*');
        $this->db->from('edu_menu');
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getMenuByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_menu');
		  return $result = $q->row();
	}
	
	function getAllActiveMenu(){
		$this->db->select('id,name');
		$this->db->where('status', '1');
        $q = $this->db->get('edu_menu');
		  return $result = $q->result();
	}
	
	
	function add_menu_data($data)
	{
		$this->db->insert('edu_menu',$data);
		return $this->db->insert_id();
	}
	
	
	function updateMenu($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_menu',$data);
		
		return true;
	}

	
	
	function deleteMenu($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('edu_menu',$status); 
		return true;
	}
	
	
}
?>