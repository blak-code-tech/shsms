<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);
    $hname = $_POST['Name'];
    $status = $_POST['Status'];
     
    $query = "INSERT INTO `hostels`(`Name`,`Status`)
     VALUES ('$hname','$status')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/hostels.php");
    }
}
?>