<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Forum_model extends CI_Model
{
	function addTopic($data)
	{
		$this->db->insert('ficci_topic',$data);
		return $this->db->insert_id();
	}
	
	function addComment($data)
	{
		$this->db->insert('ficci_comment',$data);
		return $this->db->insert_id();
	}	
	
	function getTopics()
	{
		 $this->db->select('*');
        $this->db->from('ficci_topic');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getComments()
	{
		$this->db->select('ficci_comment.*');
		$this->db->select('users.username');
        $this->db->from('ficci_comment');
		$this->db->join('users','users.id=ficci_comment.user_id','inner');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function getTopicByID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_topic');
		return $result = $q->row();
	}
	
	function getCommentByID($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('ficci_comment');
		return $result = $q->row();
	}
	
	function getTopicCommentCount($id)
	{
		$this->db->select('*');
		$this->db->where('topic_id', $id);
        $q = $this->db->get('ficci_comment');
		return $result = $q->num_rows();
	}
	
	function getTopicUserCount($id)
	{
		$this->db->select('*');
		$this->db->where('topic_id', $id);
		$this->db->group_by('user_id');
        $q = $this->db->get('ficci_comment');
		return $result = $q->num_rows();
	}
	
	function getTopicComments($id)
	{
		$this->db->select('ficci_comment.*');
		$this->db->select('users.username');
		$this->db->join('users','users.id=ficci_comment.user_id','inner');
		$this->db->where('user_id', $id);
		$this->db->where('ficci_comment.status', 1);
		$this->db->order_by('id', 'desc');
        $q = $this->db->get('ficci_comment');
		return $result = $q->result_array();
	}
	
	function updateTopic($data,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_topic',$data);	
		
	}
	
	function updateComment($data,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_comment',$data);	
		
	}
	function updateReplyComment($data,$id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_comment',$data);	
		
	}
	
	function deleteTopicByID($id){
		
		$this->db->where('id', $id);
		$this->db->delete('ficci_topic'); 
		return true;
	}
	
	function deleteCommentByID($id){
		
		$this->db->where('id', $id);
		$this->db->delete('ficci_comment'); 
		return true;
	}
	
	function changestatus($id,$status)
	{
	
	  $this->db->where('id',$id);
      $this->db->update('ficci_comment',$status);
      return true;
		
	}
	
}
?>