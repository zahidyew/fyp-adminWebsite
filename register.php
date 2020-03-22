<?php
include_once './config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$table = 'admin';

// check if POST vars are set
if (isset($_POST['uname']) && isset($_POST['password'])) {
	$username = $_POST['uname'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	// TODO: add check for duplicate username. If exists in DB then inform, else proceed with insertion.

	// SQL query and execute
	$query = 'INSERT INTO ' . $table . ' SET 
								username = :name, 
								password = :pass, 
								email = :email';

	$stmt = $db->prepare($query);

	//hash the password
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	$stmt->bindParam(':name', $username);
	$stmt->bindParam(':pass', $hashedPassword);
	$stmt->bindParam(':email', $email);

	if ($stmt->execute()) {
		echo '<script>alert("Success.");</script>';
		/* echo '<div id="modalHeaderColorSuccess" class="modal-block modal-header-color modal-block-success mfp-hide">';
			echo '<section class="panel">';
				echo '<header class="panel-heading">';
					echo '<h2 class="panel-title">Success!</h2>';
				echo '</header>';
				echo '<div class="panel-body">';
					echo '<div class="modal-wrapper">';
						echo '<div class="modal-icon">';
							echo '<i class="fa fa-check"></i>';
						echo '</div>';
						echo '<div class="modal-text">';
							echo '<h4>Success</h4>';
							echo '<p>This is a successfull message.</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<footer class="panel-footer">';
					echo '<div class="row">';
						echo '<div class="col-md-12 text-right">';
							echo '<button class="btn btn-success modal-dismiss">OK</button>';
						echo '</div>';
					echo '</div>';
				echo '</footer>';
			echo '</section>';
		echo '</div>'; */
	} else {
		printf("Error: %s.\n", $stmt->error);
		//return false;
	}
}
?>

<!doctype html>
<html class="fixed">

<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">

</head>

<body>
	<!-- start: page -->
	<section class="body-sign">
		<div class="center-sign">
			<!-- <a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a> -->

			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Register</h2>
				</div>
				<div class="panel-body">
					<form action="./register.php" method="post">
						<div class="form-group mb-lg">
							<label>Username</label>
							<input id="uname" name="uname" type="text" class="form-control input-lg" required />
						</div>

						<div class="form-group mb-lg">
							<label>E-mail</label>
							<input id="email" name="email" type="email" class="form-control input-lg" required />
						</div>

						<div class="form-group mb-none">
							<div class="row">
								<div class="col-sm-6 mb-lg">
									<label>Password</label>
									<input id="password" name="password" type="password" class="form-control input-lg" required />
								</div>
								<div class="col-sm-6 mb-lg">
									<label>Password Confirmation</label>
									<input name="pwd_confirm" type="password" class="form-control input-lg" required />
								</div>
							</div>
						</div>

						<div class="row">
							<!-- <div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="AgreeTerms" name="agreeterms" type="checkbox"/>
										<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
									</div>
								</div> -->
							<div class="col-sm-12 text-right">
								<button type="submit" class="btn btn-primary hidden-xs">Register</button>
								<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Register</button>
							</div>
						</div>

						<p class="text-center"><a href="index.php">Log in</a>

					</form>
				</div>
			</div>

			<!-- <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p> -->
		</div>
	</section>
	<!-- end: page -->

	<!-- Vendor -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>

	<!-- Modals 
	<script src="assets/javascripts/ui-elements/examples.modals.js"></script>-->
</body>

</html>