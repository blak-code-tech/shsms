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
    <h1 class="text-center text-muted" data-aos="zoom-in" data-aos-duration="500" style="font-size:50px;">Dashboard</h1>
    <hr class="container col-xxl-8">
</header>

<section id="dashboad-items" class="container-fluid px-5 py-3">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-user fa-3x text-warning"></i>
                        <div class="card-info">
                            <p class="lead">Students</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("students"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>students.php">View <i
                            class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500"
                data-aos-delay="250">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-book fa-3x text-secondary"></i>
                        <div class="card-info">
                            <p class="lead">Subjects</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("subjects"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>subjects.php">View <i
                            class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500"
                data-aos-delay="350">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-credit-card fa-3x text-success"></i>
                        <div class="card-info">
                            <p class="lead">Banks</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("banks"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>banks.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500"
                data-aos-delay="450">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-graduation-cap fa-3x text-info"></i>
                        <div class="card-info">
                            <p class="lead">Staff</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("staff"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>staff.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="550">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-money fa-3x text-warning"></i>
                        <div class="card-info">
                            <p class="lead">Fees Collection</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("feescollection"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>feescollection.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="650">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-flask fa-3x text-secondary"></i>
                        <div class="card-info">
                            <p class="lead">Classes</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("classes"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>classes.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="750">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-home fa-3x text-success"></i>
                        <div class="card-info">
                            <p class="lead">Hostels</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("hostels"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>hostels.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="850">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-flag fa-3x text-info"></i>
                        <div class="card-info">
                            <p class="lead">Events</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("events"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>events.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="250">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-clipboard fa-3x text-warning"></i>
                        <div class="card-info">
                            <p class="lead">Notices</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("notices"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>notices.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="350">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-users fa-3x text-secondary"></i>
                        <div class="card-info">
                            <p class="lead">Parents</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("parents"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>parents.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="450">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-sort-amount-asc fa-3x text-success"></i>
                        <div class="card-info">
                            <p class="lead">Fees Structure</p>
                            <h5 class="d-flex flex-row-reverse">7</5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right">View <i class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>

        <div class="col">
            <div class="card rounded-3 shadow" data-aos="fade-up" data-aos-duration="500" data-aos-delay="550">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-pencil fa-3x text-info"></i>
                        <div class="card-info">
                            <p class="lead">Exams Results</p>
                            <h5 class="d-flex flex-row-reverse"><?php countrecords("exams"); ?></5>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-block hvr-bounce-to-right" href="<?php echo ROOT_URL;?>examresults.php">View <i
                            class="fa fa-angle-double-right"></i></a>

                </div>
            </div>
        </div>
    </div>

</section>

<!--
<section class="container-fluid px-5 py-3">
    <div class="card-group">
        <div class="card mb-4 mt-3 mx-2 rounded-3 shadow">

            <div class="card-body">
                <div class="card-title pb-2">
                    <h5 data-aos="zoom-in-up" data-aos-duration="500">Recently Fees Collection</p>
                        <p class="text-muted lead" style="font-size:18px;">Fees collection by date</p>
                </div>
                <div class="table-responsize">
                    <table class="table">
                        <thead data-aos="fade-up" data-aos-duration="500">
                            <tr>
                                <th class="lead">ID</th>
                                <th class="lead">Student</th>
                                <th class="lead">Amount</th>
                                <th class="lead">Date</th>
                                <th class="lead">Remarks</th>
                            </tr>
                        </thead>

                        <tbody style="font-size: 15px;" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200">

                            <?php
                                    ob_start();
                                
                                    $num = 0;


                                    $query = "SELECT * FROM feescollection";

                                    $check = mysqli_query($conn, $query);

                                    if (!$check) {
                                        die('Query failed'.mysqli_error($conn));
                                    }else {

                                        if ($check-> num_rows > 0){
                                            # code...

                                            ?>
                            <?php while ($row = mysqli_fetch_assoc($check)):?>

                            <tr class="p-1">

                                <td><?php echo $row["ID"];?></td>
                                <td><?php echo $row["Student"];?></td>
                                <td><?php echo $row["PaidAmount"];?></td>
                                <td><?php echo $row["Date"];?></td>
                                <td><?php echo $row["Remarks"];?></td>

                            </tr>

                            <?php $num += 1;?>
                            <?php endwhile ?>
                            <caption>Number of students : <span class="badge bg-success"><?php echo $num ;?></span>
                            </caption>
                            <?php

                                        }else{
                                            echo '<div class="alert alert-info">No Records to Show</div>';
                                        }
                                    }

                                    /*require 'deleteUpdate.php';*/

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>-->

<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>
<?php
}else header("Location: index.php");?>