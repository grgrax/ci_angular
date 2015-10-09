

<form action="<?php echo $link.'updateAll/';?>" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">
			Settings
			<span class="badge badge-info"><?=count($rows)?></span>
		</div>
		<div class="panel-body">
			<?php $this->load->view("setting/partials/table.php",array('rows'=>$rows)); ?>
		</div>
		<div class="panel-footer">
			<div class="table-footer">
				<!-- <a href="<?= $link ?>add" class="btn btn-primary"/>Add New  </a> -->
				<input type="submit" value="Update" class="btn btn-success">
				<ul class="pagination">
					<?php  if (!empty($pages)) echo $pages; ?>
				</ul>
			</div>
		</div>
	</div>
</form>

