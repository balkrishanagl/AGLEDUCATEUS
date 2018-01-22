<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class news_model extends CI_model
{
		function add_news_data($data)
	{
		$this->db->insert('edu_news',$data);
		return $this->db->insert_id();
	}
	
	
	function get_news_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_news');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_news_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_news');
		  return $result = $q->row();
	}
	
	
	function update_news_data($data_update_news,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_news',$data_update_news);	
		
	}
	
	
	function delete_news_by_id($id,$status){
		
		  $this->db->where('id', $id);
      $this->db->update('edu_news',$status); 
		return true;
	}
	
	function getLatestNews(){
		$this->db->select('*');
		$this->db->from('edu_news');
		$this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function get_front_page_news($num=NULL,$offset=NULL,$year=NULL,$month=NULL)
	{
		/* $this->db->select('*');
		$this->db->where('status', '1');
		$q = $this->db->get('edu_news');
		return $result = $q->result(); */
	}

	function getNewsYear(){
		
		$this->db->select('Year(created) As Year');
		$this->db->where('status', '1');
        $this->db->from('edu_news');
        $query = $this->db->get();
        return $result = $query->result_array();
	}
	
	
	function getNewsByMonthYear($year=NULL,$month=NULL,$num=NULL,$offset=NULL){
		
		/* $this->db->select('*');
			$this->db->where('Year(created)', $year);
			$this->db->where('Month(created)', $month);
       // $this->db->from('edu_news');
        //$query = $this->db->get('edu_news',$num,$offset);

	
	}
	
	
	function getNewsBySearch($search){
		
		$this->db->select('news_title,content,slug');
		$this->db->where('status', '1');
		$this->db->like('news_title', $search);
        $this->db->from('edu_news');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}
}


?>