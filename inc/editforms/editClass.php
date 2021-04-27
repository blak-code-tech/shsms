<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['eid'])) {
        

        $eid = $_POST['eid'];
        $cname = $_POST['editClassName'];

        if ($eid) {
            # code...
            $query = "UPDATE `classes` SET `Name`= '$cname' WHERE ID = $eid";

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