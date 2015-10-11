<?php

//forms
if (!function_exists('form_head')) {
	function form_head()
	{
		if(config_item('admin_template')=='charisma-master') { ?>
		<div class="panel panel-default">
			<div class="panel-heading">Add Group Details</div>
			<div class="panel-body">				
				<?php } 
				else if(config_item('admin_template')=='charisma-master') { ?>
				<div class="row-fluid sortable ui-sortable">
					<div class="box span12">
						<div class="box-header well" data-original-title="">
							<h2><i class="icon-edit"></i> Form Elements</h2>
							<div class="box-icon">
								<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
								<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
								<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
							</div>
						</div>
						<div class="box-content">
							<?php } 
						}
					}

					if(!function_exists('get_slug')){
						function get_slug($str,$slug='-',$force_lower=TRUE){
							return url_title($str, $slug, $force_lower);
						}
					}
//forms 



//TODO create testimonial helper using hmvc

					?>