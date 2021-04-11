<?php
    require('config/config.php');
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != 0) {
            $query = ("SELECT * FROM hostels WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['Name'];
                $myObj[] = $row['Status'];

                $myJSON = json_encode($myObj);

                echo $myJSON;
            }
        }
    }
    
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php')?>

    <header class="container mt-5 px-5 py-5">
        <h1 class="text-center text-muted" data-aos="zoom-in"
        data-aos-duration="500" style="font-size:50px;">Hostels</h1>
        <hr class="container">
    </header>

    <div class="container py-3 justify-content-center">
            
            <div class="table-responsive text-center">
                <?php if($msg != ''):?>
                    <div class="alert <?php echo $msgClass; ?>">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg; ?></div>
                <?php endif?>
            
                <div id="toolbar">
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addHostel" type="button" href="addstudent.php" class="btn btn-primary mx-2">
                    Add New Hostel
                    </a>
                </div>
                <table  data-toggle="table"
                        data-search="true"
                        data-filter-control="true" 
                        data-click-to-select="true"
                        data-pagination="true"
                        data-search-align="left"
                        data-show-toggle="true"
                        data-show-fullscreen="true"
                        data-show-pagination-switch="true"
                        data-pagination-pre-text="Previous"
                        data-pagination-next-text="next"
                        data-pagination-h-align="left"
                        data-pagination-detail-h-align="right"
                        data-page-list="[10,20,30,40,50,All]"
                        data-toolbar="#toolbar">
                                                
                    <?php include 'inc/pages/hostelList.php';?>

                </table>
            </div>
    </div>

        <!-- Add student Modal -->
    <div class="modal fade" id="addHostel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hostel Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if($msg != ''):?>
                        <div class="alert <?php echo $msgClass; ?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $msg; ?></div>
                    <?php endif?>

                    <form method="POST" action="inc/addforms/addHostel.php">

                        <div class="form-group">
                            <label for="firstname">Hostel Name</label>
                            <input class="form-control" required="" id="Name" name="Name" placeholder="Enter the hostel name"/>
                            <br>
                        </div>
                        
                        <div class="form-group">
                            <label for="gender">Status</label>
                            <select class="form-select" name="Status" aria-label="Default select example">
                                <option disabled selected>Select status</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Student"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- Edit student info Modal -->
    <div class="modal fade" id="editHostel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subject's Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/editforms/editHostel.php">
                        <input type="hidden" name="eid" value="">
                        
                        <div class="form-group">
                            <label for="editName">Hostel Name</label>
                            <input class="form-control" required="" id="editName" name="editName" placeholder="Enter the hostel name"/>
                            <br>
                        </div>
                        
                        <div class="form-group">
                            <label for="gender">Status</label>
                            <select class="form-select" id="editStatus" name="editStatus" aria-label="Default select example">
                                <option disabled selected>Select status</option>
                                <option value="Available">Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="editSubmit" class="btn btn-primary" value="Update Record"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete student info Modal -->
    <div class="modal fade" id="deleteHostel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/deleteforms/deleteHostel.php">
                        <input type="hidden" name="did" value="">
                        <h3 class="text-danger"> Are you sure you want to delete this record?</h3>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="deleteSubmit" class="btn btn-danger" value="Delete Record"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>