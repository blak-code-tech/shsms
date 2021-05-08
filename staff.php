<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != '') {
            $query = ("SELECT * FROM staff WHERE StaffID='$id'");
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
                $myObj[] = $row['Position'];

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
        data-aos-duration="500" style="font-size:50px;">Staff</h1>
        <hr class="container">
    </header>

    <div class="container py-3 justify-content-center">
            
            <div class="table-responsive text-center">
                <div id="toolbar">
                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addStaff" type="button" class="btn btn-primary mx-2">
                    Add New Staff
                    </a>
                    <?php endif; ?>
                </div>
                <table  id="table"
                        data-toggle="table"
                        data-buttons="buttons"
                        data-search="true"
                        data-filter-control="true" 
                        data-click-to-select="true"
                        data-pagination="true"
                        data-search-align="left"
                        data-show-toggle="true"
                        data-show-fullscreen="true"
                        data-pagination-pre-text="Prev"
                        data-pagination-next-text="Next"
                        data-pagination-h-align="left"
                        data-pagination-detail-h-align="right"
                        data-page-list="[10,20,30,40,50,All]"
                        data-toolbar="#toolbar">
                                                
                    <?php include 'inc/pages/staffList.php';?>

                </table>
            </div>
    </div>
</div>
    <!-- Add student Modal -->
    <div class="modal fade" id="addStaff" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="overlay-loading">
                    <div class="d-flex justify-content-center m-5">
                        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <p class="text-center lead text-secondary"><strong>Processing Form ...</strong></p>
                </div>
                <div class="overlay-results">
                    <div class="text-center">
                        <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2" style="font-size:50px;border-radius:60px;"></i>
                        <p class="lead text-success mb-5"><strong>Staff Added Successfully...</strong></p>
                        <p class="lead text-dark mb-5"><strong>Kindly forward the generated report to the staff.</strong></p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                    </div>
                </div>
                <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Staff Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="getAddStaff">

                        <div class="row">
                            <!-- Staff number Number-->
                            <div class="form-group col-4">
                                <label for="StaffID">Staff ID</label>
                                <input class="form-control" type="text" value="<?php generateStaffId();?>"
                                 readonly placeholder="Reg no." id="StaffID" name="StaffID">
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
                                <select class="form-select" required id="Gender" name="Gender" aria-label="Default select example">
                                    <option disabled selected>Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <br>
                            </div>

                            <!-- DOB-->
                            <div class="form-group col-4">
                                <label for="dob">Staff's Date of Birth</label>
                                <input class="form-control" type="date" required="" id="DOB" name="DOB">
                                <br>
                            </div>
                            
                            <div class="form-group col-4">
                                <label for="Phone">Staff's Phone Number</label>
                                <input class="form-control" required="" id="Phone" name="Phone" placeholder="Enter the phone number"/>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="position">Staff's Position</label>
                                <select class="form-select" id="Position" name="Position" aria-label="Default select example">
                                    <optgroup label="Select Position">
                                        <?php getitems('positions');?>
                                    </optgroup>
                                </select>
                                <br>
                            </div>

                            <div class="form-group col-4">
                                <label for="position">Staff's Subject</label>
                                <select class="form-select" id="Subject" name="Subject" aria-label="Default select example">
                                    <optgroup label="Select Subject">
                                        <?php getitems('subjects');?>
                                    </optgroup>
                                </select>
                                <br>
                            </div>
                            <!--
                            <div class="form-group col-8">
                                <label for="Phone">Staff's Email</label>
                                <input class="form-control" required="" id="Email" name="Email" placeholder="Enter the email"/>
                                <br>
                            </div>-->
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
    </div>
    <!-- Edit staff info Modal -->
    <div class="modal fade" id="editStaff" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="overlay-loading">
                    <div class="d-flex justify-content-center m-5">
                        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <p class="text-center lead text-secondary"><strong>Updating Records ...</strong></p>
                </div>
                <div class="overlay-results">
                    <div class="text-center">
                        <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2" style="font-size:50px;border-radius:60px;"></i>
                        <p class="lead text-success mb-5"><strong>Record Updated Successfully...</strong></p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                    </div>
                </div>
                <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Staff Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getEditStaff">
                        
                        <div class="row">
                            <!-- Staff number Number-->
                            <div class="form-group col-4">
                                <label for="eid">Staff ID</label>
                                <input class="form-control" type="text" value="" readonly placeholder="Staff ID" id="eid" name="eid">
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
                                <input class="form-control" type="date" required="" id="editDOB" name="editDOB">
                                <br>
                            </div>
                            
                            <div class="form-group col-4">
                                <label for="Phone">Staff's Phone Number</label>
                                <input class="form-control" required="" id="editPhone" name="editPhone" placeholder="Enter the phone number"/>
                                <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="position">Staff's Position</label>
                                <select class="form-select" id="editPosition" name="editPosition" aria-label="Default select example">
                                    <optgroup label="Select Position">
                                        <?php getitems('positions');?>
                                    </optgroup>
                                </select>
                                <br>
                            </div>
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
    </div>

    <!-- Delete student info Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="deleteStaff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="overlay-loading">
                <div class="d-flex justify-content-center m-5">
                    <div class="spinner-grow text-primary" style="width: 5rem; height: 5rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <p class="text-center lead text-secondary"><strong>Cleaning Up ...</strong></p>
            </div>
            <div class="overlay-results">
                <div class="text-center">
                    <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2" style="font-size:50px;border-radius:60px;"></i>
                    <p class="lead text-success mb-5"><strong>Record Deleted Successfully...</strong></p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                </div>
            </div>
            <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getDeleteStaff">
                        <input type="hidden" id="did" name="did" value="">
                        <h5 class="text-danger"> Are you sure you want to delete this record?</h5>                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="deleteSubmit" class="btn btn-danger" value="Delete Record"/>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>
<?php
}else header("Location: index.php");?>