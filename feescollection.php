<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/fetch_data.php');

    $msg = '';
    $msgClass = '';
    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != '') {
            $query = ("SELECT * FROM feescollection WHERE ID='$id'");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                
                $myObj[] = $row['ID'];
                $myObj[] = $row['Student'];
                $myObj[] = $row['PaidAmount'];
                $myObj[] = $row['Arrears'];
                $myObj[] = $row['Balance'];
                $myObj[] = $row['Remarks'];

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
        data-aos-duration="500" style="font-size:50px;">Fees Collection</h1>
        <hr class="container">
    </header>

    <div class="container py-3 justify-content-center">
            
            <div class="table-responsive text-center">

                <div id="toolbar">
                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin'):?>
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addFeesCollection" type="button" class="btn btn-primary mx-2">
                    Add New Fees Collection
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
                        data-show-fullscreen="true"
                        data-show-pagination-switch="true"
                        data-pagination-pre-text="Previous"
                        data-pagination-next-text="next"
                        data-pagination-h-align="left"
                        data-pagination-detail-h-align="right"
                        data-page-list="[10,20,30,40,50,All]"
                        data-toolbar="#toolbar">
                                                
                    <?php include 'inc/pages/feescollectionList.php';?>

                </table>
            </div>
    </div>

    <!-- Add fees Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="addFeesCollection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <h5 class="modal-title" id="exampleModalLabel">Fees Collection Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getAddFees">
                        <div class="row">

                            <!--<div class="form-group col-6">
                                <label for="gender">Registration Number</label>
                                <select class="form-select" name="RegNo" aria-label="Default select example">
                                    <option disabled selected>Select student</option>
                                    <?php getstudentregs();?>
                                </select>
                                <br>
                            </div>-->
                            <div class="form-group col-6">
                                <label for="gender">Registration Number</label>
                                <input list="datalistOptions" required class="form-control" name="RegNo" 
                                id="RegNo" placeholder="Enter the registration number">
                                <datalist id="datalistOptions">
                                    <?php getstudentregs();?>
                                </datalist>
                                <br>
                            </div>
                            

                            <!-- DOB-->
                            <div class="form-group col-6">
                                <label for="PaidAmount">Paid Amount</label>
                                <input class="form-control" type="text" placeholder="Enter the paid amount"
                                 required="" id="PaidAmount" name="PaidAmount" pattern="^[0-9]+$">
                                <br>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-6">
                                <label for="Arrears">Arrears</label>
                                <input class="form-control" type="text" placeholder="Enter the arrears"
                                 required="" id="Arrears" name="Arrears" pattern="^[0-9]+$" maxlength="8">
                                <br>
                            </div>


                            <div class="form-group col-6">
                                <label for="Balance">Balance</label>
                                <input class="form-control" type="number" placeholder="Enter the balance"
                                 required="" id="Balance" name="Balance" readonly pattern="^[0-9]+$">
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Phone">Remarks</label>
                            <input class="form-control" required="" id="Remarks" name="Remarks" placeholder="Enter your remarks"/>
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
    </div>

    <!-- Edit fees info Modal -->
    <div class="modal fade" data-bs-backdrop="static" id="editFeesCollection" tabindex="-1" aria-hidden="true">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Fees Collection Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="getEditFees">
                        <input type="hidden" value="" id="eid" name="eid">
                        
                        <div class="row">

                            <div class="form-group col-6">
                                <label>Registration Number</label>
                                <input class="form-control" type="text" readonly="" 
                                placeholder="Enter the paid amount" required="" id="editRegNo"
                                 name="editRegNo">
                                <br>
                            </div>

                            <!-- DOB-->
                            <div class="form-group col-6">
                                <label for="">Paid Amount</label>
                                <input class="form-control" maxlength="6" type="text" placeholder="Enter the paid amount"
                                 required="" id="editPaidAmount" id="editPaidAmount" pattern="^[0-9]+$" name="editPaidAmount">
                                <br>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-6">
                                <label for="Arrears">Arrears</label>
                                <input class="form-control" maxlength="6" type="text" placeholder="Enter the arrears"
                                 required="" id="editArrears" name="editArrears" pattern="^[0-9]+$">
                                <br>
                            </div>


                            <div class="form-group col-6">
                                <label for="Balance">Balance</label>
                                <input class="form-control" type="number" readonly placeholder="Enter the balance"
                                 required="" id="editBalance" name="editBalance" pattern="^[0-9]+$">
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Phone">Remarks</label>
                            <input class="form-control" required="" id="editRemarks"
                             name="editRemarks" placeholder="Enter your remarks"/>
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
    <div class="modal fade" id="deleteFeesCollection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form id="getDeleteFees">
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
