<?php

if (!function_exists('get_action_links')) {
	function get_action_links($model=NULL,$status=NULL){
		$alertClass="";
		$action_links=array();
		switch($status){
			case $model::PENDING:
			{
				$alertClass="active";
				$action_links=array($model::ACTIVE=>$model::ACTIVE);
				break;
			}
			case $model::ACTIVE:
			{
				$alertClass="";
				$action_links=array(
					$model::BLOCKED=>$model::BLOCKED,
					$model::DELETED=>$model::DELETED
					);
				break;
			}
			case $model::BLOCKED:
			{
				$alertClass="warning";
				$action_links=array(
					$model::ACTIVE=>$model::ACTIVE,
					$model::DELETED=>$model::DELETED
					);
				break;
			}
			case $model::DELETED:
			{
				$alertClass="danger";
				$action_links=array($model::ACTIVE=>$model::ACTIVE);
				break;
			}
		}
		return (array(
			'alertClass'=>$alertClass,
			'action_links'=>$action_links,
			));
	}
}


if (!function_exists('generate_action_links')) {
	function generate_action_links($model=NULL,$action_links=NULL,$action_url=NUll,$id=NULL)
	{		
		$edit_url=$action_url."edit/$id";
		echo anchor("$edit_url",'Edit', '');
		foreach ($action_links as $key=>$action) 
		{ 
			$url=$action_url."action/$action/$id";
			$title=$model::actions($key);
			echo " / ".anchor($url,$title, '');
		}	
	}
}

?>