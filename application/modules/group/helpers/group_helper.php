<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_action_links')) {
	function get_action_links($user_m=NULL,$status=NULL){
		$alertClass="";
		$action_links=array();
		switch($status){
			case $user_m::PENDING:
			{
				$alertClass="active";
				$action_links=array($user_m::ACTIVE=>$user_m::ACTIVE);
				break;
			}
			case $user_m::ACTIVE:
			{
				$alertClass="";
				$action_links=array(
					$user_m::BLOCKED=>$user_m::BLOCKED,
					$user_m::DELETED=>$user_m::DELETED
					);
				break;
			}
			case $user_m::BLOCKED:
			{
				$alertClass="warning";
				$action_links=array(
					$user_m::ACTIVE=>$user_m::ACTIVE,
					$user_m::DELETED=>$user_m::DELETED
					);
				break;
			}
			case $user_m::DELETED:
			{
				$alertClass="danger";
				$action_links=array($user_m::ACTIVE=>$user_m::ACTIVE);
				break;
			}
		}
		return (array(
			'alertClass'=>$alertClass,
			'action_links'=>$action_links,
			));
	}
}


// function show_group_name($id){
// 	try {
// 		$ci=& get_instance();
// 		// show_pre($ci);
// 		return $ci->load->model('group/group_m')->get_group_name($id);
// 	} catch (Exception $e) {
		
// 	}
// }

// function get_all_groups(){
// 	try {
// 		$ci=& get_instance();
// 		return $ci->load->model('group/group_m')->get_groups();
// 	} catch (Exception $e) {
		
// 	}
// }	

function get_groups($param){
	try {
		$ci=& get_instance();
		return $ci->load->model('group/group_m')->read_rows_by($param);
	} catch (Exception $e) {
		
	}	
}

function get_group($param){
	try {
		$ci=& get_instance();
		return $ci->load->model('group/group_m')->read_row_by_n($param);
	} catch (Exception $e) {
		
	}	
}

/* End of file user_helper.php */
