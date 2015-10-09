<form action="<?php echo $url.'updateAll/';?>" method="post">
	<div class="panel panel-default table-responsive">
		<div class="panel-heading">
			Permissions
			<span class="badge badge-info"><?=$total?></span>
			<span class="pull-right">
				<?php if(permission_permit(array('add-user'))){?>
				<span class="col-md-6">
					<a href="<?= $url ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>					
				</span>
				<span class="col-md-6">
					<input type="submit" value="Update" class="btn btn-success">
				</span>
				<?php } ?>
			</span>
		</div>
		<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th class="center" width="10%">&nbsp;&nbsp;s.no</th>
						<th>name</th>
						<th>description</th>
						<th>created at</th>
						<th>actions</th>
					</tr>
				</thead>
				<tbody class="accordian">
					<?php 
					if ($rows && count($rows) > 0) {
						$c = $offset;
						foreach ($rows as $row) {
							$c++;
							$child_permissions=$permission_m->get_child_permissions($row['id']);
							?>
							<tr class="tr-head">
								<td class="center table-accordian" data-class-target="<?php echo $row['id']?>">
									<?php if(count($child_permissions)>0) { ?>
									<span class="fa fa-plus"> </span>
									<?php } ?> &nbsp; &nbsp;<?php echo $c;?>
								</td>
								<td>
									<input name="permission[<?php echo $row['id']?>][name]" 
									type="text" class="form-control" 
									placeholder="Name"
									value="<?=$row['name'] ?>">
								</td>
								<td>
									<textarea cols="50" rows="2"
									name="permission[<?php echo $row['id']?>][desc]"
									class="form-control" 
									placeholder="Description"><?=$row['desc'] ?></textarea> 
								</td>
								<td class="no-capitalize"><?php echo format($row['created_at']);?></td>
								<td>
									<?php 
									echo anchor($url."add/".$row['slug'],"Add",'class="text-success"');
									echo " / ".anchor($url."delete/".$row['slug'],"Delete",'class="text-danger"');
									?>
								</td>
							</tr>
							<?php
							foreach ($child_permissions as $permission) {
								?>
								<tr class="child-permission <?php echo $permission['parent_permission_id']?>">
									<td>&nbsp</td>
									<td>
										<input name="permission[<?php echo $permission['id']?>][name]" 
										type="text" class="form-control" 
										placeholder="Name"
										value="<?=$permission['name'] ?>">
									</td>
									<td>
										<textarea cols="50" rows="2"
										name="permission[<?php echo $permission['id']?>][desc]"
										class="form-control" 
										placeholder="Description"><?=$permission['desc'] ?></textarea> 
									</td>
									<td class="no-capitalize"><?php echo format($permission['created_at']);?></td>
									<td>
										<?php 
										echo anchor($url."delete/".$permission['slug'],"Delete",'class="text-danger"');
										?>
									</td>
								</tr>
								<?php 
							}
							//end of child permissons
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
			</table>
		</div>
		<div class="panel-footer">
			<div class="table-footer">
				<input type="submit" value="Update" class="btn btn-success">
				<ul class="pagination">
					<? if (!empty($pages)) echo $pages; ?>
				</ul>
			</div>
		</div>
	</div>
</form>







