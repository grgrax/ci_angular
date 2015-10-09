<?php $groups=get_groups(array('id >'=>0));?>
<hr>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalGroupAdd">
	Add new
</button>
<table class="table table-hover">
	<thead>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>description</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($groups as $group) { ?>
		<tr>
			<td><?php echo $group['id']?></td>
			<td><?php echo $group['name']?></td>
			<td><?php echo $group['desc']?$group['desc']:''?></td>
			<td>
				<button type="button" class="btn btn-primary edit" data-toggle="modal" data-target="#myModalGroupEdit" 
				data-id="<?php echo $group['id']?>">
				Edit 
			</button>
			<button type="button" class="btn btn-danger delete" 
			data-id="<?php echo $group['id']?>">
			Delete 
		</button>
	</td>
</tr>
<?php } ?>
</tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="myModalGroupEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="POST" role="form" class="form-edit" id="form_another" novalidate>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="groupname">Name</label>
						<input type="text" required class="form-control" id="groupname" name="groupname" placeholder="e.g, rohan">
						<input type="hidden" name="id" id="id">
					</div>
					<div class="form-group">
						<label for="desc">Description</label>
						<textarea class="form-control" name="desc" id="desc" cols="30" rows="10" placeholder="e.g, rohan@gmail.com"></textarea>
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
<div class="modal fade" id="myModalGroupAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" method="POST" role="form" class="form-add" id="form_add" novalidate>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Add new</h4>

				</div>
				<div class="modal-body">
					<span id="error"></span>					
					<div class="form-group">
						<label for="groupname">Name</label>
						<input type="text" required class="form-control" id="groupname" name="groupname" placeholder="e.g, donee">
						<input type="hidden" name="id" id="id">
					</div>
					<div class="form-group">
						<label for="desc">Description</label>
						<textarea class="form-control" name="desc" id="desc" cols="30" rows="10" placeholder="e.g, group description"></textarea>
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

// 		$("#form_add").validate({
// 			submitHandler: function(form) {

//             // your ajax loading logic
//             e.preventDefault();
//             url = "<?php echo base_url('test/group/add')?>";
//             form_data = $(this).serialize();
//             $.ajax({
//             	url: url,
//             	type: 'POST',
//             	dataType: 'json',
//             	data: form_data,
//             	success: function(data) {
//             		alert("Success");
//             		if(data.status=='success'){						
//             			$('#myModalGroupAdd').modal('hide');
//             			get_groups();						
//             		}
//             		else if(data.status=='error'){

//             			div='<div class="alert alert-danger" alert-dismissible>';
//             			div+='<button type="button" class="close" data-dismiss="alert">';
//             			div+='<span aria-hidden="true">&times;</span>';
//             			div+='<span class="sr-only">Close</span>';
//             			div+='</button>';

//             			div+='<span id="error">'+data.message+'</span>';
//             			div+='</div>';
//             			$('#myModalGroupAdd #error').html(div);
//             		}
//             	},
//             	error: function(xhr,status,error){
//             		console.log("Error: " + xhr.status + ": " + xhr.statusText);
//             	}
//             });
// }
// });



// $('#form_another').validate();

		//load data
		$('.edit').on("click", function() {
			id = $(this).attr('data-id');
			url = "<?php echo base_url('test/group/edit')?>"+"/"+id;
			$.post(url, function(response, status, xhr){
				// console.log(response);
				response=$.parseJSON(response);
				if(response.status == "success"){
					$('.form-edit #id').val(response.data.id);
					$('.form-edit #groupname').val(response.data.name);
					$('.form-edit #desc').val(response.data.desc);
				}
				if(response.status == "error"){
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		//edit
		$(".form-edit").submit(function(e) {
			// var actionurl = e.currentTarget.action;
			e.preventDefault();
			id = $('#id').val();
			url = "<?php echo base_url('test/group/edit')?>"+"/"+id;
			form_data = $(this).serialize();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				success: function(data) {
					// alert("Success");
					if(data.status=='success'){						
						$('#myModalGroupEdit').modal('hide');
						$('.alert-success span').html(data.message);
						$('.alert-success').show();
						get_groups();						
					}
					else if(data.status=='error'){
						div='<div class="alert alert-danger" alert-dismissible>';
						div+='<button type="button" class="close" data-dismiss="alert">';
						div+='<span aria-hidden="true">&times;</span>';
						div+='<span class="sr-only">Close</span>';
						div+='</button>';

						div+='<span id="error">'+data.message+'</span>';
						div+='</div>';
						$('#myModalGroupAdd #error').html(div);
					}
				},
				error: function(xhr,status,error){
					console.log("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		//add
		$(".form-add").submit(function(e) {
			e.preventDefault();
			url = "<?php echo base_url('test/group/add')?>";
			form_data = $(this).serialize();
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: form_data,
				success: function(data) {
					// alert("Success");
					if(data.status=='success'){						
						$('#myModalGroupAdd').modal('hide');
						$('.alert-success span').html(data.message);
						$('.alert-success').show();
						get_groups();						
					}
					else if(data.status=='error'){
						div='<div class="alert alert-danger" alert-dismissible>';
						div+='<button type="button" class="close" data-dismiss="alert">';
						div+='<span aria-hidden="true">&times;</span>';
						div+='<span class="sr-only">Close</span>';
						div+='</button>';

						div+='<span id="error">'+data.message+'</span>';
						div+='</div>';
						$('#myModalGroupAdd #error').html(div);
					}
				},
				error: function(xhr,status,error){
					console.log("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		//delete
		$('.delete').on("click", function() {
			id = $(this).attr('data-id');
			bootbox.confirm("Are you sure?", function(result) {
				if(result){
					url = "<?php echo base_url('test/group/delete')?>"+"/"+id;
					$.ajax({
						url: url,
						type: 'POST',
						dataType: 'json',
						success: function(data) {
							if(data.status=='success'){						
								$('#myModalGroupAdd').modal('hide');
								$('.alert-success span').html(data.message);
								$('.alert-success').show();
								get_groups();						
							}
							else if(data.status=='error'){
								div='<div class="alert alert-danger" alert-dismissible>';
								div+='<button type="button" class="close" data-dismiss="alert">';
								div+='<span aria-hidden="true">&times;</span>';
								div+='<span class="sr-only">Close</span>';
								div+='</button>';

								div+='<span id="error">'+data.message+'</span>';
								div+='</div>';
								$('#myModalGroupAdd #error').html(div);
							}
						},
						error: function(xhr,status,error){
							console.log("Error: " + xhr.status + ": " + xhr.statusText);
						}
					});
				}
			});
});




});
</script>