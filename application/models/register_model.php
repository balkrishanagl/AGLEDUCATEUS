<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class register_model extends CI_model
{
	/* function add_appointment($data)
	{
		$this->db->insert('ehcc_appointment',$data);
		return $this->db->insert_id();
	}
	
	
	
	function add_opinion($data)
	{
		$this->db->insert('ehcc_opinion',$data);
		return $this->db->insert_id();
	} */
	
	function add_online_register($data){
		
		$this->db->insert('edu_online_registration',$data);
		return $this->db->insert_id();
	}
	
	function add_exhibitor_register($data){
		
		$this->db->insert('edu_exhibitor_registration',$data);
		return $this->db->insert_id();
	}
	
	function updateOnlineregisterByEmailCode($data,$email,$code)
	{
		$this->db->where('email',$email);
		$this->db->where('email_confirmation_code',$code);
		$this->db->update('edu_online_registration',$data);
		
	}
	
	function updateExhibitorregisterByEmailCode($data,$email,$code)
	{
		$this->db->where('email',$email);
		$this->db->where('email_confirmation_code',$code);
		$this->db->update('edu_exhibitor_registration',$data);
		
	}
	
	function updateCityregisterByEmailCode($data,$email,$code)
	{
		$this->db->where('email',$email);
		$this->db->where('email_confirmation_code',$code);
		$this->db->update('edu_city_exhibition_register',$data);
		
	}
	
	
	function listcityExhibitionRegister()
	{
		$this->db->select('edu_city_exhibition_register.*');
		$this->db->select('edu_state_city.city_name as city');
		$this->db->select('edu_course.name as course');
		$this->db->from("edu_city_exhibition_register");
		$this->db->join('edu_state_city','edu_state_city.id=edu_city_exhibition_register.exhibition_city','inner');
		$this->db->join('edu_course','edu_course.id=edu_city_exhibition_register.course','inner');
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
	
	
	
	function getcityExhibitionRegisterByID($id)
	{
			$this->db->select('edu_city_exhibition_register.*');
			$this->db->select('edu_state_city.city_name as city');
			$this->db->select('edu_course.name as course');
			$this->db->from("edu_city_exhibition_register");
			$this->db->join('edu_state_city','edu_state_city.id=edu_city_exhibition_register.exhibition_city','inner');
			$this->db->join('edu_course','edu_course.id=edu_city_exhibition_register.course','inner');
			$this->db->where('edu_city_exhibition_register.id',$id);
			$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
		
	}
	
	
	
	function exportCityExhibitionRegisterData(){
		
		 $this->db->select('edu_city_exhibition_register.created As registration_date,edu_state_city.city_name as exhibition_city,edu_city_exhibition_register.name,edu_city_exhibition_register.email,edu_city_exhibition_register.mobile,edu_city_exhibition_register.user_city,edu_city_exhibition_register.qualification,edu_city_exhibition_register.course');
		 $this->db->from("edu_city_exhibition_register");
		 $this->db->join('edu_state_city','edu_state_city.id=edu_city_exhibition_register.exhibition_city','inner');
		 $query = $this->db->get();
		 return $query;
	}
	
	
	
	
	function listOnlineRegister()
	{
		$this->db->select('edu_online_registration.*');
		$this->db->select('edu_state_city.city_name as city');
		$this->db->select('edu_course.name as course');
		$this->db->select('edu_source_information.name as source');
		$this->db->from("edu_online_registration");
		$this->db->join('edu_state_city','edu_state_city.id=edu_online_registration.intrested_city','inner');
		$this->db->join('edu_course','edu_course.id=edu_online_registration.course','inner');
		$this->db->join('edu_source_information','edu_source_information.id=edu_online_registration.source','inner');
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
	
	
	function get_online_register_user_by_city($cityId)
	{
		$this->db->select('*');
		$this->db->from("edu_online_registration");
		$this->db->where('intrested_city',$cityId);
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
	
	function get_city_register_user_by_city($cityId)
	{
		$this->db->select('*');
		$this->db->from("edu_city_exhibition_register");
		$this->db->where('exhibition_city',$cityId);
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
	
	function get_exhibitor_register_user_by_city($cityId)
	{
		$this->db->select('*');
		$this->db->from("edu_exhibitor_registration");
		$this->db->where('intrested_city',$cityId);
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
	
	function getOnlineUserByEmailCode($email, $code){
		$this->db->select('*');
		$this->db->from("edu_online_registration");
		$this->db->where('email', $email);
		$this->db->where('email_confirmation_code', $code);
		$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
	}
	
	function getExhibitorUserByEmailCode($email, $code){
		$this->db->select('*');
		$this->db->from("edu_exhibitor_registration");
		$this->db->where('email', $email);
		$this->db->where('email_confirmation_code', $code);
		$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
	}
	
	function getCityRegisterUserByEmailCode($email, $code){
		$this->db->select('*');
		$this->db->from("edu_city_exhibition_register");
		$this->db->where('email', $email);
		$this->db->where('email_confirmation_code', $code);
		$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
	}
	
	
	function getOnlineRegisterByID($id)
	{
			$this->db->select('edu_online_registration.*');
			$this->db->select('edu_state_city.city_name as city');
			$this->db->select('edu_course.name as course');
			$this->db->select('edu_source_information.name as source');
			$this->db->from("edu_online_registration");
			$this->db->join('edu_state_city','edu_state_city.id=edu_online_registration.intrested_city','inner');
			$this->db->join('edu_course','edu_course.id=edu_online_registration.course','inner');
			$this->db->join('edu_source_information','edu_source_information.id=edu_online_registration.source','inner');
			$this->db->where('edu_online_registration.id',$id);
			$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
		
	}
	
	
	
	function exportonline_register(){
		
		 $this->db->select('edu_online_registration.created As registration_date,edu_state_city.city_name as exhibition_city,edu_online_registration.name,edu_online_registration.email,edu_online_registration.mobile,edu_online_registration.alt_mobile,edu_course.name As course,edu_online_registration.qualification,edu_online_registration.percentage,edu_online_registration.app_jee as appeared_jee,edu_source_information.name As Source');
		 $this->db->from("edu_online_registration");
		 $this->db->join('edu_state_city','edu_state_city.id=edu_online_registration.intrested_city','inner');
		 $this->db->join('edu_course','edu_course.id=edu_online_registration.course','inner');
		 $this->db->join('edu_source_information','edu_source_information.id=edu_online_registration.source','inner');
		 $query = $this->db->get();
		 return $query;
	}	
	
	
	function listExhibitorRegister()
	{
		$this->db->select('edu_exhibitor_registration.*');
		$this->db->select('edu_state_city.city_name as city');
		$this->db->from("edu_exhibitor_registration");
		$this->db->join('edu_state_city','edu_state_city.id=edu_exhibitor_registration.intrested_city','inner');
		
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
	
	
	
	function getExhibitorRegisterByID($id)
	{
			$this->db->select('edu_exhibitor_registration.*');
			$this->db->select('edu_state_city.city_name as city');
			$this->db->from("edu_exhibitor_registration");
			$this->db->join('edu_state_city','edu_state_city.id=edu_exhibitor_registration.intrested_city','inner');
			
			$this->db->where('edu_exhibitor_registration.id',$id);
			$query = $this->db->get();
			
			if($query -> num_rows() > 0)
			{
				return $query->row();
			}
			else
			{
				return NULL;
			}
		
	}
	
	
	
	function exportexhibitor_register(){
		
		 $this->db->select('edu_exhibitor_registration.created As registration_date,edu_state_city.city_name as exhibition_city,edu_exhibitor_registration.contact_person,edu_exhibitor_registration.email,edu_exhibitor_registration.contact,edu_exhibitor_registration.designation,edu_exhibitor_registration.university_collage,edu_exhibitor_registration.university_collage_address,edu_exhibitor_registration.message');
		 $this->db->from("edu_exhibitor_registration");
		 $this->db->join('edu_state_city','edu_state_city.id=edu_exhibitor_registration.intrested_city','inner');
		 
		 $query = $this->db->get();
		 return $query;
	}	
	
	
}


?>