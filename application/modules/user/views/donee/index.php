<div class="panel panel-default table-responsive">
	<div class="panel-heading">
		Donees
		<span class="badge badge-info"><?=$total?></span>
		<span class="pull-right">
			<?php if(permission_permit(array('add-donee'))){?>
			<span class="col-lg-3">
				<a href="<?= $link ?>add" class="btn btn-primary btn-labeled fa fa-plus"/>Add New  </a>
			</span>
			<?php } ?>
		</span>
	</div>
	<div class="panel-body">
		<form action="" method="GET" role="form">
			<div class="text-center"><b>--- Filter data by ---</b></div>
			<table class="table filter">            
				<tbody>
					<tr>
						<td class="col-lg-3">
							<div class="form-group">
								<!-- <label>Fund Category</label> -->
								<select id="group_id" class="form-control" name="group_id">
									<option value=""> -- Group --</option>
									<?php foreach ($groups as $group) { ?>
									<option value="<?=$group['id']?>"
										<?php echo $this->input->get('group_id')==$group['id']?'selected':'';?>
										>
										<?=my_word_limiter($group['name'])?>
									</option>
									<?php } ?>
								</select>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Username" name="username"                                    
								value="<?=$this->input->get('username')?$this->input->get('username'):''?>"
								>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Email" name="email"                                    
								value="<?=$this->input->get('email')?$this->input->get('email'):''?>"
								>
							</div>
						</td>
						<td>
							<div class="form-group">
								<!-- <label>Status</label> -->
								<select id="status" class="form-control" name="status">
									<option value="">-- Status --</option>
									<?php foreach ($status as $k=>$v) { if($k==user_m::DELETED) continue;?>
										<option value="<?=$k?>"
											<?php 
											if($this->input->get('status')!=''){
												echo $this->input->get('status')==$k?'selected':'';
											}
											?>
											>
											<?=$v;?>
										</option>
										<?php } ?>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td  class="col-lg-3">
								<div class="form-group">
									<input type="text" name="starting_at" id="filter_starting_at"  data-required="1" 
									class="form-control" placeholder="From date "
									value="<?=$this->input->get('starting_at')?$this->input->get('starting_at'):''?>">
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" name="ending_at" id="ending_at" data-required="1" 
									class="form-control" placeholder="To date"
									value="<?=$this->input->get('ending_at')?$this->input->get('ending_at'):''?>">
								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control" name="first_name" placeholder="First Name" 
									value="<?=$this->input->get('first_name')?$this->input->get('first_name'):''?>">

								</div>
							</td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control" name="last_name" placeholder="Last Name" 
									value="<?=$this->input->get('last_name')?$this->input->get('last_name'):''?>">
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-group pull-right">
					<input type="submit" class="btn btn-info" name="filter" value="Filter">
					<a href="<?=$link?>" class="btn btn-info">Reset</a>
				</div>
			</form>

			<table class="table">
				<thead>
					<tr>
						<th class="center">s.no</th>
						<th>username</th>
						<th>group name</th>
						<th>email</th>
						<th>Full name</th>
						<th>created at</th>
						<th>status</th>
						<th>actions</th>
					</tr>
				</thead>

				<tbody>
					<?php
					if ($rows && count($rows) > 0) {
						$c = $offset;
						foreach ($rows as $row) {
							$c++;
							$alertClass="";
							$actions=array();
							switch($row['status']){
								case user_m::PENDING:
								{
									$alertClass="warning";
									if(permission_permit(array('activate-donee'))) 
										$actions=array('activate');
								}
								case user_m::BLOCKED:
								{
									$alertClass="warning";
									if(permission_permit(array('activate-donee'))) 
										$actions=array('activate');
									break;
								}
								case user_m::ACTIVE:
								{
									$alertClass="";
									if(permission_permit(array('block-donee'))) 
										$actions[]='block';
									if(permission_permit(array('delete-donee'))) 
										$actions[]='delete';
									break;
								}
							}
							?>
							<tr class="<?php echo $alertClass?>">
								<td class="center"><?php echo $c;?></td>
								<td class="no-capitalize"><?=$row['username'] ?></td>
								<td><?php echo $row['name'];?></td>
								<td class="no-capitalize"><?=$row['email'] ?></td>
								<td><?php echo $row['first_name']." ".$row['last_name'];?></td>
								<td class="no-capitalize"><?php echo format($row['created_at']);?></td>
								<td>
									<?php 
									$status=user_m::status($row['status']);
									if($status=='Pending')
										$class='warning';
									elseif($status=='Active')
										$class='success';									
									elseif($status=='Blocked')									
										$class='danger';
									?>
									<span class="label label-table label-<?=$class?>"><?=$status?></span>
								</td>
								<td>
									<?php if(is_default($row['username'])) continue; ?>
									<?php if(!$row['facebook_id'] and permission_permit(array('edit-donee'))) { ?>
									<a class="btn btn-sm btn-default btn-icon btn-hover-success add-tooltip fa fa-pencil" 
									data-toggle="tooltip" 
									href="<?= $link ?>edit/<?= $row['username'] ?>" 
									data-original-title="Edit" ></a>
									<?php } ?>
									<?php 
									foreach ($actions as $k=>$action) 
									{ 
										switch ($action) 
										{
											case 'activate':
											$class='btn-success fa fa-check';
											break;
											case 'block':
											$class='btn-warning fa fa-warning';
											break;
											case 'delete':
											$class='btn-danger fa fa-times delete';
											break;
										}
										?>
										<a href="<?=$link.$action.'/'.$row['username'] ?>" class="btn btn-sm btn-icon add-tooltip <?=$class?>" 
											data-toggle="tooltip" 
											data-original-title="<?=ucfirst($action)?>"
											data-container="body"/>
										</a>
										<?php 
									} 
									?>
								</td>
							</tr>
							<?php 
						}
					}
					else {
						?>
						<tr>
							<td colspan="8" class="td_no_data">No data</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<div class="table-footer">
				<ul class="pagination">
					<?php  if (!empty($pages)) echo $pages; ?>
				</ul>
			</div>
		</div>
	</div>


	<script>
		$(function(){

			$("#filter_starting_at").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				onClose: function( selectedDate ) {
					$( "#ending_at" ).datepicker( "option", "minDate", selectedDate );
					$( "#ending_at" ).focus();                                    
				}
			});
			$("#ending_at").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				minDate: $('#filter_starting_at').val()
			});
		})
	</script>

	<style>
		.filter{
			margin-bottom: 10px;
			border-top: none !important;
			/*border-bottom: 1px dotted rgba(182, 184, 184, 0.99);*/
		}
	</style>





