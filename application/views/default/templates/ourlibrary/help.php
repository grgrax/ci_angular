<section class="top">
	<!-- Example row of columns -->
	<div class="row">
		<h1 class="title2"><?php echo isset($category['name'])?ucwords($category['name']):''?></h1>
	</div>
	<div class="row" style="margin-top:20px; background:#eee; padding:10px">
		<div  class="col-md-12" style="padding-top:20px">
			<div class="col-sm-8" style="">
				<h4 style="line-height:1.4em; color:green;margin-bottom:20px" >Frequently Asked Questions</h4>
				<div id="toggle">
					<ul>
						<?php foreach ($articles as $a) { ?>
						<li class="active"><h6><?php echo $a['name']?:''?></h6></li>
						<div><p><?php echo $a['content']?:''?></p></div>
						<?} ?>
					</ul>
				</div>
			</div>
			<div class="col-sm-4" style="border-left:2px #fff solid">
				<div>
					<h4>Contact Us</h4><hr>
					<form method="post">

						<div class="form-group">
							<label for="first_name">Name:</label>
							<input name="name" type="text" class="form-control" id="name" value="<?php echo set_value('name') ?>">
						</div>

						<div class="form-group">
							<label for="question">Email address:</label>
							<input name="email" type="text" class="form-control" id="email" value="<?php echo set_value('email')?>"/>
						</div>
						<div class="form-group">
							<label for="question">Question</label>
							<textarea name="question" type="text" class="form-control" id="question" value="" rows="5"><?php echo set_value('question')?></textarea>
							
						</div>
						<input type="submit" class="btn btn-primary" value="Submit" name="submit">
					</form>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>		

	</div>	
</section>

<style>
	#main_layout{
		margin-top: 2%;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("li").click(function(){
			$(this).toggleClass("active");
			$(this).next("div").stop('true','true').slideToggle("slow");
		});
	});
</script>
<style>
	#toggle li{list-style-type: square; cursor:pointer; color:#46b8da; margin-top: 10px}
	ul div{cursor: auto; display: none;text-decoration: none; padding-left: 10px}
	ul div a{font-weight:bold;}
	li div:hover{text-decoration:none !important;}
</style>
