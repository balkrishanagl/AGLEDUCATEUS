<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Report extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$session_data = $this->session->userdata('admin_user');



		if($session_data['admin_user_type_id']==3){

			redirect('admin/dashboard');

		}

		$this->load->helper('url');

		$this->load->helper('download');

		$this->load->model("user_model");

		$this->load->model("student_model");

		$this->load->model("payment_model");

		$this->load->model("source_model");

		$this->load->model("session_model");

		$this->load->model("fees_model");



	}





	//Method to get payment report - Manoj Sharma

	function payment_report($type=NULL){





		$payment_type=null;

		$status=null;

		$from=null;

		$to=null;

		$sessionId=null;

		$userType=null;

		$source=null;

		$exam_type=null;



		if($this->session->userdata('admin_user')){

			$session_data = $this->session->userdata('admin_user');

			$data['username'] = $session_data['admin_username'];

			$data['user_type_id'] = $session_data['admin_user_type_id'];



			$data['payment_type_list'] = $this->payment_model->getPaymentType();

			$data['session_data'] = $this->session_model->getAllActiveSession();

			//$data['user_type'] = $this->session_model->getAllActiveSession();



			$data['source_data'] =  $this->source_model->get_source_detail();

			$data['user_type'] = $this->fees_model->getAllFees();





			$header['main_page'] = 'report';

			$header['tab'] = 'payment_report';

			$header['username'] =  $data['username'];



			$sidebar['page'] = 'report';

			$sidebar['username'] =  $data['username'];



			$footer['main_page'] = 'report';

			/*if($session_data['admin_username']!='admin'){

				$data['question_list'] = $this->question_model->listQuestion($session_data['id']);

			} else {*/



			//assign post data if any













			if($_SERVER['REQUEST_METHOD']=='POST'){

				//echo "<pre>"; print_r($_POST); die;



				if(isset($_POST['payment_type']) and $_POST['payment_type']!=''){

					$payment_type = $_POST['payment_type'];

				}



				if(isset($_POST['payment_status']) and $_POST['payment_status']!=''){

					$status = $_POST['payment_status'];

				}



				if(isset($_POST['sessionId']) and $_POST['sessionId']!=''){

					$sessionId = $_POST['sessionId'];

				}



				if(isset($_POST['userType']) and $_POST['userType']!=''){

					$userType = $_POST['userType'];

				}



				if(isset($_POST['exam_type']) and $_POST['exam_type']!=''){



					$exam_type = $_POST['exam_type'];

				}



				if(isset($_POST['source']) and $_POST['source']!=''){

					$source = $_POST['source'];

				}







				if(isset($_POST['fromdt']) and $_POST['fromdt']!=''){



					$from = $_POST['fromdt'];

					$from = date_create($from);

					$from = date_format($from,"Y/m/d");



				}



				if(isset($_POST['todt']) and $_POST['todt']!=''){

					$to = $_POST['todt'];

					$to = date_create($to);

					$to = date_format($to,"Y/m/d");

				}





				$filter_data = $this->payment_model->listPayment($payment_type, $status, $from, $to, $userType, $sessionId, $source, $exam_type);

				//echo '<pre>'; print_r($filter_data); die;

				if(isset($filter_data) && $filter_data != NULL) {

					$i=0;

					$result = '';

					$status = '';

					$examType = '';

					$data = array();

					foreach($filter_data as $filterData) {



						if($filterData->status == "1"){

							$status = "Active";

						}else{

							$status = "Inactive";

						}



						if($filterData->exam_type == 1){

							$examType = "Main";

						}else{

							$examType = "Re-Exam";

						}



						$regDate = date("d/m/Y", strtotime($filterData->created));



						$i++;

						/* $result .= '<tr><td>'.$i.'</td>/';

                        $result .= '<td>' .$filterData->username. '</td>';

                        $result .= '<td>'. $filterData->payment_type. '</td>';

                        $result .= '<td>' .$filterData->cheque_date. '</td>';

                        $result .= '<td>' .$filterData->course_fee. '</td>';

                        $result .= '<td>' .$filterData->vendor_amount. '</td>';

                        $result .= '<td>' .$filterData->servicetax_amount. '</td>';

                        $result .= '<td>' .$filterData->gross_amount. '</td>';

                        $result .= '<td>' .$filterData->reference_no. '</td>';

                        $result .= '<td>' .$filterData->bank_name. '</td>';

                        $result .= '<td>' .$filterData->branch_name. '</td>';

                        $result .= '<td>' .$status. '</td>'; */



						$data[] = array($i,$filterData->session,$regDate,$filterData->enrollment_no,$filterData->user_type_name,$filterData->first_name,$filterData->username,$filterData->email,$filterData->mobile_number,$filterData->source,

							$filterData->source_detail,$filterData->course_fee,$filterData->vendor_amount,$filterData->servicetax_amount,$filterData->gross_amount,$filterData->payment_type_id,$filterData->cheque_date,$filterData->reference_no,$examType,$filterData->bank_name,

							$filterData->branch_name,$status);



					}

					//echo $result; die;

					echo json_encode($data);

				}else{



					/* $result = "";

                    echo $result; die; */



					$data = array();

					echo json_encode($data);

				}

			}else{

				$data['payment_list'] = $this->payment_model->listPayment($payment_type, $status, $from, $to, $userType, $sessionId, $source);

				//echo '<pre>'; print_r($data['payment_list']); die;

				$this->load->view('admin/parts/header',$header);

				$this->load->view('admin/parts/sidebar_left',$sidebar);

				$this->load->view('admin/report/payment_report', $data);

				$this->load->view('admin/parts/footer',$footer);

			}



			//}



		} else {

			redirect('admin/login', 'refresh');

		}





	}







	function exportPayment(){



		//$formType = urldecode($sts);



		$this->load->dbutil();

		$this->load->helper('file');

		$this->load->helper('download');

		$delimiter = ",";

		$newline = "\r\n";

		$filename = "payment_report";

		$this->db->select('ficci_session.name as session,users.created as registration_on,user_profiles.enrollment_no as user_registration_id,admin_user_type.user_type_name,user_profiles.first_name as name');

		$this->db->select('users.username as username,users.email,user_profiles.mobile_number,ficci_source_information.name as source,ficci_payment.course_fee,ficci_payment.vendor_amount,ficci_payment.servicetax_amount');

		$this->db->select('ficci_payment.gross_amount,ficci_payment.exam_type,ficci_payment.payment_on,ficci_payment.reference_no,ficci_payment.exam_type,ficci_payment.bank_name,ficci_payment.branch_name');



		$this->db->from('ficci_payment');



		$this->db->join('user_profiles','user_profiles.user_id=ficci_payment.user_id','inner');

		$this->db->join('ficci_source_information','ficci_source_information.id=user_profiles.sourceinformation','inner');

		$this->db->join('users','users.id=ficci_payment.user_id','inner');

		$this->db->join('admin_user_type','admin_user_type.user_type_id=users.user_type_id','inner');

		$this->db->join('ficci_session','ficci_session.id=users.session_id','left');

		$this->db->order_by('ficci_payment.id','desc');

		$query = $this->db->get();



		$result = $query->result_array();

		//echo '<pre>'; print_r($result); die;

		$fData = $result;

		//echo '<pre>'; print_r($fData); die;

		$field_arr = array();

		$data_arr = array();

		$cnt = 0;

		$i = 0;

		foreach($fData as $fdt){



			foreach($fdt as $key => $value){

				if($cnt==0){



					$field_arr[] = $key;

					if($key == "exam_type"){

						if($value == 1){

							$data_arr[$cnt][] = "Main";

						}elseif($value == 2){

							$data_arr[$cnt][] = "Re-Exam";

						}else{

							$data_arr[$cnt][] = $value;

						}

					}elseif($key == "registration_on"){

						$data_arr[$cnt][] = date("d/m/Y", strtotime($value));

					}else{

						$data_arr[$cnt][] = $value;

					}

				} else {

					//$data_arr[$cnt][]= $value;

					if($key == "exam_type"){

						if($value == 1){

							$data_arr[$cnt][] = "Main";

						}elseif($value == 2){

							$data_arr[$cnt][] = "Re-Exam";

						}else{

							$data_arr[$cnt][] = $value;

						}

					}elseif($key == "registration_on"){

						$data_arr[$cnt][] = date("d/m/Y", strtotime($value));

					}else{

						$data_arr[$cnt][] = $value;

					}

				}

				$i++;

			}



			$cnt++;

		}



		//echo '<pre>'; print_r($field_arr); die;

		header("Content-type: application/csv");

		header("Content-Disposition: attachment; filename=".$filename.".csv");

		header("Pragma: no-cache");

		header("Expires: 0");



		$handle = fopen('php://output', 'w');



		fputcsv($handle,$field_arr);



		foreach ($data_arr as $data) {



			fputcsv($handle, $data);

		}

		fclose($handle);

		exit;

	}









	//Method to get payment report - Manoj Sharma

	function registration_report(){



		$from=null;

		$to=null;

		$source=null;

		$sessionId=null;

		$userType=null;

		if($this->session->userdata('admin_user')){



			$data['source_type_list'] = $this->source_model->get_source_detail();





			$session_data = $this->session->userdata('admin_user');

			$data['username'] = $session_data['admin_username'];

			$data['user_type_id'] = $session_data['admin_user_type_id'];

			$data['session_data'] = $this->session_model->getAllActiveSession();

			$header['main_page'] = 'report';

			$header['tab'] = 'registration_report';

			$header['username'] =  $data['username'];
			$data['user_type'] = $this->fees_model->getAllFees();


			$sidebar['page'] = 'report';

			$sidebar['username'] =  $data['username'];



			$footer['main_page'] = 'report';

			/*if($session_data['admin_username']!='admin'){

                $data['question_list'] = $this->question_model->listQuestion($session_data['id']);

            } else {*/



			if($_SERVER['REQUEST_METHOD']=='POST'){



				if(isset($_POST['SourceId']) and $_POST['SourceId']!=''){



					$source = $_POST['SourceId'];

				}





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


				if(isset($_POST['userType']) and $_POST['userType']!=''){

					$userType = $_POST['userType'];

				}

				if(isset($_POST['sessionId']) and $_POST['sessionId']!=''){

					$sessionId = $_POST['sessionId'];

				}



				$filter_data = $this->student_model->listRegisterUser($from, $to, $source,$userType, $sessionId);





				if(isset($filter_data) && $filter_data != NULL) {

					$i=1;

					$result = '';

					$status = '';

					$data = array();

					foreach($filter_data as $filterData) {



						$regDate = date("d/m/Y", strtotime($filterData->created));



						$data[] = array($i,$filterData->session,$filterData->user_type_name,$regDate,$filterData->first_name,$filterData->father_name,$filterData->gender,$filterData->source,$filterData->created,

							$filterData->dob,$filterData->email,$filterData->permanent_address,$filterData->mobile_number,

							$filterData->nationality,$filterData->qualification,$filterData->organization,$filterData->designation,

							$filterData->designation,$filterData->about_course,$filterData->course_year);





						$i++;





					}



					echo json_encode($data);



				}else{



					/* $result = "";

                    echo $result; die; */



					$data = array();

					echo json_encode($data);

				}

			}else{

				//echo "Test"; die;

				//$data['user_list'] = $this->user_model->listUser();

				$data['user_list'] = $this->student_model->listRegisterUser();



				//echo '<pre>'; print_r($data['user_list']); die;

				//}

				$this->load->view('admin/parts/header',$header);

				$this->load->view('admin/parts/sidebar_left',$sidebar);

				$this->load->view('admin/report/registration_report', $data);

				$this->load->view('admin/parts/footer',$footer);



			}



		} else {

			redirect('admin/login', 'refresh');

		}



	}





	function download_registration_csv()

	{





		//echo $fromDate.'<br/>';





		//echo $toDte; die;

		$this->load->dbutil();

		$this->load->helper('file');

		$this->load->helper('download');



		$this->db->select('users.username,users.email,ficci_session.name as session');

		$this->db->select('user_profiles.first_name,user_profiles.father_name,user_profiles.gender,user_profiles.dob,user_profiles.permanent_address,user_profiles.mobile_number,

								   user_profiles.nationality,user_profiles.qualification,user_profiles.organization,user_profiles.designation,user_profiles.about_course,user_profiles.course_year');

		$this->db->select('ficci_source_information.name as source');

		$this->db->from('users');

		$this->db->join('user_profiles','user_profiles.user_id=users.id');

		$this->db->join('ficci_source_information','ficci_source_information.id=user_profiles.sourceinformation');

		$this->db->join('ficci_session','ficci_session.id=users.session_id','left');







		$this->db->where('users.user_type_id in(4,5,6)');

		$this->db->order_by('users.id','desc');

		$query = $this->db->get();



		//echo $this->db->last_query(); die;

		//echo $this->db->last_query(); die;



		$delimiter = ",";

		$newline = "\r\n";

		$data = $this->dbutil->csv_from_result($query, $delimiter, $newline);

		echo force_download('Registration_Report.csv', $data); die;



		//}

		//$status='success';

		//$msg='Email Sent Successfully';

	}











}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */