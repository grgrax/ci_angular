<form action="<?php echo $url.'updateAll/';?>" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">Permissions</div>
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="center">s.no</th>
						<th>name</th>
						<th>description</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if ($rows && count($rows) > 0) {
						$c = $offset;
						foreach ($rows as $row) {
							$c++;
							?>
							<tr class="tr-head">
								<td class="center"><?php echo $c;?></td>
								<td>
									<input name="permission[<?php echo $row['id']?>][name]" 
									type="text" class="form-control" 
									placeholder="Name"
									value="<?=$row['name'] ?>">
								</td>
								<td>
									<input name="permission[<?php echo $row['id']?>][desc]" 
									type="text" class="form-control" 
									placeholder="Name"
									value="<?=$row['desc'] ?>">
								</td>
							</tr>
							<?php
							$child_permissions=$permission_m->get_child_permissions($row['id']);
							foreach ($child_permissions as $permission) {
								?>
								<tr class="tr-hide">
									<td class="center"></td>
									<td>
										<input name="permission[<?php echo $permission['id']?>][name]" 
										type="text" class="form-control" 
										placeholder="Name"
										value="<?=$permission['name'] ?>">
									</td>
									<td>
										<input name="permission[<?php echo $permission['id']?>][desc]" 
										type="text" class="form-control" 
										placeholder="Name"
										value="<?=$permission['desc'] ?>">
									</td>
								</tr>
								<?php 
						}//end of child permissons
						?>
						<?php 
					}
				}
				else {
					?>
					<tr>
						<td colspan="6" class="td_no_data">No data</td>
					</tr>
					<?php
				}
				?>
			</tbody>

		</div>
		<div class="panel-footer">
			<div class="table-footer">
				<a href="<?= $url ?>add" class="btn btn-primary"/>Add New  </a>
				<input type="submit" value="Update" class="btn btn-primary">
				<ul class="pagination">
					<?php  if (!empty($pages)) echo $pages; ?>
				</ul>
			</div>
		</div>
	</div>
</form>

