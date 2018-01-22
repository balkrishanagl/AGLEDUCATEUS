<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Common_model extends CI_Model
{

	function __construct() {
			
		$this->getSetting();
		$this->getPageMetaData();
	}

	
	function getSetting(){
		
	$q = "select * from  edu_options";
	$query = $this->db->query($q);
	$settingData = $query->result();
		
		foreach($settingData as $setting){
			
			if($setting->name == "copyright_text"){
				
				$this->config->set_item('copyright',$setting->value);
			}elseif($setting->name == "header_logo_1"){
				
				$this->config->set_item('headerLogo1',$setting->value);
			}elseif($setting->name == "header_logo_2"){
				
				$this->config->set_item('headerLogo2',$setting->value);
			}elseif($setting->name == "header_logo_url_1"){
				
				$this->config->set_item('headerLogoUrl1',$setting->value);
			}elseif($setting->name == "header_logo_url_2"){
				
				$this->config->set_item('headerLogoUrl2',$setting->value);
			}elseif($setting->name == "phone_no"){
				
				$this->config->set_item('phone',$setting->value);
			}elseif($setting->name == "fb_url"){
				
				$this->config->set_item('fbUrl',$setting->value);
			}elseif($setting->name == "twitter_url"){
				
				$this->config->set_item('twitterUrl',$setting->value);
			}elseif($setting->name == "youtube_url"){
				
				$this->config->set_item('youtubeUrl',$setting->value);
			}elseif($setting->name == "pinterest_url"){
				
				$this->config->set_item('pinterestUrl',$setting->value);
			}elseif($setting->name == "footer_logo_1"){
				
				$this->config->set_item('footerLogo1',$setting->value);
			}elseif($setting->name == "footer_logo_url_1"){
				
				$this->config->set_item('footerLogoUrl1',$setting->value);
			}elseif($setting->name == "email"){
				
				$this->config->set_item('Email',$setting->value);
			}elseif($setting->name == "address"){
				
				$this->config->set_item('Address',$setting->value);
			}elseif($setting->name == "service_tax"){
				
				$this->config->set_item('ServiceTax',$setting->value);
			}elseif($setting->name == "from_email"){
				
				$this->config->set_item('FromEmail',$setting->value);
			}elseif($setting->name == "site_name"){
				
				$this->config->set_item('Site_name',$setting->value);
			}elseif($setting->name == "email_logo"){
				
				$this->config->set_item('email_logo',$setting->value);
			}elseif($setting->name == "google_url"){	
				$this->config->set_item('google_url',$setting->value);			
			}elseif($setting->name == "linkedin_url"){								
			
				$this->config->set_item('linkedin_url',$setting->value);			
				
			}elseif($setting->name == "admin_email"){
				
				$this->config->set_item('AdminEmail',$setting->value);
			}elseif($setting->name == "client_tds"){
				
				$this->config->set_item('ClientTds',$setting->value);
			}elseif($setting->name == "client_gst"){
				
				$this->config->set_item('ClientGst',$setting->value);
			}
			
		}
	}
	
	function getPageMetaData(){
		
		$totalSegment = $this->uri->total_segments();
		$slug = "";
		if($totalSegment == 2){
			
			if($this->uri->segment(1) == "course"){
				
				
				
			}else{
				
				
				 if(!is_numeric($this->uri->segment(2))){
					 
					 $slug = $this->uri->segment(2);
				 }else{
					 $slug = $this->uri->segment(1);
					 
				 }
					$this->db->select('page_meta_title,page_meta_kaywords,page_meta_description');
					$this->db->where('page_slug', $slug);
					$this->db->where('page_status', '1');
					
					$q = $this->db->get('edu_pages');
					$result = $q->row();
					$this->config->set_item('page_meta',$result);
				
			}
		}else{
			
				$slug = $this->uri->segment(1);
				
				if($slug == "internships"){
					$slug = "internship";
				}
				
				if($slug !=""){
					$this->db->select('page_meta_title,page_meta_kaywords,page_meta_description');
					$this->db->where('page_slug', $slug);
					$this->db->where('page_status', '1');
					
					$q = $this->db->get('edu_pages');
					$result = $q->row();
					$this->config->set_item('page_meta',$result);
				}
		}
		
	
	}
	
	function get_header_menu(){
		
		$this->db->select('*');
		$this->db->where('status', '1');
		$this->db->where('type', 'header');
		$this->db->limit(12);
        $q = $this->db->get('edu_menu');
		return $result = $q->result();
		
	}
	
	
	function get_footer_menu($section){
		
		$this->db->select('*');
		$this->db->where('status', '1');
		$this->db->where('type', 'footer');
		$this->db->where('footer_section', $section);
		$this->db->limit(8);
        $q = $this->db->get('edu_menu');
		return $result = $q->result();
		
	}
	
	function unique_slug($app_title,$table)
	{
			$slug = url_title($app_title);
			$slug = strtolower($slug);
			$i = 0;
			$params = array ();
			$params['slug'] = $slug;
			while ($this->db->where($params)->get($table)->num_rows()) 
				{
					if (!preg_match ('/-{1}[0-9]+$/', $slug )) 
						{
							$slug .= '-' . ++$i;
						}
				    else 
						{
							$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
						}
					$params ['slug'] = $slug;
				}
				$app_title=$slug;
				return $app_title;
	}
	
	

}
?>