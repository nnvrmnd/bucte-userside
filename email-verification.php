<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blank Page | BUCTE</title>
	<?php include './components/layout/Head.php'; ?>
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
						<h2 class="page-title">Blog Left Sidebar</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb justify-content-center">
								<li class="breadcrumb-item"><a href="./">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Blog Left Sidebar</li>
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
				<div class="col-12 col-lg-8 ">
					<!-- MAIN CONTENT HERE -->
					<div class="single-widget-area mb-100 box-shadow">
						<div class="list-area">
							<h1 class="mb-40">Your email has been successfu</h1>
							<p class="d-none">Subscribe our newsletter gor get notification new updates.</p>
							<ul style="margin-left: 4%">
								<li class="pointer-here level" data-target="gen">
									<i class="fa fa-arrow-right mr-1"></i>
									<span class="text-primary">General Education</span>
								</li>
								<li class="pointer-here level" data-target="prof">
									<i class="fa fa-arrow-right mr-1"></i>
									<span class="text-primary">Professional Education</span>
								</li>

								<p class="mt-30"><b>Specialization:</b></p>
								<ul>
									<li class="pointer-here level" data-target="eng">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">English Education</span>
									</li>
									<li class="pointer-here level" data-target="fil">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Filipino Education</span>
									</li>
									<li class="pointer-here level" data-target="bio">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Biological Sciences</span>
									</li>
									<li class="pointer-here level" data-target="phys">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Physical Sciences</span>
									</li>
									<li class="pointer-here level" data-target="math">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Mathematics</span>
									</li>
									<li class="pointer-here level" data-target="socsci">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Social Studies/Sciences</span>
									</li>
									<li class="pointer-here level" data-target="values">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Values Education</span>
									</li>
									<li class="pointer-here level" data-target="mapeh">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">MAPEH</span>
									</li>
									<li class="pointer-here level" data-target="agri">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Agriculture and Fishery Arts</span>
									</li>
									<li class="pointer-here level" data-target="tech">
										<i class="fa fa-arrow-right mr-1"></i>
										<span class="text-primary">Technology and Livelihood Education</span>
									</li>
								</ul>
							</ul>
						</div>
					</div>
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
</body>

</html>