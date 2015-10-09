<?php


function fund_categories(){
	$ci=& get_instance();
	return $rows=$ci->load->model('fund_category/fund_category_m')->read_all_published(); 
}

function fund_categories_($get=array()){
	$ci=& get_instance();
	$rows=$ci->load->model('fund_category/fund_category_m')->read_all_published(); 
	// show_pre($rows);
	$categories=[];
	foreach ($rows as $k=>$row) {
		foreach ($row as $key=>$column) {
			// echo in_array($key,$get)?'y':'n';
			if(in_array($key,$get)){
				$categories[$k][$key]=$row[$key];
			}
		}
	}
	show_pre($categories);
	die;
	return $categories;
}

function get_fund_categories($param){
	$ci=& get_instance();
	return $data=$ci->load->model('fund_category/fund_category_m')->read_rows_by($param); 
}

function get_fund_category_n($param){
	$ci=& get_instance();
	return $data=$ci->load->model('fund_category/fund_category_m')->read_rows_by($param,1); 
}

//later
function count_fund_category_campaigns_as_per_status($fund_category_id=null,$status=null){
	$ci=& get_instance();
	try {
		if($fund_category_id===null or $status===null) throw new Exception("Error Processing Request", 1);
		$query="SELECT COUNT(fc.id) total
		FROM tbl_campaign c 
		JOIN tbl_fund_categories fc ON (fc.id=c.fund_category_id AND c.status =$status AND fc.id=$fund_category_id)
		";
		$rs=$ci->db->query($query);			
		// echo $ci->db->last_query();
		return ($rs->first_row('array'));

	} catch (Exception $e) {
		$ci->session->set_flashdata('error',$e->getMessage());
		redirect('dashboard');
	}
}
?>