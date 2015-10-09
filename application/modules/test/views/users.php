<hr>
<hr>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalAdd">
	Add new
</button>

<table class="table table-hover">
	<thead>
		<tr>
			<th>id</th>
			<th>username</th>
			<th>email</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo $user['id']?></td>
			<td><?php echo $user['username']?></td>
			<td><?php echo $user['email']?></td>
			<td>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-id="<?php echo $user['id']?>">
					Edit 
				</button>
				<?php echo anchor('test/user/'.$user['id'], 'Delete', 'class="btn btn-danger"');?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="POST" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">username</label>
						<input type="text" class="form-control" id="" placeholder="Input field">
					</div>
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" id="" placeholder="Input field">
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" value="Save changes" class="btn btn-primary" name="submit">
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="POST" role="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add new</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">username</label>
						<input type="text" class="form-control" id="" placeholder="Input field">
					</div>
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" id="" placeholder="Input field">
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
					<input type="submit" value="Save changes" class="btn btn-primary" name="submit">
				</div>
			</form>
		</div>
	</div>
</div>