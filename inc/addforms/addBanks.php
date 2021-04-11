<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);
    $bname = $_POST['BankName'];
    $acc = $_POST['accNo'];
     
    $query = "INSERT INTO `banks`(`Name`,`Account_No`) VALUES ('$bname','$acc')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/banks.php");
    }
}
?>