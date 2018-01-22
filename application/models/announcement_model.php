<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class announcement_model extends CI_model
{
		function add_announcement_data($data)
	{
		$this->db->insert('ficci_announcement',$data);
		return $this->db->insert_id();
	}
	
	
	function get_announcement_detail()
	{
		 $this->db->select('*');
	     $this->db->from('ficci_announcement');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $result = $query->result();
		
	}
	
	function get_announcement_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_announcement');
		  return $result = $q->row();
	}
	
	
	function update_announcement_data($data_update_announcement,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_announcement',$data_update_announcement);	
		
	}
	
	
	function delete_announcement_by_id($id, $status){
		$this->db->where('id', $id);
		$this->db->update('ficci_announcement',$status); 
		return true;
	}
	
		function get_active_announcement()
	{
		 $this->db->select('*');
        $this->db->from('ficci_announcement');
		$this->db->where('status','1');
		$this->db->order_by('id','desc');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}


?>