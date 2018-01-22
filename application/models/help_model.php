<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class help_model extends CI_model
{
		function add_help_data($data)
	{
		$this->db->insert('edu_help',$data);
		return $this->db->insert_id();
	}
	
	
	function get_help_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_help');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_help_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_help');
		  return $result = $q->row();
	}
	
	
	function update_help_data($data_update_help,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_help',$data_update_help);	
		
	}
	
	
	function delete_help_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('edu_help'); 
		return true;
	}
	
	function get_help_front()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		$this->db->limit(5);
		$this->db->from('edu_help');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}


?>