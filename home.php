<?php
require('config/config.php');
require('config/db.php');
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php')?>

<header class="container mt-5 pt-5 col-8">
    <h1 class="text-center text-muted" data-aos="zoom-in" data-aos-duration="500" style="font-size:50px;">Home</h1>
    <hr class="container col-xxl-8">
</header>
<main>
    <div id="myCarousel" class="carousel carousel-fade slide col-xxl-8 px-4 pt-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/2.jpg" alt="img1">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Students Championship</h1>
                        <p>Be a winner of a laptop to aid in your studies. READY??</p>
                        <button class="btn btn-primary">JOIN NOW !!</button>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg>

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Some representative placeholder content for the second slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg>

                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>One more for good measure.</h1>
                        <p>Some representative placeholder content for the third slide of this carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container col-xxl-8 px-4 pt-3">
        <hr>
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/carousel1.jpg" data-aos="zoom-in-up" class="d-block mx-lg-auto img-fluid"
                    width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3" data-aos="fade-up" data-aos-duration="500">Welcome to Edukate.
                </h1>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Edukate aims to promote good 'Edukation'. By
                    bridging the gap between rich and poor to support a common goal - Growing the African Human resource
                    -
                    Leadership - Building capacity for young and vibrant African leaders
                    Innovation - Creating avenue for prototyping and innovation through teamwork.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-outline-primary btn-mdi px-4" data-aos-delay="500"
                        data-aos="zoom-out">Read more..</button>
                </div>
            </div>
        </div>

        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/carousel1.jpg" data-aos="zoom-in-up" class="d-block mx-lg-auto img-fluid"
                    width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3" data-aos="fade-up" data-aos-duration="500">Welcome to Edukate.
                </h1>
                <p class="lead" data-aos="fade-up" data-aos-delay="200">Edukate aims to promote good 'Edukation'. By
                    bridging the gap between rich and poor to support a common goal - Growing the African Human resource
                    -
                    Leadership - Building capacity for young and vibrant African leaders
                    Innovation - Creating avenue for prototyping and innovation through teamwork.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-outline-primary btn-mdi px-4" data-aos-delay="500"
                        data-aos="zoom-out">Read more..</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>