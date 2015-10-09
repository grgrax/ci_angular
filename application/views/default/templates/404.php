<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section id="error" class="text-center">
				<h1><?php echo isset($message)?$message:'404, Page not found'?></h1>
				<p>The Page you are looking for doesn't exist or an other error occurred.</p>
				<a class="btn btn-success" href="<?php echo base_url()?>">GO BACK TO THE HOMEPAGE</a>
			</section>	
		</div>

	</div>
</div>

<style>
	#error h1{ font-size: 50px; margin-top: 15%;}
	#error p{
		color:red;
		text-align: center;
	}
</style>