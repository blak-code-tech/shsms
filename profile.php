<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/count_records.php');
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php')?>

    <header class="container mt-5 col-xxl-8 px-5 py-5">
        <h1 class="text-center text-muted" data-aos="zoom-in"
        data-aos-duration="500" style="font-size:50px;">Profile</h1>
        <hr class="container col-xxl-8">
    </header>

    <div class="container py-5">
        <div class="card profile-page">
            <div class="profile">
                <img src="assets/img/user.png" class="img-raised rounded-circle" alt="userImage">
            </div>
        </div>
    </div>

<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>
<?php
}else header("Location: index.php");?>