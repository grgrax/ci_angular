<form method="post" action="" id="upload_file">
	<label for="title">Title</label>
	<input type="text" name="title" id="title" value="" />

	<label for="userfile">File</label>
	<input type="file" name="userfile" id="userfile" size="20" />

	<input type="submit" name="submit" id="submit" />
</form>

<script>
	$(function() {


		function refresh_files()
		{
			$.get('./upload/files/')
			.success(function (data){
				$('#files').html(data);
			});
		}
		
		$('#upload_file').submit(function(e) {
			e.preventDefault();
			$.ajaxFileUpload({
				url 			:'./upload/upload_file/', 
				secureuri		:false,
				fileElementId	:'userfile',
				dataType		: 'json',
				data			: {
					'title'				: $('#title').val()
				},
				success	: function (data, status)
				{
					if(data.status != 'error')
					{
						$('#files').html('<p>Reloading files...</p>');
						refresh_files();
						$('#title').val('');
					}
					alert(data.msg);
				}
			});
			return false;
		});
	});
</script>