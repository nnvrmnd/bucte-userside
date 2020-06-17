<!-- Preloader -->
<div id="preloader">
	<div class="loader"></div>
</div>
<!-- /Preloader -->

<!-- Header Area Start -->
<header class="header-area">
	<!-- Search Form -->
	<div class="search-form d-flex align-items-center">
		<div class="container">
			<form action="./" method="get">
				<input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
				<button type="submit"><i class="icon_search"></i></button>
			</form>
		</div>
	</div>

	<!-- Top Header Area Start -->
	<div class="top-header-area">
		<div class="container">
			<div class="row">

				<div class="col-8">
					<div class="top-header-content">
						<a href="#"><i class="fa fa-facebook"></i> <span>BUCTE Official</span></a>
						<a href="#"><i class="icon_mail"></i> <span>bu-cte@bicol-u.edu.ph</span></a>
						<a href="#"><i class="icon_phone"></i> <span>Telefax: (052) 742-1909</span></a>
					</div>
				</div>

				<div class="col-6">
					<div class="top-header-content">
						<!-- Top Social Area -->
						<div class="top-social-area ml-auto">
							<a href="#">
								<i class="fa fa-facebook mr-1" aria-hidden="true"></i>
								<!-- <span>BUCTE Official</span> -->
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Top Header Area End -->

	<!-- Main Header Start -->
	<div class="main-header-area">
		<div class="classy-nav-container breakpoint-off">
			<div class="container">
				<!-- Classy Menu -->
				<nav class="classy-navbar justify-content-between" id="robertoNav">

					<!-- Logo -->
					<a class="nav-brand" href="./"><img src="./dist/img/core-img/cte.png" alt=""></a>

					<!-- Navbar Toggler -->
					<div class="classy-navbar-toggler">
						<span class="navbarToggler"><span></span><span></span><span></span></span>
					</div>

					<!-- Menu -->
					<div class="classy-menu">
						<!-- Menu Close Button -->
						<div class="classycloseIcon">
							<div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
						</div>
						<!-- Nav Start -->
						<div class="classynav">
							<ul id="nav">
								<li class="active"><a href="./">Home</a></li>
								<li><a href="./events.php">Events</a></li>
								<li><a href="#" class="default-pointer-here">Library</a>
									<ul class="dropdown">
										<li><a href="./reviewer.php">E-LET Reviewer</a></li>
										<li><a href="./library.php">Learning Resources</a></li>
									</ul>
								</li>
								<li><a href="./about.php">About Us</a></li>
								<li><a href="./gallery.php">Gallery</a></li>
								<li><a href="./contact.php">Contact</a></li>
								<li id="login_li">
									<a href="#" class="pointer-here" id="login">Login</a>
									<ul class="dropdown d-none">
										<li><a href="#">My profile</a></li>
										<li><a href="#" id="logout">Logout</a></li>
									</ul>
								</li>
							</ul>

							<!-- Search -->
							<div class="search-btn ml-4 d-none">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>

							<!-- Book Now -->
							<div class="book-now-btn ml-3 ml-lg-5 d-none">
								<a href="#">Book Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
							</div>
						</div>
						<!-- Nav End -->
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>
<!-- Header Area End -->

<?php
   $user_rn = (isset($_SESSION['user'])) ? $_SESSION['user'][0] : '';
?>
<input type="password" class="d-none" id="user_rn"
	value="<?=$user_rn?>">