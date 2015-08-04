<?php //show_pre($category_m); ?>
<div class="panel panel-default">
	<div class="panel-heading">Categories from (API) -- <?php echo $api_url_string;?></div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th class="center">s.no</th>
					<th width="20%">name</th>
					<th>parent</th>
					<th>content</th>
					<th>image</th>
					<th>published</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($rows && count($rows) > 0) {
					$c=0;
					foreach ($rows as $row) {
						$c++;
						$alertClass="";
						$actions=array();
						switch($row['published']){
							case $category_m['constant']['UNPUBLISHED']:
							{
								$alertClass="warning";
								$actions=array('publish');
								break;
							}
							case $category_m['constant']['PUBLISHED']:
							{
								$alertClass="";
								$actions[]='unpublish';
								$actions[]='delete';
								break;
							}
						}
						?>
						<tr class="<?php echo $alertClass?>">
							<td class="center"><?php echo $c;?></td>
							<td>
								<a href="<?= $link ?>edit/<?= $row['slug'] ?>"/><?= word_limiter(convert_accented_characters($row['name']), 5) ?></a>
							</td>
							<td><?php //echo $row['parent_id']?$category_m->get_parent_name($row['parent_id']):'---';?></td>
							<td><?= word_limiter(convert_accented_characters($row['content']), 5) ?></td>
							<td>
								<?php if($row['image']!="") { ?>
								<img src="<?php echo is_picture_exists_api($category_m['file_path'].$row['image']);?>" 
								class="img-responsive" width="70" height="30" title=<?php echo $row['image_title']?$row['image_title']:''?>>
								<?php } ?>
							</td>
							<td><?php echo $row['published']==1?"yes":'no';?></td>
							<td>
								<?php if(is_default($row['slug'])) continue; ?>
								<?php if(permission_permit(array('edit-category'))) { ?>
								<a href="<?= $link ?>edit/<?= $row['slug'] ?>"/>Edit </a>
								<?php if(count($actions)>0) echo "/" ?>
								<?php } ?>
								<?php foreach ($actions as $k=>$action) { ?>
								<a href="<?= $link ?><?= $action ?>/<?= $row['slug'] ?>"/> <?php if($k>0) echo "/"; ?> <?php echo $action?> </a>
								<?php } ?>
							</td>
						</tr>
						<?php
					}
				} else {
					?>
					<tr>
						<td colspan="7" class="td_no_data">No data</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<?php if(permission_permit(array('add-category'))){?>
		<a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a>
		<?php } ?>
		<ul class="pagination">
			<?php if (!empty($pages)) echo $pages; ?>
		</ul>
	</div>
</div>



