<div class="panel panel-default">
	<div class="panel-heading">Users</div>
	<div class="panel-body">
		<table class="table">
			<thead>
				<tr>
					<th class="center">s.no</th>
					<th>username</th>
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
							<td class="no-capitalize"><?php echo format($row['created_at']);?></td>
							<td><?php echo user_m::status($row['status']);?></td>
							<td>
							<?php echo generate_action_links($data['action_links'],$url,$row['id']);?>
							</td>
						</tr>
						<?
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
			<a href="<?= $url ?>add" class="btn btn-primary"/>Add New  </a>
			<ul class="pagination">
				<?php  if (!empty($pages)) echo $pages; ?>
			</ul>
		</div>
	</div>
</div>

