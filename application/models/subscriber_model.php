<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Subscriber_model extends CI_Model
{

	
	//Insert subscriber registration data -Balkrishan
	function addsubscriberData($data){
		//$this->db->trans_start();
		$this->db->insert('edu_subscriber', $data);
		//$this->db->trans_complete();
		return $this->db->insert_id();
	}
	

		
	// Get All subscriber list -Manoj Sharma
	function listsubscriber()
	{
			$this->db->select("*");
			$this->db->from("edu_subscriber");
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
		
	}

	function listsubscriberExp(){
		$this->db->select("email,status");
			$this->db->from("edu_subscriber");
		$query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}

	}
		function getsubscriberByID($id)
	{
			$this->db->select("*");
			$this->db->from("edu_subscriber");
			$this->db->where('id',$id);
		 $query = $this->db->get();
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
		
	}
	
	// update subscriber data - Manoj sharma
	function updatesubscriber($data,$id)
	{
	
		$this->db->where('id',$id);
      $this->db->update('edu_subscriber',$data);

		
	}
	
	function unsubscriber($id,$status)
	{
	
	  $this->db->where('id',$id);
      $this->db->update('edu_subscriber',$status);
      return true;
		
	}
	
	
	function delete_subscribe($id)
	{
	
	  $this -> db -> where('id', $id);
	  $this -> db -> delete('edu_subscriber');
      return true;
		
	}
	
	function activesubscriber($id,$status)
	{
	
	  $this->db->where('id',$id);
      $this->db->update('edu_subscriber',$status);
      return true;
		
	}
	
	function chkSubscriberDuplicate($email){
		
		$this->db->select("*");
		$this->db->from("edu_subscriber");
		$this->db->where('email',$email);
		$query = $this->db->get();
		
			if($query -> num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return NULL;
			}
		
	}
	
	function getSubcribeData(){
		
		 $this->db->select('email');
		 $this->db->where('status','1');
		 $query = $this->db->get('edu_subscriber');
		 return $query;
	}
	
	function getSubcribeDataByStatus($status){
		
		 $this->db->select('email');
		 $this->db->where('status',$status);
		 $query = $this->db->get('edu_subscriber');
		 return $query;
	}


}
?>