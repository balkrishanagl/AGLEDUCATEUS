<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Faq_model extends CI_Model
{
	function listFaq($id=null){
		$this->db->select('*');
		$this->db->order_by('id','desc');
        $this->db->from('edu_faq');
		$query = $this->db->get();
        return $result = $query->result();
		
		
	}
	
	function getFaqByID($id){
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_faq');
		  return $result = $q->row();
	}
	function getorderIDByFaqId($id,$orderNo){
		$this->db->select('*');
		$this->db->where('id !=', $id);
		$this->db->where('order_no', $orderNo);
        $q = $this->db->get('edu_faq');
		  return $result = $q->row();
	}
	
	function getAllActiveFaq(){
		$this->db->select('*');
        $this->db->from('edu_faq');
		$this->db->where('status', '1');
		$this->db->order_by('order_no','ASC');
		
        $query = $this->db->get();
		
		
        return $result = $query->result();
	}
	
	
	function add_faq_data($data)
	{
		$this->db->insert('edu_faq',$data);
		return $this->db->insert_id();
	}
	
	
	function updateFaq($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_faq',$data);
		
		return true;
	}
	
	
	
	function deleteFaq($id,$status){
		
		$this->db->where('id', $id);
		$this->db->update('edu_faq',$status); 
		return true;
	}
	
	function getActiveFaq($limit){
		$this->db->select('*');
        $this->db->from('edu_faq');
		$this->db->where('status', '1');
		$this->db->limit($limit);
		$this->db->order_by('order_no','ASC');
		
        $query = $this->db->get();
		
		
        return $result = $query->result();
	}
}
?>