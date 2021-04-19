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
            $query = ("SELECT * FROM notices WHERE ID='$id'");
            $check_edit = mysqli_query($conn, $query);

            if (!$check_edit) {
                die("Cannot connect");
            }else{
                $myObj = [];
                $row = mysqli_fetch_array($check_edit);
                
                $myObj[] = $row['ID'];
                $myObj[] = $row['Name'];
                $myObj[] = $row['Date'];
                $myObj[] = $row['Description'];
                $myObj[] = $row['Posted_By'];

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
        data-aos-duration="500" style="font-size:50px;">Notices</h1>
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
                    <a data-bs-toggle="modal" data-bs-target="#addNotice" type="button" class="btn btn-primary mx-2">
                    Add New Notice
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
                                                
                    <?php include 'inc/pages/noticesList.php';?>

                </table>
            </div>
    </div>

    <!-- Add student Modal -->
    <div class="modal fade" id="addNotice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notice Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if($msg != ''):?>
                        <div class="alert <?php echo $msgClass; ?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $msg; ?></div>
                    <?php endif?>

                    <form method="POST" action="inc/addforms/addNotice.php">
                        <input type="hidden" name="eid" value="">

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Notice Name</label>
                                <input class="form-control" placeholder="Enter the name" required="" name="NoticeName">
                                <br>
                            </div>

                            <div class="form-group col-6">
                                <label for="dob">Notice Date</label>
                                <input class="form-control" type="date" required="" name="NoticeDate">
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Notice Details</label>
                            <textarea class="form-control" rows="8" required="" name="NoticeDetails" placeholder="Enter the details"></textarea>
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="addSubmit" class="btn btn-primary" value="Add Notice"/>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editNotice" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Notice Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/editforms/editNotice.php">
                        <input type="hidden" value="" name="eid">
                        
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Event Name</label>
                                <input class="form-control" placeholder="Enter the name" required="" name="editNoticeName">
                                <br>
                            </div>

                            <div class="form-group col-6">
                                <label for="dob">Event Date</label>
                                <input class="form-control" type="date" required="" name="editNoticeDate">
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Event Details</label>
                            <textarea class="form-control" rows="8" required="" name="editNoticeDetails" placeholder="Enter your details"></textarea>
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
    <div class="modal fade" id="deleteNotice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="inc/deleteforms/deleteNotice.php">
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
