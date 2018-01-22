<?php if (!defined('BASEPATH')) exit('No direct script access allowed');error_reporting(0);Class Setting_model extends CI_Model{	

function getSettingData()	{		
	$q = "select * from  edu_options";		
	$query = $this->db->query($q);					
	return $query->result();	
}
		
function getSettingDataByName($name)	{		
	$this->db->select('value');		
	$this->db->where('name', $name);
	$q = $this->db->get('edu_options');		  
	return $result = $q->result();	
}
	
function update_setting_data($data_update,$key)	{
	$this->db->where('name',$key);
	$this->db->update('edu_options',$data_update);
	return true;
	}



	}
	?>