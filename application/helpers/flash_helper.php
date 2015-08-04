<?php

function flash_msg($class,$message){
	?>
	<div class="alert <?php echo isset($class)?$class:'';?>" alert-dismissible>
		<button type="button" class="close" data-dismiss="alert">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
		<?php echo isset($message)?ucfirst($message):'';?>
	</div>
	<?php
}