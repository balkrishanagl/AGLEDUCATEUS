<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discussion_model extends CI_Model {
  function __construct() {
    parent::__construct();
  }
  
  function fetch_discussions($filter = null, $direction = null) {
  $query = "SELECT * FROM ficci_discussions INNER JOIN users 
            ON ficci_discussions.user_id = users.id
            where ficci_discussions.status != 0 ";
			
		if ($filter != null) {
		  if ($filter == 'age') {
			$filter = 'created';
			switch ($direction) {
			  case 'ASC':
				$dir = 'ASC';
				break;
			  case 'DESC':
				$dir = 'DESC';
				break;
			  default:
				$dir = 'ASC';
			}
		  }
		} else {
		  $dir = 'ASC';
		}
		
		$query .= "ORDER BY 'created' " . $dir;
		$result = $this->db->query($query, array($dir));

		if ($result) {
		  return $result;
		} else {
		  return false;
		}
	}

	function fetch_discussion($ds_id) {
	  $query = "SELECT * FROM 'ficci_discussions', 'users' WHERE 'ficci_discussions'.'id' = ?
				AND 'ficci_discussions'.'user_id' = 'users'.'id'";
	  return $result = $this->db->query($query, array($ds_id));
	}
	
	function create($data) {
	  // Look and see if the email address already exists in the users 
	  // table, if it does return the primary key, if not create them 
	  // a user account and return the primary key.
	  $user_email = $data['user_email'];
	  $query = "SELECT * FROM 'users' WHERE 'email' = ? ";
	  $result = $this->db->query($query,array($user_email));

	  if ($result->num_rows() > 0) {
		foreach ($result->result() as $rows) {
		  $data['user_id'] = $rows->user_id;
		}
	  
		  $discussion_data = array('title' => $data['title'],
                         'body' => $data['body'],
                         'user_id' => $data['user_id'],
                         'status' => '1');
		  if ($this->db->insert('ficci_discussions',$discussion_data) ) {
			return $this->db->insert_id();
		  } else {
			return false;
		  }
		}
	}
	
	function flag($ds_id) {
		$this->db->where('id', $ds_id);
		if ($this->db->update('ficci_discussions', array('status' => '0'))) {
		  return true;
		} else {
		  return false;
		}
	  }
}