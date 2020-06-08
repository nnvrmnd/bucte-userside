<?php
include './components/functions/Functions.php';
SeshStart('page');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Account | BUCTE</title>
    <?php include './components/layout/Head.php'; ?>
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
                        <h2 class="page-title">Create Account</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Account</li>
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

                <div class="col-12 col-lg-6 main-card">
                    <!-- Form -->
                    <div class="roberto-contact-form single-widget-area mb-100 box-shadow">
                        <form role="form" class="list-area" id="newprofile_form" novalidate>
                            <div class="row">
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_given" class="col-form-label">Given name:</label>
                                    <small class="create_given"></small>
                                    <input type="text" name="create_given" id="create_given"
                                        class="form-control mb-30 text-dark" placeholder="e.g. Juan Pedro">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_surname" class="col-form-label">Surname:</label>
                                    <small class="create_surname"></small>
                                    <input type="text" name="create_surname" id="create_surname"
                                        class="form-control mb-30 text-dark" placeholder="e.g. Cruz">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_username" class="col-form-label">Username:</label>
                                    <small class="create_username"></small>
                                    <input type="text" name="create_username" id="create_username"
                                        class="form-control mb-30 text-dark" placeholder="Username...">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_email" class="col-form-label">Email:</label>
                                    <small class="create_email"></small>
                                    <input type="email" name="create_email" id="create_email"
                                        class="form-control mb-30 text-dark" placeholder="Email address...">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_password" class="col-form-label">Password:</label>
                                    <small class="create_password"></small>
                                    <input type="password" name="create_password" id="create_password"
                                        class="form-control mb-30 text-dark" placeholder="Password...">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <label for="create_password2" class="col-form-label">Confirm Password:</label>
                                    <small class="create_password2"></small>
                                    <input type="password" name="create_password2" id="create_password2"
                                        class="form-control mb-30 text-dark" placeholder="Confirm password...">
                                </div>
                                <div class="col-12 col-lg-12 wow fadeInUp" data-wow-delay="100ms">
                                    <a href="./login.php" class="btn btn-link float-right" title="Already have an account?"
                                        style="font-size: 14px;">Login instead</a>
                                </div>

                                <div class="col-12 text-center wow fadeInUp" data-wow-delay="100ms">
                                    <button type="submit" class="btn btn-success w-100 mt-15">Create account</button>
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

    <!-- Footer Area Start -->
    <?php include './components/layout/Footer.php'; ?>

    <!-- **** All JS Files ***** -->
    <?php include './components/layout/Scripts.php'; ?>
    <script src="./assets/js/create-profile.js"></script>
</body>

</html>