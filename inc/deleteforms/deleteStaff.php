<?php
require('../../config/config.php');
require('../../config/db.php');

if (isset($_POST['did'])) {
    
    $id = $_POST['did'];
    $delete_query = ("DELETE FROM staff WHERE StaffID='$id'");
    $check_delete = mysqli_query($conn, $delete_query);
    if (!$check_delete) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>