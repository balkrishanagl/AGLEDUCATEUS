<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Source_model extends CI_model
{
		function add_source_data($data)
	{
		$this->db->insert('edu_source_information',$data);
		return $this->db->insert_id();
	}
	
	
	function get_source_detail()
	{
		$this->db->select('*');
		$this->db->where('status', '1');
		//$this->db->order_by('id','DESC');
		$this->db->order_by('order_no','ASC');
        $this->db->from('edu_source_information');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_source_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_source_information');
		  return $result = $q->row();
	}
	
	
	function update_source_data($data_update_source,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_source_information',$data_update_source);	
		
	}
	
	
	function delete_source_by_id($id){
		
		$this->db->where('id', $id);
		$this->db->set('status', '0');
		$this->db->update('edu_source_information'); 
		return true;
	}
	
	function updateCountSoi($id){
		$this->db->set('count', 'count+1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('edu_source_information');
	}
	
	function insrtStndtClntData($data){
		$this->db->insert('edu_source_information',$data);
		return $this->db->insert_id();
	}

	function decrsCountSoi($id){
		$this->db->set('count', 'count-1', FALSE);
		$this->db->where('id', $id);
		$this->db->update('edu_source_information');
	}
	
	function getorderIDBySourceId($id,$orderNo){
		$this->db->select('*');
		$this->db->where('id !=', $id);
		$this->db->where('order_no', $orderNo);
        $q = $this->db->get('edu_source_information');
		  return $result = $q->row();
	}
	
	function get_source_detail_front()
	{
		$this->db->select('*');
		$this->db->where('status', '1');
		$this->db->order_by('order_no','ASC');
        $this->db->from('edu_source_information');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
}


?>