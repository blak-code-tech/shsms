<?php
require('../../config/config.php');
require('../../config/db.php');
    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $fname = $_POST['editFirstName'];
        $fname = trim($fname);
        $fname = ucwords($fname);
        $lname = $_POST['editLastName'];
        $lname = trim($lname);
        $lname = ucwords($lname);
        $dob = $_POST['editDOB'];
        $classID = $_POST["editClass"];
        $gender = $_POST['editGender'];
        $hostelID = $_POST['editHostel'];

        if ($eid) {
            # code...
            $query = "UPDATE `students` SET `FirstName`= '$fname',`LastName`='$lname',
            `Gender`='$gender',`DOB`='$dob',`HostelID`=$hostelID,
            `ClassID`=$classID WHERE StudentID = '$eid'";

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