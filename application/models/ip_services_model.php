<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ip_services_model extends CI_model
{
		function add_ip_services_data($data)
	{
		$this->db->insert('ficci_ip_services',$data);
		return $this->db->insert_id();
	}
	
	
	function get_ip_services_detail()
	{
		 $this->db->select('*');
		 $this->db->from('ficci_ip_services');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_ip_services_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_ip_services');
		  return $result = $q->row();
	}
	
	
	function update_ip_services_data($data_update_page,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_ip_services',$data_update_page);	
		
	}
	
	
	function delete_ip_services_by_id($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('ficci_ip_services',$status); 
		return true;
	}
	
	 function front_ip_services(){
		$this->db->select('*');
		$this->db->where('page_status', '1');
        $this->db->from('ficci_ip_services');
        $query = $this->db->get();
        return $result = $query->result();
	} 
	
	function get_front_page_data($slug)
	{
		$this->db->select('*');
		$this->db->where('page_status', '1');
		$this->db->where('page_slug', $slug);
		
		
        $q = $this->db->get('ficci_ip_services');
		  return $result = $q->row();	
		
	}
	
	function getServiceBySearch($search){
		
		$this->db->select('page_title,page_content,page_slug');
		$this->db->where('page_status', '1');
		$this->db->like('page_title', $search);
        $this->db->from('ficci_ip_services');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
	
	
}


?>