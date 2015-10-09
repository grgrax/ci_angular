<div class="panel panel-default">
	<div class="panel-heading">Users</div>
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
						$data=get_action_links($user_m,$row['status']);
						?>
						<tr class="<?php echo $data['alertClass']?>">
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
							<td><?php echo user_m::status($row['status']);?></td>
							<td>
								<a href="<?php echo base_url("user/manage/edit/".$row['id'])?>" 
									data-toggle="modal"
									data-target="#myModal">Edit
								</a>
								/ 
								<a href="<?php echo base_url("user/manage/delete/".$row['id'])?>" 
									data-toggle="modal"
									data-target="#myModal">Delete
								</a>

								<?php //echo generate_action_links($user_m,$data['action_links'],$url,$row['id']);?>
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
			<a href="<?php echo base_url('user/manage/add')?>" class="btn btn-primary" 
				data-toggle="modal"
				data-target="#myModal">Add New
			</a>
			<ul class="pagination">
				<?php  if (!empty($pages)) echo $pages; ?>
			</ul>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>



