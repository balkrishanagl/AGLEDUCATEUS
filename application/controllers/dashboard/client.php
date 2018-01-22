<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class client extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('email');
		$session_data = $this->session->userdata('admin_user');
		if($session_data){
			if($session_data['admin_user_type_id']==2){
				redirect('admin/dashboard');
			}
			
			if(!$this->session->userdata('admin_user'))
			{
				redirect('admin/login', 'refresh');
			}
			$this->load->model('client_model');
			$this->load->model('user_model');
		}else{
			redirect('admin/login', 'refresh');
		}	
	}
	function manage_client()
	{
			$from=null;
			$to=null;
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'manage_client';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'manage_client';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'manage_client';
			
			if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
				$data['clients'] = $this->client_model->get_clients();
			}else{
				$data['clients'] = $this->client_model->get_clients($session_data['id']);
			}
			
			
			
			if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$clientId = null;
				$from = null;
				$to = null;
				
				if(isset($_POST['fromdt']) and $_POST['fromdt']!=''){
					$from = $_POST['fromdt'];
					$from = date_create($from);
					$from = date_format($from,"Y-m-d");
				}
				
				if(isset($_POST['todt']) and $_POST['todt']!=''){
					$to = $_POST['todt'];
					$to = date_create($to);
					$to = date_format($to,"Y-m-d");
				}
				
				if(isset($_POST['clientId']) and $_POST['clientId']!=''){
					$clientId = $_POST['clientId'];
				}
				
				if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
					$filter_data = $this->client_model->get_client_detail($from, $to, $clientId);
				}else{
					$filter_data = $this->client_model->get_client_by_parent_detail($session_data['id'],$from, $to, $clientId);
				}
				
				
				if(isset($filter_data) && $filter_data != NULL) {
					
					$i=1;
					$result = '';
					$status = '';
					$payment_status ='';
					$action='';
					$data = array();

					foreach($filter_data as $filterData) {
						
						$action = "<a href=".base_url().'admin/client/edit_client/'.$filterData->id.">Edit</a>";
						if($filterData->status == "1"){
							$status = "Active";
							$action.= "| <a href='javascript:void(0);' onclick=delete_client(".$filterData->id.")>Inactive</a>";
						}else{
							$status = "Inactive";
							$action.= "| <a href='javascript:void(0);' onclick=active_client(".$filterData->id.")>Active</a>";
						}
						
						if($filterData->payment_status == "1"){
							$payment_status = "Active";
						}else{
							$payment_status = "Inactive";
						}
						
						if($filterData->first_installment_status == "1"){
							$first_inst__status = "&#10004;";
						}else{
							$first_inst__status = "&#10006;";
						}
						
						if($filterData->second_installment_status == "1"){
							$second_inst__status = "&#10004;";
						}else{
							$second_inst__status = "&#10006;";
						}
						
						if($filterData->third_installment_status == "1"){
							$third_inst__status = "&#10004;";
						}else{
							$third_inst__status = "&#10006;";
						}
						
						if($filterData->fourth_installment_status == "1"){
							$fourth_inst__status = "&#10004;";
						}else{
							$fourth_inst__status = "&#10006;";
						}
						
						if($filterData->fifth_installment_status == "1"){
							$fifth_inst__status = "&#10004;";
						}else{
							$fifth_inst__status = "&#10006;";
						}
						
						$date = date("d/m/Y", strtotime($filterData->created));
						
						$data[] = array($i,$date,$filterData->client_name,$filterData->email,$filterData->contract_value,$filterData->total_tds,
						$filterData->total_gst,$filterData->first_inst_net_amount,$filterData->second_inst_net_amount,$filterData->third_inst_net_amount,
						$filterData->fourth_inst_net_amount,$filterData->fifth_inst_net_amount,$first_inst__status,$second_inst__status,
						$third_inst__status,$fourth_inst__status,$fifth_inst__status,$status,$action);
						$i++;
					}
						echo json_encode($data);
				}else{
					
					$data = array();
					echo json_encode($data);
				}
				
				
				
			}else{
					
				if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
					 $data['client_details'] = $this->client_model->get_client_detail();
				}else{
					 $data['client_details'] = $this->client_model->get_client_by_parent_detail($session_data['id']);
				}

				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/client/manage_client',$data);
				$this->load->view('admin/parts/footer',$footer);    	
			}
			
			

	}

	function add_client()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_client';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'add_client';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_client';

	
		$error_arr = array();
		
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			
				$this->form_validation->set_rules('client_name', 'Client Name', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('email', 'Client Email', 'trim|required|xss_clean|valid_email|is_unique[edu_client.email]');
				$this->form_validation->set_rules('contract_value', 'Contract Value', 'strip_tags|trim|required|xss_clean');
				//$this->form_validation->set_rules('gst_rate', 'GST Rate', 'required|is_numeric|greater_than[1]|less_than[101]');
				
				/* if($this->input->post('chk_tds')){
					$this->form_validation->set_rules('tds_rate', 'TDS Rate', 'required|is_numeric|greater_than[1]|less_than[101]');
				} */
				
				$this->form_validation->set_rules('first_installment', 'First Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('second_installment', 'Second Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('third_installment', 'Third Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('fourth_installment', 'Fourth Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('fifth_installment', 'Fifth Installment', 'strip_tags|trim|required|xss_clean');
				
				
			  if ($this->form_validation->run() == FALSE){
				
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/client/add_client',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
			
			/* $first_installment_gst = 0;
			$second_installment_gst = 0;
			$third_installment_gst = 0;
			$fourth_installment_gst = 0;
			$fifth_installment_gst = 0;
			
			$first_installment_tds = 0;
			$second_installment_tds = 0;
			$third_installment_tds = 0;
			$fourth_installment_tds = 0;
			$fifth_installment_tds = 0;
			
			if($this->input->post('chk_tds')){
					$total_tds = $this->input->post('contract_value')*$this->input->post('tds_rate')/100;
				}else{
					$total_tds = 0;
				}
			$total_gst = $this->input->post('contract_value')*$this->input->post('gst_rate')/100;
			
			
			if($this->input->post('first_installment') != ""){
				$first_installment_gst = $this->input->post('first_installment')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('chk_tds')){
					$first_installment_tds = $this->input->post('first_installment')*$this->input->post('tds_rate')/100;
				}
			}
			
			if($this->input->post('second_installment') != ""){
				$second_installment_gst = $this->input->post('second_installment')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('chk_tds')){
					$second_installment_tds = $this->input->post('second_installment')*$this->input->post('tds_rate')/100;
				}
			}
			if($this->input->post('third_installment') != ""){
				$third_installment_gst = $this->input->post('third_installment')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('chk_tds')){
					$third_installment_tds = $this->input->post('third_installment')*$this->input->post('tds_rate')/100;
				}
			}
			if($this->input->post('fourth_installment') != ""){
				$fourth_installment_gst = $this->input->post('fourth_installment')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('chk_tds')){
					$fourth_installment_tds = $this->input->post('fourth_installment')*$this->input->post('tds_rate')/100;
				}
			}
			if($this->input->post('fifth_installment') != ""){
				$fifth_installment_gst = $this->input->post('fifth_installment')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('chk_tds')){
					$fifth_installment_tds = $this->input->post('fifth_installment')*$this->input->post('tds_rate')/100;
				}
			} */
			
			/* $contractAmount = $this->input->post('contract_value');
			$tds = $this->config->item('ClientTds');
			$gst = $this->config->item('ClientGst');
			
			$tdsAmount = $contractAmount*$tds/100;
			$gstAmount = $contractAmount*$gst/100; */
			
			$data_addclient = array(
						'team_member_id' => $session_data['id'],
						'client_name' => $this->input->post('client_name'),
						'email' => $this->input->post('email'),
				     	'contract_value' => $this->input->post('contract_value'),
						'status' => $this->input->post('status'),
						'created' => date('Y/m/d  h:m:s'),
						);
					
				   						
					if($this->input->post('first_inst_net_amount')){
						$data_addclient['first_installment'] 	 = 	$this->input->post('first_installment');
						$data_addclient['first_inst_net_amount'] = 	$this->input->post('first_inst_net_amount');
						
						if($this->input->post('first_inst_tds')){
							$data_addclient['first_inst_tds_rate'] = 	$this->input->post('first_inst_tds');
							$data_addclient['first_installment_tds'] = 	$this->input->post('first_inst_tds_amount');
						}else{
							$data_addclient['first_inst_tds_rate'] = 0;
							$data_addclient['first_installment_tds'] = 0;
						}
						
						if($this->input->post('first_inst_gst')){
							$data_addclient['first_inst_gst_rate'] = 	$this->input->post('first_inst_gst');
							$data_addclient['first_installment_gst'] = 	$this->input->post('first_inst_gst_amount');
						}else{
							$data_addclient['first_inst_gst_rate'] = 0;
							$data_addclient['first_installment_gst'] = 0;
						}
						
						
						
					}
					if($this->input->post('second_inst_net_amount')){
						$data_addclient['second_installment'] 	  = 	$this->input->post('second_installment');
						$data_addclient['second_inst_net_amount'] = 	$this->input->post('second_inst_net_amount');
						
						if($this->input->post('second_inst_tds')){
							$data_addclient['second_inst_tds_rate'] = 	$this->input->post('second_inst_tds');
							$data_addclient['second_installment_tds'] = 	$this->input->post('second_inst_tds_amount');
						}else{
							$data_addclient['second_inst_tds_rate'] = 0;
							$data_addclient['second_installment_tds'] = 0;
						}
						
						if($this->input->post('second_inst_gst')){
							$data_addclient['second_inst_gst_rate'] = 	$this->input->post('second_inst_gst');
							$data_addclient['second_installment_gst'] = 	$this->input->post('second_inst_gst_amount');
						}else{
							$data_addclient['second_inst_gst_rate'] = 0;
							$data_addclient['second_installment_gst'] = 0;
						}
					}
					if($this->input->post('third_inst_net_amount')){
						$data_addclient['third_installment'] 	 = 	$this->input->post('third_installment');
						$data_addclient['third_inst_net_amount'] = 	$this->input->post('third_inst_net_amount');
						
						if($this->input->post('third_inst_tds')){
							$data_addclient['third_inst_tds_rate'] = 	$this->input->post('third_inst_tds');
							$data_addclient['third_installment_tds'] = 	$this->input->post('third_inst_tds_amount');
						}else{
							$data_addclient['third_inst_tds_rate'] = 0;
							$data_addclient['third_installment_tds'] = 0;
						}
						
						if($this->input->post('third_inst_gst')){
							$data_addclient['third_inst_gst_rate'] = 	$this->input->post('third_inst_gst');
							$data_addclient['third_installment_gst'] = 	$this->input->post('third_inst_gst_amount');
						}else{
							$data_addclient['third_inst_gst_rate'] = 0;
							$data_addclient['third_installment_gst'] = 0;
						}
					}
					if($this->input->post('fourth_inst_net_amount')){
						$data_addclient['fourth_installment'] 	  = 	$this->input->post('fourth_installment');
						$data_addclient['fourth_inst_net_amount'] = 	$this->input->post('fourth_inst_net_amount');
						
						if($this->input->post('fourth_inst_tds')){
							$data_addclient['fourth_inst_tds_rate'] = 	$this->input->post('fourth_inst_tds');
							$data_addclient['fourth_installment_tds'] = 	$this->input->post('fourth_inst_tds_amount');
						}else{
							$data_addclient['fourth_inst_tds_rate'] = 0;
							$data_addclient['fourth_installment_tds'] = 0;
						}
						
						if($this->input->post('fourth_inst_gst')){
							$data_addclient['fourth_inst_gst_rate'] = 	$this->input->post('fourth_inst_gst');
							$data_addclient['fourth_installment_gst'] = 	$this->input->post('fourth_inst_gst_amount');
						}else{
							$data_addclient['fourth_inst_gst_rate'] = 0;
							$data_addclient['fourth_installment_gst'] = 0;
						}
					}
					if($this->input->post('fifth_inst_net_amount')){
						$data_addclient['fifth_installment'] 	 =  $this->input->post('fifth_installment');
						$data_addclient['fifth_inst_net_amount'] = 	$this->input->post('fifth_inst_net_amount');
						
						if($this->input->post('fifth_inst_tds')){
							$data_addclient['fifth_inst_tds_rate'] = 	$this->input->post('fifth_inst_tds');
							$data_addclient['fifth_installment_tds'] = 	$this->input->post('fifth_inst_tds_amount');
						}else{
							$data_addclient['fifth_inst_tds_rate'] = 0;
							$data_addclient['fifth_installment_tds'] = 0;
						}
						
						if($this->input->post('fifth_inst_gst')){
							$data_addclient['fifth_inst_gst_rate'] = 	$this->input->post('fifth_inst_gst');
							$data_addclient['fifth_installment_gst'] = 	$this->input->post('fifth_inst_gst_amount');
						}else{
							$data_addclient['fifth_inst_gst_rate'] = 0;
							$data_addclient['fifth_installment_gst'] = 0;
						}
					}
					
					
						
					/* if($this->input->post('chk_tds')){
						$data_addclient['tds_rate'] = 	$this->input->post('tds_rate');
					}	 */
						
					if($this->input->post('first_installment_due')){
						$data_addclient['first_installment_due'] = 	$this->input->post('first_installment_due');
					}
					if($this->input->post('second_installment_due')){
						$data_addclient['second_installment_due'] = $this->input->post('second_installment_due');
					}
					if($this->input->post('third_installment_due')){
						$data_addclient['third_installment_due'] = $this->input->post('third_installment_due');
					}
					if($this->input->post('fourth_installment_due')){
						$data_addclient['fourth_installment_due'] = $this->input->post('fourth_installment_due');
					}
					if($this->input->post('fifth_installment_due')){
						$data_addclient['fifth_installment_due'] = 	$this->input->post('fifth_installment_due');
					}
					
				
					
				$this->client_model->add_client_data($data_addclient);	
			 
		
				//after successful submission
				$this->session->set_flashdata('success', 'You have added client successfully.');
				redirect('admin/client/manage_client/');
			
			
			  }
			  }
			  else {
				
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/client/add_client',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}

	function edit_client($id = Null)
	{
		
			if($id == NULL)
		{
			redirect('admin/client/manage_client');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_client';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'edit_client';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_client';

		  
		$data['client_data'] = $clientData =  $this->client_model->get_client_data_by_id($id);
	
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  
				$clientEmail = $this->input->post('email');
				
				$adClientEmail = $this->client_model->getClientByEmail($clientEmail,$id);
				
				if(sizeof($adClientEmail)>0)
				{
					$this->form_validation->set_rules('email', 'Client Email', 'trim|required|xss_clean|valid_email|is_unique[edu_client.email]');
				}
				else
				{
					$this->form_validation->set_rules('email', 'Client Email', 'trim|required|xss_clean|valid_email');
				}
			
			
				$this->form_validation->set_rules('client_name', 'Client Name', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('contract_value', 'Contract Value', 'strip_tags|trim|required|xss_clean');
				
				//$this->form_validation->set_rules('gst_rate', 'GST Rate', 'required|is_numeric|greater_than[1]|less_than[101]');
				
				/* if($this->input->post('chk_tds')){
					$this->form_validation->set_rules('tds_rate', 'TDS Rate', 'required|is_numeric|greater_than[1]|less_than[101]');
				} */
				
				$this->form_validation->set_rules('first_installment', 'First Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('second_installment', 'Second Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('third_installment', 'Third Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('fourth_installment', 'Fourth Installment', 'strip_tags|trim|required|xss_clean');
				$this->form_validation->set_rules('fifth_installment', 'Fifth Installment', 'strip_tags|trim|required|xss_clean');
			
			  
			if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/client/edit_client',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
				/* $first_installment_gst = 0;
				$second_installment_gst = 0;
				$third_installment_gst = 0;
				$fourth_installment_gst = 0;
				$fifth_installment_gst = 0;
				
				$first_installment_tds = 0;
				$second_installment_tds = 0;
				$third_installment_tds = 0;
				$fourth_installment_tds = 0;
				$fifth_installment_tds = 0;
				
				if($this->input->post('chk_tds')){
					$total_tds = $this->input->post('contract_value')*$this->input->post('tds_rate')/100;
				}else{
					$total_tds = 0;
				}
				$total_gst = $this->input->post('contract_value')*$this->input->post('gst_rate')/100;
				
				if($this->input->post('first_installment') != ""){
					$first_installment_gst = $this->input->post('first_installment')*$this->input->post('gst_rate')/100;
					
					if($this->input->post('chk_tds')){
						$first_installment_tds = $this->input->post('first_installment')*$this->input->post('tds_rate')/100;
					}
				}
				
				if($this->input->post('second_installment') != ""){
					$second_installment_gst = $this->input->post('second_installment')*$this->input->post('gst_rate')/100;
					
					if($this->input->post('chk_tds')){
						$second_installment_tds = $this->input->post('second_installment')*$this->input->post('tds_rate')/100;
					}
				}
				if($this->input->post('third_installment') != ""){
					$third_installment_gst = $this->input->post('third_installment')*$this->input->post('gst_rate')/100;
					
					if($this->input->post('chk_tds')){
						$third_installment_tds = $this->input->post('third_installment')*$this->input->post('tds_rate')/100;
					}
				}
				if($this->input->post('fourth_installment') != ""){
					$fourth_installment_gst = $this->input->post('fourth_installment')*$this->input->post('gst_rate')/100;
					
					if($this->input->post('chk_tds')){
						$fourth_installment_tds = $this->input->post('fourth_installment')*$this->input->post('tds_rate')/100;
					}
				}
				if($this->input->post('fifth_installment') != ""){
					$fifth_installment_gst = $this->input->post('fifth_installment')*$this->input->post('gst_rate')/100;
					
					if($this->input->post('chk_tds')){
						$fifth_installment_tds = $this->input->post('fifth_installment')*$this->input->post('tds_rate')/100;
					}
				} */
							
						$data_update_client = array(
						'client_name' => $this->input->post('client_name'),
						'email' => $this->input->post('email'),
				     	'contract_value' => $this->input->post('contract_value'),
				     	'status' => $this->input->post('status'),
						'updated' => date('Y/m/d  h:m:s'),
							
							
						);
						
					
					if($this->input->post('first_inst_net_amount')){
						$data_update_client['first_installment'] 	 = 	$this->input->post('first_installment');
						$data_update_client['first_inst_net_amount'] = 	$this->input->post('first_inst_net_amount');
						
						if($this->input->post('first_inst_tds')){
							$data_update_client['first_inst_tds_rate'] = 	$this->input->post('first_inst_tds');
							$data_update_client['first_installment_tds'] = 	$this->input->post('first_inst_tds_amount');
						}else{
							$data_update_client['first_inst_tds_rate'] = 0;
							$data_update_client['first_installment_tds'] = 0;
						}
						
						if($this->input->post('first_inst_gst')){
							$data_update_client['first_inst_gst_rate'] = 	$this->input->post('first_inst_gst');
							$data_update_client['first_installment_gst'] = 	$this->input->post('first_inst_gst_amount');
						}else{
							$data_update_client['first_inst_gst_rate'] = 0;
							$data_update_client['first_installment_gst'] = 0;
						}
						
						
						
					}
					if($this->input->post('second_inst_net_amount')){
						$data_update_client['second_installment'] 	  = 	$this->input->post('second_installment');
						$data_update_client['second_inst_net_amount'] = 	$this->input->post('second_inst_net_amount');
						
						if($this->input->post('second_inst_tds')){
							$data_update_client['second_inst_tds_rate'] = 	$this->input->post('second_inst_tds');
							$data_update_client['second_installment_tds'] = 	$this->input->post('second_inst_tds_amount');
						}else{
							$data_update_client['second_inst_tds_rate'] = 0;
							$data_update_client['second_installment_tds'] = 0;
						}
						
						if($this->input->post('second_inst_gst')){
							$data_update_client['second_inst_gst_rate'] = 	$this->input->post('second_inst_gst');
							$data_update_client['second_installment_gst'] = 	$this->input->post('second_inst_gst_amount');
						}else{
							$data_update_client['second_inst_gst_rate'] = 0;
							$data_update_client['second_installment_gst'] = 0;
						}
					}
					if($this->input->post('third_inst_net_amount')){
						$data_update_client['third_installment'] 	 = 	$this->input->post('third_installment');
						$data_update_client['third_inst_net_amount'] = 	$this->input->post('third_inst_net_amount');
						
						if($this->input->post('third_inst_tds')){
							$data_update_client['third_inst_tds_rate'] = 	$this->input->post('third_inst_tds');
							$data_update_client['third_installment_tds'] = 	$this->input->post('third_inst_tds_amount');
						}else{
							$data_update_client['third_inst_tds_rate'] = 0;
							$data_update_client['third_installment_tds'] = 0;
						}
						
						if($this->input->post('third_inst_gst')){
							$data_update_client['third_inst_gst_rate'] = 	$this->input->post('third_inst_gst');
							$data_update_client['third_installment_gst'] = 	$this->input->post('third_inst_gst_amount');
						}else{
							$data_update_client['third_inst_gst_rate'] = 0;
							$data_update_client['third_installment_gst'] = 0;
						}
					}
					if($this->input->post('fourth_inst_net_amount')){
						$data_update_client['fourth_installment'] 	  = 	$this->input->post('fourth_installment');
						$data_update_client['fourth_inst_net_amount'] = 	$this->input->post('fourth_inst_net_amount');
						
						if($this->input->post('fourth_inst_tds')){
							$data_update_client['fourth_inst_tds_rate'] = 	$this->input->post('fourth_inst_tds');
							$data_update_client['fourth_installment_tds'] = 	$this->input->post('fourth_inst_tds_amount');
						}else{
							$data_update_client['fourth_inst_tds_rate'] = 0;
							$data_update_client['fourth_installment_tds'] = 0;
						}
						
						if($this->input->post('fourth_inst_gst')){
							$data_update_client['fourth_inst_gst_rate'] = 	$this->input->post('fourth_inst_gst');
							$data_update_client['fourth_installment_gst'] = 	$this->input->post('fourth_inst_gst_amount');
						}else{
							$data_update_client['fourth_inst_gst_rate'] = 0;
							$data_update_client['fourth_installment_gst'] = 0;
						}
					}
					if($this->input->post('fifth_inst_net_amount')){
						$data_update_client['fifth_installment'] 	 =  $this->input->post('fifth_installment');
						$data_update_client['fifth_inst_net_amount'] = 	$this->input->post('fifth_inst_net_amount');
						
						if($this->input->post('fifth_inst_tds')){
							$data_update_client['fifth_inst_tds_rate'] = 	$this->input->post('fifth_inst_tds');
							$data_update_client['fifth_installment_tds'] = 	$this->input->post('fifth_inst_tds_amount');
						}else{
							$data_update_client['fifth_inst_tds_rate'] = 0;
							$data_update_client['fifth_installment_tds'] = 0;
						}
						
						if($this->input->post('fifth_inst_gst')){
							$data_update_client['fifth_inst_gst_rate'] = 	$this->input->post('fifth_inst_gst');
							$data_update_client['fifth_installment_gst'] = 	$this->input->post('fifth_inst_gst_amount');
						}else{
							$data_update_client['fifth_inst_gst_rate'] = 0;
							$data_update_client['fifth_installment_gst'] = 0;
						}
					}
					
					
			
					/* if($this->input->post('chk_tds')){
						$data_update_client['tds_rate'] = 	$this->input->post('tds_rate');
					}	 */
						
					if($this->input->post('first_installment_due')){
						$data_update_client['first_installment_due'] = 	$this->input->post('first_installment_due');
					}
					if($this->input->post('second_installment_due')){
						$data_update_client['second_installment_due'] = $this->input->post('second_installment_due');
					}
					if($this->input->post('third_installment_due')){
						$data_update_client['third_installment_due'] = $this->input->post('third_installment_due');
					}
					if($this->input->post('fourth_installment_due')){
						$data_update_client['fourth_installment_due'] = $this->input->post('fourth_installment_due');
					}
					if($this->input->post('fifth_installment_due')){
						$data_update_client['fifth_installment_due'] = 	$this->input->post('fifth_installment_due');
					}
					
					if($this->input->post('first_installment_status')){
						//echo $this->input->post('first_installment_status'); die;
						$data_update_client['first_installment_status']  = $this->input->post('first_installment_status');
						
					}else{
						//echo "test"; die;
						$data_update_client['first_installment_status']  = 'Not Received';
					}
					
					if($this->input->post('second_installment_status')){
						$data_update_client['second_installment_status'] = $this->input->post('second_installment_status');
						
					}else{
						$data_update_client['second_installment_status'] = 'Not Received';
					}
					if($this->input->post('third_installment_status')){
						$data_update_client['third_installment_status'] = $this->input->post('third_installment_status');
						
					}else{
						$data_update_client['third_installment_status'] = 'Not Received';
					}
					if($this->input->post('fourth_installment_status')){
						$data_update_client['fourth_installment_status'] = $this->input->post('fourth_installment_status');
						
					}else{
						$data_update_client['fourth_installment_status'] = 'Not Received';
					}
					if($this->input->post('fifth_installment_status')){
						$data_update_client['fifth_installment_status'] = $this->input->post('fifth_installment_status');
						
					}else{
						$data_update_client['fifth_installment_status'] = 'Not Received';
					}	
					
			$this->client_model->update_client_data($data_update_client,$id);			
					
			/* Send mail to client for installment status */
			
			$to = $this->input->post('email');
			$from = $this->config->item('FromEmail');
			$subject = "Installment status!";
			$emaildata['site_name'] = $this->config->item('Site_name');
			$emaildata['name'] = $this->input->post('client_name');
			
					
			if($this->input->post('first_installment_status') && $this->input->post('chkStatusfirstInstallment') == 'Not Received'){
				$emaildata['message'] = "Your first installment received.";
				$message = $this->load->view('site/email/installment_status',$emaildata, true);
				$sendMailClient = $this->sendEmail($to,$from,$subject,$message);
			}
			
			if($this->input->post('second_installment_status') && $this->input->post('chkStatussecondInstallment') == 'Not Received'){
				$emaildata['message'] = "Your second installment received.";
				$message = $this->load->view('site/email/installment_status',$emaildata, true);
				$sendMailClient = $this->sendEmail($to,$from,$subject,$message);
			}
			if($this->input->post('third_installment_status') && $this->input->post('chkStatusthirdInstallment') == 'Not Received'){
				$emaildata['message'] = "Your third installment received.";
				$message = $this->load->view('site/email/installment_status',$emaildata, true);
				$sendMailClient = $this->sendEmail($to,$from,$subject,$message);
			}
			if($this->input->post('fourth_installment_status') && $this->input->post('chkStatusfourthInstallment') == 'Not Received'){
				
				$emaildata['message'] = "Your fourth installment received.";
				$message = $this->load->view('site/email/installment_status',$emaildata, true);
				$sendMailClient = $this->sendEmail($to,$from,$subject,$message);
			}
			if($this->input->post('fifth_installment_status') && $this->input->post('chkStatusfifthInstallment') == 'Not Received'){
				$emaildata['message'] = "Your fifth installment received.";
				$message = $this->load->view('site/email/installment_status',$emaildata, true);
				$sendMailClient = $this->sendEmail($to,$from,$subject,$message);
			}
			
			/* Send mail to client for installment status end */			
			
			 
			 $data['client_data'] = $this->client_model->get_client_data_by_id($id);
	
			//after successful submission
				$this->session->set_flashdata('success', 'You have updated client successfully.');
				redirect('admin/client/manage_client/');
			
			
			  }
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/client/edit_client',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	function delete_client($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '0');
			$delete = $this->client_model->delete_client_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have deactivate client successfully.');
				redirect('admin/client/manage_client');
			}
		}
		
	}
	
	function active_client($id=null)
	{
		
		if($id!=null){
			$status = array('status'=> '1');
			$delete = $this->client_model->delete_client_by_id($id,$status);
			if($delete==true){
				//after successful submission
				$this->session->set_flashdata('success', 'You have active client successfully.');
				redirect('admin/client/manage_client');
			}
		}
		
	}

	
 	function alpha_dash_space($str) {
		
		if( ! preg_match("/^([-a-z_ \"#$%&'()*+,\-.\\:\/;=?@^_])+$/i", $str)){ 
		
			$this->form_validation->set_message('alpha_dash_space', 'The Partner Title Field Should Be Valid');
			
			return FALSE;
		}else{ 
			
			return TRUE; 
		} 

	}
	
	function download_client_csv($from = null, $to = null, $id = null){
		//echo $from; die;
		$dtfrom ="";
		$dtto = "";
		$clientId = "";
		
		if($from != 'null'){
			
			$dtfrom = $from;
			$dtfrom = date_create($dtfrom);
			$dtfrom = date_format($dtfrom,"Y-m-d");
		}
		if($to != 'null'){
			$dtto = $to;
			$dtto = date_create($dtto);
			$dtto = date_format($dtto,"Y-m-d");
		
		}
		if($id != 'null'){
			$clientId = $id;
		}
		
		$session_data = $this->session->userdata('admin_user');
		
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		
		if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
		
			$this->db->select('client_name,contract_value,first_inst_net_amount,second_inst_net_amount,third_inst_net_amount,fourth_inst_net_amount,fifth_inst_net_amount,first_installment_status,second_installment_status,third_installment_status,fourth_installment_status,fifth_installment_status,created');
						
			$this->db->from('edu_client');
			
			 if($dtfrom!=""){
				$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") >=',$dtfrom);

			}

			if($dtto!=""){
				$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") <=',$dtto);

			} 
			
			if($clientId != ""){
				$this->db->where('id =',$clientId);
			}
			
			$this->db->order_by('id','DESC');
			$query = $this->db->get();
			
		}else{
			
			$this->db->select('client_name,contract_value,first_installment + first_installment_tds + first_installment_gst as first_installment,second_installment + second_installment_tds + second_installment_gst as second_installment,third_installment + third_installment_tds + third_installment_gst as third_installment,fourth_installment + fourth_installment_tds + fourth_installment_gst as fourth_installment,fifth_installment + fifth_installment_tds + fifth_installment_gst as fifth_installment,total_tds,total_gst,first_installment_status,second_installment_status,third_installment_status,fourth_installment_status,fifth_installment_status,created');
			$this->db->from('edu_client');
			$this->db->where('team_member_id', $parent_id);
			
			if($from!=""){
				$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") >=',$dtfrom);

			}

			if($to!=""){
				$this->db->where('DATE_FORMAT(edu_client.created,"%Y-%m-%d") <=',$dtto);

			}
			
			$this->db->order_by('id','DESC');
			$query = $this->db->get();
		}
		
		
		$delimiter = ",";

		$newline = "\r\n";
		
		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);

		echo force_download('client_data.csv', $data); die;
	}
	
/* Client and team member relation start */	

function relation_list()
	{
		
    		$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];
			$header['main_page'] = 'relation_list';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'relation_list';
		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'relation_list';
			
			if($session_data['user_type'] == "admin" || $session_data['user_type'] == "superadmin"){
					$data['relation_details'] = $this->client_model->get_relation_detail();
			}else{
				
					$data['relation_details'] = $this->client_model->get_relation_by_user($session_data['id']);
					
			}

		  // $data['relation_details'] = $this->client_model->get_relation_detail();
		   //echo '<pre>'; print_r($data['relation_details']); die;

			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/client/relation_list',$data);
			$this->load->view('admin/parts/footer',$footer);    	

	}
	

function add_relation()
	{
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'add_relation';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'add_relation';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'add_relation';

	
		$error_arr = array();
		
		  $data['team_members'] = $this->user_model->get_team_members();
		  $data['clients'] = $this->client_model->get_active_clients();
		  
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  $team_member = $this->input->post('team_member');
			  $client = $this->input->post('client');
			  
			 
			
				$this->form_validation->set_rules('team_member', 'Team Member', 'required');
				$this->form_validation->set_rules('client', 'Client', 'required');
				$temp = true;
				
				$duplicate_relation = $this->client_model->get_exist_relation($team_member,$client);
				
				if(sizeof($duplicate_relation) > 0){
					$data['duplicate_error'] = 'Duplicate Relation';
					$temp = false;
				}
				
			  if ($this->form_validation->run() == FALSE){
				
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/client/add_relation',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				
			if($temp){	
						
				$data_addrelation = array(
							'team_member_id' => $this->input->post('team_member'),
							'client_id' => $this->input->post('client'),
							'status' => $this->input->post('status'),
							'created_by' => $session_data['id'],
							'created' => date('Y/m/d  h:m:s'),
							);
						
					$this->client_model->add_relation_data($data_addrelation);	
				 
			
					//after successful submission
					$this->session->set_flashdata('success', 'You have added relation successfully.');
					redirect('admin/client/relation_list/');
			
			}else{
				
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/client/add_relation',$data);
				$this->load->view('admin/parts/footer',$footer);	
			}
			  }
			  }
			  else {
				
				$this->load->view('admin/parts/header',$header);
				$this->load->view('admin/parts/sidebar_left',$sidebar);
				$this->load->view('admin/client/add_relation',$data);
				$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	
	
	function edit_relation($id = Null)
	{
		
			if($id == NULL)
		{
			redirect('admin/client/relation_list');
		}
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
    	$session_data = $this->session->userdata('admin_user');
		    $data['username'] = $session_data['admin_username'];

		    $header['main_page'] = 'edit_relation';
		    $header['tab'] = 'client';
		    $header['username'] =  $data['username'];

		    $sidebar['page'] = 'client';
		    $sidebar['main_page'] = 'edit_relation';

		    $sidebar['username'] =  $data['username'];
		    
		    $footer['main_page'] = 'edit_relation';

		  
		$data['relation_data'] = $clientData =  $this->client_model->get_relation_data_by_id($id);
	
		$error_arr = array();
		
		// Displaying Errors In Div
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		$data['team_members'] = $this->user_model->get_team_members();
		$data['clients'] = $this->client_model->get_active_clients();
		  
		  if($_SERVER['REQUEST_METHOD']=='POST')
		  {
			  $team_member = $this->input->post('team_member');
			  $client = $this->input->post('client');
			  
			  $this->form_validation->set_rules('team_member', 'Team Member', 'required');
			  $this->form_validation->set_rules('client', 'Client', 'required');
			  
			$temp = true;
				
				$duplicate_relation = $this->client_model->get_exist_relation($team_member,$client,$id);
				
				if(sizeof($duplicate_relation) > 0){
					$data['duplicate_error'] = 'Duplicate Relation';
					$temp = false;
				}
				
			  
			if ($this->form_validation->run() == FALSE){
				  
				$this->load->view('admin/parts/header',$header);
		        $this->load->view('admin/parts/sidebar_left',$sidebar);
		        $this->load->view('admin/client/edit_relation',$data);
		        $this->load->view('admin/parts/footer',$footer);
			} 
			else {
				if($temp){

					
						$data_update_relation = array(
						'team_member_id' => $this->input->post('team_member'),
						'client_id' => $this->input->post('client'),
						'status' => $this->input->post('status'),
						'updated' => date('Y/m/d  h:m:s'),
						);
						
						 $this->client_model->update_relation_data($data_update_relation,$id);	
						 $data['client_data'] = $this->client_model->get_relation_data_by_id($id);
				
						//after successful submission
							$this->session->set_flashdata('success', 'You have updated relation successfully.');
							redirect('admin/client/relation_list/');
				}else{
					
					$this->load->view('admin/parts/header',$header);
					$this->load->view('admin/parts/sidebar_left',$sidebar);
					$this->load->view('admin/client/edit_relation',$data);
					$this->load->view('admin/parts/footer',$footer);
				}
					 
			}
	}
			  else {
				
			
			
			$this->load->view('admin/parts/header',$header);
			$this->load->view('admin/parts/sidebar_left',$sidebar);
			$this->load->view('admin/client/edit_relation',$data);
			$this->load->view('admin/parts/footer',$footer);	
			
			  }
		
	}
	

/* Client and team member relation end */	

function sendEmail($to,$from,$subject,$message){
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from($from,$this->config->item('Site_name'));
		$this->email->subject($subject);
		$this->email->message($message);
				
		if($this->email->send()){
			return true;
		}else{
			return false;
			
		}
}

 function editor($path,$width) {
		 
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'/assets/admin/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';		$this->ckeditor-> config['allowedContent'] = 'true';	$this->ckeditor-> config['removeFormatAttributes'] = ''; 
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }	
	

	

//end by aglram

}

?>