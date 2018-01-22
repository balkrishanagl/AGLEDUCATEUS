<?php 
class emailtemplates_model extends CI_Model
{
 	
 	var $emailtemplatestbl = 'email_templates';
	
	
	
	function __construct()
	{
 	// 	$this->db->where('Admin_ID','1');
		// $querymail = $this->db->get('ci_settings');
		// $rowmail = $querymail->row();
		// $this->sitelogo = base_url().'assets/uploads/logo/'.$rowmail->logo;
		// $this->from = $rowmail->email_from_name;		
		// $this->senderemail = $rowmail->sender_from_email;
		// $this->site_title = $rowmail->site_title;
		// $this->contact_email = $rowmail->contact_email;
			
	}
	
	function EmailTemplateChoose($id)
	{
 		$this->db->where('id',$id);
		$query = $this->db->get($this->emailtemplatestbl);
		return $query->row();
	}
	
	
	function GetEmailTemplateByID($id){
	$this->db->where('id',$id);
	$query = $this->db->get($this->emailtemplatestbl);	
	return $query->row();
	}
	
	function GetEmailTemplates(){
	$this->db->order_by('id','desc');
 	$query = $this->db->get($this->emailtemplatestbl);	
	return $query->result();
	}
	
	function save_EmailTemplate($data){
  
		$this->db->insert('email_templates',$data);
		return $this->db->insert_id();
	
	}
	
	function update_EmailTemplate($id,$data){
		$this->db->where('id',$id);
		$this->db->update('email_templates',$data);	
	}
	
	function delete_EmailTemplate($id){
	$this->db->where('id', $id);
	$this->db->delete($this->emailtemplatestbl);	
	return true;
	}
	function status_EmailTemplate($id,$status){
	$this->db->set('status', $status);	
	$this->db->where('id',$id);
	$this->db->update($this->emailtemplatestbl);
	}
	function getAllEmailTemplates()
	{
		$this->db->where('status','Active');
		$query = $this->db->get($this->emailtemplatestbl);
		return $res = $query->result();

	}
	
	function get_EmailTemplate_subject($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->emailtemplatestbl);
		return $res = $query->row();
	}
	
	function add_bulk_data($data)
	{
		$this->db->insert('edu_bulk_email_history',$data);
		return $this->db->insert_id();
	}
	 
	function get_bulk_email_history(){
		
		$this->db->select('edu_bulk_email_history.*');
		$this->db->select('email_templates.email_title');

        $this->db->from('edu_bulk_email_history');
		$this->db->join('email_templates','email_templates.id=edu_bulk_email_history.email_template_id','inner');
		$this->db->order_by('edu_bulk_email_history.id','DESC');

        $query = $this->db->get();

        return $result = $query->result();
	} 
}