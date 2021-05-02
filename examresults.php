<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/fetch_data.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != 0) {
            $query = ("SELECT * FROM exams WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['StudentID'];
                $myObj[] = $row['ExamCategory'];
                $myObj[] = $row['Score'];
                $myObj[] = $row['Grade'];

                $myJSON = json_encode($myObj);

                echo $myJSON;
            }
        }
    }
    
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php');?>

    <header class="container mt-5 px-5 py-5">
        <h1 class="text-center text-muted" data-aos="zoom-in"
        data-aos-duration="500" style="font-size:50px;">Exam Results</h1>
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
                <?php $user = $_SESSION['UserType']; if($user == 'admin' || $user === 'teacher'):?>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addExamResults" type="button" class="btn btn-primary mx-2">
                    Add New Result
                    </a>
                <?php endif;?>
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
                                                
                    <?php include 'inc/pages/examResultsList.php';?>

                </table>
            </div>
    </div>

    <!-- Add results Modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addExamResults" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
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
                        <h5 class="modal-title" id="exampleModalLabel">Student Results Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form id="getAddResults">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="RegNo">Students ID</label>
                                    <input list="datalistOptions" required class="form-control" name="RegNo" 
                                    id="RegNo" placeholder="Enter the registration number">
                                    <datalist id="datalistOptions">
                                        <?php getstudentregs();?>
                                    </datalist>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="Category">Exam Category</label>
                                    <select class="form-select" id="Category" name="Category" aria-label="Default select example">
                                    <option class="p-2" disabled selected>Select Category</option>
                                    <?php getitems('examcategory');?>
                                    </select>
                                    <br>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="Score">Student's Score</label>
                                    <input class="form-control" required="" id="Score"
                                    title="Make sure there are at most 3 digits." type="number"
                                        name="Score" placeholder="Enter the score out of 100%"/>
                                    <br>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="Grade">Grade</label>
                                    <input class="form-control" disabled required="" id="Grade"
                                        name="Grade" placeholder="Students Grade"/>
                                    <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Exam Result"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit results info Modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editExamResults" tabindex="-1" aria-hidden="true">
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
                        <h5 class="modal-title" id="exampleModalLabel">Student Results Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form id="getEditResults">
                            <input type="hidden" id="eid" name="eid" value="">
                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="editRegNo">Students ID</label>
                                    <input list="datalistOptions" disabled required class="form-control" name="editRegNo" 
                                    id="editRegNo" placeholder="Enter the registration number">
                                    <datalist id="datalistOptions">
                                        <?php getstudentregs();?>
                                    </datalist>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="hostel">Exam Category</label>
                                    <select class="form-select" id="editCategory" name="editCategory" aria-label="Default select example">
                                    <option class="p-2" disabled selected>Select Category</option>
                                    <?php getitems('examcategory');?>
                                    </select>
                                    <br>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="accNo">Student's Score</label>
                                    <input class="form-control" required="" id="editScore"
                                    title="Make sure there are 2 digits." type="number"
                                        name="editScore" placeholder="Enter the score out of 100%"/>
                                    <br>
                                </div>
                                
                                <div class="form-group col-6">
                                    <label for="editGrade">Grade</label>
                                    <input class="form-control" disabled required="" id="editGrade"
                                        name="editGrade" placeholder="Students Grade"/>
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

    <!-- Delete results info Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="deleteExamResults" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="getDeleteResults">
                            <input type="hidden" id="did" name="did" value="">
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
    </div>



<?php include('inc/footers/mainFooter.php')?>
<?php include('inc/foots/mainFoot.php')?>
<?php
}else header("Location: index.php");?>