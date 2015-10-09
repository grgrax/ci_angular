<?php

function get_page_type($param){
	$ci=& get_instance();
	return $ci->page_types_m->read_row_by($param);
}

function get_page_types($param){
	$ci=& get_instance();
	$menus=$ci->page_types_m->read_rows_by($param);
	return $menus?:null;			
}

function get_child_menus($parent_id){
	$ci=& get_instance();
	$param['parent_id']=$parent_id;
	$param['status !=']=menu_m::DELETED;
	$param['order_by']='order';
	$param['order']='asc';
	return $ci->menu_m->read_mutiple_rows_by($param);
}

function get_menus_n($param){
	$ci=& get_instance();
	$menus=$ci->menu_m->read_rows_by($param);
	return $menus?:null;			
}

?>