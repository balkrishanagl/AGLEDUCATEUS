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
		return $result = $q->result(); */				$this->db->select('*');        $this->db->where('status', '1');		if($year != null){			$this->db->where_in('Year(created)', $year);		}		if($month != null){			$this->db->where_in('Month(created)', $month);		}		$this->db->order_by('id','ASC');		$query = $this->db->get('edu_news',$num,$offset);		//echo $this->db->last_query(); 		return $result = $query->result();
	}			function get_news_by_slug($slug)	{		$this->db->select('*');		$this->db->from('edu_news');		$this->db->where('slug', $slug);		$query = $this->db->get();        return $result = $query->row();	}

	function getNewsYear(){
		
		$this->db->select('Year(created) As Year');		$this->db->group_by('YEAR(created)');		$this->db->order_by('YEAR(created)','DESC');
		$this->db->where('status', '1');
        $this->db->from('edu_news');
        $query = $this->db->get();
        return $result = $query->result_array();
	}		function getNewsMonth(){				$this->db->select('Monthname(created) As Month,Month(created) As month_val');		$this->db->group_by('Monthname(created)');		$this->db->order_by('Monthname(created)','DESC');		$this->db->where('status', '1');        $this->db->from('edu_news');        $query = $this->db->get();        return $result = $query->result_array();	}
	
	
	function getNewsByMonthYear($year=NULL,$month=NULL,$num=NULL,$offset=NULL){
		
		/* $this->db->select('*');				if($year != null){
			$this->db->where('Year(created)', $year);		} */		/* if($month != null){
			$this->db->where('Month(created)', $month);		} */
       // $this->db->from('edu_news');
        //$query = $this->db->get('edu_news',$num,$offset);		//echo $this->db->last_query(); 		//return $result = $query->result();				$this->db->select('*');        $this->db->where('status', '1');		if($year != null){			$this->db->where_in('Year(created)', $year);		}		if($month != null){			$this->db->where_in('Month(created)', $month);		}		$this->db->order_by('id','desc');		$query = $this->db->get('edu_news',$num,$offset);		//echo $this->db->last_query(); 		return $result = $query->result();

	
	}
	
	
	function getNewsBySearch($search){
		
		$this->db->select('news_title,content,slug');
		$this->db->where('status', '1');
		$this->db->like('news_title', $search);
        $this->db->from('edu_news');
        $query = $this->db->get();
		
        return $result = $query->result();
		
	}		function update_views_counter($slug) {			$this->db->where('slug', urldecode($slug));		$this->db->select('views');		$count = $this->db->get('edu_news')->row();			$this->db->where('slug', urldecode($slug));		$this->db->set('views', ($count->views + 1));		$this->db->update('edu_news');	}				function get_most_viewd($limit){		$this->db->select('*');		$this->db->where('status','1');		$this->db->order_by('views','DESC');		$this->db->limit($limit);		$this->db->from('edu_news');        $query = $this->db->get();        return $result = $query->result();	}
}


?>