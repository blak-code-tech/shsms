<?php
require('../../config/config.php');
require('../../config/db.php');

if (isset($_POST['did'])) {
    $id = $_POST['did'];
    $table = $_POST['table'];
    delete($table, $id, $conn);
}

function delete($table, $id, $conn){

    $delete_query = ("DELETE FROM banks WHERE ID='$id'");
    $check_delete = mysqli_query($conn, $delete_query);
    if (!$check_delete) {

        die(mysqli_error($conn));
        echo mysqli_error($conn);
    }else{
        echo "OK.";
    }  
}
?>