<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!DOCTYPE html>


<link rel="stylesheet" href="<?=admin_template_asset_path()?>/assets/lib/bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="<?=admin_template_asset_path()?>/assets/css/main.css">
<link rel="stylesheet" href="<?=admin_template_asset_path()?>/assets/lib/magic/magic.css">

<div class="row">
	<div class="col-lg-12">
		<!-- subview -->
		<div class="row">
			<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->
			<div class="modal fade" id="modal-id" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="<?php echo base_url()."auth/login";?>" method="POST" role="form">
							<div class="modal-header">
								<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->								
								<h4 class="modal-title">Admin Panel</h4>
							</div>
							<div class="modal-body">
								<legend>Welcome to Login Section</legend>	
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
									<label for="username">Username</label>
									<input name="username" type="text" class="form-control" id="" placeholder="Username Here" 
									value="<?php echo set_value('username');?>">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input name="password" type="password" class="form-control" id="" placeholder="Password Here" 
									value="<?php  echo set_value('password');?>">
								</div>
							</div>
							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" value="Login"/>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
		<!-- subview ends -->

	</div>
</div>
<!-- Core Scripts - Include with every page -->
<script src="<?=admin_template_asset_path()?>/assets/lib/jquery.min.js"></script>
<script src="<?=admin_template_asset_path()?>/assets/lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
	$(function(){
		$('#modal-id').modal({keyboard:false});
	})
</script>
