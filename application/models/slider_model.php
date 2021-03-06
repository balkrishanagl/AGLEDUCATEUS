<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma

class Slider_model extends CI_model
{
		function add_slider_data($data)
	{
		$this->db->insert('edu_slider',$data);
		return $this->db->insert_id();
	}
	
	
	function get_slider_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_slider');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_slider_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_slider');
		  return $result = $q->row();
	}
	
	
	function update_slider_data($data_update_slider,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_slider',$data_update_slider);	
		
	}
	
	
	function delete_slider_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('edu_slider'); 
		return true;
	}
	
	function get_slider_detail_front()
	{
		 $this->db->select('*');
        $this->db->from('edu_slider');
		$this->db->where('status','1');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	
	
}


?>