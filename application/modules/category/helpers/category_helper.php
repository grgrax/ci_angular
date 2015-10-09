<?php

function category_name($id){
	$ci=& get_instance();
	$category=$ci->category_m->read_row($id);
	return $category?$category['name']:null;			
}

function get_categories($param){
	$ci=& get_instance();
	$categories=$ci->category_m->read_rows_by($param);
	return $categories?:null;			
}

function get_published_categories(){
	$param['status']=category_m::PUBLISHED;
	return get_categories($param);			
}

function get_widget($widget_id){
	
	$widget['category']=null;
	$widget['articles']=null;

	$widget['category']=$category=get_categories(array('id'=>$widget_id));
	if($category){
		$widget['articles']=get_articles_widget(array('category_id'=>$widget_id,'order_by'=>'order'));	
	}
	return $widget;
}

?>