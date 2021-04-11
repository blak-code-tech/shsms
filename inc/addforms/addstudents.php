<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['addSubmit'])){
    var_dump($_POST);
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $dob = $_POST['DOB'];
    $regNo = $_POST['RegNo'];
    $class = $_POST["Class"];
    $gender = $_POST['Gender'];
    $hostel = $_POST['Hostel'];
    $totalFees = $_POST['TotalFees'];
    $advanceFees = $_POST['AdvanceFees'];
    $balance = $advanceFees - $totalFees;
    $guardian = $_POST['Guardian'];
     
    $query = "INSERT INTO `students`(`FirstName`, `LastName`, `Gender`, `DOB`, `RegNo`, `Hostel`, `Class`, `TotalFees`, `AdvanceFees`, `Balance`, `Guardian`) 
    VALUES ('$fname','$lname','$gender',$dob,'$regNo','$hostel','$class',$totalFees,$advanceFees,$balance,'$guardian')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));   
    }else{
        $msg = "Record updated successfully..";
        $msgClass = "alert-success";
        echo "all good";
        header("location: http://localhost/shsms/students.php");
    }
}
?>