<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | BUCTE</title>
    <?php include './components/layout/Head.php'; ?>
</head>

<body>
    <!-- Preloader & Header (Topnav) -->
    <?php include './components/layout/Topnav.php'; ?>

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(./dist/img/bg-img/17.jpg);">
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
        <div class="hotel-search-form-area">
            <div class="container-fluid">
                <div class="hotel-search-form">
                    <div class="row justify-content-between align-items-end">
                        <div class="col-12 col-md-12 col-lg-6 mb-4">
                            <div class="single-recent-post d-flex">
                                <!-- Thumb -->
                                <div class="post-thumb">
                                    <a href="#"><img src="./dist/img/core-img/e.png" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <!-- Post Meta -->
                                    <div class="post-meta">
                                        <a href="#" class="post-author">Date of Event</a>
                                        <a href="#" class="post-tutorial">Venue of Event</a>
                                    </div>
                                    <!-- Post Title -->
                                    <a href="#" class="post-title">TITLE OF EVENT</a>
                                    <a href="#" class="btn continue-btn" data-toggle="modal" data-target="#details">Read
                                        details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <button type="submit" class="form-control btn roberto-btn w-100 font-weight-bold"
                                id="submit_btn">REGISTER</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-100">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <!-- Section Heading -->
                    <div class="section-heading wow fadeInUp" data-wow-delay="100ms">
                        <h6>WELCOME TO</h6>
                        <h2>Bicol University<br>Center For Teaching Excellence</h2>
                    </div>
                    <div class="about-us-content mb-100">
                        <h5 class="wow fadeInUp" data-wow-delay="300ms">
                            Bicol University, as a premier university in the Bicol Region, aims to become a world-class
                            university. To attain this vision, it has to strengthen its foothold on scholarly and
                            academic engagements which include among others quality instruction. There is then a need to
                            continue building a critical mass of faculty who will exemplify practices that promote
                            quality instruction. The existing professional development and continuing education programs
                            for Bicol University faculty may be helping in the professional development of faculty;
                            however, there is a strong need to institutionalize policies, initiatives and programs on
                            the faculty’s professional advancement especially along delivery of instruction. This may be
                            made possible through the establishment of the Bicol University Center for Teaching
                            Excellence which aims primarily to promote a culture of excellence in teaching within the
                            University as well as in the region through responsive, innovative, and research-based
                            initiatives and undertakings.
                        </h5>
                        <p class="wow fadeInUp" data-wow-delay="400ms">Dept. Director: <span>R. Bercassio</span></p>
                        <img src="./dist/img/core-img/signature.png" alt="" class="wow fadeInUp" data-wow-delay="500ms">
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="about-us-thumbnail mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <div class="row no-gutters">
                            <div class="col-6">
                                <div class="single-thumb">
                                    <img src="./dist/img/bg-img/13.jpg" alt="">
                                </div>
                                <div class="single-thumb">
                                    <img src="./dist/img/bg-img/14.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="single-thumb">
                                    <img src="./dist/img/bg-img/15.jpg" alt="">
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
    <section class="roberto-blog-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Section Heading -->
                <div class="col-12">
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        <h6>Our Blog</h6>
                        <h2>Latest News &amp; Event</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <a href="#" class="post-thumbnail"><img src="./dist/img/bg-img/2.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Learn How To Motivate Yourself</a>
                        <p>How many free autoresponders have you tried? And how many emails did you get through using
                            them?</p>
                        <a href="#" class="btn continue-btn"><i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <a href="#" class="post-thumbnail"><img src="./dist/img/bg-img/3.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">What If Let You Run The Hubble</a>
                        <p>My point here is that if you have no clue for the answers above you probably are not
                            operating a followup.</p>
                        <a href="#" class="btn continue-btn"><i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

                <!-- Single Post Area -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post-area mb-100 wow fadeInUp" data-wow-delay="700ms">
                        <a href="#" class="post-thumbnail"><img src="./dist/img/bg-img/4.jpg" alt=""></a>
                        <!-- Post Meta -->
                        <div class="post-meta">
                            <a href="#" class="post-date">Jan 02, 2019</a>
                            <a href="#" class="post-catagory">Event</a>
                        </div>
                        <!-- Post Title -->
                        <a href="#" class="post-title">Six Pack Abs The Big Picture</a>
                        <p>Some good steps to take to ensure you are getting what you need out of a autoresponder
                            include…</p>
                        <a href="#" class="btn continue-btn"><i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Blog Area End -->

    <!-- Footer Area Start -->
    <?php include './components/layout/Footer.php'; ?>

    <!-- **** All JS Files ***** -->
    <?php include './components/layout/Scripts.php'; ?>
</body>

</html>