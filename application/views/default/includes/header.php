<!DOCTYPE html>
<html lang="en" data-ng-app="groupApp">
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
<body data-ng-controller="groupCtrl">
	<div class="container">
		<div class="row">

			<br>
			<ul class="nav nav-pills">
				<li class="active"><a href="#/">Home</a></li>
				<li><a href="#/about">About Us</a></li>
				<li><a href="#/contact">Contact</a></li>
			</ul>

			<h3>CI-Angular Demo App</h3>
			<hr>

			<!-- <div ng-view></div> -->
			



