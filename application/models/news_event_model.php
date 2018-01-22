<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//  Created by Manoj sharma


class news_event_model extends CI_model
{
		function add_event_data($data)
	{
		$this->db->insert('edu_news_event',$data);
		return $this->db->insert_id();
	}
	
	public function total_count() {
       return $this->db->count_all("edu_news_event");
    }
	
	function get_event_detail()
	function get_event_detail_by_slug($slug)
	{
		 $this->db->select('edu_news_event.id as event_id,edu_news_event.status as event_status,edu_news_event.*');
        $this->db->from('edu_news_event');
		$this->db->order_by('edu_news_event.id','DESC');
        $query = $this->db->get();
         return $result = $query->row();
		
	}
	
	function get_event_detail_front()
	{
		 $this->db->select('edu_news_event.*');
        $this->db->from('edu_news_event');
		$this->db->where('edu_news_event.status', '1');
		$this->db->order_by('edu_news_event.id','DESC');
		$this->db->limit(8);
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_event_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_news_event');
		  return $result = $q->row();
	}
	
	
	function update_event_data($data_update_event,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_news_event',$data_update_event);	
		
	}
	
	
	function delete_event_by_id($id,$status){
		
		 $this->db->where('id', $id);
		$this->db->update('edu_news_event',$status); 
		return true;
	}
	
	
	
	function get_front_page_data($limit, $start)
	{
	/* 	$this->db->select('*');
		$this->db->order_by('start_date','DESC');
		$this->db->where('status', '1');
        $this->db->from('ficci_event');
        $query = $this->db->get();
        return $result = $query->result(); */
		
		//$this->db->limit($limit, $start);
		$query = $this->db->get("edu_news_event",$limit, $start);
		if ($query->num_rows() > 0) {
        return $query->result_array();
      }
	  
		return false;
		
	}
	
	function yearWiseData(){
		
		$this->db->select('Year(created) As Year,Count(*) As Total_Record');
		$this->db->group_by('Year(created)');
		$this->db->order_by('start_date','DESC');
		$this->db->where('status', '1');
        $this->db->from('edu_news_event');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function getEventBySearch($search){
		
		$this->db->select('name,event_content,slug');
		$this->db->where('status', '1');
		$this->db->like('name', $search);
        $this->db->from('edu_news_event');
        $query = $this->db->get();
		
        return $result = $query->result();
	}
	
	function get_news_event_data($slug){
		
		$this->db->select('*');
		$this->db->where('slug', $slug);
        $q = $this->db->get('edu_news_event');
		return $result = $q->row();
	}
	
	function get_all_news_events()
	{
		 $this->db->select('*');
		 $this->db->where('status', '1');
        $this->db->from('edu_news_event');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
}


?>