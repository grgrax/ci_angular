<div class="panel panel-default">
	<div class="panel-heading">Categories</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th class="center">#</th>
					<th>name</th>
					<th width="35%">content</th>
					<th>published</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($rows && count($rows) > 0) {
					foreach ($rows as $row) {
						?>
						<tr>
							<td></td>
							<td>
								<a href="edit/<?= $row['slug'] ?>"/><?= word_limiter(convert_accented_characters($row['name']), 5) ?></a>
							</td>
							<td><?= word_limiter(convert_accented_characters($row['content']), 5) ?></td>
							<td><?php echo $row['published']==1?"yes":'no';?></td>
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
		<a href="add" class="btn btn-primary"/>Add New  </a>
		<?php } ?>
		<ul class="pagination">
			<?php if (!empty($pages)) echo $pages; ?>
		</ul>
	</div>
</div>



