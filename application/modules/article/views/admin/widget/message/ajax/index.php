<?php 
$message_category_id=get_setting_value('message_category_id');
$category=get_categories(array('id'=>$message_category_id));
$rows=null;
$offset=0;
$link=base_url('article/widget/');
if($category){
	$param['category_id']=$category['id'];
	$rows=get_articles_widget($param);	
}
?>
<div id="messages">	
	<table class="table">
		<thead>
			<tr>
				<th class="center">#</th>
				<th>Message</th>
				<th>By</th>
				<th>Order</th>
				<th>Status</th>
				<th>Date</th>
				<th>actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (isset($rows) && $rows && count($rows) > 0) {
				$c = $offset;
				foreach ($rows as $row) {
					$c++;
					$alertClass="";
					$actions=array();
					switch($row['status']){
						case article_m::UNPUBLISHED:
						{
							$alertClass="warning";
							if(permission_permit(array('activate-article'))) 
								$actions=array('publish');
							break;
						}
						case article_m::PUBLISHED:
						{
							$alertClass="";
							if(permission_permit(array('block-article'))) 
								$actions[]='unpublish';
							if(permission_permit(array('delete-article'))) 
								$actions[]='delete';
							break;
						}
						case article_m::BLOCKED:
						{
							$alertClass="warning";
							if(permission_permit(array('activate-article'))) 
								$actions=array('publish');
							break;
						}
					}
					?>
					<tr class="<?php echo $alertClass?>">
						<td class="center"><?php echo $c?></td>
						<td width="50%">
							<a href="<?= $link ?>edit/<?= $row['slug'] ?>"/>
								<h5><?php echo $row['name']?:'N/A'?></h5>
								<p><?= word_limiter(convert_accented_characters($row['content']), 75) ?></p>                            
							</a>
						</td>
						<td>
							<?php if($row['image']) { ?>
							<?php $image=is_picture_exists(article_m::file_path.article_m::WIDGET_MESSAGE.'/'.$row['image']); ?>  
							<img alt="" class="img-md" src="<?php echo $image;?>">
							<?php } ?>
							<br>
							<b><?php echo $row['title']?:'N/A'?></b><br>
							<?php echo $row['image_title']?:'N/A'?><br>
							<?php echo $row['image_title_2']?:'N/A'?>
						</td>
						<td class="center"><?php echo $row['order']?:'N/A'?></td>
						<td><?php echo article_m::status($row['status']);?></td>
						<td><?php echo $row['updated_at']?format($row['updated_at'])."<br/>Updated":format($row['created_at']);?></td>
						<td>
							<?php //if(is_default($row['slug'])) continue; ?>
							<a href="#"
							class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
							id="edit_message_link"
							data-original-title="Edit" 
							data-toggle="modal"
							data-target="#my_modal_message_edit"
							data-slug="<?php echo $row['slug']?>">
						</a>
						<a href="<?php echo base_url('article/widget/delete/'.$row['slug'])?>"
							class="btn btn-sm btn-icon add-tooltip btn-danger fa fa-times"
							id="delete_message_link" 
							data-toggle="tooltip" 
							data-original-title="Delete"
							data-container="body"/>
						</a>
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
<div class="row">
	<ul class="pagination">
		<?php if (!empty($pages)) echo $pages; ?>
	</ul>
</div>	
</div>

