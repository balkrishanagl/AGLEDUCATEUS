<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Tool_model extends CI_Model
{
	function insertData($data)
	{
		$this->db->insert('fuccha_lead_call_pridictor',$data);
		return $this->db->insert_id();
	}
	
	function add_col_enq($data)
	{
		$this->db->insert('fuccha_college_enquiry',$data);
		return $this->db->insert_id();
	}	
	
	function add_col_review_enq($data)
	{
		$this->db->insert('fuccha_college_review',$data);
		return $this->db->insert_id();
	}
	
	function updateData($data, $id)
	{
		$this->db->where('lcpr_id',$id);
		$this->db->update('fuccha_lead_call_pridictor',$data);
		return true;
	}

	function countPredictor()
	{
		$this->db->where('lcpr_status', 1);
		$query = $this->db->get('fuccha_lead_call_pridictor');
		$result = $query->num_rows();
		return $result;
	}
	
	function getEligibleColleges($percentile){
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		$this->db->order_by('coll_percentile','DESC');
		$this->db->where('coll_percentile !=','');
		$this->db->where('coll_percentile <=',$percentile);
		
		$this->db->like('coll_exam','CAT');
		
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$result = $query->result();
		return $result;
	}
	
	function getPercentileRange($mark){
		$this->db->select('*');
		$this->db->from('fuccha_cat_cutoff');
		$this->db->where('ccof_overall_min <', $mark);
		$this->db->where('ccof_overall_max >=', $mark);
		
		$query = $this->db->get();
		//cho $this->db->last_query(); die;
		$result = $query->result_array();
		return $result;
	}
	
	function insertCapData($data)
	{
		$this->db->insert('fuccha_lead_cat_percentiler',$data);
		return $this->db->insert_id();
	}
	
	function updateCapData($data, $id)
	{
		$this->db->where('lcap_id',$id);
		$this->db->update('fuccha_lead_cat_percentiler',$data);
		return true;
	}
	
	function get_call_predictor_detail()
	{
		$this->db->select('*');
		$this->db->order_by('lcpr_id','DESC');
		$this->db->from('fuccha_lead_call_pridictor');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	function getCityData()
	{
		$this->db->select('fuccha_colleges.coll_city');
		$this->db->from('fuccha_colleges');
		$this->db->group_by('fuccha_colleges.coll_city');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	function getCitiesData($state)
	{
		$this->db->select('state_city_db.city_name,state_city_db.id');
		$this->db->from('state_city_db');
		$this->db->where('state_name',$state);
		$query = $this->db->get();
		// echo $this->db->last_query();
		$result = $query->result();
		
		// print_r($cityu);
		// print_r($result);
		return $result;	
	}

	function getStateData()
	{
		$this->db->select('state_city_db.state_name');
		$this->db->from('state_city_db');
		$this->db->group_by('state_city_db.state_name');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}

	
	function getUniCityData()
	{
		$this->db->select('fuccha_universities.uni_city');
		$this->db->from('fuccha_universities');
		$this->db->group_by('fuccha_universities.uni_city');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	
	function get_call_predictor_detail_by_id($id)
	{
	    $this->db->select('*');
		$this->db->from('fuccha_lead_call_pridictor');
		$this->db->where('lcpr_id',$id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	function get_college_detail($city,$exam)
	{
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		if($city!=null){
			$this->db->where_in('coll_city',$city);
		}
		if($exam!=null){
			$this->db->like('coll_exam',$exam);
		}
		$this->db->where('coll_bt_ranking !=',0);
		$this->db->where_in('coll_type',array('MBA','both'));
		$this->db->order_by('coll_bt_ranking', 'asc');
		/*if($this->session->userdata('user_id')=='')
		{
			$this->db->where('coll_bt_ranking !=',0);
			$this->db->limit('12');
		}*/
		
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		$result1 = $query->result();
		$result2 = $this->get_college_detail_top($city,$exam);
		$result = array_merge($result1,$result2);
		return $result;	
	}

	function get_college_detail_top($city,$exam)
	{
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		if($city!=null){
			$this->db->where_in('coll_city',$city);
		}
		if($exam!=null){
			$this->db->like('coll_exam',$exam);
		}
		$this->db->where('coll_bt_ranking',0);
		$this->db->where_in('coll_type',array('MBA','both'));
		$this->db->order_by('coll_bt_ranking', 'asc');
		
		$this->db->limit('20');
	
		
		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$result = $query->result();
		return $result;	
	}

	
	function get_engineering_college_detail($city,$exam)
	{
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		if($city!=null){
			$this->db->where_in('coll_city',$city);
		}
		if($exam!=null){
			$this->db->like('coll_exam',$exam);
		}
		$this->db->where('coll_ni_ranking !=',0);
		$this->db->where('coll_status',1);
		$this->db->where_in('coll_type',array('Engineering','both'));
		// $this->db->order_by('coll_bt_ranking', 'asc');
		$this->db->order_by('coll_ni_ranking', 'asc');
		//if($this->session->userdata('user_id')=='')
		//$this->db->limit('12');

		$query = $this->db->get();
		// echo $this->db->last_query(); die;
		$result1 = $query->result();
		$result2 = $this->get_engineering_college_detail_top($city,$exam);
		$result = array_merge($result1,$result2);
		return $result;
	}
	
	function get_engineering_college_detail_top($city,$exam)
	{
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		if($city!=null){
			$this->db->where_in('coll_city',$city);
		}
		if($exam!=null){
			$this->db->like('coll_exam',$exam);
		}
		$this->db->where('coll_ni_ranking',0);
		$this->db->where('coll_status',1);
		$this->db->where_in('coll_type',array('Engineering','both'));
		$this->db->order_by('coll_ni_ranking', 'asc');
		//if($this->session->userdata('user_id')=='')
		//$this->db->limit('20');

		$query = $this->db->get();
//		echo $this->db->last_query(); die;
		$result = $query->result();
		return $result;
	}

	function get_university_college_detail($city,$exam)
	{
		$this->db->select('*');
		$this->db->from('fuccha_universities');
		if($city!=null){
			$this->db->where('uni_city',$city);
		}
		if($exam!=null){
			$this->db->like('uni_exam',$exam);
		}
		$this->db->where('uni_ni_ranking !=',0);
		$this->db->where('coll_status',1);
//		$this->db->where('uni_type','Engineering');
		$this->db->order_by('uni_bt_ranking', 'asc');
		if($this->session->userdata('user_id')=='')
		$this->db->limit('12');

		$query = $this->db->get();
//		echo $this->db->last_query(); die;
		$result = $query->result();
		return $result;
	}

	function get_college_detail_by_location($city)
	{
		$exam=null;
		$this->db->select('*');
		$this->db->from('fuccha_colleges');
		if($city!=null){
			if($city=='mba-colleges-in-delhi-ncr'){
				$bind = array('Delhi', 'Ghaziabad', 'Gurgaon', 'Noida');
				$this->db->where_in('coll_city', $bind);
			}elseif($city=='mba-colleges-in-mumbai'){
				$bind = array('Bombay', 'Mumbai');
				$this->db->where_in('coll_city', $bind);
			}elseif($city=='mba-colleges-in-bangalore'){
				$this->db->where('coll_city','Bengaluru');
			}elseif($city=='mba-colleges-in-chennai'){
				$this->db->where('coll_city','Chennai');
			}elseif($city=='mba-colleges-in-hyderabad'){
				$this->db->where('coll_city','Hyderabad');
			}elseif($city=='mba-colleges-in-kolkata'){
				$this->db->where('coll_city','Kolkata');
			}elseif($city=='mba-colleges-in-pune'){
				$this->db->where('coll_city','Pune');
			}else{
				if(isset($_POST['ranking_exam']) and $_POST['ranking_exam']!=''){
					$exam = $_POST['ranking_exam'];
				}
				if($exam!=null){
					$this->db->like('coll_exam',$exam);
				}
				$this->db->where('coll_city',$city);
			}
		}
		$this->db->where('coll_bt_ranking !=',0);
		$this->db->where('coll_type','MBA');
		$this->db->order_by('coll_bt_ranking', 'asc');
		if($this->session->userdata('user_id')=='')
			$this->db->limit('12');

		$query = $this->db->get();
//		echo $this->db->last_query(); die;
		$result = $query->result();
		return $result;
	}
	
	function insertDataAsk($data)
	{
		$this->db->insert('fuccha_ask_expert',$data);
		return $this->db->insert_id();
	}
	
	function updateDataAsk($data, $id)
	{
		$this->db->where('aske_id',$id);
		$this->db->update('fuccha_ask_expert',$data);
		return true;
	}
	function getAskExpert($id)
	{
		$this->db->where('aske_id',$id);
		$query = $this->db->get('fuccha_ask_expert');
		return $row = $query->row();
	}
	
	function insertDataBSchool($data)
	{
		$this->db->insert('fuccha_b_school_helpline',$data);
		return $this->db->insert_id();
	}
	
	function updateDataBSchool($data, $id)
	{
		$this->db->where('bsh_id',$id);
		$this->db->update('fuccha_b_school_helpline',$data);
		return true;
	}
	function getBSchoolHelpline($id)
	{
		$this->db->where('bsh_id',$id);
		$query = $this->db->get('fuccha_b_school_helpline');
		return $row = $query->row();
	}
	
	function insertDataJBSchool($data)
	{
		$this->db->insert('fuccha_jb_school_helpline',$data);
		return $this->db->insert_id();
	}
	
	function updateDataJBSchool($data, $id)
	{
		$this->db->where('jbsh_id',$id);
		$this->db->update('fuccha_jb_school_helpline',$data);
		return true;
	}
	function getJBSchoolHelpline($id)
	{
		$this->db->where('jbsh_id',$id);
		$query = $this->db->get('fuccha_jb_school_helpline');
		return $row = $query->row();
	}
	
	function insertDataNIU($data)
	{
		$this->db->insert('fuccha_niu_helpline',$data);
		return $this->db->insert_id();
	}
	
	function updateDataNIU($data, $id)
	{
		$this->db->where('niu_id',$id);
		$this->db->update('fuccha_niu_helpline',$data);
		return true;
	}
	function getNIUHelpline($id)
	{
		$this->db->where('niu_id',$id);
		$query = $this->db->get('fuccha_niu_helpline');
		return $row = $query->row();
	}
	
	function insertDataSchool($data)
	{
		$this->db->insert('fuccha_school_helpline',$data);
		return $this->db->insert_id();
	}
	
	function updateDataSchool($data, $id)
	{
		$this->db->where('bsh_id',$id);
		$this->db->update('fuccha_school_helpline',$data);
		return true;
	}
	function getSchoolHelpline($id)
	{
		$this->db->where('bsh_id',$id);
		$query = $this->db->get('fuccha_school_helpline');
		return $row = $query->row();
	}
	
	/* ======= Get Record by ID ============== */
	function get_record_call_predictor_detail_by_id($id)
	{
	    $this->db->select('*');
		$this->db->from('fuccha_lead_call_pridictor');
		$this->db->where('lcpr_id',$id);
		$query = $this->db->get();
		$result = $query->row();
		return $result;	
	}
	function delete_call_predictor($Iid)
	{
		$this->db->where('lcpr_id',$Iid);
		$this->db->delete('fuccha_lead_call_pridictor');
		return true;
	}
	
	
	/* ============== Snap score Calculator ==================== */
	
	function insertSnapData($data)
	{
		$this->db->insert('fuccha_snap_score_calculator',$data);
		return $this->db->insert_id();
	}
	
	function updateSnapData($data, $id)
	{
		$this->db->where('ssca_id',$id);
		$this->db->update('fuccha_snap_score_calculator',$data);
		return true;
	}
	
	/* ============== Xat Calculator ==================== */
	
	function insertXatData($data)
	{
		$this->db->insert('fuccha_xat_calculator',$data);
		return $this->db->insert_id();
	}
	
	function updateXatData($data, $id)
	{
		$this->db->where('xat_id',$id);
		$this->db->update('fuccha_xat_calculator',$data);
		return true;
	}
	
	/* ============== Xat score Calculator ==================== */
	
	function insertXatScoreData($data)
	{
		$this->db->insert('fuccha_xat_score_calculator',$data);
		return $this->db->insert_id();
	}
	
	function updateXatScoreData($data, $id)
	{
		$this->db->where('xat_score_id',$id);
		$this->db->update('fuccha_xat_score_calculator',$data);
		return true;
	}
	/*================= Join Gang =========================*/
	function addGangData($data)
	{
		$this->db->insert('fuccha_join_gang',$data);
		return $this->db->insert_id();
	}
	/*================= Join Gang =========================*/
	function addCompData($data)
	{
		$this->db->insert('fuccha_join_gang',$data);
		return $this->db->insert_id();
	}
	function get_allJoinGang()
	{
		$this->db->order_by('jg_id','desc');
		$query = $this->db->get('fuccha_join_gang');
		return $res = $query->result();
	}
	function get_JoinGangById($Iid)
	{
		$this->db->where('jg_id',$Iid);
		$query = $this->db->get('fuccha_join_gang');
		return $row = $query->row();
	}

	function get_college_reviews($colid, $limit=3, $offset=null)
	{
		$this->db->order_by('coll_review_id','desc');
		$this->db->where('coll_review_college_id',$colid);
		$this->db->where('coll_review_status',1);
        $this->db->limit($limit, $offset);
		$query = $this->db->get('fuccha_college_review');
		return $row = $query->result();
	}
	function get_total_college_reviews($colid)
	{
		$this->db->where('coll_review_college_id',$colid);
		$this->db->where('coll_review_status',1);
		$query = $this->db->get('fuccha_college_review');
		return $row = $query->result();
	}
	function get_ReviewById($id)
	{
		$this->db->where('coll_review_id',$id);
		$query = $this->db->get('fuccha_college_review');
		// echo $this->db->last_query();
		return $row = $query->row();
	}
	
	function update_review_status($data, $id)
	{
		$this->db->where('coll_review_id',$id);
		$this->db->update('fuccha_college_review',$data);
		return true;
	}
	function get_all_college_reviews()
	{
		$query = $this->db->get('fuccha_college_review');
		return $row = $query->result();
	}
	
	
}
?>