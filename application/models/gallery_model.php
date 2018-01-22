<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class gallery_model extends CI_Model
{
	function list_gallery(){
		$this->db->select('*');
		$this->db->from('edu_gallery');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	function get_gallery_ByID($id){
		$this->db->select('*');
		$this->db->from('edu_gallery');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	
	function add_gallery($data){
		$this->db->insert('edu_gallery',$data);
		return $this->db->insert_id();
	}
	
	function update_gallery($data,$id){
		$this->db->where('id',$id);
		$this->db->update('edu_gallery',$data);
		return true;
	}

	function delete_gallery($id){
		$this->db->where('id', $id);
		$this->db->delete('edu_gallery');
		return true;
	}
	function updateStatus($id,$status){
		$this->db->where('id', $id);
		$this->db->set('status',$status);
		$this->db->update('edu_gallery');
		return true;
	}
	function getAlldata(){
		$this->db->select('*');
		$this->db->where('status','Active');
		$this->db->order_by('id','desc');
		$this->db->from('edu_gallery');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getGalleryByType($type){
		$this->db->select('*');
		$this->db->where('status','Active');
		$this->db->where('type',$type);
		$this->db->order_by('id','desc');
		$this->db->from('edu_gallery');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_year_month(){
		
		$this->db->select('YEAR(created) as year');
		$this->db->group_by('YEAR(created)');
		$this->db->order_by('YEAR(created)','DESC');
		$this->db->where('status', 'Active');
        $this->db->from('edu_gallery');
		$this->db->limit(6, 0);
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $result = $query->result();
	}
	
	function get_gallery_by_year($q){
		
		 $this->db->select('*');
		 $this->db->where('status', 'Active');
		 $this->db->where('DATE_FORMAT(created,"%Y")', $q);
		 $this->db->from('edu_gallery');
		 $query = $this->db->get();
		 return $result = $query->result();
		
	}
	
	function get_gallery_by_city($city){
		$this->db->select('*');
		$this->db->where('status','Active');
		$this->db->where('type', 'image');
		$this->db->where('city', $city);
		$this->db->order_by('id','desc');
		$this->db->from('edu_gallery');
		$query = $this->db->get();
		return $query->result();
	}

}
?>