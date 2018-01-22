<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = 'welcome/show_404';

$route['^(index|login|logout|send_again|forgot_password|reset_password)(/:any)?$'] = "auth/$0";


//$route['^(index|about_ficci|about_ipec|message_sg_desk|about_rgniip|message_cg_desk|message_rgniip_head|contact|user_registration|about|user_profile)(/:any)?$'] = "welcome/$0";

$route['admin'] = "dashboard/admin/login";
$route['admin/user/(:any)'] = "dashboard/user/$1";
$route['admin/assignment/(:any)'] = "dashboard/assignment/$1";
$route['admin/page/(:any)'] = "dashboard/page/$1";
$route['admin/ip_services/(:any)'] = "dashboard/ip_services/$1";
$route['admin/quiz/(:any)'] = "dashboard/quiz/$1";
$route['admin/question/(:any)'] = "dashboard/question/$1";
$route['admin/event/(:any)'] = "dashboard/news_event/$1";
$route['admin/news/(:any)'] = "dashboard/news/$1";
$route['admin/course/(:any)'] = "dashboard/course/$1";
$route['admin/slider/(:any)'] = "dashboard/slider/$1";
$route['admin/report/(:any)'] = "dashboard/report/$1";
$route['admin/forum/(:any)'] = "dashboard/forum/$1";
$route['admin/announcement/(:any)'] = "dashboard/announcement/$1";
$route['admin/payment/edit_payment/(:num)'] = "dashboard/payment/add_payment/$1";
$route['admin/payment/(:any)'] = "dashboard/payment/$1";
$route['admin/payment/update_status/(:any)/(:any)/(:any)'] = "dashboard/payment/update_status/$1/$2/$3";

$route['admin/nationality/(:any)'] = "dashboard/nationality/$1";
$route['admin/source_information/(:any)'] = "dashboard/source_information/$1";
$route['admin/source_registration/(:any)'] = "dashboard/source_registration/$1";

$route['admin/testimonial/(:any)'] = "dashboard/testimonial/$1";

$route['admin/setting/(:any)'] = "dashboard/setting/$1";
$route['admin/announcement/(:any)'] = "dashboard/announcement/$1";

$route['admin/subscriber/(:any)'] = "dashboard/subscriber/$1";
$route['admin/enquiry/(:any)'] = "dashboard/enquiry/$1";
$route['admin/key-feature/(:any)'] = "dashboard/key_features/$1";
$route['admin/course_coverage/(:any)'] = "dashboard/course_coverage/$1";
$route['admin/ip_competition/(:any)'] = "dashboard/ip_competition_law/$1";
//$route['admin/category/(:any)'] = "dashboard/category/$1";
$route['admin/faq/(:any)'] = "dashboard/faq/$1";
$route['admin/course/(:any)'] = "dashboard/course/$1";
$route['admin/session/(:any)'] = "dashboard/session/$1";
$route['admin/study_material/(:any)'] = "dashboard/study_material/$1";
$route['admin/student_result/(:any)'] = "dashboard/exam_result/$1";
$route['admin/fees/(:any)'] = "dashboard/fees_manager/$1";
$route['admin/city/(:any)'] = "dashboard/city_manager/$1";
$route['admin/state/(:any)'] = "dashboard/state_manager/$1";
$route['admin/gallery/(:any)'] = "dashboard/gallery/$1";
$route['admin/menu/(:any)'] = "dashboard/menu/$1";
$route['admin/help/(:any)'] = "dashboard/help/$1";
$route['admin/history/(:any)'] = "dashboard/educatus_history/$1";
$route['admin/participat_collage/(:any)'] = "dashboard/participating_colleges/$1";
$route['admin/counselor/(:any)'] = "dashboard/counselor/$1";
$route['admin/dream_collage/(:any)'] = "dashboard/dream_colleges/$1";
$route['admin/universities/(:any)'] = "dashboard/universities/$1";
$route['admin/register/(:any)'] = "dashboard/registration/$1";
$route['admin/client/(:any)'] = "dashboard/client/$1";
$route['admin/email_template/(:any)'] = "dashboard/Emailtemplates/$1";
$route['admin/bulk/(:any)'] = "dashboard/bulk/$1";
$route['admin/(:any)'] = "dashboard/admin/$1";

$route['student/(:any)'] = "frontuser/student/$1";
$route['forum/(:any)'] = "frontuser/forum/$1";




// Page routing Start
//$route['about-us'] = "page/getPageData";
//$route['about/(:any)'] = "page/getPageData/$1";
$route['contact-us'] = "page/getContactUs";
//$route['about-us'] = "page/getAboutUs";
$route['disclaimer'] = "page/disclaimer";
$route['terms'] = "page/terms";
//$route['faq'] = "page/faq";
$route['online-register'] = "page/online_registration";
$route['exhibitor-register'] = "page/exhibitior_registration";
$route['thankyou'] = "welcome/thankyou";
$route['post/(:any)'] = "page/news_detail/$1";
$route['news-events'] = "page/news_events";
$route['success-online-register'] = "page/success_online_register";
$route['success-exhibitor-register'] = "page/success_exhibitor_register";
$route['exhibition/(:any)'] = "page/exhibition_detail/$1";
$route['news-filter'] = 'page/filter_news';
$route['confirmation'] = 'page/confirmation';
$route['filter_news/(:num)'] = "page/filter_news/$1";
$route['paginat-news'] = 'page/ajaxPaginationData';
$route['paginat-news/(:num)'] = "page/ajaxPaginationData/$1";
$route['news'] = "page/list_news";
$route['news/(:num)'] = "page/list_news/$1";
$route['form'] = 'ajax/user/formData/';
$route['subscribe'] = 'ajax/subscribe/subcribeUser';
$route['search'] = "page/search";
$route['feedback'] = "page/feedback";
$route['(:any)'] = "page/get_page_data/$1";






//  Ip services routing Start

// Ajax URl 






/* End of file routes.php */
/* Location: ./application/config/routes.php */