<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Payment_model extends CI_Model
{
	function listPayment($payment_type=null, $payment_status=null, $from=null, $to=null, $usertype=null, $session=null, $source=null, $exam_type=null){
		
		$this->db->select('ficci_payment.*');
		$this->db->select('users.username,users.email,users.created');
		$this->db->select('user_profiles.enrollment_no,user_profiles.first_name,user_profiles.mobile_number,user_profiles.source_detail');
		//$this->db->select('ficci_payment_type.payment_type');
		$this->db->select('admin_user_type.user_type_name');
		$this->db->select('ficci_session.name as session');
		$this->db->select('ficci_source_information.name as source');
		//$this->db->select('ficci_payment_type.payment_type');
		$this->db->from('ficci_payment');
		//$this->db->join('ficci_payment_type','ficci_payment_type.id=ficci_payment.payment_type_id','inner');
		$this->db->join('user_profiles','user_profiles.user_id=ficci_payment.user_id','inner');
		$this->db->join('ficci_source_information','ficci_source_information.id=user_profiles.sourceinformation','inner');
		$this->db->join('users','users.id=ficci_payment.user_id','inner');
		$this->db->join('admin_user_type','admin_user_type.user_type_id=users.user_type_id','inner');
		$this->db->join('ficci_session','ficci_session.id=users.session_id','left');
	
		if($payment_status!=null){
			$this->db->where('ficci_payment.status',$payment_status);
		}
		if($payment_type!=null){
			$this->db->where('ficci_payment.payment_type_id',$payment_type);
		}
		
		if($usertype!=null){
			$this->db->where('users.user_type_id',$usertype);
		}
		
		if($session!=null){
			$this->db->where('users.session_id',$session);
		}
		
		if($source!=null){
			$this->db->where('user_profiles.sourceinformation',$source);
		}
		
		if($from!=""){
			$this->db->where('ficci_payment.payment_on >=',$from);
			
		}
		
		if($to!=""){
			$this->db->where('ficci_payment.payment_on <=',$to);
			
		}
		
		if($exam_type!=""){
			$this->db->where('ficci_payment.exam_type =',$exam_type);
			
		}
		$this->db->order_by('ficci_payment.id','desc');
		
		
	
		//$this->db->join('ficci_payment_type','ficci_payment_type.id=ficci_payment.payment_type_id');
		$query = $this->db->get();
		$str = $this->db->last_query();
		//echo $str; die;
		return $query->result();
	}
	
	function getPaymentByID($id){
		$this->db->select('*');
		$this->db->from('ficci_payment');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getPaymentDetailByID($id){
		$this->db->select('*');
		$this->db->from('ficci_payment');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	function getPaymentType(){
		$this->db->select('*');
		$this->db->from('ficci_payment_type');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result();
	}
	
	function addPayment($data){
		$this->db->insert('ficci_payment',$data);
		return $this->db->insert_id();
	}
	
	function updatePayment($data, $id){
		
		$this->db->where('id',$id);
		$this->db->update('ficci_payment',$data);
		
		return true;
	}

	function deletePayment($id){
		$this->db->where('id', $id);
		$this->db->delete('ficci_payment');
		return true;
	}
	
	function getPaymentTypeDetail($Iid)
	{
		$this->db->select('ficci_payment.*');
		$this->db->where('ficci_payment.id',$Iid);
		$query = $this->db->get('ficci_payment');
		
		return $query->row();
	}
	
	
	
	
	
}
?>