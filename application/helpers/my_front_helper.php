<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_article_by_name($slug){
	$ci=& get_instance();
	try {
		$data['row']=$ci->load->model('article/article_m')->read_row_by_slug($slug);
		return $data;
	} catch (Exception $e) {
		redirect('dashboard');
	}
}


function get_articles_of_category_($cat_id){
	$ci=& get_instance();
	try {
		return $ci->load->model('article/article_m')->read_all_published_of_category($cat_id);
	} catch (Exception $e) {
		redirect('dashboard');
	}
}

function get_articles_of_category($cat_id){
	$ci=& get_instance();
	try {
		return $ci->load->model('article/article_m')->read_mutiple_rows_by(array('category_id'=>$cat_id));
	} catch (Exception $e) {
		redirect('dashboard');
	}
}

function get_category_of_article($id){
	$ci=& get_instance();
	try {
		return $ci->load->model('category/category_m')->read_row($id);
	} catch (Exception $e) {
		redirect('dashboard');
	}
}


// partners
function get_partners_widget($category_name){
	$ci=& get_instance();
	try {
		$response=$ci->load->model('category/category_m')->read_row_by_slug($category_name);
		$data['row']=$response;
		$data['rows']=get_articles_of_category($response['id']);
		return $data;
	} catch (Exception $e) {
		redirect('dashboard');
	}	
}
// partners

// partners

function get_category_and_subcategories($category_name){
	$ci=& get_instance();
	try {
		$response=$ci->load->model('category/category_m')->read_row_by_slug($category_name);
		$data['row']=$response;
		$data['rows']=$ci->load->model('category/category_m')->read_all_published_childs($response['id']);						
		return $data;
	} catch (Exception $e) {
		redirect('dashboard');
	}	
}
function get_category_and_aritcles($category_name){
	$ci=& get_instance();
	try {
		$response=$ci->load->model('category/category_m')->read_row_by_slug($category_name);
		$data['row']=$response;
		$data['rows']=$ci->load->model('article/article_m')->read_all_published_of_category($response['id']);						
		return $data;
	} catch (Exception $e) {
		redirect('dashboard');
	}	
}
// partners
// menu
function get_menu(){
	try {
		$ci=& get_instance();
		$response=$ci->load->model('menu/menu_m')->get_parents();
		$data['rows']=$response;
		return $data;
	} catch (Exception $e) {
		redirect('dashboard');
	}		
}

function get_menus(){
	try {
		$ci=& get_instance();
		$response=$ci->load->model('menu/menu_m')->read_menus_for_ordering();
		return $response;		
	} catch (Exception $e) {
		redirect('dashboard');
	}		
}

function no_of_child_menus($id){
	try {
		$ci=& get_instance();
		$response=$ci->load->model('menu/menu_m')->nested_childs($id);
		if($response[0]['nested_child'])
			return $response[0]['nested_child'];
		else 
			return 0;
	} catch (Exception $e) {
		redirect('dashboard');
	}		
}

// setting
function get_setting($name){
	try {
		$ci=& get_instance();
		$response=$ci->load->model('setting/setting_m')->read_row_by_name($name);
		return $response['value'];		
	} catch (Exception $e) {
		redirect();
	}		
}
// setting

// for app
// get session data 
function get_session($param){
	try {
		$ci=& get_instance();
		if(is_array($param) && isset($param['array_name']) && isset($param['key'])){
			$data=$ci->session->userdata($param['array_name']);
			return $data[$param['key']];
		}
		else
			return $ci->session->userdata($param);
	} catch (Exception $e) {
		$ci->session->set_flashdata('error', $e->getMessage());
		die($e->getMessage());
		// redirect();
	}		
}
// get session data 
// for app


// deep
function get_fund_category($id){
	$ci=& get_instance();
	try {
		return $ci->load->model('fund_category/fund_category_m')->read_row($id);
	} catch (Exception $e) {
		redirect();
	}
}

function get_popular_campaign($id){
	$ci=& get_instance();
	try {
		return $ci->load->model('campaign/campaign_m')->read_row($id);
	} catch (Exception $e) {
		redirect();
	}
}
function get_donation_amount($campaign_id){
	$ci=& get_instance();
	try {
		return $ci->load->model('donation/donation_m')->total_donation_amount($campaign_id);
	} catch (Exception $e) {
		redirect('dashboard');
	}
}
function get_donar_of_campaign($campaign_id) {
	$ci=& get_instance();
	try {
		return $ci->load->model('campaign/donar_m')->donar_of_campaign($campaign_id);
	} catch (Exception $e) {
		redirect();
	}
}
function get_time_elapsed($ptime) {
	$ci=& get_instance();
	try {
		return $ci->load->model('campaign/donar_m')->time_elapsed_string($ptime);
	} catch(Exception $e) {
		redirect();
	}
	
}
function get_time_left($ptime) {
	$ci=& get_instance();
	try {
		return $ci->load->model('campaign/donar_m')->time_left_string($ptime);
	} catch(Exception $e) {
		redirect();
	}
	
}

// function get_users(){
// 	$ci=& get_instance();
// 	try {
// 		return $ci->load->model('user/user_m')->read_all_active();
// 	} catch (Exception $e) {
// 		redirect();
// 	}	
// }

// function get_groups(){
// 	$ci=& get_instance();
// 	try {
// 		return $ci->load->model('group/group_m')->read_rows_by(group_m::$param);
// 	} catch (Exception $e) {
// 		redirect();
// 	}	
// }

//messaging
function flash_msg($class,$message){
	?>
	<div class="alert <?php echo isset($class)?$class:'';?>" alert-dismissible>
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<?php echo isset($message)?ucfirst($message):'';?>
	</div>
	<!-- <div class="alert alert-purple" role="alert">
		<button class="close" type="button">
			<i class="fa fa-times-circle"></i>
		</button>
		<div class="media"><div class="media-left">
			<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
				<i class="fa fa-shopping-cart fa-lg"></i>
			</span>
		</div>
		<div class="media-body">
			<h4 class="alert-title">Sticky Alert Box</h4>
			<p class="alert-message">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
		</div>
	</div> -->
	<?php
}

function template_validation(){
	?>
	<?php if(validation_errors()){ ?>
	<!-- form validation -->
	<div class="alert alert-danger" alert-dismissible>
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<?php echo validation_errors()?>
	</div>
	<!-- form validation ends -->
	<?php } 
}
//messaging
function get_group_by($param){
	$ci=& get_instance();
	try {
		return $ci->load->model('group/group_m')->read_row_by($param);
	} catch (Exception $e) {
		redirect();
	}	
}


//rotary
function get_articles_widget($param){
	$ci=& get_instance();
	try {
		if(!is_array($param)) throw new Exception("Error Processing Request", 1);		
		return $ci->load->model('article/article_m')->filter_rows_by($param);
	} catch (Exception $e) {
		redirect('dashboard');
	}
}
