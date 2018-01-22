<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class counselor_model extends CI_model
{
		function add_counselor_data($data)
	{
		$this->db->insert('edu_counselor',$data);
		return $this->db->insert_id();
	}
	
	
	function get_counselor_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_counselor');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_counselor_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_counselor');
		  return $result = $q->row();
	}
	
	
	function update_counselor_data($data_update_testimonial,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_counselor',$data_update_testimonial);	
		
	}
	
	
	function delete_counselor_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('edu_counselor'); 
		return true;
	}
	
	function get_counselor_front()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		//$this->db->limit(5);
		$this->db->from('edu_counselor');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}


?>