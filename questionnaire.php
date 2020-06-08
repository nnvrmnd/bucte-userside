<?php
include './components/functions/Functions.php';
SeshStart('restricted');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>E-LET Questionnaire | BUCTE</title>
    <?php include './components/layout/Head.php'; ?>
    <link rel="stylesheet" href="./assets/css/radio-buttons.css">

    <style>
        .questionnaire-timer {
            text-alight: left !important;
        }
    </style>
</head>

<body>
    <!-- Preloader & Header (Topnav) -->
    <?php include './components/layout/Topnav.php'; ?>

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(./dist/img/bg-img/bu-dim.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">E-LET Questionnaire</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="./reviewer.php">Reviewer</a></li>
                                <li class="breadcrumb-item"><a href="./reviewer-list.php">List</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Questionnaire</li>
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
                        <div class="col-6 col-md-2 col-lg-3 mb-4">
                            <label for="checkIn" class="text-primary">TIMER</label>
                            <h1 class="font-weight-bold countdown_timer">00:00:00</h1>
                        </div>
                        <div class="col-6 col-md-2 col-lg-3"></div>
                        <div class="col-4 col-md-1"></div>
                        <div class="col-4 col-md-1"></div>
                        <div class="col-4 col-md-2 col-lg-1"></div>
                        <div class="col-12 col-md-3">
                            <button type="submit" class="form-control btn btn-success w-100 font-weight-bold"
                                id="submit_btn">S&nbsp;U&nbsp;B&nbsp;M&nbsp;I&nbsp;T</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Area End -->

    <!-- Blog Area Start -->
    <div class="roberto-news-area section-padding-80-0 mb-80 itms sensored">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12 col-lg-8">
                    <form role="form" class="items-container" id="test_form">
                        <input type="password" class="d-none" name="testee">
                        <input type="text" class="d-none" name="reviewer">
                    </form>

                    <!-- <div class="single-widget-area mb-100 box-shadow">
                        <div class="list-area">
                            <h5 class="mb-40">Select Level:</h5>
                            <p class="d-none">Subscribe our newsletter gor get notification new updates.</p>

                        </div>
                    </div> -->
                </div>

                <div class="col-12 col-sm-8 col-md-12 col-lg-3"></div>
            </div>
        </div>
    </div>
    <!-- Blog Area End -->

    <!-- Modal -->
    <div class="modal fade" id="CueModal" tabindex="-1" role="dialog" aria-labelledby="CueModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="CueModalLabel">READ ME!</h5>
                </div>
                <div class="modal-body">
                    <p class="mx-5 mb-0 text-dark"><b>You have <span id="Ns">N</span> to finish the test.</b><br>Once
                        you
                        <u>Begin The Test</u> the <u>Timer</u> will begin counting down. Click submit when you're
                        done.<br>Do
                        not exit or reload this page or you'll lose all of your progress and would have to start
                        over.<br>When
                        the time is up, your answers will be automatically submitted and checked.<br>You should have
                        your
                        results immediately.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn roberto-btn bg-white text-dark"
                        onClick="history.back()">Cancel</button>
                    <button type="button" class="btn roberto-btn bg-warning text-dark" data-dismiss="modal"
                        id="begin_btn">Begin the test</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Footer Area Start -->
    <?php include './components/layout/Footer.php'; ?>

    <!-- **** All JS Files ***** -->
    <?php include './components/layout/Scripts.php'; ?>
    <script src="./assets/js/questionnaire.js"></script>
</body>

</html>