<?php 
$project_category_id=get_setting_value('project_category_id');
$category=get_categories(array('id'=>$project_category_id));
$rows=null;
$offset=0;
$link=base_url('article/project/');
if($category){
	$param['category_id']=$category['id'];
	$rows=get_articles_widget($param);	
}
?>
<span id="project_error_success"></span>

<div id="projects">	
	<table class="table">
		<thead>
			<tr>
				<th class="center">#</th>
				<th width="15%">Titles</th>
				<th width="40%">Content</th>
				<th>Order</th>
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
						<td>
							<a href="<?= $link ?>edit/<?= $row['slug'] ?>"/>
								<b><?php echo $row['name']?:'N/A'?></b>                            
							</a>
						</td>
						<td><?= word_limiter(convert_accented_characters($row['content']), 75) ?></td>
						<td class="center"><?php echo $row['order']?:'N/A'?></td>
						<td>
							<?php echo $row['created_at']?format($row['created_at'])."<br/>Updated":format($row['created_at']);?>
						</td>
						<td>
							<a href="#"
							class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
							id="edit_project_link"
							data-original-title="Edit" 
							data-toggle="modal"
							data-target="#my_modal_project_edit"
							data-slug="<?php echo $row['slug']?>">
						</a>
						<a href="<?php echo base_url('article/widget/delete/'.$row['slug'])?>"
							class="btn btn-sm btn-icon add-tooltip btn-danger fa fa-times"
							id="delete_project_link" 
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
