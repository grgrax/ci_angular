<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo site_name()?> - Admin Login</title>


	<!--Open Sans Font [ OPTIONAL ] -->
	<link href="../../../fonts.googleapis.com/css7ba5.css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
	<!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link href="<?=admin_template_asset_path()?>/css/bootstrap.min.css" rel="stylesheet">	<!--Nifty Stylesheet [ REQUIRED ]-->
	<link href="<?=admin_template_asset_path()?>/css/nifty.min.css" rel="stylesheet">
	<!--Font Awesome [ OPTIONAL ]-->
	<link href="<?=admin_template_asset_path()?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">	<!--Demo [ DEMONSTRATION ]-->
	<link href="<?=admin_template_asset_path()?>/css/demo/nifty-demo.min.css" rel="stylesheet">	<!--SCRIPT-->
	<!--=================================================-->

	<!--Page Load Progress Bar [ OPTIONAL ]-->
	<link href="<?=admin_template_asset_path()?>/plugins/pace/pace.min.css" rel="stylesheet">
	<script src="<?=admin_template_asset_path()?>/plugins/pace/pace.min.js"></script>			

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
	<div id="container" class="cls-container">
		
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay" class="bg-img img-balloon"></div>
		
		
		<!-- HEADER -->
		<!--===================================================-->
		<div class="cls-header cls-header-lg">
			<div class="cls-brand">
				<a class="box-inline" href="#">
					<!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
					<br>
					<span class="brand-title">
						<?php echo site_name()?> <br><br>
						<span class="text-thin">Admin Login</span>
					</span>
				</a>
			</div>
		</div>
		<!--===================================================-->
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
			<div class="cls-content-sm panel">
				<div class="panel-body">
					<p class="pad-btm">Sign In to your account</p>
					<form action="<?php echo base_url('auth/login');?>"  method="POST" >
						<?php if($this->session->flashdata('error') or validation_errors()){ ?>
						<!-- flash message -->
						<div class="form-group">     
							<div class="alert alert-danger" alert-dismissible>
								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<?php echo $this->session->flashdata('error')?$this->session->flashdata('error'):'';?>
								<?php if(validation_errors()) echo validation_errors()?>
							</div>
						</div>
						<!-- flash message ends-->
						<?php } ?>					
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-user"></i></div>
								<input type="text" name="username" class="form-control" placeholder="Username"
								value="<?php echo set_value('username');?>">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input type="password" name="password" class="form-control" placeholder="Password"
								value="<?php echo set_value('password');?>">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-8 text-left checkbox">
								<label class="form-checkbox form-icon">
									<input type="checkbox"> Remember me
								</label>
							</div>
							<div class="col-xs-4">
								<div class="form-group text-right">
									<input type="submit" class="btn btn-success text-uppercase" value="Log In"/>
								</div>
							</div>
						</div>						
					</form>
				</div>
			</div>
			<div class="pad-ver">
				<a href="#" class="btn-link mar-rgt">Forgot password ?</a>
			</div>
		</div>
		<!--===================================================-->
		
		
	</div>
	<!--===================================================-->
	<!-- END OF CONTAINER -->		
	<!--JAVASCRIPT-->
	<!--=================================================-->

	<!--jQuery [ REQUIRED ]-->
	<script src="<?=admin_template_asset_path()?>/js/jquery-2.1.1.min.js"></script>	<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="<?=admin_template_asset_path()?>/js/bootstrap.min.js"></script>	<!--Fast Click [ OPTIONAL ]-->
	<script src="<?=admin_template_asset_path()?>/plugins/fast-click/fastclick.min.js"></script>
	<!--Nifty Admin [ RECOMMENDED ]-->
	<script src="<?=admin_template_asset_path()?>/js/nifty.min.js"></script>		

</body>

</html>
