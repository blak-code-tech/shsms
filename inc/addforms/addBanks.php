<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['BankName']) && isset($_POST['accNo'])){
    
    $bname = $_POST['BankName'];
    $acc = $_POST['accNo'];

    $query = "INSERT INTO `banks`(`Name`,`Account_No`) VALUES ('$bname','$acc')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed: '.mysqli_error($conn));
        echo 'Query failed: '.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>