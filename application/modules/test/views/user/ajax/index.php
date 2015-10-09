<hr>
<hr>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalAdd">
	Add new
</button>

<div class="row" id="users">
	ajax content	
</div>

<script>
	$(function(){
		url = "<?php echo base_url('test/user/ajax')?>";
		$.post(url, function(response, status, xhr){
				response=$.parseJSON(response);
				console.log(response);
				if(response.status == "success"){
					$('#users').html(response.data);
				}
				if(response.status == "error"){
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
	});
</script>
