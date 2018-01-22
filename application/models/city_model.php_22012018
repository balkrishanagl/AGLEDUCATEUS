<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Amit Chaudhary

class City_model extends CI_model
{
		function add_city_data($data)
	{
		$this->db->insert('edu_state_city',$data);
		return $this->db->insert_id();
	}
	
	
	function get_city_detail()
	{
		 $this->db->select('*');
		 $this->db->order_by('id','DESC');
        $this->db->from('edu_state_city');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_city_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_state_city');
		  return $result = $q->row();
	}
	
	
	function update_city_data($data_update_city,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_state_city',$data_update_city);
		
	}
	
	
	function delete_city_by_id($id){
		
		  $this->db->where('id', $id);
      $this->db->delete('edu_state_city');
		return true;
	}
	
	function getAllActiveCityList()
	{
		//$this->db->where('status','1');
		$this->db->order_by('city_name','asc');
		$query = $this->db->get('edu_state_city');
		return $res = $query->result();
	}
	function getCityDetailByName($cityName)
	{
		
		$this->db->where('city_name',$cityName);
		$query=$this->db->get('edu_state_city');
		return $res = $query->row();
	}
	function getStateDetailByName($stateName)
	{
		
		$this->db->where('state_name',$stateName);
		$query=$this->db->get('edu_state_city');
		return $res = $query->row();
	}
	
	function getStateData()
	{
		$this->db->select('edu_state_city.state_name');
		$this->db->from('edu_state_city');
		$this->db->where('edu_state_city.state_name !=','');
		$this->db->group_by('edu_state_city.state_name');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	function get_city_data_by_type($type)
	{
		 $this->db->select('*');
		 $this->db->order_by('city_name','asc');
        $this->db->from('edu_state_city');
		$this->db->where('type',$type);
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getcityByStateCity($stateName,$cityName,$id=null){
		$this->db->where('state_name',$stateName);
		$this->db->where('city_name',$cityName);
		
		if($id != null){
			$this->db->where('id !=',$id);
		}
		
		$query=$this->db->get('edu_state_city');
		return $res = $query->row();
	}
	
}


?>