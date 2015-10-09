<div class="panel panel-primary">

	<!--Panel heading-->
	<!-- tabs -->
	<div class="panel-heading">
		<!-- tab-head -->
		<div class="panel-control">
			<ul class="nav nav-tabs">
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-1" aria-expanded="true">Header</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-2" aria-expanded="false">Slider</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-3" aria-expanded="false">Sidebars</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-4" aria-expanded="false">Messages</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-5" aria-expanded="false">Projects</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-6" aria-expanded="false">News & events</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-7" aria-expanded="false">Footer Message</a></li>
				<li class=""><a data-toggle="tab" href="#demo-tabs-box-8" aria-expanded="false">Contact Settings</a></li>
			</ul>
		</div>
		<!-- tab-head -->
		<h3 class="panel-title">Front page settings</h3>
	</div>
	<!-- tabs -->
	<!--Panel heading-->

	<!--Panel body-->
	<div class="panel-body">
		<!--form-->
		<!--Tabs content-->
		<div class="tab-content">

			<!-- tab1 -->
			<div id="demo-tabs-box-1" class="tab-pane fade">
				<!-- form -->
				<form class="form-horizontal" method="post" name="form_options" enctype="multipart/form-data">						
					<!-- Title -->
					<span class="row">
						
						<span class="col-md-6">                  
							<h4 class="text-thin mar-btm">Title</h4><hr>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-md-3 control-label">Select Logo</label>
									<div class="col-md-9">
										<span class="pull-left btn btn-default">
											<input type="file" name="header_logo">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-5">
										<ul>
											<li><b>Type: </b> gif | jpg | png </li>
											<li><b>Size: </b> < 1mb </li>
											<li><b>Dimension: </b> 1024 X 768 </li>
										</ul>
									</div>
									<div class="col-md-4">
										
										<?php 
										$header_logo=get_setting_value('header_logo');	
										$image=is_picture_exists("setting/$header_logo");
										if($header_logo && $image) {?>
										<a href="<?php echo is_picture_exists("setting/$header_logo")?>">
											<img alt="" class="img-circle img-sm" src="<?php echo $image;?>">
										</a>
										<?php }
										else{ ?>
										<img alt="" class="img-circle img-sm" src="<?php echo is_picture_exists('setting/demo.jpg');?>">
										<?php } ?> 

									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Club Name</label>
									<div class="col-sm-9">
										<input name="club_name" type="text" placeholder="Club Name" id="demo-hor-inputemail" class="form-control"
										value="<?php echo get_setting_value('club_name')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Club No.</label>
									<div class="col-sm-9">
										<input name="club_number" type="text" placeholder="Club No." id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('club_number')?>" >
									</div>
								</div>
							</div> 
						</span>
						<!-- Title -->

						<!-- Slogan -->
						<span  class="col-md-6">
							<h4 class="text-thin mar-btm">Slogan</h4><hr>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Head</label>
									<div class="col-sm-9">
										<input name="slogan_head" type="text" placeholder="Slogan head" id="demo-hor-inputemail" class="form-control"
										value="<?php echo get_setting_value('slogan_head')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Body</label>
									<div class="col-sm-9">
										<input name="slogan_body" type="text" placeholder="Slogan body" id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('slogan_body')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Dist.</label>
									<div class="col-sm-9">
										<input name="slogan_dist" type="text" placeholder="Dist." id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('slogan_dist')?>" >
									</div>
								</div>
							</div>
						</span>
						<!-- Slogan -->

					</span>
					<!-- Title -->

					<!-- Other sites -->
					<span class="row">						
						

						<h4 class="text-thin mar-btm">Our other's sites</h4><hr>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Site 1</label>
								<div class="col-sm-4">
									<input name="other_site_1_name" type="text" placeholder="Name" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('other_site_1_name')?>" >
								</div>
								<div class="col-sm-5">
									<input name="other_site_1_url" type="text" placeholder="Url" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('other_site_1_url')?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Site 2</label>
								<div class="col-sm-4">
									<input name="other_site_2_name" type="text" placeholder="Name" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('other_site_2_name')?>" >
								</div>
								<div class="col-sm-5">
									<input name="other_site_2_url" type="text" placeholder="Url" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('other_site_2_url')?>" >
								</div>
							</div>
						</div>
						<!-- Other sites -->
					</span>
					<!-- Other sites -->


					<!-- Title -->
					<span class="row">                  
						<h4 class="text-thin mar-btm">Welcome & Introduction</h4><hr>
						<div class="panel-body">
							<span class="col-md-12"> 
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Welcome Message</label>
									<div class="col-sm-9">
										<input name="welcome_message" type="text" placeholder="Welcome Message" id="demo-hor-inputemail" class="form-control"
										value="<?php echo get_setting_value('welcome_message')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Introduction</label>
									<div class="col-sm-9">
										<textarea name="introduction" id="" cols="30" rows="10" class="form-control" placeholder="sidebar 1 content"><?php echo get_setting_value('introduction')?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Introduction Page</label>
									<div class="col-sm-9">
										<select name="introduction_article_id" id="" class="form-control">	
											<option value=""> Select Page </option>
											<?php $articles=get_active_articles();?>	
											<?php foreach ($articles as $article) { ?>
											<?php $selected=get_setting_value('introduction_article_id')==$article['id']?'selected':''?>
											<option value="<?php echo $article['id']?>" <?php echo $selected?> ><?php echo $article['name']?></option>
											<?php } ?>				
										</select>
									</div>
								</div>
							</span>
						</div> 
					</span>
					<!-- Title -->


					<!-- save and cancel -->
					<div class="panel-footer text-right" id="no-color">                
						<input name="header" class="btn btn-success" type="submit" value="Submit">
						<!-- <button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button> -->
						<button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
					</div>
					<!-- save and cancel -->
				</form>
				<!-- form -->				
			</div>
			<!-- tabl -->

			<!-- tab2-Slider -->
			<div id="demo-tabs-box-2" class="tab-pane fade">
				<!-- form -->
				<form class="form-horizontal" method="post" name="form_options" enctype="multipart/form-data">						
					<span>
						<h4 class="text-thin mar-btm">Slider Options</h4><hr>
						<div class="panel-body">
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Category</label>
								<div class="col-sm-9">
									<select name="slider_category_id" id="" class="form-control">	
										<option value=""> Select Category </option>
										<?php $categories=get_published_categories();?>	
										<?php foreach ($categories as $category) { ?>
										<?php $selected=get_setting_value('slider_category_id')==$category['id']?'selected':''?>
										<option value="<?php echo $category['id']?>" <?php echo $selected?> ><?php echo $category['name']?></option>
										<?php } ?>				
									</select>
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputpass">No of Pictures</label>
								<div class="col-sm-9">
									<input name="slider_show_total" type="number" id="demo-hor-inputpass" class="form-control"
									value="<?php echo get_setting_value('slider_show_total')?>" >
								</div>
							</div>
						</div>
					</span>
					<!-- Slider -->
					<!-- save and cancel -->
					<div class="panel-footer text-right" id="no-color">
						<input name="slider" class="btn btn-success" type="submit" value="Submit">
						<button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
					</div>
					<!-- save and cancel -->
				</form>
				<!-- form -->				
			</div>
			<!-- tab2-Slider -->

			<!-- tab3-Sidbars -->
			<div id="demo-tabs-box-3" class="tab-pane fade">
				<!-- Sidbars -->
				<form class="form-horizontal" method="post" name="form_options" enctype="multipart/form-data">	
					<span>
						<h4 class="text-thin mar-btm">Sidebar 1 and 2 Options</h4><hr>
						<div class="panel-body">

							<!-- sidebar 1 -->
							<span class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">Select Logo</label>
									<div class="col-md-9">
										<span class="pull-left btn btn-default">
											<input type="file" name="sidebar1_picture">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-5">
										<ul>
											<li><b>Type: </b> gif | jpg | png </li>
											<li><b>Size: </b> < 1mb </li>
											<li><b>Dimension: </b> 1024 X 768 </li>
										</ul>
									</div>
									<div class="col-md-4">

										<?php 
										$sidebar1_picture=get_setting_value('sidebar1_picture');	
										$image=is_picture_exists("setting/$sidebar1_picture");
										if($sidebar1_picture && $image) {?>
										<a href="<?php echo is_picture_exists("setting/$sidebar1_picture")?>">
											<img alt="" class="img-circle img-sm" src="<?php echo $image;?>">
										</a>
										<?php }
										else{ ?>
										<img alt="" class="img-circle img-sm" src="<?php echo is_picture_exists('setting/demo.jpg');?>">
										<?php } ?> 

									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-offset-3 col-md-9">
										<b>OR</b> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Content</label>
									<div class="col-sm-9">
										<textarea name="sidebar1_content" id="" cols="30" rows="10" class="form-control" placeholder="sidebar 1 content"><?php echo get_setting_value('sidebar1_content')?></textarea>
									</div>
								</div>                      
							</span>
							<!-- sidebar 1 -->


							<!-- sidebar 2 -->
							<span class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">Select Logo</label>
									<div class="col-md-9">
										<span class="pull-left btn btn-default">
											<input type="file" name="sidebar2_picture">
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-5">
										<ul>
											<li><b>Type: </b> gif | jpg | png </li>
											<li><b>Size: </b> < 1mb </li>
											<li><b>Dimension: </b> 1024 X 768 </li>
										</ul>
									</div>
									<div class="col-md-4">

										<?php 
										$sidebar2_picture=get_setting_value('sidebar2_picture');	
										$image=is_picture_exists("setting/$sidebar2_picture");
										if($sidebar1_picture && $image) {?>
										<a href="<?php echo is_picture_exists("setting/$sidebar2_picture")?>">
											<img alt="" class="img-circle img-sm" src="<?php echo $image;?>">
										</a>
										<?php }
										else{ ?>
										<img alt="" class="img-circle img-sm" src="<?php echo is_picture_exists('setting/demo.jpg');?>">
										<?php } ?> 

									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-offset-3 col-md-9">
										<b>OR</b> 
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Content</label>
									<div class="col-sm-9">
										<textarea name="sidebar2_content" id="" cols="30" rows="10" class="form-control" placeholder="sidebar 2 content"><?php echo get_setting_value('sidebar2_content')?></textarea>
									</div>
								</div>                      
							</span>
							<!-- sidebar 2 -->
							<p class="clear"></p>
							<!-- save and cancel -->
							<div class="panel-footer text-right" id="no-color">
								<input name="sidebar" class="btn btn-success" type="submit" value="Submit">
								<button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
							</div>
							<!-- save and cancel -->
						</div>
						<!-- Sidbars -->
					</span>
				</form>
			</div>
			<!-- tab3-Sidbars -->

			<!-- tab4-Messages -->
			<div id="demo-tabs-box-4" class="tab-pane fade table-responsive">
				<h4 class="text-thin mar-btm">Message Options</h4><hr>
				<span>
					<?php 
					$this->load->view("article/admin/widget/message/ajax/manage.php");
					?>              
				</span>
			</div>
			<!-- tab4-Messages -->

			<!-- tab5-Logos -->
			<div id="demo-tabs-box-5" class="tab-pane fade table-responsive">
				<h4 class="text-thin mar-btm">Projects Options</h4><hr>
				<span>
					<?php 
					$this->load->view("article/admin/widget/project/ajax/manage.php");
					?>              
				</span>
			</div>
			<!-- tab5-Logos -->

			<!-- tab6-News -->
			<div id="demo-tabs-box-6" class="tab-pane fade table-responsive">
				<h4 class="text-thin mar-btm">News & Events Options</h4><hr>
				<span>
					<?php 
					$this->load->view("article/admin/widget/news/ajax/manage.php");
					?>              
				</span>
			</div>
			<!-- tab6-News -->

			<!-- tab7-Footer -->
			<div id="demo-tabs-box-7" class="tab-pane fade">
				<form class="form-horizontal" method="post" name="form_options" enctype="multipart/form-data">
					<span>
						<h4 class="text-thin mar-btm">Footer Options</h4><hr>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputpass">Content</label>
								<div class="col-sm-9">
									<input name="footer_message" type="text" id="demo-hor-inputpass" class="form-control"
									value="<?php echo get_setting_value('footer_message')?>" >
								</div>
							</div>
						</div>
					</span>
					<!-- save and cancel -->
					<div class="panel-footer text-right" id="no-color">
						<input name="footer" class="btn btn-success" type="submit" value="Submit">
						<button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
					</div>
					<!-- save and cancel -->
				</form>
			</div>
			<!-- tab7-Footer -->

			<!-- tab8-Contact -->
			<div id="demo-tabs-box-8" class="tab-pane fade">
				<form class="form-horizontal" method="post" name="form_options" enctype="multipart/form-data">

					<!-- Other sites -->
					<span class="row">
						<h4 class="text-thin mar-btm">Contacts</h4><hr>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Telephones</label>
								<div class="col-sm-4">
									<input name="telephone_1" type="text" placeholder="Telephone 1" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('telephone_1')?>" >
								</div>
								<div class="col-sm-5">
									<input name="telephone_2" type="text" placeholder="Telephone 2" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('telephone_2')?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Mobiles</label>
								<div class="col-sm-4">
									<input name="mobile_1" type="text" placeholder="Mobile 1" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('mobile_1')?>" >
								</div>
								<div class="col-sm-5">
									<input name="mobile_2" type="text" placeholder="Mobile 2" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('mobile_2')?>" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label" for="demo-hor-inputemail">Emails</label>
								<div class="col-sm-4">
									<input name="email_1" type="text" placeholder="Email 1" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('email_1')?>" >
								</div>
								<div class="col-sm-5">
									<input name="email_2" type="text" placeholder="Email 2" id="demo-hor-inputemail" class="form-control"
									value="<?php echo get_setting_value('email_2')?>" >
								</div>
							</div>
						</div>
					</span>
					<!-- Other sites -->
					<span class="row">						
						<!-- Title -->
						<span class="col-md-6">                  
							<h4 class="text-thin mar-btm">Address</h4><hr>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputemail">Address</label>
									<div class="col-sm-9">
										<textarea name="location" id="" cols="30" rows="10" class="form-control" placeholder="sidebar 1 content"><?php echo get_setting_value('location')?></textarea>
									</div>
								</div>
							</div> 
						</span>
						<!-- Title -->

						<!-- Slogan -->
						<span  class="col-md-6">
							<h4 class="text-thin mar-btm">Social Links</h4><hr>
							<div class="panel-body">
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Facebook</label>
									<div class="col-sm-9">
										<input name="facebook_link" type="text" placeholder="Slogan body" id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('facebook_link')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Twitter</label>
									<div class="col-sm-9">
										<input name="twitter_link" type="text" placeholder="Dist." id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('twitter_link')?>" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="demo-hor-inputpass">Google Plus</label>
									<div class="col-sm-9">
										<input name="google_plus_link" type="text" placeholder="Slogan body" id="demo-hor-inputpass" class="form-control"
										value="<?php echo get_setting_value('google_plus_link')?>" >
									</div>
								</div>
							</div>
						</span>
						<!-- Slogan -->
					</span>





					<!-- save and cancel -->
					<div class="panel-footer text-right" id="no-color">                
						<input name="contact" class="btn btn-success" type="submit" value="Submit">
						<!-- <button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button> -->
						<button class="btn btn-warning btn-labeled fa fa-repeat" type="reset">Reset</button>
					</div>
					<!-- save and cancel -->
				</div>
				<!-- tab8-Contact -->

			</div>
			<!--Tabs content-->
		</div>
		<!--Panel body-->

	</div>





	<style>
		#no-color{
			background-color: #E7EBEE !important;
			border-color: #E7EBEE !important;
		}
		.panel-body{
			margin-top: 1% !important;
		}
		.mar-btm {
			margin-bottom: none !important;
		}
		.panel-body {
			padding: none !important;
		}
		.form-control {
			/*height: 5%;*/
		}
		mark{
			/*line-height: 33px;*/
		}
	</style>

	<script>
		$(function(){

			$('#remove_all').click(function(e){
				e.preventDefault();
				$("#add_remove div.form-group:not(:first)").remove();
				$('#remove_all').toggle(false);
			});

			var tab='<?php echo get_session("tab")?:1?>';
			tab=tab?tab:'1';
			// console.log(tab);
			$('.nav-tabs a[href="#demo-tabs-box-' + tab + '"]').tab('show');

		});
	</script>


