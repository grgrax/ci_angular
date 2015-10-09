<section id="contact-page" class="container">

	<div class="row-fluid">
		<div class="span15">
			<h2>Contact Us</h2>      
		</div>
	</div>
	
	<div class="row-fluid">
		<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3521.4867110862915!2d82.48436199999999!3d28.040160000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3997947b6ea52f51%3A0x1dd0a21566fc6f88!2sTHE+IIT+Pvt.Ltd.!5e0!3m2!1sen!2snp!4v1426612655535" width="400" height="300" frameborder="0" style="border:0"></iframe>
	</div>

	<br/>
	<div class="row-fluid">
		<div class="span8">
			<h4>Please leave us a message if you have any queries.</h4>
			<form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
				<div class="row-fluid">
					<div class="span5">
						<label>First Name</label>
						<input type="text" class="input-block-level" required="required" placeholder="Your First Name">
						<label>Last Name</label>
						<input type="text" class="input-block-level" required="required" placeholder="Your Last Name">
						<label>Email Address</label>
						<input type="text" class="input-block-level" required="required" placeholder="Your email address">
					</div>
					<div class="span7">
						<label>Message</label>
						<textarea name="message" id="message" required="required" class="input-block-level" rows="8"></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-large pull-right">Send Message</button>
			</form>
		</div>

		<?php $data_address=get_article_by_name(FOOTER_ADDRESS); ?>
		<div class="span3 contact-address">
			<h4>            
			Our <?php echo isset($data_address['row']['name'])?$data_address['row']['name']:''?>
			</h4>
			<?php echo isset($data_address['row']['content'])?$data_address['row']['content']:''?>
		</div>
	</div>
</section>