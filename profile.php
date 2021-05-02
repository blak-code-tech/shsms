<?php 
    require('config/config.php');

if (isset($_SESSION["id"])) {?>

<?php
    require('config/db.php');
    require('config/count_records.php');
?>

<?php include('inc/headers/mainHeader.php')?>

<?php include('inc/navbars/mainNavbar.php')?>

<header class="container mt-5 col-xxl-8 px-5 py-5">
    <h1 class="text-center text-muted" data-aos="zoom-in" data-aos-duration="500" style="font-size:50px;">Profile</h1>
    <hr class="container col-xxl-8">
</header>

<div class="container my-5">

    <div class="card profile-page shadow">

        <div class="profile">
            <img id="testClick" src="assets/img/user.png" class="img-raised rounded-circle" alt="userImage">
        </div>

        <h3 class="text-center text-dark text-capitalize fw-bold mb-3" style="margin-top: -50px;">
            <?php echo $_SESSION['fname'] .' '.$_SESSION['lname']?>
        </h3>

        <small class="text-center text-uppercase">
            <?php echo $_SESSION['UserType']?>
        </small>
        <div class="container mt-5 mb-3">
            <div class="table-responsive text-center">
                <table class="table" data-toggle="table">
                    <?php include 'inc/pages/profileList.php';?>
                </table>
            </div>

        </div>
        <div class="row mx-3 mb-5">
            <div class="col-6">
                <a data-bs-toggle="modal" data-passwordid="<?php echo $_SESSION["id"]; ?>"
                    href="profile.php#editPassword">
                    Change Password?
                </a>
            </div>
            <div class="col-6">
                <i id="btnReport" class="fa fa-print float-end" data-bs-toggle="tooltip" data-bs-placement="left"
                    rel="tooltip" title="Download Report"></i>
            </div>
        </div>
    </div>
</div>


<!-- Edit profile info Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editProfile" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                    <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2"
                        style="font-size:50px;border-radius:60px;"></i>
                    <p class="lead text-success mb-5"><strong>Record Updated Successfully...</strong></p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                </div>
            </div>
            <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="getEditBank">
                        <input type="hidden" id="eid" name="eid" value="">
                        <div class="form-group">
                            <!-- subject name-->
                            <label for="editBankName">Student Name</label>
                            <input class="form-control" pattern="^[a-zA-Z ]+$"
                                title="*Valid characters: Alphabets and space." value="" id="editBankName"
                                name="editBankName" required placeholder="Enter the bank name" />
                            <br>
                        </div>

                        <div class="form-group">
                            <!-- subject name-->
                            <label for="editAccNo">Account number</label>
                            <input class="form-control" required="" value="" pattern="^\d{14}$"
                                title="Make sure there are 14 digits." id="editAccNo" name="editAccNo"
                                placeholder="Enter the account number" />
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" name="editSubmit" class="btn btn-primary" value="Update Record" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Edit password info Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="editPassword" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="overlay-loading">
                <div class="d-flex justify-content-center m-5">
                    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <p class="text-center lead text-secondary"><strong>Updating Password ...</strong></p>
            </div>
            <div class="overlay-results">
                <div class="text-center">
                    <i class="fa fa-check bg-success align-middle text-light p-3 mt-4 mb-2"
                        style="font-size:50px;border-radius:60px;"></i>
                    <p class="lead text-success mb-5"><strong>Record Updated Successfully...</strong></p>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Return to page</button>
                </div>
            </div>
            <div class="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Password Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="getEditPass">
                        <input type="hidden" id="pid" name="pid" value="<?php echo $_SESSION['id'];?>">

                        <div class="form-group">
                            <label for="editBankName">New Password</label>
                            <input class="form-control" id="editNewPassword" type="password" name="editNewPassword"
                                maxlength="30" required placeholder="Enter the new password" />
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="editBankName">Confirm Password</label>
                            <input class="form-control" id="editNewConfirmPassword" type="password"
                                name="editNewConfirmPassword" maxlength="30" required
                                placeholder="Enter the new password again" />
                            <br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" maxlength="30" name="editSubmit" class="btn btn-primary"
                                value="Update Password" />
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