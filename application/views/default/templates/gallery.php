<!-- gallery -->
<link rel="stylesheet" href="<?php echo front_template_path()?>assets/gallery/css/magnific-popup.css">
<link rel="stylesheet" href="<?php echo front_template_path()?>assets/gallery/css/style.css">
<!-- gallery end -->

<?php //show_pre($categories) ?>
<h2><?php echo $category['name']?></h2>
<?php
$show_gallery=false; 
$total_articles=0; 
$all_articles=array();
if(isset($categories) && count($categories)) { 
	foreach ($categories as $key=>$cat){
		$articles=get_articles_of_category($cat['id']); 
		$total_articles=$total_articles+count($articles);
		if(count($articles)){
			foreach ($articles as $article){
				$show_gallery=true;
				$all_articles[]=$article; 
			}
		}
	}
}	

if($show_gallery){ ?>
<div class="portfolio-container">   
	<div class="container">
		<?php $left=$top=0; ?>
		<!-- albums header starts -->
		<div class="row-fluid">
			<div class="col-sm-12 portfolio-filters wow fadeInLeft">
				<a href="#" class="filter-all active">All</a>  
				<?php foreach ($categories as $cat) { ?>
				<a href="#" class="filter-<?php echo $cat['slug']?>"><?php echo $cat['name']?></a>  
				<?php } ?>
			</div>
		</div>
		<!-- albums header ends -->

		<div class="row-fluid">
			<div class="col-sm-12 portfolio-masonry" style="position: relative; height: 876px;">		

				<!-- albums gallery (pictures & vdos) starts -->
				<?php 
				foreach ($all_articles as $key=>$article) 
				{ 
					$category=get_category_of_article($article['category_id']);
					?>
					<div 
					class="portfolio-box <?php echo $category['slug']?>" 
					style="position: absolute; left: <?php echo $left?>px; top: <?php echo $top?>px;">
					<div class="portfolio-box-container">
						<img src="<?php echo front_template_path()?>images/portfolio/work2.jpg" alt="" 
						data-at2x="<?php echo front_template_path()?>images/portfolio/work2.jpg">
						<div class="portfolio-box-text">
							<h3><?php echo $article['name']?$article['name']:''?></h3>
							<p>
								<?php echo $article['content']?$article['content']:''?>.
							</p>
								<!-- <h5>
								k:<?php echo $key?>--
								w:<?php echo $left?>--
								h:<?php echo $top?>--
							</h5> -->
						</div>
					</div>
				</div>
				<?php 
				$left=$left+291;
				if($key!=0 && $key%3 == 0){
					$left=0;
					$top=$top+312; 
				}
			}
			?>
			<!-- albums gallery (pictures & vdos) ends -->

		</div>
	</div>

</div>
</div>
<?php }// if show_gallery
?>
