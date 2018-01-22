<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class page_model extends CI_model
{
		function add_page_data($data)
	{
		$this->db->insert('edu_pages',$data);
		return $this->db->insert_id();
	}
	
	
	function get_page_detail()
	{
		$this->db->select('*');
        $this->db->from('edu_pages');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_page_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_pages');
		  return $result = $q->row();
	}
	
	
	function update_page_data($data_update_page,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_pages',$data_update_page);	
		
	}
	
	
	function delete_page_by_id($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('edu_pages',$status); 
		return true;
	}
	
	
	function get_front_page_data($slug)
	{
		$this->db->select('*');
		$this->db->where('page_slug', $slug);
		$this->db->where('page_status', '1');
		
        $q = $this->db->get('edu_pages');
		  return $result = $q->row();	
		
	}
	
	function get_front_event_data()
	{
	   $this->db->select('*');
        $this->db->from('edu_event');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
		function get_front_announcement_data()
	{
	   $this->db->select('*');
        $this->db->from('edu_announcement');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getPageBySearch($search){
		
		$this->db->select('page_title,page_content,page_slug');
		$this->db->where('page_status', '1');
		$this->db->like('page_title', $search);
        $this->db->from('edu_pages');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
	
}


?>