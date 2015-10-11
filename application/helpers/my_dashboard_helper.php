<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function permission_permit_(array $slugs){
	try {
		$ci=& get_instance();
		$total_pemission_allowed=0;
		$id=$ci->session->userdata('id');
		if(!$id) throw new Exception("User not logged in", 1);
		$user=$ci->load->model('user/user_m')->read_row($id);
		if(!$user) throw new Exception("User not found", 1);
		$group_permsissions=$ci->load->model('group/group_permission_m')->read_row($user['group_id']);
		if(!$group_permsissions) throw new Exception("Group Permsissions not found", 1);
		$gps=array();
		if($group_permsissions){
			foreach ($group_permsissions as $gp) {
				$gps[]=$gp['permission_id'];
			}
		}
		foreach ($slugs as $slug) {
			$permission=$ci->load->model('group/permission_m')->read_row_by_slug($slug);
			//show_pre($permission);
			if(!$permission) throw new Exception("Permission not found", 1);
			if(in_array($permission['id'], $gps)){
				$total_pemission_allowed++;
			}
		}
		if(count($slugs)>0 && count($slugs)==$total_pemission_allowed){
			return true;
		}		
	} catch (Exception $e) {
		$ci->session->set_flashdata('error', $e->getMessage());
		redirect('dashboard');		
	}
}

function permission_permit(array $slugs){
	try {
		$ci=& get_instance();
		$admin=get_session('admin');
		if(!$admin)
			throw new Exception("User not logged in", 1);
		if(!array_key_exists('group_permsissions', $admin)) 
			throw new Exception("User not logged in", 1);
		$group_permsissions=$admin['group_permsissions'];		
		$total_pemission_allowed=0;
		foreach ($slugs as $permission) {
			if(in_array($permission, $group_permsissions))
				$total_pemission_allowed++;
		}
		if(count($slugs)>0 && count($slugs)==$total_pemission_allowed){
			return true;
		}
		return false;
	} catch (Exception $e) {
		$ci->session->set_flashdata('error', $e->getMessage());
		echo  $e->getMessage();
	}
}



function show_current_loggedin_username(){
	try {
		$ci=& get_instance();
		return $ci->load->model('user/user_m')->get_user_name();
	} catch (Exception $e) {

	}
}

function current_loggedin_user(){
	try {
		$ci=& get_instance();
		$id=$ci->session->userdata('id');
		return $ci->load->model('user/user_m')->read_row($id);
	} catch (Exception $e) {

	}
}

function redirect_to_dashboard($msg='Permission Denied'){
	$ci=& get_instance();
	$ci->session->set_flashdata('error', $msg);
	redirect('dashboard');
}

function show_total($param){

	try {

		// $this->load->helper('fund_category/fund_category'); 
		// $this->load->model('fund_category/fund_category_m');
		// return count(get_fund_categories(array('status !='=>fund_category_m::DELETED))); 


		$ci=& get_instance();
		$count=0;		
		if($param && $param['module']){
			// if($param['module']!='donee' or $param['module']!='permission'){
			if($param['module']=='donee' or $param['module']=='permission'){
			}
			else{
				$ci->load->helper($param['module'].'/'.$param['module']); 
				$ci->load->model($param['module'].'/'.$param['module'].'_m');
			}
			// echo $param['module'];
			switch ($param['module']) {
				case 'fund_category':
				$count=count(get_fund_categories(array('status !='=>fund_category_m::DELETED)));
				break;				
				case 'campaign':
				// $count=count(get_campaigns(array('c.id >'=>'0')));
				$count=count(get_campaigns(array('status !='=>campaign_m::DELETED)));
				break;				
				case 'donee':
				$count=count(get_non_deleted_donees());
				break;				
				case 'donation':
				$count=count(get_donations(array('id >'=>'0')));
				break;				
				case 'group':
				$param=array('status !='=>group_m::DELETED,'parent_group_id'=>NULL);
				$count=count(get_groups($param));
				break;				
				case 'user':{
					$dn_group=get_group(group_m::$dn_param);
					$fb_group=get_group(group_m::$fb_param);
					$param=array(
						'group_id_not_in'=>array($dn_group['id'],$fb_group['id']),
						'status !='=>user_m::DELETED
						);
					$count=count($ci->user_m->read_rows_by($param));
					break;									
				}
				case 'permission':
				$ci->load->helper('group/group_permission');
				$count=count(get_permissions(array('id >'=>'0')));
				break;				
				case 'setting':
				$count=count(get_settings(array('id >'=>'0')));
				break;				
			}
		}
		return $count; 		
	} catch (Exception $e) {
		echo $e->getMessage();
		die;
	}

}