<style type="text/css">
	.fb_login{
		text-align: center;
		background: black;
		height: 500px;
	}
	.fb_login a{
		color: white;
		font-size: 30px;
	}
</style>
<div id="main">
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 fb_login">
		<a href="<?php echo base_url('test/fb_login');?>">Login with Facebook</a>
	</div>

	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<form id="signupForm" method="get" action="" novalidate="novalidate">
			<legend>Validating a complete form</legend>
			<div class="form-group">
				<label for="firstname">Firstname</label>
				<input class="form-control" id="firstname" name="firstname" type="text">
			</div>
			<div class="form-group">
				<label for="lastname">Lastname</label>
				<input class="form-control" id="lastname" name="lastname" type="text">
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input class="form-control" id="username" name="username" type="text">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input class="form-control" id="password" name="password" type="password">
			</div>
			<div class="form-group">
				<label for="confirm_password">Confirm password</label>
				<input class="form-control" id="confirm_password" name="confirm_password" type="password">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" id="email" name="email" type="email">
			</div>
			<div class="form-group">
				<label for="agree">Please agree to our policy</label>
				<input type="checkbox" class="checkbox" id="agree" name="agree">
			</div>
			<div class="form-group">
				<label for="newsletter">I'd like to receive the newsletter</label>
				<input type="checkbox" class="checkbox" id="newsletter" name="newsletter">
			</div>
			<div class="form-group">
				<fieldset id="newsletter_topics" class="gray">
					<p>Topics (select at least two) - note: would be hidden when newsletter isn't selected, but is visible here for the demo</p>
					<label for="topic_marketflash">
						<input  type="checkbox" id="topic_marketflash" value="marketflash" name="topic" disabled="disabled">Marketflash
					</label>
					<label for="topic_fuzz">
						<input  type="checkbox" id="topic_fuzz" value="fuzz" name="topic" disabled="disabled">Latest fuzz
					</label>
					<label for="topic_digester">
						<input  type="checkbox" id="topic_digester" value="digester" name="topic" disabled="disabled">Mailing list digester
					</label>
					<label for="topic" class="error">Please select at least two topics you'd like to receive.</label>
				</fieldset>
			</div>
			<input class="btn btn-info" type="submit" value="Submit">
		</form>
	</div>
</div>


<script type="text/javascript">
	$().ready(function() {

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				username: {
					required: true,
					minlength: 2
				},
				password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				agree: "Please accept our policy"
			}
		});

		// propose username by combining first- and lastname
		$("#username").focus(function() {
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			if (firstname && lastname && !this.value) {
				this.value = firstname + "." + lastname;
			}
		});

		//code to hide topic selection, disable for demo
		var newsletter = $("#newsletter");
		// newsletter topics are optional, hide at first
		var inital = newsletter.is(":checked");
		var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
		var topicInputs = topics.find("input").attr("disabled", !inital);
		// show when newsletter is checked
		newsletter.click(function() {
			topics[this.checked ? "removeClass" : "addClass"]("gray");
			topicInputs.attr("disabled", !this.checked);
		});
	});

</script>