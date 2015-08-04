<h2><?php echo isset($category['name'])?$category['name']:''?></h2>
<?php if(isset($articles) && count($articles)) { ?>
<?php foreach ($articles as $key=>$article) { ?>
<div>
	<h3><?php echo ($key+1).". "; echo $article['name']?></h3>
	<?php if($article['image'] && is_article_picture_exists($article['image'])){?>
	<img class="course" src="<?php echo is_article_picture_exists($article['image'])?>" width="100%"/>
	<?php } else {?>
	<img class="course" src="<?php echo is_article_picture_exists('default.png')?>" width="100%"/>
	<?php } ?>
	<p>
		<?php echo $article['content']?>
	</p>
</div>
<?php } ?>
<?php } ?>


