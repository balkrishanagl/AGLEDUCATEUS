<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	function fetch_comments($ds_id) {
    $query = "SELECT * FROM 'ficci_comments', 'ficci_discussions', 'users' 
              WHERE 'ficci_discussions'.'discussion_id' = ?
               AND 'ficci_comments'.'discussion_id' = 'ficci_discussions'.'id' 
               AND 'ficci_comments'.'user_id' = 'users'.'id' 
               AND 'ficci_comments'.'status' = '1' 
               ORDER BY 'ficci_comments'.'created' DESC " ;

        $result = $this->db->query($query, array($ds_id));
		
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	function new_comment($data) {
    // Look and see if the email address already exists in the users 
    // table, if it does return the primary key, if not create them 
    // a user account and return the primary key.
		$uesr_email = $data['usr_email'];
        $query = "SELECT * FROM 'users' WHERE 'email' = ? ";
        $result = $this->db->query($query,array($uesr_email));

        if ($result->num_rows() > 0) {
			
			foreach ($result->result() as $rows) {
				$data['user_id'] = $rows->user_id;
			}
		
			$comment_data = array('body' => $data['body'],
                      'discussion_id' => $data['discussion_id'],
                      'status' => '1',
                      'user_id' => $data['user_id']);
			if($this->db->insert('ficci_comments',$comment_data) ) {
				return $this->db->insert_id();
			} else {
				return false;
			}
        }
    }

	  function flag($cm_id) {
		$this->db->where('id', $cm_id);
		if ($this->db->update('ficci_comments', array('status' => '0'))) {
		  return true;
		} else {
		  return false;
		}
	  } 
	}
			
}