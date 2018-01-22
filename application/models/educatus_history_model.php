<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class educatus_history_model extends CI_model
{
		function add_history_data($data)
	{
		$this->db->insert('edu_educatus_history',$data);
		return $this->db->insert_id();
	}
	
	
	
	function get_history_detail()
	{
		 $this->db->select('*');
        $this->db->from('edu_educatus_history');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_history_detail_front($limit)
	{
		$this->db->select('*');
        $this->db->from('edu_educatus_history');
		$this->db->where('status', '1');
		$this->db->order_by('year','ASC');
		$this->db->limit($limit);
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_history_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_educatus_history');
		  return $result = $q->row();
	}
	
	
	function update_history_data($data_update_insurance_partner,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_educatus_history',$data_update_insurance_partner);	
		
	}
	
	
	function delete_history_by_id($id,$status){
		
		 $this->db->where('id', $id);
		$this->db->update('edu_educatus_history',$status); 
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
		$query = $this->db->get("edu_educatus_history",$limit, $start);
		if ($query->num_rows() > 0) {
        	return $query->result_array();
      	}
	  
		return false;
		
	}
	
	
	function get_history_data($slug){
		
		$this->db->select('*');
		$this->db->where('slug', $slug);
        $q = $this->db->get('edu_educatus_history');
		return $result = $q->row();
	}
	
	function get_all_history()
	{
		 $this->db->select('*');
		 $this->db->where('status', '1');
        $this->db->from('edu_educatus_history');
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

	function get_all_history_latest()
	{
		$this->db->where('status', '1');
		$this->db->limit('5');
		$this->db->order_by('id','desc');
		$query = $this->db->get('edu_educatus_history');
		return $res = $query->result();
	}







		
	
	
	
}

?>