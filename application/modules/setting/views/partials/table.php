<table class="table table-striped">
	<thead>
		<tr>
			<th class="center">s.no</th>
			<th>name</th>
			<th width="70%">description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if ($rows && count($rows) > 0) {
			$c = 0;
			foreach ($rows as $row) {
				$c++;
				?>
				<tr class="tr-head">
					<td class="center"><?php echo $c;?></td>
					<td><?=ucfirst($row['name']) ?></td>
					<td>
						<textarea cols="50" rows="2"
						name="setting[<?php echo $row['id']?>]"
						class="form-control" 
						placeholder="Description"><?=$row['value'] ?></textarea> 
					</td>
					<td>
						<?php //echo anchor($link."delete/".$row['slug'],"Delete",'class="a-delete"');?>
					</td>
				</tr>
				<?php 
			}
		}?>
	</tbody>
</table>
