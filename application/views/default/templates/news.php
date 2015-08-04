<h2><?php echo isset($category['name'])?$category['name']:''?></h2>
<!-- news -->
<?php if(isset($articles) && count($articles)) { ?>
<?php foreach ($articles as $article) { ?>
<div class="span12 category_article" id="news">
	<div class="blog-item well" id="category_article_inner">
		<h3><?php echo $article['name']?></h3>
		<div class="blog-meta clearfix">
			<p class="pull-left">
				<i class="icon-calendar"></i> <?php echo format($article['created_at'])?>
			</p>
		</div>
		<p>
			<?php if($article['image'] && is_article_picture_exists($article['image'])){?>
			<img class="news" src="<?php echo is_article_picture_exists($article['image'])?>" width="100%"/>
			<?php } else {?>
			<img class="news" src="<?php echo is_article_picture_exists('default.png')?>" width="100%"/>
			<?php } ?>
		</p>
		<?php echo $article['content']?>
	</div>
</div>
<?php } ?>
<?php } ?>
<!-- news -->


