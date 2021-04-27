<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != 0) {
            $query = ("SELECT * FROM classes WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['Name'];

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
        data-aos-duration="500" style="font-size:50px;">Classes</h1>
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
                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addClass" type="button" href="addstudent.php" class="btn btn-primary mx-2">
                    Add New Class
                    </a>
                <?php endif; ?>
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
                                                
                    <?php include 'inc/pages/classList.php';?>

                </table>
            </div>
    </div>

        <!-- Add student Modal -->
        <div class="modal fade" id="addClass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="overlay-loading">
                    <div class="d-flex justify-content-center m-5">
                        <div class="spinner-grow text-primary" style="width: 5rem; height: 5rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <p class="text-center lead text-secondary"><strong>Processing Form ...</strong></p>
                </div>
                <div class="overlay-results">
                    <div class="text-center">
                        <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2" style="font-size:50px;border-radius:60px;"></i>
                        <p class="lead text-success mb-5"><strong>Record Added Successfully...</strong></p>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                    </div>
                </div>
                <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Class Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getAddClass">
                        <div class="row">
                            <!-- First name-->
                            <div class="form-group">
                                <label for="firstname">Class Name</label>
                                <input class="form-control" required="" id="ClassName" name="ClassName" placeholder="Enter the class name"/>
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
    </div>
    <!-- Edit student info Modal -->
    <div class="modal fade" id="editClass" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="overlay-loading">
                    <div class="d-flex justify-content-center m-5">
                        <div class="spinner-grow text-primary" style="width: 5rem; height: 5rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <p class="text-center lead text-secondary"><strong>Updating Record ...</strong></p>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Class Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getEditClass">
                        <input type="hidden" id="eid" name="eid" value="">
                        <div class="form-group">
                            <!-- subject name-->
                            <label for="editClassName">Class Name</label>
                            <input class="form-control" required="" value="" id="editClassName" name="editClassName" placeholder="Enter the class name"/>
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
    </div>

    <!-- Delete student info Modal -->
    <div class="modal fade" id="deleteClass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form id="getDeleteClass">
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