<?php
require('../../config/config.php');
require('../../config/db.php');
    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $fname = $_POST['editFirstName'];
        $lname = $_POST['editLastName'];
        $dob = $_POST['editDOB'];
        $class = $_POST["editClass"];
        $gender = $_POST['editGender'];
        $hostel = $_POST['editHostel'];
        $totalFees = $_POST['editTotalFees'];
        $advanceFees = $_POST['editAdvanceFees'];
        $balance = $advanceFees - $totalFees;
        $guardian = $_POST['editGuardian'];

        if ($eid) {
            # code...
            $query = "UPDATE `students` SET `FirstName`= '$fname',`LastName`='$lname',
            `Gender`='$gender',`DOB`='$dob',`Hostel`='$hostel',
            `Class`='$class',`TotalFees`=$totalFees,`AdvanceFees`=$advanceFees,
            `Balance`=$balance,`Guardian`='$guardian' WHERE ID = $eid";

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
    }
?>