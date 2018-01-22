<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('get_total_user'))
{
	function get_total_user()
	{
		$CI = & get_instance();
		$CI->load->model('user_model');
		
		return $CI->user_model->get_total_user_count();
		
		 
	}
}



if ( ! function_exists('get_user_type_name'))
{
	function get_user_type_name($id)
	{
		$CI = & get_instance();
		$CI->load->model('user_model');
		
		return $CI->user_model->get_user_type_name($id);
		
		 
	}
}
