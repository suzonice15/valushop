<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Registration Page</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="#">School Management </a>
	</div>

	<div class="register-box-body " >
		<p class="login-box-msg">Register a new membership</p>
		<?php $messeage=$this->session->userdata('message');
		if(isset($messeage)){

			$this->session->unset_userdata('message');

		?>
		<p class="text-success"><?php echo $messeage;?></p>

		<?php } ?>

		<?php $error=$this->session->userdata('error');
		if(isset($error)){

			$this->session->unset_userdata('error');

			?>
			<p class="text-danger"><?php echo $error;?></p>

		<?php } ?>
		<form action="<?php echo base_url()?>registration-save" method="post">
			<div class="form-group has-feedback">
				<input name="user_name" id="name"   type="text"  class="form-control regitration" placeholder="Full name">
				<?php echo form_error('user_name', '<span style="color:red">', '</span>'); ?>

				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input name="user_email" id="email"  type="email"  class="form-control regitration" placeholder="Email">
				<?php echo form_error('user_email', '<span style="color:red">', '</span>'); ?>

				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input name="user_password"  id="password"    type="password" class="form-control regitration" placeholder="Password">
				<?php echo form_error('user_password', '<span style="color:red">', '</span>'); ?>

				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" id ="cpassword"  name ="cpassword"  class="form-control regitration" placeholder="Retype password">
				<?php echo form_error('cpassword', '<span style="color:red">', '</span>'); ?>
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<input type="checkbox" id="checkRegister"> I agree to the <a href="#">terms</a>
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button id="Register" type="submit"  class="btn btn-primary btn-block btn-flat">Register</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

		<div class="social-auth-links text-center">
			<a href="<?php echo base_url()?>admin" class="text-center">I already have a membership</a>
		</div>


	</div>
	<!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
		$(".regitration").blur(function () {
			var name=$("#name").val();
			if(name.length==0)
			{
				$("#nameError").text("This field is mandatory");
			}
			else{
				$("#nameError").text("");
			}
		});


		$("#checkRegister").click(function () {
				$("#Register]").prop('disabled', true);

		});
	});
</script>
</body>
</html>
