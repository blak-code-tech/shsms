<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);

    $name = $_POST['NoticeName'];
    $date = $_POST['NoticeDate'];
    $details = $_POST['NoticeDetails'];
    $postBy = '('.$_SESSION['UserType'].') '.$_SESSION['fname'].' '.$_SESSION['lname'];

     
    $query = "INSERT INTO `notices`(`Name`,`Date`, `Description`, `Posted_By`) 
    VALUES ('$name','$date','$details', '$postBy')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/notices.php");
    }
}
?>