<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['Name']) && isset($_POST['Status'])){
    
    $hname = $_POST['Name'];
    $status = $_POST['Status'];
     
    $query = "INSERT INTO `hostels`(`Name`,`Status`)
     VALUES ('$hname','$status')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }  
}
?>