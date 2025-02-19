<?php
session_start();
include_once './config/Database.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$table = 'admin';

// check if POST vars are set
if (isset($_POST['uname']) && isset($_POST['password'])) {
	$username = $_POST['uname'];
	$password = $_POST['password'];

	$query = 'SELECT * FROM ' . $table .
		' WHERE username = :name';

	$stmt = $db->prepare($query);
	$stmt->bindParam(':name', $username);
	$stmt->execute();
	$num = $stmt->rowCount();

	if ($num > 0) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (password_verify($password, $row['password'])) {
			// creds is valid, then redirect to homepage
			$_SESSION['loggedIn'] = true;
			$_SESSION['username'] = $username;
			redirectTo('./homepage.php');
		} else {
			// prompt them its incorrect
			echo '<script>alert("Incorrect password.")</script>';
		}
	} else {
		echo '<script>alert("Username does not exists.")</script>';
	}
}

function redirectTo($url)
{
	ob_start();
	header('Location: ' . $url);
	ob_end_flush();
	die();
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
			<a href="/" class="logo pull-left">
				<!-- <img src="assets/images/logo.png" height="54" alt="Porto Admin" /> -->
			</a>

			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Log In</h2>
				</div>
				<div class="panel-body">
					<form action="./index.php" method="post">
						<div class="form-group mb-lg">
							<label>Username</label>
							<div class="input-group input-group-icon">
								<input id="uname" name="uname" type="text" class="form-control input-lg" required />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<div class="clearfix">
								<label class="pull-left">Password</label>
								<!-- <a href="pages-recover-password.html" class="pull-right">Lost Password?</a> -->
							</div>
							<div class="input-group input-group-icon">
								<input id="password" name="password" type="password" class="form-control input-lg" required />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<!-- <div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div> -->
							<!-- <div class="col-sm-4 text-right"> -->
							<div class="col-sm-12 text-right">
								<button type="submit" class="btn btn-primary hidden-xs">Log In</button>
								<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Log In</button>
							</div>
						</div>

						<!-- <p class="text-center">Don't have an account yet? <a href="register.php">Register!</a> -->

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

</body><img src="http://www.ten28.com/fref.jpg">

</html>