<?php require 'inc/header.php'; 
	// debugger($_SESSION);

?>

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="./">Home</a></li>
				<li class="active">Signin / Signup</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<?php echo flash(); ?>
	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-sm-8 col-md-8 ">
					<div style="border-right: 1px solid #000000; padding-right: 10px">
						<h4>Register</h4>
						<hr>
						<form action="register" method="post" class="form form-horizontal" onsubmit="return validatePassword()">
							<div class="form-group row">
								<label for="" class="col-sm-12">Full Name:</label>
								<div class="col-sm-12">
									<input type="text" name="full_name" required class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Email:</label>
								<div class="col-sm-12">
									<input type="email" name="email" required class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Password:</label>
								<div class="col-sm-12">
									<input type="password" name="password" id="password" required class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-12">Confirm Password:</label>
								<div class="col-sm-12">
									<input type="password" name="re_password" id="re_password" required class="form-control form-control-sm">
									<span class="alert-danger hidden" id="password_error"></span>
								</div>
							</div>
							
							<div class="form-group row">
								<label for="" class="col-sm-12">Phone Number:</label>
								<div class="col-sm-12">
									<input type="tel" name="phone_number" required class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Gender:</label>
								<div class="col-sm-12">
									<input type="radio" value="male" name="gender">Male
									<input type="radio" value="female" name="gender">Female
									<input type="radio" value="other" name="gender">Other
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Age:</label>
								<div class="col-sm-12">
									<input type="number" name="age" min="1" max="115" required class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Billing Address:</label>
								<div class="col-sm-12">
									<textarea name="billing_address" id="billing_address" rows="5" style="resize: none;" class="form-control form-control-sm"></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Shipping Address:</label>
								<div class="col-sm-12">
									<textarea name="shipping_address" id="shipping_address" rows="5" style="resize: none;" class="form-control form-control-sm"></textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12"></label>
								<div class="col-sm-12">
									<button class="btn btn-danger" type="reset">
										<i class="fa fa-trash"></i> Cancel
									</button>
									<button class="btn btn-success" id="submit" type="submit">
										<i class="fa fa-send"></i> Submit
									</button>
								</div>
							</div>


							

						</form>
					</div>
				</div>
				<div class="col-sm-4 col-md-4">
					<h4>Login</h4>
					<!-- <?php flash(); ?> -->
					<hr>
					<form action="customerlogin" method="post" class="form form-horizontal">
					<div class="form-group row">
								<label for="" class="col-sm-12">Email:</label>
								<div class="col-sm-12">
									<input type="email" name="username" required class="form-control form-control-sm">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-12">Password:</label>
								<div class="col-sm-12">
									<input type="password" name="password" id="password" required class="form-control form-control-sm">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-12"></label>
								<div class="col-sm-12">
									<button class="btn btn-success" id="submit" type="submit">
										<i class="fa fa-send"></i> Login
									</button>
									<button class="btn btn-danger" type="reset">
										<i class="fa fa-trash"></i> Cancel
									</button>
									
								</div>
							</div>
							</form>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
<?php require 'inc/footer.php'; ?>

<script>
	function validatePassword(){
		var pass = $('#password').val();
		var confirm_pass = $('#re_password').val();
		if(pass != confirm_pass){
			$('#submit').attr('disabled','disabled');
			$('#password_error').html('Confirm password does not match.');
			$('#password_error').removeClass('hidden');
			return false;
		} else {
			$('#submit').removeAttr('disabled','disabled');
			$('#password_error').html('');
			$('#password_error').addClass('hidden');
			return true;
		}
	}


	$('#re_password').keyup(function(){
		validatePassword();
	});
</script>