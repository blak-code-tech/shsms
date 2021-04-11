<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);
    $sname = $_POST['SubjectName'];
     
    $query = "INSERT INTO `subjects`(`Name`) VALUES ('$sname')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/subjects.php");
    }
}
?>