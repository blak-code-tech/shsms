<?php
    require('config/config.php');
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
       if ($id != 0) {
            $query = ("SELECT * FROM students WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['FirstName'];
                $myObj[] = $row['LastName'];
                $myObj[] = $row['Gender'];
                $myObj[] = $row['DOB'];
                $myObj[] = $row['RegNo'];
                $myObj[] = $row['Hostel'];
                $myObj[] = $row['Class'];
                $myObj[] = $row['TotalFees'];
                $myObj[] = $row['AdvanceFees'];
                $myObj[] = $row['Balance'];
                $myObj[] = $row['Guardian'];

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
     data-aos-duration="500" style="font-size:50px;">Students</h1>
    <hr class="container">
</header>

<div class="container-fluid py-3 justify-content-center">
        
        <div class="table-responsive text-center">
            <?php if($msg != ''):?>
                <div class="alert <?php echo $msgClass; ?>">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $msg; ?></div>
            <?php endif?>
        
        <div id="toolbar">
            <!-- Button trigger modal -->
            <a data-bs-toggle="modal" data-bs-target="#addStudent" type="button" href="addstudent.php" class="btn btn-primary mx-2">
            Add New Student
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
                                            
                <?php include 'inc/pages/studentsList.php';?>

            </table>
        </div>
</div>

<!-- Add student Modal -->
<div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student's Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php if($msg != ''):?>
                    <div class="alert <?php echo $msgClass; ?>">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg; ?></div>
                <?php endif?>

                <form method="POST" action="inc/addforms/addStudents.php"">
                    <div class="row">
                        <!-- First name-->
                        <div class="form-group col-6">
                            <label for="firstname">Student's First Name</label>
                            <input class="form-control" required="" id="FirstName" name="FirstName" placeholder="Enter the first name"/>
                            <br>
                        </div>

                        <!-- Last name-->
                        <div class="form-group col-6">
                            <label for="lastname">Student's Last Name</label>
                            <input class="form-control" required="" id="LastName" name="LastName" placeholder="Enter the last name"/>
                            <br>
                        </div>

                    </div>

                    <div class="row">
                        <!-- Registration Number-->
                        <div class="form-group col-6">
                            <label for="regNo">Student's Registration number</label>
                            <input class="form-control" type="text" value="<?php generateRegNo();?>" readonly placeholder="Reg no." name="RegNo">
                            <br>
                        </div>
                        
                        <!-- DOB-->
                        <div class="form-group col-6">
                            <label for="dob">Student's Date of Birth</label>
                            <input class="form-control" type="date" required="" name="DOB">
                            <br>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Gender-->
                        <div class="form-group col-4">
                            <label for="gender">Student's Gender</label>
                            <select class="form-select" name="Gender" aria-label="Default select example">
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <br>
                        </div>

                        <!-- Hostel-->
                        <div class="form-group col-4">
                            <label for="hostel">Student's Hostel</label>
                            <select class="form-select" name="Hostel" aria-label="Default select example">
                            <option selected>Select Hostel</option>
                            <?php getitems('hostels');?>
                            </select>
                            <br>
                        </div>

                        <!-- Class-->
                        <div class="form-group col-4">
                            <label for="class">Student's Class</label>
                            <select class="form-select" name="Class" aria-label="Default select example">
                                <option selected>Select Class</option>
                                <?php getitems('classes');?>
                            </select>
                            <br>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="totalfees">Student's Total Fees Cost</label>
                            <input type="number" required="" class="form-control" id="TotalFees" name="TotalFees" placeholder="Enter the total fees charged"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="advancefees">Student's Advance Payment</label>
                            <input type="number" required="" class="form-control" id="AdvanceFees" name="AdvanceFees" placeholder="Enter the fees pain in advance"/>
                            <br>
                        </div>

                       <!-- <div class="form-group col-4">
                            <label for="balance">Student's Balance</label>
                            <input type="number" readonly class="form-control" id="Balance" name="Balance" placeholder="Enter the balance."/>
                            <br>
                        </div> -->
                        
                    </div>

                    <div class="form-group">
                        <label for="guardian">Guardian's Name</label>
                        <input class="form-control" required="" id="Guardian" name="Guardian" placeholder="Enter the guardian's name"/>
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

<!-- Edit student info Modal -->
<div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student's Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="inc/editforms/editStudents.php">
                    <input type="hidden" name="eid" value="">
                    <div class="row">
                        <!-- First name-->
                        <div class="form-group col-6">
                        <label for="editFirstName">Student's First Name</label>
                            <input class="form-control" required="" value="" id="editFirstName" name="editFirstName" placeholder="Enter the first name"/>
                            <br>
                        </div>

                        <!-- Last name-->
                        <div class="form-group col-6">
                            <label for="lastname">Student's Last Name</label>
                                <input class="form-control" required="" id="editLastName" name="editLastName" placeholder="Enter the last name"/>
                            <br>
                        </div>

                    </div>

                    <div class="row">
                        <!-- Registration Number-->
                        <div class="form-group col-6">
                            <label for="regNo">Student's Registration number</label>
                            <input class="form-control" type="text" value="" readonly placeholder="Reg no." name="editRegNo">
                            <br>
                        </div>
                        
                        <!-- DOB-->
                        <div class="form-group col-6">
                            <label for="dob">Student's Date of Birth</label>
                            <input class="form-control" type="date" required="" name="editDOB">
                            <br>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!-- Gender-->
                        <div class="form-group col-4">
                            <label for="gender">Student's Gender</label>
                            <select class="form-select" id="editGender" name="editGender">
                                <option disabled selected>Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <br>
                        </div>

                        <!-- Hostel-->
                        <div class="form-group col-4">
                            <label for="hostel">Student's Hostel</label>
                            <select class="form-select" id="editHostel" name="editHostel" aria-label="Default select example">
                            <optgroup label="Select hostel">
                            <?php getitems('hostels');?>
                            </optgroup>
                            </select>
                            <br>
                        </div>

                        <!-- Class-->
                        <div class="form-group col-4">
                            <label for="class">Student's Class</label>
                            <select class="form-select" required="" id="editClass" name="editClass" aria-label="Default select example">
                            <optgroup label="Select class">
                                <?php getitems('classes');?>
                            </optgroup>
                            </select>
                            <br>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="totalfees">Student's Total Fees Cost</label>
                            <input type="number" required="" class="form-control" name="editTotalFees" placeholder="Enter the total fees charged"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="advancefees">Student's Advance Payment</label>
                            <input type="number" required="" class="form-control" id="editAdvanceFees" name="editAdvanceFees" placeholder="Enter the fees pain in advance"/>
                            <br>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="guardian">Guardian's Name</label>
                        <input class="form-control" required="" id="editGuardian" name="editGuardian" placeholder="Enter the guardian's name"/>
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
<div class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="inc/deleteforms/deleteStudents.php">
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