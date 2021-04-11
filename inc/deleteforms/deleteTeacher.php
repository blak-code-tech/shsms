<?php
require('../../config/config.php');
require('../../config/db.php');

if (isset($_POST['deleteSubmit'])) {
    var_dump($_POST);

    $id = $_POST['did'];
    $delete_query = ("DELETE FROM teachers WHERE StaffID='$id'");
    $check_delete = mysqli_query($conn, $delete_query);
    if (!$check_delete) {

        die(mysqli_error($conn));
    }else{
        $msg = "Record Deleted successfully..";
        $msgClass = "alert-danger";
        echo "all good"; 
        header("location: http://localhost/shsms/teachers.php"); 
    }                        
}
?>