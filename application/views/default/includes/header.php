<!DOCTYPE html>
<html lang="en" ng-app="groupApp">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo config_item('project')?></title>

	<link rel="stylesheet" href="<?php echo assets('css/bootstrap.min.css');?>">

	<script src="<?php echo assets('js/jquery-2.1.1.min.js');?>"></script>
	<script src="<?php echo assets('js/bootstrap.min.js');?>"></script>

</head>
<body>
	<div class="container">
		<div class="row">

			<br>
			<ul class="nav nav-pills">
				<li ng-class="{{group_menu}}"><a href="#/">Goups</a></li>
				<li><a href="#/user">Users</a></li>
			</ul>

			<h3>CI-Angular Demo App</h3>
			<hr>

			



