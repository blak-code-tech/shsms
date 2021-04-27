<?php
require('../../config/config.php');
require('../../config/db.php');


    if (isset($_POST['eid'])) {


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
        $today = date("Y/m/d");

        if ($eid) {
            # code...
            $query = "UPDATE `students` SET `FirstName`= '$fname',`LastName`='$lname',
            `Gender`='$gender',`DOB`='$dob',`HostelID`=$hostelID,
            `ClassID`=$classID WHERE StudentID = '$eid'";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));
                echo 'Query failed'.mysqli_error($conn);
            }else{
                echo "OK."; 
            }
        }
    }
?>