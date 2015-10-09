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
						<input type="text" class="form-control" id="username" placeholder="e.g, rohan">
					</div>
					<div class="form-group">
						<label for="">email</label>
						<input type="text" class="form-control" id="email" placeholder="e.g, rohan@gmail.com">
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


<script>
	$(function(){

		$('.edit').on("click", function() {
			id = $(this).attr('data-id');
			url = "<?php echo base_url('test/user/edit')?>"+"/"+id;
			$.post(url, function(response, status, xhr){
				// console.log("posted");
				// console.log(response);
				response=$.parseJSON(response);
				if(response.status == "success"){
					$('.form-edit #username').val(response.username);
					$('.form-edit #email').val(response.email);
				}
				if(response.status == "error"){
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				}
			});
		});

		// $('.update').on("click", function() {
		// 	id = $(this).attr('data-id');
		// 	url = "<?php echo base_url('test/user/edit')?>"+"/"+id;
		// 	$.post(url, function(response, status, xhr){
		// 		response=$.parseJSON(response);
		// 		if(status == "success"){
		// 			$('.form-edit #username').val(response.username);
		// 			$('.form-edit #email').val(response.email);
		// 		}
		// 		if(status == "notmodified")
		// 			alert("notmodified: " + xhr.status + ": " + xhr.statusText);
		// 		if(status == "error")
		// 			alert("Error: " + xhr.status + ": " + xhr.statusText);
		// 	});
		// });

});

</script>





































<script type="text/javascript">  
	$(document).ready(function(){    
 //modal - action after click button Delete->Yes  
 $('#btn_YesDel').click(function(){              
 	var idExp = $('#idExp').val();      
 	$(location).attr('href','<?php echo base_url() ?>index.php/applicant_work/delete/'+idExp);  
 });        
 for(var i=1;i<=$('#bilExp').val();i++) {  
 //modal - action after click button View      
 $('#view'+i).click(function(){  
 	var idExp = $('#idExp').val();  
 	$.post('<?php echo base_url() ?>index.php/applicant_work/view/'+idExp,function(data){                                      
 		var obj = $.parseJSON(data);  
 		$('#Vposition').html(obj.desc_position);          
 		$('#Vdesignation').html(obj.designation);    
 		$('#Vworkplace').html(obj.workplace);    
 		$('#Vduration').html(obj.date_from+" - "+obj.date_to);    
 		$('#Vsector').html(obj.desc_sector);    
 		$('#Vgrade').html(obj.desc_grade);  
 	});        
 });      
 //modal - action after click button Edit  
 $('#edit'+i).click(function(){              
 	var idExp = $('#idExp').val();               
 	$.post('<?php echo base_url() ?>index.php/applicant_work/view/'+idExp,function(data){                                      
 		var obj = $.parseJSON(data);    
 		$('#id').val(obj.id_applicantpc_experience);  
 		$('#Eposition option[value=' + obj.position +']').attr("selected",true);  
 		$('#Edesignation').val(obj.designation);          
 		$('#Eworkplace').val(obj.workplace);    
 		$('#Edate_from').val(obj.date_from);  
 		$('#Edate_to').val(obj.date_to);  
 		$('input[name=Esector][value=' + obj.sector +']').attr("checked",true);    
 	});                  
 });    
 } //end function for  
 //modal - action after click button Save  
 $("#btn_wEdit").click(function( e ) {  
 	e.preventDefault();  
 	var id = $('#id').val();  
 	var position = $('#Eposition').val();  
 	var designation = $('#Edesignation').val();  
 	var workplace = $('#Eworkplace').val();  
 	var dtFrom = $('#Edate_from').val();  
 	var dtTo = $('#Edate_to').val();  
 	var sector = $('input:radio[name=Esector]:checked').val();    
 	var grade = $('#Egrade').val();  
 	$.ajax({  
 		type: "POST",  
 		url: "<?=base_url()?>index.php/applicant_work/update",  
 		cache: false,  
 		dataType: "json",  
 		data: 'id='+id+'&Eposition='+position+'&Edesignation='+designation+'&Eworkplace='+workplace+'&dtFrom='+dtFrom+'&dtTo='+dtTo+'&Esector='+sector+'&Egrade='+grade,  
 		success: function(result){  
 			if(result.error) {  
 				$(".alert").fadeIn('slow');  
 				$("#error_message").html(result.message);  
 			} else {        
 				$(location).attr('href','<?php echo base_url() ?>index.php/applicant_work/refresh/'+modul_id);        }  
 			}  
 		});  
 });  
}  