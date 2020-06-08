<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Events | BUCTE</title>
	<?php include './components/layout/Head.php'; ?>
	<style>
		#events img {
			height: 150px;
			width: 100%;
			max-width: 300px;
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
						<h2 class="page-title">Events</h2>
						<!-- <nav aria-label="breadcrumb">
							<ol class="breadcrumb justify-content-center">
								<li class="breadcrumb-item"><a href="./index.php">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Events</li>
							</ol>
						</nav> -->
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
				<div class="col-12 col-lg-8">
					<!-- Single Blog Post Area -->
					<div id="events"></div>
					<!-- Pagination -->
					<nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="600ms">
						<ul class="pagination" style="display: flex; flex-wrap: wrap; justify-content: end;">
							<li class="page-item" id="nextNumber" style="margin: 1px"><a class="page-link" href="#">Next
									<i class="fa fa-angle-right"></i></a></li>
						</ul>
					</nav>
				</div>

				<!-- Right bar -->
				<?php include './components/layout/Rightbar.php';?>
			</div>
		</div>
	</div>
	<!-- Blog Area End -->

	<!-- Call To Action Area Start -->
	<section class="roberto-cta-area d-none">
		<div class="container">
			<div class="cta-content bg-img bg-overlay jarallax" style="background-image: url(./dist/img/bg-img/1.jpg);">
				<div class="row align-items-center">
					<div class="col-12 col-md-7">
						<div class="cta-text mb-50">
							<h2>Contact us now!</h2>
							<h6>Contact (+12) 345-678-9999 to book directly or for advice</h6>
						</div>
					</div>
					<div class="col-12 col-md-5 text-right">
						<a href="#" class="btn roberto-btn mb-50">Contact Now</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Call To Action Area End -->

	<!-- Partner Area Start -->
	<div class="partner-area d-none">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="partner-logo-content d-flex align-items-center justify-content-between wow fadeInUp"
						data-wow-delay="300ms">
						<!-- Single Partner Logo -->
						<a href="#" class="partner-logo"><img src="./dist/img/core-img/p1.png" alt=""></a>
						<!-- Single Partner Logo -->
						<a href="#" class="partner-logo"><img src="./dist/img/core-img/p2.png" alt=""></a>
						<!-- Single Partner Logo -->
						<a href="#" class="partner-logo"><img src="./dist/img/core-img/p3.png" alt=""></a>
						<!-- Single Partner Logo -->
						<a href="#" class="partner-logo"><img src="./dist/img/core-img/p4.png" alt=""></a>
						<!-- Single Partner Logo -->
						<a href="#" class="partner-logo"><img src="./dist/img/core-img/p5.png" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Partner Area End -->

	<!-- Footer Area Start -->
	<?php include './components/layout/Footer.php'; ?>

	<!-- **** All JS Files ***** -->
	<?php include './components/layout/Scripts.php'; ?>
	<script src="./assets/js/events.js" type="text/javascript"></script>

</body>

</html>