<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $hname = $_POST['editName'];
        $status = $_POST['editStatus'];

        if ($eid) {
            # code...
            $query = "UPDATE `hostels` SET `Name`= '$hname',
            `Status` = '$status' WHERE ID = $eid";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));   
            }else{
                $msg = "Record updated successfully..";
                $msgClass = "alert-success";
                echo "all good";
                header("location: http://localhost/shsms/hostels.php");
            }
        }
    }
?>