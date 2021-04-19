<?php
    require('config/config.php');

    if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
       if ($id != 0) {
            $query = ("SELECT * FROM parents WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['FirstName'];
                $myObj[] = $row['LastName'];
                $myObj[] = $row['Phone'];
                $myObj[] = $row['Email'];
                $myObj[] = $row['HomeAddress'];

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
     data-aos-duration="500" style="font-size:50px;">Parents</h1>
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
            <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                <!--<a data-bs-toggle="modal" data-bs-target="#addParent" type="button" href="addstudent.php" class="btn btn-primary mx-2">
                Add New Parent
                </a>-->
            <?php endif; ?>
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
                                            
                <?php include 'inc/pages/parentsList.php';?>

            </table>
        </div>
</div>

<!-- Add student Modal -->
<!-- <div class="modal fade" id="addParent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
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

                <form method="POST" action="inc/addforms/addParent.php">
                        
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guardian">First Name</label>
                            <input class="form-control" required="" name="ParentsFirstName" placeholder="Enter the first name"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="guardian">Last Name</label>
                            <input class="form-control" required="" name="ParentsLastName" placeholder="Enter the last name"/>
                            <br>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guardian">Address</label>
                            <input class="form-control" required="" name="ParentsName" placeholder="Enter the parents's address"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="guardian">Email</label>
                            <input class="form-control" required="" name="ParentsPhone" placeholder="Enter the parents's email"/>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guardian">Phone</label>
                            <input class="form-control" required="" name="ParentsPhone" placeholder="Enter the parents's phone"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="Sub">Student's Registration number</label>
                            <input class="form-control" type="text" readonly placeholder="StudentID" name="editStudentID">
                            <br>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Student"/>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>-->

<!-- Edit student info Modal -->
<div class="modal fade" id="editParent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Parent's Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="inc/editforms/editParent.php">
                    <input type="hidden" name="eid" value="">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guardian">Parent's First Name</label>
                            <input class="form-control" required="" name="editParentsFirstName" placeholder="Enter the first name"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="guardian">Parents's Last Name</label>
                            <input class="form-control" required="" name="editParentsLastName" placeholder="Enter the last phone"/>
                            <br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="guardian">Parent's Phone</label>
                            <input class="form-control" required="" name="editParentsPhone" placeholder="Enter the phone number"/>
                            <br>
                        </div>

                        <div class="form-group col-6">
                            <label for="guardian">Parents's Email</label>
                            <input class="form-control" required="" name="editParentsEmail" placeholder="Enter the email"/>
                            <br>
                        </div>
                    </div>
                    
                    <!-- Registration Number-->
                    <div class="form-group">
                        <label for="Sub">Parent's Home Address</label>
                        <input class="form-control" type="text" placeholder="Enter the address" name="editParentsAddress">
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
<div class="modal fade" id="deleteParent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="inc/deleteforms/deleteParent.php">
                    <input type="hidden" name="did" value="">
                    <h5 class="text-danger"> Are you sure you want to delete this record?</h5>
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
<?php
}else header("Location: index.php");?>