<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_permissions($param){
	$ci=& get_instance();
	return $data=$ci->load->model('group/permission_m')->read_rows_by($param); 
}


/* End of file user_helper.php */
