<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['eid'])) {
        
        $eid = $_POST['eid'];
        $bname = $_POST['editBankName'];
        $acc = $_POST['editAccNo'];
        
        if ($eid) {
            # code...
            $query = "UPDATE `banks` SET `Name`= '$bname', `Account_No` = '$acc' WHERE ID = $eid";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));
                echo 'Query failed'.mysqli_error($conn);
            }else{
                echo "OK.";
                //header("location: http://localhost/shsms/banks.php");
            }
        }
    }
?>