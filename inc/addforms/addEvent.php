<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);

    $name = $_POST['EventName'];
    $date = $_POST['EventDate'];
    $details = $_POST['EventDetails'];
     
    $query = "INSERT INTO `events`(`Name`,`Date`, `Details`) 
    VALUES ('$name','$date','$details')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/events.php");
    }
}
?>