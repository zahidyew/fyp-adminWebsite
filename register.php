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
			<div class="panel panel-sign">
				<div class="panel-title-sign mt-xl text-right">
					<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Register</h2>
				</div>
				<div class="panel-body">
					<form>
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
									<input id="pwd_confirm" name="pwd_confirm" type="password" class="form-control input-lg" required />
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 text-right">
								<button id="register" type="button" class="btn btn-primary hidden-xs">Register</button>
								<button id="register2" type="button" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Register</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- end: page -->

	<script>
		const usernameElem = document.getElementById("uname");
		const emailElem = document.getElementById("email");
		const pwdElem = document.getElementById("password");
		const pwdConfirmElem = document.getElementById("pwd_confirm");
		const registerBtn = document.getElementById("register");
		const registerBtn2 = document.getElementById("register2");


		registerBtn.addEventListener("click", () => {
			postRequest();
		})

		registerBtn2.addEventListener("click", () => {
			postRequest();
		})

		function getFormValues() {
			const name = usernameElem.value;
			const email = emailElem.value;
			const pwd = pwdElem.value;
			const pwdConfirm = pwdConfirmElem.value;

			if (name === "" || email === "" || pwd === "" || pwdConfirm === "") {
				alert("Please complete the form first.");
				return false;
			} else {
				if (pwd != pwdConfirm) {
					alert("Passwords do not match.\nPlease try again.");
					return false;
				} else {
					const formData = {
						username: name,
						email: email,
						password: pwd
					};
					return formData;
				}
			}
		}

		function postRequest() {
			const formData = getFormValues();

			if (formData === false) {

			} else {
				//console.log(formData);
				fetch('./signUp.php', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
						},
						body: JSON.stringify(formData)
					})
					.then((response) => response.json())
					.then((data) => {
						//console.log('Success:', data);
						window.location = "./index.php";
					})
					.catch((error) => {
						console.error('Error:', error);
					});
			}
		}
	</script>

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