<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $fname = $_POST['editParentsFirstName'];
        $lname = $_POST['editParentsLastName'];
        $address = $_POST['editParentsAddress'];
        $email = $_POST['editParentsEmail'];
        $phone = $_POST['editParentsPhone'];

        if ($eid) {
            # code...
            $query = "UPDATE `parents` SET `FirstName`= '$fname', `LastName` = '$lname',
            `HomeAddress` = '$address', `Email` = '$email', 
            `Phone` = '$phone' WHERE ID = '$eid'";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));   
            }else{
                $msg = "Record updated successfully..";
                $msgClass = "alert-success";
                echo "all good";
                header("location: http://localhost/shsms/parents.php");
            }
        }
    }
?>