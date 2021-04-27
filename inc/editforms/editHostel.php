<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['eid'])) {
        
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
                echo 'Query failed'.mysqli_error($conn);
            }else{
                echo "OK.";
            }   
        }
    }
?>