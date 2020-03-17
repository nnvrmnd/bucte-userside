<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>About Us | BUCTE</title>
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
                        <h2 class="page-title">About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
                            <h5 class="mb-40">Vision, Mission, and Objectives:</h5>
                            <p class="d-none">Subscribe our newsletter gor get notification new updates.</p>
                            <div style="margin-left: 4%">
                                <p class="mt-30">
                                    <b>
                                        <i class="fa fa-eye fa-lg"></i> VISION:
                                    </b>
                                </p>
                                <p>A Center for Teaching Excellence that promotes innovative instructional practices.</p>

                                <p class="mt-30">
                                    <b>
                                        <i class="fa fa-bullseye fa-lg"></i> MISSION:
                                    </b>
                                </p>
                                <p>The Center seeks to advance responsive, research-based, technology-enhanced, and outcomes-based teaching and learning practices.</p>

                                <p class="mt-30">
                                    <b>
                                        <i class="fa fa-map-pin fa-lg"></i> OBJECTIVES:
                                    </b>
                                </p>
                                <ul>
                                    <li>
                                        <p>Offer quality professional development programs/projects and services to
                                            Bicol University faculty as well as to educators and teachers in the Bicol
                                            Region.</p>
                                    </li>
                                    <li>
                                        <p>Conduct and/or assist in the conduct of researches or initiatives which aim
                                            to inform, improve and innovate the teaching and learning practices.</p>
                                    </li>
                                    <li>
                                        <p>Provide alternative academic support to students across levels and
                                            disciplines, and to students in Teacher Education Programs both in the
                                            undergraduate and graduate levels along research and instructional practices
                                            in collaboration with the Graduate School and the College of Education.</p>
                                    </li>
                                    <li>
                                        <p>
                                            Work collaboratively with the relevant centers and offices in the University
                                            in offering blended learning programs to both faculty and Teacher Education
                                            students.
                                        </p>
                                    </li>
                                    <li>
                                        <p>Engage in partnership with colleges or units of the University in order to
                                            establish faculty learning communities to strengthen sharing of good
                                            practices.</p>
                                    </li>
                                    <li>
                                        <p>Establish a regional consortium which will focus on the integration of
                                            research and academic practices.</p>
                                    </li>
                                    <li>
                                        <p>Promote excellence in teaching through scholarly undertakings in Bicol
                                            University and beyond through trainings, seminars or conferences.</p>
                                    </li>
                                </ul>
                            </div>
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
    <script src="./assets/js/reviewer.js"></script>
</body>

</html>