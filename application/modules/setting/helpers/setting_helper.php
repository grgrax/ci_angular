<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_settings($param){
	$ci=& get_instance();
	return $data=$ci->load->model('setting/setting_m')->read_rows_by($param); 
}

function get_setting_n($param){
	$ci=& get_instance();
	$data=$ci->load->model('setting/setting_m')->read_rows_by($param); 
	return $data?:null;
}

function setting_exists($slug){
	$data=get_setting(array('slug'=>$slug));
	return $data?true:false;
}

function get_setting_value($key){
	$ci=& get_instance();
	$data=$ci->load->model('setting/setting_m')->read_rows_by(array('slug'=>$key),1); 	
	return $data?$data['value']:null;
}

/* End of file user_helper.php */
