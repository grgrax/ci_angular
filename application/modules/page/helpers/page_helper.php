<?php

function get_page_types($param){
	$ci=& get_instance();
	$categories=$ci->page_types_m->read_rows_by($param);
	return $categories?:null;			
}

?>