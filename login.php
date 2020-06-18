<?php
include './components/functions/Functions.php';
SeshStart('login');

$val0 = ''; $val1 = ''; $val2 = '';
if (isset($_GET['email']) && isset($_GET['exp']) && isset($_GET['sig'])) {
	$val0 = $_GET['email'];
	$val1 = $_GET['exp'];
	$val2 = $_GET['sig'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | BUCTE</title>
	<?php include './components/layout/Head.php'; ?>

	<style>
		.alert {
			border-radius: 2px !important;
		}
	</style>
</head>

<body>
	<!-- Preloader & Header (Topnav) -->
	<?php include './components/layout/Topnav.php'; ?>

	<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area bg-img bg-overlay jarallax"
		style="background-image: url(./dist/img/bg-img/bu-dim.jpg);">
		<div class="container h-100">
			<div class="row h-100 align-items-center">
				<div class="col-12">
					<div class="breadcrumb-content text-center">
						<h2 class="page-title">Login</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb justify-content-center">
								<li class="breadcrumb-item"><a href="./">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Login Page</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area End -->

	<!-- Blog Area Start -->
	<div class="roberto-news-area section-padding-100-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-1"></div>

				<div class="col-12 col-lg-6">
					<!-- Form -->
					<div class="roberto-contact-form single-widget-area mb-100 box-shadow">
						<form role="form" class="list-area" id="loginpage_form" novalidate>
							<div class="row">
								<div class="col-12 col-lg-12 login-header d-non">
									<center><span class="text-danger msg login-msg"></span></center>
								</div>
								<div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
									<label for="loginpage_user" class="col-form-label">Username/Email:</label>
									<small class="loginpage_user"></small>
									<input type="email" name="loginpage_user" id="loginpage_user"
										class="form-control mb-30 text-dark" placeholder="">
								</div>
								<div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
									<label for="loginpage_pass" class="col-form-label">Password:</label>
									<small class="loginpage_pass"></small>
									<input type="password" name="loginpage_pass" id="loginpage_pass"
										class="form-control mb-30 text-dark" placeholder="">
								</div>
								<div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
									<a href="./create-profile.php" class="btn btn-link float-right"
										title="New at BUCTE?" style="font-size: 14px;">Create an account</a>
								</div>

								<div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
									<button type="submit" class="btn roberto-btn w-100 mt-15">Login</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-12 col-lg-1"></div>

				<!-- Right bar -->
				<?php include './components/layout/Rightbar.php';?>
			</div>
		</div>
	</div>
	<!-- Blog Area End -->

	<!-- Modals -->
	<!-- EVF MODAL -->
	<div class="modal fade" id="EVFailedModal" tabindex="-1" role="dialog" aria-labelledby="EVFailedModalLabel"
		aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="background-color: #e8f1f8;">
				<div class="modal-header">
					<h5 class="modal-title" id="EVFailedModalLabel">Email Verification</h5>
				</div>
				<form class="roberto-contact-form" id="rev_form">
					<div class="modal-body">
						<div class="alert-msg"></div>
						<div class="form-group">
							<p>Enter the email address associated with your account and we'll send you a link to verify
								your email.</p>
						</div>
						<!-- <center><span class="text-danger evf-msg"></span></center> -->
						<div class="form-group">
							<input type="text" class="form-control text-dark" placeholder="Registered email"
								name="rev_email">
							<small class="rev_email"></small>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn roberto-btn px-5">Resend verification email</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Modals -->


	<!-- Footer Area Start -->
	<?php include './components/layout/Footer.php'; ?>

	<!-- **** All JS Files ***** -->
	<?php include './components/layout/Scripts.php'; ?>
	<script src="./assets/js/email-verification.js"></script>
</body>

</html>