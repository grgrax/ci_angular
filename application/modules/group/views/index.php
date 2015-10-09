<div class="panel panel-default table-responsive">
	<div class="panel-heading">
		Groups
		<span class="badge badge-info"><?=$total?></span>
		<span class="pull-right">
			<?php if(permission_permit(array('add-group'))){?>
			<span class="col-lg-3">
				<a href="<?= $url ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
			</span>
			<?php } ?>
		</span>
	</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th class="center">s.no</th>
					<th>name</th>
					<th>created at</th>
					<th>parent group</th>
					<th>no of users</th>
					<th>status</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if ($rows && count($rows) > 0) {
					$c = $offset;
					foreach ($rows as $row) {
						$c++;
						$alertClass="";
						$actions=array();
						switch($row['status']){
							case user_m::PENDING:
							{
								$alertClass="warning";
								if(permission_permit(array('activate-group'))) 
									$actions=array('activate');
							}
							case user_m::BLOCKED:
							{
								$alertClass="warning";
								if(permission_permit(array('activate-group'))) 
									$actions=array('activate');
								break;
							}
							case user_m::ACTIVE:
							{
								$alertClass="";
								if(permission_permit(array('block-group'))) 
									$actions[]='block';
								if(permission_permit(array('delete-group'))) 
									$actions[]='delete';
								break;
							}
						}
						?>
						<tr class="<?php echo $alertClass?>">
							<td class="center"><?php echo $c;?></td>
							<td><?=$row['name'] ?></td>
							<td class="no-capitalize"><?php echo format($row['created_at']);?></td>
							<td>
								<?php 
								$group=get_group(array('id'=>$row['parent_group_id']));								
								echo $group?$group['name']:'---';
								?>
							</td>
							<td><?php echo count_group_user($row['id']) ?></td>
							<td>
								<?php 
								$status=group_m::status($row['status']);
								if($status=='Pending')
									$class='warning';
								elseif($status=='Active')
									$class='success';									
								elseif($status=='Blocked')									
									$class='danger';
								?>
								<span class="label label-table label-<?=$class?>"><?=$status?></span>
							</td>
							<td>
								<?php if($row['slug']==group_m::DONEE or $row['slug']==group_m::FACEBOOK_USER ) continue; ?>
									<?php if($row['slug']!='superadmin' and permission_permit(array('edit-group'))) { ?>
									<a class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
									data-toggle="tooltip" 
									href="<?= $url ?>edit/<?= $row['slug'] ?>" 
									data-original-title="Edit" ></a>
									<?php } ?>
									<?php 
									if($row['slug']!='superadmin') {
										foreach ($actions as $k=>$action) 
										{ 
											switch ($action) 
											{
												case 'activate':
												$class='btn-success fa fa-check';
												break;
												case 'block':
												$class='btn-warning fa fa-warning';
												break;
												case 'delete':
												$class='btn-danger fa fa-times delete';
												break;
											}
											?>
											<a href="<?=$url.$action.'/'.$row['slug'] ?>" class="btn btn-sm btn-icon add-tooltip <?=$class?>" 
												data-toggle="tooltip" 
												data-original-title="<?=ucfirst($action)?>"
												data-container="body"/>
											</a>
											<?php 									
										} 
										
									} 
									?>
									<?php if($row['status']==user_m::ACTIVE && permission_permit(array('update-permission-group'))) { ?>
										<a class="btn btn-sm btn-icon add-tooltip btn-info fa fa-lock" 
										data-toggle="tooltip" 
										href="<?php echo $url."group_permsission/".$row['slug']?>" 
										data-original-title="Permission" ></a>
										<?php } ?>
									</td>
								</tr>
								<?php
							}
						}
						else {
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
				<div class="table-footer">
					<ul class="pagination">
						<?php  if (!empty($pages)) echo $pages; ?>
					</ul>
				</div>
			</div>
		</div>

		<style>
			table th:last-child{
				width: 20% !important;
			}
		</style>