<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class client_model extends CI_Model
{
	
	function add_client_data($data)
	{
		$this->db->insert('edu_client',$data);
		return $this->db->insert_id();
	}
	
	
	
	function get_client_detail($from = null, $to=null, $id = null)
	{
		$this->db->select('*');
        $this->db->from('edu_client');
		
		if($from!=""){
			$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") >=',$from);

		}

		if($to!=""){
			$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") <=',$to);

		}
		
		if($id!=""){
			$this->db->where('id', $id);

		}
		
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
		
		//echo $this->db->last_query(); die;
        return $result = $query->result();
		
	}
	
	function get_clients($parent_id = null)
	{
		$this->db->select('*');
        $this->db->from('edu_client');
		if($parent_id != null){
			$this->db->where('team_member_id', $parent_id);
		}
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
	}
	
	function get_client_by_parent_detail($parent_id, $from = null, $to=null, $id=null)
	{
		$this->db->select('*');
        $this->db->from('edu_client');
		$this->db->where('team_member_id', $parent_id);
		
		if($from!=""){
			$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") >=',$from);

		}

		if($to!=""){
			$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") <=',$to);

		}
		
		if($id!=""){
			$this->db->where('id', $id);

		}
		
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	
	
	function get_client_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_client');
		  return $result = $q->row();
	}
	
	
	function update_client_data($data_update,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_client',$data_update);	
		
	}
	
	
	function delete_client_by_id($id,$status){
		
		 $this->db->where('id', $id);
		$this->db->update('edu_client',$status); 
		return true;
	}
	
	
	function getClientByEmail($email,$id){
				
		$this->db->where('email',$email);
		$this->db->where('id !=',$id);
		$query = $this->db->get('edu_client');
		return $res = $query->result();
	}
	
	function get_active_clients()
	{
		$this->db->select('*');
        $this->db->from('edu_client');
		$this->db->where('status','1');
		$this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function add_relation_data($data)
	{
		$this->db->insert('edu_client_team_relation',$data);
		return $this->db->insert_id();
	}
	
	function get_relation_detail()
	{
		$this->db->select('edu_client_team_relation.*,admin_user.name As team_member,edu_client.client_name');
        $this->db->from('edu_client_team_relation');
		$this->db->join('admin_user','admin_user.id=edu_client_team_relation.team_member_id','inner');
		$this->db->join('edu_client','edu_client.id=edu_client_team_relation.client_id','inner');
		$this->db->order_by('edu_client_team_relation.id','DESC');
        $query = $this->db->get();
        return $result = $query->result();
		
	}
	
	function get_relation_by_user($id)
	{
		$this->db->select('edu_client_team_relation.*,admin_user.name As team_member,edu_client.client_name');
        $this->db->from('edu_client_team_relation');
		$this->db->where('edu_client_team_relation.created_by', $id);
		$this->db->join('admin_user','admin_user.id=edu_client_team_relation.team_member_id','inner');
		$this->db->join('edu_client','edu_client.id=edu_client_team_relation.client_id','inner');
		$this->db->order_by('edu_client_team_relation.id','DESC');
        $query = $this->db->get();
		//echo $this->db->last_query(); die;
        return $result = $query->result();
		
	}
	
	function get_exist_relation($team_id,$client_id,$id = null){
		$this->db->select('*');
		$this->db->where('team_member_id', $team_id);
		$this->db->where('client_id', $client_id);
		
		if($id != null){
		   $this->db->where('id !=', $id);
		}
		
        $q = $this->db->get('edu_client_team_relation');
		return $result = $q->row();
	}
	
	function update_relation_data($data_update,$id){
		
		$this->db->where('id',$id);
		$this->db->update('edu_client_team_relation',$data_update);	
		
	}
	
	function get_relation_data_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_client_team_relation');
		  return $result = $q->row();
	}


}
?>