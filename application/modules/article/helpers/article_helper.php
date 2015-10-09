<?php

function get_articles($param){
	$ci=& get_instance();
	return $data=$ci->load->model('article/article_m')->read_mutiple_rows_by($param); 
}

function get_article($param){
	$ci=& get_instance();
	return $data=$ci->load->model('article/article_m')->read_rows_by($param); 
}

function get_active_articles(){
	$ci=& get_instance();
	$param=array('status'=>article_m::ACTIVE);
	return $data=$ci->load->model('article/article_m')->filter_rows_by($param); 
}
function get_widget_rules($widget_type){
	
	$widget_message='message';


	$widget_message_rules=array(
		array(
			'field'=>'name',
			'label'=>'Message Title',
			'rules'=>'trim|required|alpha_space|xss_clean'
			),
		array(
			'field'=>'content',
			'label'=>'Message Content',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'field'=>'title',
			'label'=>'By',
			'rules'=>'trim|required|valid_personname|xss_clean'
			),
		array(
			'field'=>'image_title',
			'label'=>'Post',
			'rules'=>'trim|required|valid_personname|xss_clean'
			),
		array(
			'field'=>'image_title_2',
			'label'=>'Working Year',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'order'=>'order',
			'label'=>'order',
			'rules'=>'trim|numeric|xss_clean'
			)
		);

	$widget_project_rules=array(
		array(
			'field'=>'name',
			'label'=>'Project Title',
			'rules'=>'trim|required|alpha_space|xss_clean'
			),
		array(
			'field'=>'content',
			'label'=>'Project Content',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'order'=>'order',
			'label'=>'order',
			'rules'=>'trim|numeric|xss_clean'
			)
		);

	$widget_news_rules=array(
		array(
			'field'=>'name',
			'label'=>'News Title',
			'rules'=>'trim|required|alpha_space|xss_clean'
			),
		array(
			'field'=>'content',
			'label'=>'News Content',
			'rules'=>'trim|required|xss_clean'
			),
		array(
			'order'=>'order',
			'label'=>'order',
			'rules'=>'trim|numeric|xss_clean'
			)
		);

	switch ($widget_type) {
		case $widget_message:{
			$rule=$widget_message_rules;
			break;
		}
		case article_m::WIDGET_PROJECT:{
			$rule=$widget_project_rules;
			break;
		}
		case article_m::WIDGET_NEWS:{
			$rule=$widget_news_rules;
			break;
		}
	}
	return $rule;
}

?>