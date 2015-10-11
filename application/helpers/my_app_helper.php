<?php

function get_site_option($param){
	$ci=& get_instance();
	$data=$ci->load->model('setting/setting_m')->read_rows_by($param); 
	return $data?$data['value']:'';
}

function site_name(){
	return get_site_option(array('slug'=>'site_name'));
}

function get_site_url(){
	return get_site_option(array('slug'=>'site_url'));
}

//leave some default cateogry and their articles
function get_default_categories(){
	$settings=array('slider_category_id','message_category_id','project_category_id','news_category_id');
	$cateogries=array();
	foreach ($settings as $setting) {
		$category_id=get_setting_value($setting);
		$category=get_categories(array('id'=>$category_id));
		$categoryies[]=$category['slug'];
	}
	show_pre($categoryies);
	die;
	return $cateogries;
}

//get default category 
function is_default_category($slug=null){
	try {
		if(!$slug) throw new Exception("Error Processing Request, no cateogry slug", 1);		
		$default_categories=default_categories();
		// show_pre($default_categories);
		if(!$default_categories) throw new Exception("no default_categories", 1);		
		if(!is_array($default_categories)) throw new Exception("default_categories is not an array", 1);
		foreach ($default_categories as $default_category) {
			foreach ($default_category as $key => $value) {
				if($key=='slug' && $value==$slug){
					// echo "$key=='slug' && $value==$slug";
					return true;
				}
			}
		}
		return false;
		
	} catch (Exception $e) {
		die($e->getMessage());
	}
}

function default_categories(){

	try {
		$defaults=array();
		$default_settings=array('message_category_id','news_category_id','project_category_id');
		foreach ($default_settings as $default_setting) {
			$id=get_setting_value($default_setting);
			if($id){
				$param['id']=$id;
			}else{
				switch ($default_setting) {
					case 'message_category_id':{
						$param['slug']=article_m::WIDGET_MESSAGE;
						break;
					}
					case 'news_category_id':{
						$param['slug']=article_m::WIDGET_NEWS;
						break;
					}
					case 'project_category_id':{
						$param['slug']=article_m::WIDGET_PROJECT;
						break;
					}
				}
			}
			$defaults[]=get_categories($param,1);
		}
		// show_pre($defaults);
		// echo count($defaults);
		if(count($defaults)>0)
			return $defaults;
		else
			return null;

	} catch (Exception $e) {
		die($e->getMessage());
	}

}

?>