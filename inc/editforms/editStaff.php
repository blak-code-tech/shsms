<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['eid'])) {
        
        $eid = $_POST['eid'];
        $fname = $_POST['editFirstName'];
        $lname = $_POST['editLastName'];
        $gender = $_POST['editGender'];
        $dob = $_POST['editDOB'];
        $position = $_POST['editPosition'];
        $phone = $_POST['editPhone'];

        if ($eid) {
            # code...
            $query = "UPDATE `staff` SET `FirstName`= '$fname', `LastName` = '$lname',
            `Gender` = '$gender', `DOB` = '$dob',
             `Phone` = '$phone', `Position` = $position  WHERE StaffID = '$eid'";

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