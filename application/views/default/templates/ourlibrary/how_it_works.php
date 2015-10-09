<section class="top">
	<!-- Example row of columns -->
	<div class="row">
		<h1 class="title2 center"><?php echo isset($article['name'])?ucwords($article['name']):''?></h1>
		<hr>
	</div>
	<div class="row" style="margin-top:20px;">
		<div  class="col-md-12" style="padding-top:20px">
			<div class="col-sm-6" style="">
				<?php echo isset($article['content'])?ucwords($article['content']):''?>
			</div>
			<div class="col-sm-6" style="border-left:2px #fff solid">
				<div>
					<?php if($article['image'] && is_picture_exists(article_m::file_path.$article['image'])) {?>
					<img src="<?php echo is_picture_exists(article_m::file_path.$article['image']);?>" alt="OurLibrary" style="width:100%"/>
					<?php }else{ ?> 
					<img src="<?php echo front_template_path()?>/assets/images/fullscreen.jpg" alt="OurLibrary" style="width:100%"/>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>


	</div>	
</section>