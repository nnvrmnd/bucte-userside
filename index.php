<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Home | BUCTE</title>
	<?php include './components/layout/Head.php'; ?>
	<style>
		.about-us-content p span {
			line-height: 1.8;
			color: #636a76;
			margin-bottom: 30px;
			font-weight: 400;
		}

		.upcoming-thumb {
			height: 220px;
			width: 100%;
			max-width: 350px;
			display: block;
			margin: auto;
		}

		.post-date {
			color: #1cc3b2 !important;
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
						<h2 class="page-title">Welcome to BUCTE</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb justify-content-center">
								<li class="breadcrumb-item active" aria-current="page">Bicol University Center for
									Teaching Exellence</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area End -->

	<!-- About Us Area Start -->
	<section class="roberto-about-area section-padding-80-0">
		<!-- Hotel Search Form Area -->
		<div class="hotel-search-form-area d-none">
			<div class="container-fluid">
				<div class="hotel-search-form">
					<div class="row justify-content-between align-items-end" id="SingleEvent">
						<!--Show Single Upcoming Event -->
					</div>
				</div>
			</div>
		</div>

		<div class="container mt-100">
			<div class="row align-items-center">
				<div class="col-12 col-lg-6">
					<!-- Section Heading -->
					<div class="section-heading wow fadeInUp" data-wow-delay="100ms">
						<h2 id="title"></h2>
					</div>
					<div class="about-us-content mb-100">
						<h5 class="wow fadeInUp" data-wow-delay="300ms" id="content"></h5>
						<!-- <img src="./dist/img/core-img/signature.png" alt="" class="wow fadeInUp" data-wow-delay="500ms" id="signature"> -->
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
						<div class="row no-gutters">
							<!-- <div class="col-6">
								<div class="single-thumb">
									<img id="image1" src="./dist/img/bg-img/bu2.jpg" alt="">
								</div>
								<div class="single-thumb">
									<img id="image2" src="./dist/img/bg-img/bu1.jpg" alt="">
								</div>
							</div> -->
							<div class="col-12">
								<div class="single-thumb">
									<img id="image1" alt="Display image">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About Us Area End -->

	<!-- Blog Area Start -->
	<section class="roberto-blog-area section-padding-100-0 upcoming-events">
		<div class="container">
			<div class="row">
				<!-- Section Heading -->
				<div class="col-12">
					<div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
						<!-- <h6>Recent Events</h6> -->
						<h2>Upcoming & Recent Events</h2>
					</div>
				</div>
			</div>

			<div class="row" id="upcoming">
				<!-- Single Post Area -->
				<div class="col">
					<center class="mb-5">
						<h4 class="text-muted"><i>Loading events...</i></h4>
					</center>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog Area End -->

	<!-- Footer Area Start -->
	<?php include './components/layout/Footer.php'; ?>

	<!-- **** All JS Files ***** -->
	<?php include './components/layout/Scripts.php'; ?>
	<script src="./assets/js/home.js" type="text/javascript"></script>
</body>

</html>