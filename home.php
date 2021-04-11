<?php
require('config/config.php');
require('config/db.php');
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php')?>

<header class="container mt-5 col-xxl-8 px-5 py-5">
    <h1 class="text-center text-muted" data-aos="zoom-in"
     data-aos-duration="500" style="font-size:50px;">Dashboard</h1>
    <hr class="container col-xxl-8">
</header>

<div class="container col-xxl-8 px-4 py-5">
  <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
      <img src="assets/img/big_image_1.jpg" data-aos="zoom-in-up" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
    </div>
    <div class="col-lg-6">
      <h1 class="display-5 fw-bold lh-1 mb-3" data-aos="fade-up"
     data-aos-duration="500">Welcome to Edukate.</h1>
      <p class="lead" data-aos="fade-up" data-aos-delay="200">Edukate aims to promote good 'Edukation'. By bridging the gap between rich and poor to support a common goal -  Growing the African Human resource - 
            Leadership -  Building capacity for young and vibrant African leaders
            Innovation -  Creating avenue for prototyping and innovation through teamwork.</p>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2" data-aos-delay="400" data-aos="zoom-in">View Courses</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-aos-delay="500" data-aos="zoom-out">Read more..</button>
      </div>
    </div>
  </div>
</div>


<section class="container-fluid col-xxl-8 px-5 py-3">
    <div class="card-group">
        <div class="card mb-4 mx-2 rounded-3 shadow-sm">
            
            <div class="card-body">
            <div class="card-title pb-2">
                <h5>Recently Fees Collection</p>
                <p class="text-muted lead" style="font-size:18px;">Fees collection by date</p>
            </div>
                <div class="table-responsize">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="lead">ID</th>
                                <th class="lead">Name</th>
                                <th class="lead">Amount</th>
                                <th class="lead">Balance</th>
                            </tr>
                        </thead>

                        <tbody style="font-size: 15px;">
    
                                <?php
                                    ob_start();
                                
                                    $num = 0;


                                    $query = "SELECT * FROM events where Customer_ID = '{$_SESSION['id']}'";

                                    $check = mysqli_query($conn, $query);

                                    if (!$check) {
                                        die('Query failed'.mysqli_error());
                                    }else {

                                        if ($check-> num_rows > 0){
                                            # code...

                                            ?>
                                            <?php while ($row = mysqli_fetch_assoc($check)): 

                                                $_SESSION['EID'] = $row['ID'];

                                                ?>

                                            <tr class="p-1">
                                                
                                                    <td class="p-2"><?php echo $row["EventID"];?></td>
                                                    <td class="p-2"><?php echo $row["Event"];?></td>
                                                    <td class="p-2"><?php echo $row["Date"];?></td>
                                                    <td class="p-2"><?php echo $row["Time"];?></td>  
                                                    <td class="p-2">
                                                        <div class="col pt-2">
                                                            <div class="btn-group btn-group-md" role="group">
                                                                <a href="update_form.php?edit=<?php echo $row["ID"];?>"class="btn btn-info btn-md" style="margin: 5px">Edit</a>
                                                                <a href="listEvents.php?delete_customer_event=<?php echo $row["ID"];?>"style="margin: 5px"class="btn btn-danger btn-md" >Delete</a>
                                                            
                                                            </div>
                                                        </div>

                                                    </td>
                                            </tr>

                                                    <?php $num += 1;?>
                                            <?php endwhile ?>
                                            <?php
                                            echo '<caption>Number of events: <span class="badge badge-success">'.$num.'</span></caption>';

                                        }else{
                                            echo '<div class="alert alert-info">No Records to Show</div>';
                                        }
                                    }

                                    require 'deleteUpdate.php';

                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>