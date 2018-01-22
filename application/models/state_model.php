<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Amit Chaudhary

class State_model extends CI_model
{
	function add_state_data($data)
	{
		$this->db->insert('fuccha_state_text',$data);
		return $this->db->insert_id();
	}
	
	
	function get_state_detail()
	{
		$this->db->select('*');
		$this->db->order_by('id','DESC');
        $this->db->from('fuccha_state_text');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_state_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('fuccha_state_text');
		  return $result = $q->row();
	}
	
	
	function update_state_data($data_update_city,$id){
		
		$this->db->where('id',$id);
		$this->db->update('fuccha_state_text',$data_update_city);
		
	}
	
	
	function delete_state_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('fuccha_state_text');
		return true;
	}
	
	function getAllActiveCityList()
	{
		$this->db->where('status','1');
		$this->db->order_by('city_name','asc');
		$query = $this->db->get('fuccha_state_text');
		return $res = $query->result();
	}
	function getStateDetailByName($stateName)
	{
		
		$this->db->where('state_name',$stateName);
		$query=$this->db->get('fuccha_state_text');
		return $res = $query->row();
	}
	
}


?>