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
				<button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#myModal" 
				data-id="<?php echo $user['id']?>"
				data-modal-title="Edit User">
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
			<form action="" method="POST" role="form" class="form-edit">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">username</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="e.g, rohan">
						<input type="hidden" name="id" id="id">
					</div>
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="e.g, rohan@gmail.com">
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
			<form action="" method="POST" role="form" class="form-add">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add new</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="">username</label>
						<input type="text" class="form-control" id="" name="username" placeholder="Input field">
					</div>
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" id="" name="email" placeholder="Input field">
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


<script>
	$(function(){
		$('.edit').on("click", function() {
			id = $(this).attr('data-id');
			url = "<?php echo base_url('test/user/edit')?>"+"/"+id;
			$.post(url, function(response, status, xhr){
				// console.log(response);
				response=$.parseJSON(response);
				if(response.status == "success"){
					$('.form-edit #id').val(response.data.id);
					$('.form-edit #username').val(response.data.username);
					$('.form-edit #email').val(response.data.email);
				}
				if(response.status == "error"){
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		//edit
		$(".form-edit").submit(function(e) {
			e.preventDefault();
			// var actionurl = e.currentTarget.action;
			id = $('#id').val();
			url = "<?php echo base_url('test/user/edit')?>"+"/"+id;
			form_data = $(this).serialize();
			console.log(form_data);
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				success: function(data) {
					alert("Success")
				},
				error: function(xhr,status,error){
					console.log("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		//add
		$(".form-add").submit(function(e) {
			e.preventDefault();
			url = "<?php echo base_url('test/user/add')?>";
			form_data = $(this).serialize();
			console.log(form_data);
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				success: function(data) {
					alert("Success")
				},
				error: function(xhr,status,error){
					console.log("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

	});

</script>
