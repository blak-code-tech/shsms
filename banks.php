<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');

    if(isset($_REQUEST["eid"])){
        $id = $_REQUEST["eid"];
        if ($id != 0) {
            $query = ("SELECT * FROM banks WHERE ID=$id");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                $myObj[] = $row['ID'];
                $myObj[] = $row['Name'];
                $myObj[] = $row['Account_No'];

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
        data-aos-duration="500" style="font-size:50px;">Banks</h1>
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
                    <a data-bs-toggle="modal" data-bs-target="#addBank" type="button" class="btn btn-primary mx-2">
                    Add New Bank
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
                                                
                    <?php include 'inc/pages/bankList.php';?>

                </table>
            </div>
    </div>

        <!-- Add student Modal -->
        <div class="modal fade" id="addBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bank Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if($msg != ''):?>
                            <div class="alert <?php echo $msgClass; ?>">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $msg; ?></div>
                        <?php endif?>

                        <form method="POST" action="inc/addforms/addBanks.php">
                            <div class="row">
                                <!-- First name-->
                                <div class="form-group">
                                    <label for="BankName">Bank's Name</label>
                                    <input class="form-control" required="" id="BankName" name="BankName" placeholder="Enter the bank's name"/>
                                    <br>
                                </div>
                                
                                <div class="form-group">
                                    <label for="accNo">Account Number</label>
                                    <input class="form-control" required="" id="accNo" name="accNo" placeholder="Enter the account number"/>
                                    <br>
                                </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Bank"/>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Edit student info Modal -->
    <div class="modal fade" id="editBank" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bank Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/editforms/editBanks.php">
                        <input type="hidden" name="eid" value="">
                        <div class="form-group">
                            <!-- subject name-->
                            <label for="editBankName">Subject Name</label>
                            <input class="form-control" required="" value="" id="editBankName" name="editBankName" placeholder="Enter the bank name"/>
                            <br>
                        </div>
                        
                        <div class="form-group">
                            <!-- subject name-->
                            <label for="editAccNo">Account number</label>
                            <input class="form-control" required="" value="" id="editAccNo" name="editAccNo" placeholder="Enter the account number"/>
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
    <div class="modal fade" id="deleteBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/deleteforms/deleteBank.php">
                        <input type="hidden" name="did" value="">
                        <h5 class="text-danger"> Are you sure you want to delete this record?</h5>                        <div class="modal-footer">
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