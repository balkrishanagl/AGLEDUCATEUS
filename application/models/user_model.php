<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class User_model extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('id, username, password, name');
		$this -> db -> from('admin_user');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return false;
		}

	}

	function get_all_user_list()
	{
		$q = "select au.*,aut.* from admin_user au 
			inner join admin_user_type aut ON aut.user_type_id = au.user_type_id Order By id DESC";
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	function get_user_by_parent_list($id)
	{
		$q = "select au.*,aut.* from admin_user au 
			inner join admin_user_type aut ON aut.user_type_id = au.user_type_id where au.parent_user_id='".$id."'Order By id DESC";
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}

	function get_all_user_type_list()
	{
		$this->db->where('user_type_id !=', '7');
		$query = $this->db->get('admin_user_type');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	function getPageAccessList()
	{
		$query = $this->db->get('edu_page_access');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	/* function getUserAccessList($id)
	{
		$this->db->select('ficci_page_access.page_name');
		$this->db->select('ficci_page_access.root_name');
		$this->db->select('ficci_user_page_access.*');
		$this->db->join('ficci_page_access','ficci_page_access.id=ficci_user_page_access.page_access_id','inner');
		$this->db->where('user_type_id',$id);
		$query = $this->db->get('ficci_user_page_access');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	} */
	
	//Insert user page access Data - Balkrishan
	function addUserPageAccess($data){
		$this->db->insert('edu_user_page_access', $data);
		return $this->db->insert_id();
	}

	function insert_user_data($data)
	{
		$this->db->insert('admin_user',$data);
		return $this->db->insert_id();
	}

	function get_user_data_by_id($id)
	{
		//$q = "select au.* from admin_user au where id=".$id;
		$q = "select au.*,aut.* from admin_user au 
			inner join admin_user_type aut ON aut.user_type_id = au.user_type_id where au.id='".$id."' Order By id DESC";
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
	
	function update_user_data($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('admin_user',$data);
		
	}
	
	function updateStudentDataByEmail($data,$email)
	{
		$this->db->where('email',$email);
		$this->db->update('users',$data);
		
	}
	
	function updateStudentDataByEmailCode($data,$email,$code)
	{
		$this->db->where('email',$email);
		$this->db->where('confirmation_code',$code);
		$this->db->update('users',$data);
		
	}


	function get_total_user_count()
	{
		$q = "select count(id) as total_user from admin_user";
		$query = $this->db->query($q);
		return $query->row()->total_user;
	}

	function get_user_type_name($id)
	{
		$this->db->where('user_type_id',$id);
		$query = $this->db->get('admin_user_type');
		if($query -> num_rows()  == 1)
		{
			return $query->row()->user_type_name;
		}
		else
		{
			return NULL;
		}
	}
	
	//get user type fee by type id - Balkrishan
	function getUserTypeFee($type_id)
	{
		$this->db->where('user_type_id',$type_id);
		$query = $this->db->get('user_type_fees');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	//get country list - Balkrishan
	function getCountryList()
	{
		$query = $this->db->get('ficci_countries');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	//get country by id - Balkrishan
	function getCountryByID($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->get('ficci_countries');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	//get states by country id - Balkrishan
	function getStateByCountryID($country_id)
	{
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('ficci_states');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	//get cities by state id - Balkrishan
	function getCityByStateID($state_id)
	{
		$this->db->where('state_id',$state_id);
		$query = $this->db->get('ficci_cities');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	//check if registered email already exist - Balkrishan
	function getUserByEmail($email){
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		if($query -> num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//get student data by email
	function getStudentUsernameByEmail($email)
	{
		$q = "select id,username from users where email='".$email."'";
		$query = $this->db->query($q);
	
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
	
	//Insert user registration data -Balkrishan
	function addUserData($data){
		//$this->db->trans_start();
		$this->db->insert('users', $data);
		//$this->db->trans_complete();
		return $this->db->insert_id();
	}
	
	//Insert user Profile Data - Balkrishan
	function addUserProfile($data){
		$this->db->insert('user_profiles', $data);
		return $this->db->insert_id();
	}
	
	//Front end user login - Balkrishan
	function user_login($username, $password)
	{
		$this -> db -> select('users.id, users.username, users.password, users.email, users.user_type_id, users.payment_id, users.payment_status, user_profiles.course_fee');
		$this -> db -> from('users');
		$this->db->join('user_profiles','user_profiles.user_id=users.id','inner');
		$this -> db -> where('username = ' . "'" . $username . "'"); 
		$this -> db -> where('password = ' . "'" . MD5($password) . "'"); 
		$this -> db -> where('activated = 1' ); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return array();
		}

	}
	
	// Get All user list -Manoj Sharma
	function listUser()
	{
			$q = "SELECT users.*, user_profiles.* FROM users INNER JOIN user_profiles ON users.id=user_profiles.user_id order by users.id desc";
			
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
		
	}
		function listFrontUser($id)
	{
			$q = "SELECT users.*, user_profiles.*  FROM users INNER JOIN user_profiles ON users.id=user_profiles.user_id  where users.id=".$id;
			
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
		
	}
	
	// update user data - Manoj sharma
	function UpdateUserProfile($data,$id)
	{
	
		$this->db->where('user_id',$id);
      $this->db->update('user_profiles',$data);

		
	}
	
	
	// delete user page access data
	function deleteUserPageAccessData($id)
	{
	
		$this->db->where('user_type_id',$id);
		$this->db->delete('edu_user_page_access');

		
	}
	
	function saveFormData($data){
		$this->db->insert('edu_formdata',$data);
		return $this->db->insert_id();
	}
	
	function getFormDataByClient($clientMailID){
		
		$this->db->select('*');
		$this->db->where('id', $id);
        $q = $this->db->get('edu_formdata');
		return $result = $q->result();
	}
	
	function chkDuplicateUser($username){
		
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where('username',$username);
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
	

	
	function getUserByLastId($id){
		
		$q = "select users.*, user_profiles.first_name, user_profiles.last_name from users INNER JOIN user_profiles ON user_profiles.user_id=users.id where users.id=".$id;
	
		$query = $this->db->query($q);
		if($query -> num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			return NULL;
		}
	}
	
	function exportUser()
	{
		/* $q = "SELECT first_name,last_name,father_name,gender,dob,permanent_address,correspondence_address,mobile_number,contact_number,nationality,qualification,organization,organisation_address,designation,about_course,course_year,college_name,college_address FROM user_profiles";
			
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return NULL;
		} */
		
		 $this->db->select('first_name,last_name,father_name,gender,dob,permanent_address,correspondence_address,mobile_number,contact_number,nationality,qualification,organization,organisation_address,designation,about_course,course_year,college_name,college_address');
		 $query = $this->db->get('user_profiles');
		 return $query;
		
	}
	
	function getPaymentStatus($id)
	{
		$this->db->select('payment_id,payment_status,re_exam_payment_id,re_exam_payment_status');
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}
	
	function update_user($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('users',$data);
		
	}
	
	function getAdminUserByEmail($email,$id){
				
		$this->db->where('email',$email);
		$this->db->where('id !=',$id);
		$query = $this->db->get('admin_user');
		return $res = $query->result();
	}
	
	//get admin data by email
	function getAdminUserByUsername($username,$id){
		
		$this->db->where('username',$username);
		$this->db->where('id !=',$id);
		$query = $this->db->get('admin_user');
		return $res = $query->result();
	}
	
	function delete_user($id){
		$this->db->where('id', $id);
		$this->db->delete('admin_user');
		return true;
	}
	
	
	
	function saveCityExhibitionRegistration($data){
		
		$this->db->insert('edu_city_exhibition_register',$data);
		return $this->db->insert_id();
	}
	
	function chkCityExhibitionUserDuplicate($email,$city){
		
		$this->db->select("*");
		$this->db->from("edu_city_exhibition_register");
		$this->db->where('email',$email);
		$this->db->where('exhibition_city',$city);
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
	
	
	function getUserAccessList($id)
	{
		$this->db->select('edu_page_access.page_name');
		$this->db->select('edu_page_access.root_name');
		$this->db->select('edu_user_page_access.*');
		$this->db->join('edu_page_access','edu_page_access.id=edu_user_page_access.page_access_id','inner');
		$this->db->where('user_type_id',$id);
		$query = $this->db->get('edu_user_page_access');
		if($query -> num_rows() > 0)
		{
		return $query->result();


		}
		else
		{
		return NULL;
		}
	}
	
	
	function get_team_members(){
		
		$q = "select au.*,aut.* from admin_user au 
			inner join admin_user_type aut ON aut.user_type_id = au.user_type_id where au.user_type_id ='8' Order By id DESC";
		$query = $this->db->query($q);
		if($query -> num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return NULL;
		}
	}


	


}
?>