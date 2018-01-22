<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Enquiry_model extends CI_Model
{

	// Get All Enquiry list 
	function listenquiry()
	{
		$this->db->from("edu_formdata");
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

	function getenquiryByID($id)
	{
			$this->db->select("*");
			$this->db->from("edu_formdata");
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
	
	function getFormType()
	{
	 
	  $this->db->distinct("form_type");
	  $this->db->select("form_type");
	  $this->db->from("edu_formdata");
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

	
	function deleteFormData($id,$status)
	{
	
	  $this->db->where('id',$id);
      $this->db->update('edu_formdata',$status);
      return true;
		
	}
	function deleteData($id,$status)
	{
	
	  $this->db->where('id',$id);
      $this->db->delete('edu_formdata');
      return true;
		
	}

}
?>