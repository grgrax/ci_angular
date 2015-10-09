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


function count_group_user($group_id){
	try {
		$ci=& get_instance();
		return $ci->load->model('user/user_m')->count_group_user($group_id);
	} catch (Exception $e) {
		
	}
}	

// function get_user($id){
// 	$ci=& get_instance();
// 	try {
// 		return $ci->load->model('user/user_m')->read_row($id);
// 	} catch (Exception $e) {
// 		redirect();
// 	}
// }

function admin_full_name(){
	$ci =& get_instance();
	try {
		$user=get_user($ci->session->userdata('id'));
		return ucfirst($user['first_name'])." ".ucfirst($user['last_name']);
	} catch (Exception $e) {
		echo $e->getMessage();
		die;
		redirect();
	}

}

function users($param){
	$ci=& get_instance();
	return $data=$ci->load->model('user/user_m')->read_rows_by($param); 
}


function get_donees($blocked=false){
	$ci=& get_instance();

	$ci->load->helper('group/group');
	$group_m=$ci->load->model('group/group_m');

	if($blocked){
		$dn_group=get_group(group_m::$dn_param);
		$fb_group=get_group(group_m::$fb_param);
		$param=array(
			'group_id_in'=>array($dn_group['id'],$fb_group['id']),
			'status !='=>group_m::DELETED
			);
		return $ci->load->model('user/user_m')->read_rows_by($param);
	}else{
		$db_group=get_group(array('slug'=>group_m::DONEE));
		$db_donees=$ci->load->model('user/user_m')->read_rows_by(array('group_id'=>$db_group['id'],'status'=>user_m::ACTIVE)); 	
		$fb_group=get_group(array('slug'=>group_m::FACEBOOK_USER));
		$fb_donnes=$ci->load->model('user/user_m')->read_rows_by(array('group_id'=>$fb_group['id'],'status'=>user_m::ACTIVE)); 		
		return $donees=array_merge($db_donees,$fb_donnes);
	}
}

function get_non_deleted_donees(){
	$ci=& get_instance();

	$ci->load->helper('group/group');
	$group_m=$ci->load->model('group/group_m');

	$db_group=get_group(group_m::$dn_param);
	$db_donees=$ci->load->model('user/user_m')->read_rows_by(array('group_id'=>$db_group['id'],'status !='=>user_m::DELETED)); 
	
	$fb_group=get_group(group_m::$fb_param);
	$fb_donnes=$ci->load->model('user/user_m')->read_rows_by(array('group_id'=>$fb_group['id'],'status !='=>user_m::DELETED)); 
	
	return $donees=array_merge($db_donees,$fb_donnes);
}

function get_users_n($param=null){
	try {
		$ci=& get_instance();
		if(!$param)
			$param['g.id >']=0;
		return $ci->load->model('user/user_m')->filter_rows_by($param);						
	} catch (Exception $e) {
		die($e->getMessage());
	}	
}


function get_users($param){
	try {
		$ci=& get_instance();
		return $ci->load->model('user/user_m')->read_rows_by($param);
	} catch (Exception $e) {

	}	
}

function get_user($param){
	try {
		$ci=& get_instance();
		return $ci->load->model('user/user_m')->read_row_by_n($param);
	} catch (Exception $e) {
		echo $e->getMessage();
		die;
	}	
}
/*function show_current_loggedin_username(){
	try {
		$ci=& get_instance();
		return $ci->load->model('user/user_m')->get_user_name();
	} catch (Exception $e) {

	}
}
*/
/* End of file user_helper.php */
