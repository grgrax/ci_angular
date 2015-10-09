
<div class="row" id="users">
	ajax content	
</div>

<script>
	$(function(){
		console.log("1");
		url = "<?php echo base_url('test/user/ajax')?>";
		$.post(url, function(data){
			console.log(data);
			$('#users').html(data);
		});
	});
</script>
