<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class testimonial_model extends CI_model
{
		function add_testimonial_data($data)
	{
		$this->db->insert('ficci_testimonial',$data);
		return $this->db->insert_id();
	}
	
	
	function get_testimonial_detail()
	{
		 $this->db->select('*');
        $this->db->from('ficci_testimonial');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_testimonial_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_testimonial');
		  return $result = $q->row();
	}
	
	
	function update_testimonial_data($data_update_testimonial,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_testimonial',$data_update_testimonial);	
		
	}
	
	
	function delete_testimonial_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('ficci_testimonial'); 
		return true;
	}
	
	function get_testimonial_front()
	{
		$this->db->select('*');
		$this->db->where('status','1');
		//$this->db->limit(5);
		$this->db->from('ficci_testimonial');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}


?>