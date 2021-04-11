<?php
    require('config/config.php');
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
                
                <?php if($msg != ''):?>
                    <div class="alert <?php echo $msgClass; ?>">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg; ?></div>
                <?php endif?>
            
                <div id="toolbar">
                    <!-- Button trigger modal -->
                    <a data-bs-toggle="modal" data-bs-target="#addFees" type="button" class="btn btn-primary mx-2">
                    Add New Fees Collection
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
                                                
                    <?php include 'inc/pages/feescollectionList.php';?>

                </table>
            </div>
    </div>

    <!-- Add student Modal -->
    <div class="modal fade" id="addFees" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fees Collection Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if($msg != ''):?>
                        <div class="alert <?php echo $msgClass; ?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $msg; ?></div>
                    <?php endif?>

                    <form method="POST" action="inc/addforms/addFeesCollection.php">
                        <input type="hidden" name="eid" value="">

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
                                <input list="regNo" class="form-control" name="RegNo" id="RegNo" placeholder="Enter the registration number">
                                <datalist id="regNo">
                                    <?php getstudentregs();?>
                                </datalist>
                                <br>
                            </div>

                            <!-- DOB-->
                            <div class="form-group col-6">
                                <label for="PaidAmount">Paid Amount</label>
                                <input class="form-control" type="number" placeholder="Enter the paid amount" required="" name="PaidAmount">
                                <br>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-6">
                                <label for="Arrears">Arrears</label>
                                <input class="form-control" type="number" placeholder="Enter the arrears" required="" name="Arrears">
                                <br>
                            </div>


                            <div class="form-group col-6">
                                <label for="Balance">Balance</label>
                                <input class="form-control" type="number" placeholder="Enter the balance" required="" name="Balance">
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
    <!-- Edit teacher info Modal -->
    <div class="modal fade" id="editFeesCollection" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Fees Collection Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/editforms/editFeesCollection.php">
                        <input type="hidden" value="" name="eid">
                        
                        <div class="row">

                            <div class="form-group col-6">
                                <label>Registration Number</label>
                                <input class="form-control" type="text" readonly="" placeholder="Enter the paid amount" required="" name="editRegNo">
                                <br>
                            </div>

                            <!-- DOB-->
                            <div class="form-group col-6">
                                <label for="">Paid Amount</label>
                                <input class="form-control" type="number" placeholder="Enter the paid amount" required="" name="editPaidAmount">
                                <br>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-6">
                                <label for="Arrears">Arrears</label>
                                <input class="form-control" type="number" placeholder="Enter the arrears" required="" name="editArrears">
                                <br>
                            </div>


                            <div class="form-group col-6">
                                <label for="Balance">Balance</label>
                                <input class="form-control" type="number" placeholder="Enter the balance" required="" name="editBalance">
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Phone">Remarks</label>
                            <input class="form-control" required="" id="Remarks" name="editRemarks" placeholder="Enter your remarks"/>
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
    <div class="modal fade" id="deleteFeesCollection" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/deleteforms/deleteFeesCollection.php">
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