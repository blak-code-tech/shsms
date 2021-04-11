<?php
    require('config/config.php');
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != '') {
            $query = ("SELECT * FROM teachers WHERE StaffID='$id'");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                
                $myObj[] = $row['StaffID'];
                $myObj[] = $row['FirstName'];
                $myObj[] = $row['LastName'];
                $myObj[] = $row['DOB'];
                $myObj[] = $row['Email'];
                $myObj[] = $row['Phone'];
                $myObj[] = $row['Gender'];

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
        data-aos-duration="500" style="font-size:50px;">Teachers</h1>
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
                    <a data-bs-toggle="modal" data-bs-target="#addTeacher" type="button" class="btn btn-primary mx-2">
                    Add New Teacher
                    </a>
                </div>
                <table  data-toggle="table"
                        data-search="true"
                        data-filter-control="true" 
                        data-click-to-select="true"
                        data-pagination="true"
                        data-search-align="left"
                        data-show-toggle="true"
                        data-show-refresh="true"
                        data-show-fullscreen="true"
                        data-show-pagination-switch="true"
                        data-pagination-pre-text="Previous"
                        data-pagination-next-text="next"
                        data-pagination-h-align="left"
                        data-pagination-detail-h-align="right"
                        data-page-list="[10,20,30,40,50,All]"
                        data-toolbar="#toolbar">
                                                
                    <?php include 'inc/pages/teachersList.php';?>

                </table>
            </div>
    </div>

        <!-- Add student Modal -->
        <div class="modal fade" id="addTeacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Teacher's Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if($msg != ''):?>
                            <div class="alert <?php echo $msgClass; ?>">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $msg; ?></div>
                        <?php endif?>

                        <form method="POST" action="inc/addforms/addTeachers.php">

                            <div class="row">
                                <!-- Staff number Number-->
                                <div class="form-group col-4">
                                    <label for="StaffID">Staff ID</label>
                                    <input class="form-control" type="text" value="<?php generateStaffId();?>" readonly placeholder="Reg no." name="StaffID">
                                    <br>
                                </div>

                                <div class="form-group col-4">
                                    <label for="FirstName">Staff's First Name</label>
                                    <input class="form-control" required="" id="FirstName" name="FirstName" placeholder="Enter the first name"/>
                                    <br>
                                </div>
                                
                                <div class="form-group col-4">
                                    <label for="LastName">Staff's Last Name</label>
                                    <input class="form-control" required="" id="LastName" name="LastName" placeholder="Enter the last name"/>
                                    <br>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Gender-->
                                <div class="form-group col-4">
                                    <label for="gender">Staff's Gender</label>
                                    <select class="form-select" name="Gender" aria-label="Default select example">
                                        <option disabled selected>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <br>
                                </div>

                                <!-- DOB-->
                                <div class="form-group col-4">
                                    <label for="dob">Staff's Date of Birth</label>
                                    <input class="form-control" type="date" required="" name="DOB">
                                    <br>
                                </div>
                                
                                <div class="form-group col-4">
                                    <label for="Phone">Staff's Phone Number</label>
                                    <input class="form-control" required="" id="Phone" name="Phone" placeholder="Enter the phone number"/>
                                    <br>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Phone">Staff's Email</label>
                                <input class="form-control" required="" id="Email" name="Email" placeholder="Enter the email"/>
                                <br>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Staff"/>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit teacher info Modal -->
    <div class="modal fade" id="editTeacher" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Teachers Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/editforms/editTeachers.php">
                        
                        <div class="row">
                            <!-- Staff number Number-->
                            <div class="form-group col-4">
                                <label for="eid">Staff ID</label>
                                <input class="form-control" type="text" value="" readonly placeholder="Staff ID" name="eid">
                                <br>
                            </div>

                            <div class="form-group col-4">
                                <label for="editFirstName">Staff's First Name</label>
                                <input class="form-control" required="" id="editFirstName" name="editFirstName" placeholder="Enter the first name"/>
                                <br>
                            </div>
                            
                            <div class="form-group col-4">
                                <label for="LastName">Staff's Last Name</label>
                                <input class="form-control" required="" id="editLastName" name="editLastName" placeholder="Enter the last name"/>
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Gender-->
                            <div class="form-group col-4">
                                <label for="editGender">Staff's Gender</label>
                                <select class="form-select" id="editGender" name="editGender" aria-label="Default select example">
                                    <option disabled selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <br>
                            </div>

                            <!-- DOB-->
                            <div class="form-group col-4">
                                <label for="dob">Staff's Date of Birth</label>
                                <input class="form-control" type="date" required="" name="editDOB">
                                <br>
                            </div>
                            
                            <div class="form-group col-4">
                                <label for="Phone">Staff's Phone Number</label>
                                <input class="form-control" required="" id="editPhone" name="editPhone" placeholder="Enter the phone number"/>
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Phone">Staff's Email</label>
                            <input class="form-control" required="" id="editEmail" name="editEmail" placeholder="Enter the email"/>
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
    <div class="modal fade" id="deleteTeacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/deleteforms/deleteTeacher.php">
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