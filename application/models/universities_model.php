<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class universities_model extends CI_model
{
		function add_universities_data($data)
	{
		$this->db->insert('edu_universities',$data);
		return $this->db->insert_id();
	}
	
	
	
	function get_universities_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_universities');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_universities_list()
	{
		 $this->db->select('*');
        $this->db->from('edu_universities');
		$this->db->where('status', 'Active');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_universities_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_universities');
		  return $result = $q->row();
	}
	
	
	function update_universities_data($data_update_insurance_partner,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_universities',$data_update_insurance_partner);	
		
	}
	
	
	function delete_universities_by_id($id,$status){
		
		 $this->db->where('id', $id);
		$this->db->update('edu_universities',$status); 
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
		$query = $this->db->get("edu_universities",$limit, $start);
		if ($query->num_rows() > 0) {
        	return $query->result_array();
      	}
	  
		return false;
		
	}
	
	
	function get_universities_data($slug){
		
		$this->db->select('*');
		$this->db->where('slug', $slug);
        $q = $this->db->get('edu_universities');
		return $result = $q->row();
	}
	
	function get_all_universities()
	{
		 $this->db->select('*');
		 $this->db->where('status', '1');
        $this->db->from('edu_universities');
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

	
}

?>