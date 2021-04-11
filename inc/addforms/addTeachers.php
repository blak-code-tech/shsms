<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);
    $id = $_POST['StaffID'];
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $dob = $_POST['DOB'];
    $gender = $_POST['Gender'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $pass = 'pass';
     
    $query = "INSERT INTO `teachers`(`StaffID`,`FirstName`, `LastName`, `Gender`, `DOB`, `Email`, `Phone`, `Passwords`) 
    VALUES ('$id','$fname','$lname','$gender','$dob','$email','$phone','$pass')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/teachers.php");
    }
}
?>