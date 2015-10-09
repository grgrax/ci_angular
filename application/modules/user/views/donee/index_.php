<div class="panel panel-default table-responsive">
	<div class="panel-heading">
		Donees
		<span class="badge badge-info"><?=$total?></span>
		<span class="pull-right">
			<?php if(permission_permit(array('add-donee'))){?>
			<span class="col-lg-3">
				<a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
			</span>
			<?php } ?>
		</span>
	</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th class="center">s.no</th>
					<th>username</th>
					<th>group name</th>
					<th>email</th>
					<th>created at</th>
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
								if(permission_permit(array('activate-donee'))) 
									$actions=array('activate');
							}
							case user_m::BLOCKED:
							{
								$alertClass="warning";
								if(permission_permit(array('activate-donee'))) 
									$actions=array('activate');
								break;
							}
							case user_m::ACTIVE:
							{
								$alertClass="";
								if(permission_permit(array('block-donee'))) 
									$actions[]='block';
								if(permission_permit(array('delete-donee'))) 
									$actions[]='delete';
								break;
							}
						}
						?>
						<tr class="<?php echo $alertClass?>">
							<td class="center"><?php echo $c;?></td>
							<td class="no-capitalize"><?=$row['username'] ?></td>
							<td>
								<?php 
								$group=get_group(array('id'=>$row['group_id']));								
								echo $group?$group['name']:'';
								?>
							</td>
							<td class="no-capitalize"><?=$row['email'] ?></td>
							<td class="no-capitalize"><?php echo format($row['created_at']);?></td>
							<td>
								<?php 
								$status=user_m::status($row['status']);
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
								<?php if(is_default($row['username'])) continue; ?>
								<?php if(permission_permit(array('edit-category'))) { ?>
								<a class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
								data-toggle="tooltip" 
								href="<?= $link ?>edit/<?= $row['username'] ?>" 
								data-original-title="Edit" ></a>
								<?php } ?>
								<?php 
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
									<a href="<?=$link.$action.'/'.$row['username'] ?>" class="btn btn-sm btn-icon add-tooltip <?=$class?>" 
										data-toggle="tooltip" 
										data-original-title="<?=ucfirst($action)?>"
										data-container="body"/>
									</a>
									<?php 
								} 
								?>
							</td>
						</tr>
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
			<ul class="pagination">
				<?php  if (!empty($pages)) echo $pages; ?>
			</ul>
		</div>
	</div>
</div>

