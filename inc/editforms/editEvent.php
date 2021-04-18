<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $name = $_POST['editEventName'];
        $name = trim($name);
        $name = ucwords($name);
        $date = $_POST['editEventDate'];
        $details = $_POST['editEventDetails'];
        $details = trim($details);
        $details = ucwords($details);

        if ($eid) {
            # code...
            $query = "UPDATE `events` SET `Name`= '$name', `Date` = '$date',
            `Details` = '$details' WHERE ID = '$eid'";

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
    }
?>