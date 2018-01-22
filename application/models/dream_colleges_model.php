<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dream_colleges_model extends CI_model
{
		function add_collage_data($data)
	{
		$this->db->insert('edu_dream_college',$data);
		return $this->db->insert_id();
	}
	
	
	
	function get_collage_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_dream_college');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_collage_list()
	{
		 $this->db->select('*');
        $this->db->from('edu_dream_college');
		$this->db->where('status', 'Active');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_collage_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_dream_college');
		  return $result = $q->row();
	}
	
	
	function update_collage_data($data_update_insurance_partner,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_dream_college',$data_update_insurance_partner);	
		
	}
	
	
	function delete_collage_by_id($id,$status){
		
		 $this->db->where('id', $id);
		$this->db->update('edu_dream_college',$status); 
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
		$query = $this->db->get("edu_dream_college",$limit, $start);
		if ($query->num_rows() > 0) {
        	return $query->result_array();
      	}
	  
		return false;
		
	}
	
	
	function get_collage_data($slug){
		
		$this->db->select('*');
		$this->db->where('slug', $slug);
        $q = $this->db->get('edu_dream_college');
		return $result = $q->row();
	}
	
	function get_all_collages()
	{
		 $this->db->select('*');
		 $this->db->where('status', '1');
        $this->db->from('edu_dream_college');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	/*function get_year_month(){
		
		$this->db->select('YEAR(start_date) as year,MONTHNAME(start_date) as month');
		//$this->db->group_by('YEAR(created)');
		$this->db->group_by('MONTH(start_date)');
		$this->db->order_by('YEAR(start_date)','ASEC');
		$this->db->order_by('MONTH(start_date)','ASEC');
		$this->db->where('status', '1');
        $this->db->from('ehcc_news_event');
		$this->db->limit(6, 0);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $result = $query->result();
	}
	
	function get_news_events_by_month_year($q)
	{
		 $this->db->select('*');
		 $this->db->where('status', '1');
		 $this->db->where('DATE_FORMAT(start_date,"%Y-%m")', $q);
        $this->db->from('ehcc_news_event');
        $query = $this->db->get();
		
		
        return $result = $query->result();
		
	}*/

	function get_all_collage_latest()
	{
		$this->db->where('status', '1');
		$this->db->limit('5');
		$this->db->order_by('id','desc');
		$query = $this->db->get('edu_dream_college');
		return $res = $query->result();
	}

	
	function getRecordByPartnername($insName,$Id)
	{
		$this->db->where('name',$insName);
		$this->db->where('id !=',$Id);
		$query = $this->db->get('edu_dream_college');
		return $res = $query->result();
		
	}
	
	function get_collage_data_by_city($city)
	{
		$this->db->select('*');
		$this->db->where('city', $city);
		$this->db->where('status', 'Active');
        $q = $this->db->get('edu_dream_college');
		return $res = $q->result();
	}





		
	
	
	
}

?>