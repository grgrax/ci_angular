<?php
if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Router {

	private static $_format = '';

	public function route() {
		echo "<pre>";
		$ci =& get_instance();
		// print_r($ci);
		$reserved_routes=array('auth','fund_category');
		$current_route=$ci->uri->segment(1);
		if(in_array($current_route,$reserved_routes)){
			echo "redirect to defined route : $current_route";
			$ci->load->module('testimonial/testimonial');		
			//redirect($current_route);
		}else{
			echo "redirect to dynamic route";			
			// redirect(base_url("frontend/campaign/index/$current_route"));
		}
		die("<br/>inside route");
	}
}