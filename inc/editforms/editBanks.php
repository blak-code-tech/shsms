<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $bname = $_POST['editBankName'];
        $acc = $_POST['editAccNo'];

        if ($eid) {
            # code...
            $query = "UPDATE `banks` SET `Name`= '$bname', `Account_No` = '$acc' WHERE ID = $eid";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));   
            }else{
                $msg = "Record updated successfully..";
                $msgClass = "alert-success";
                echo "all good";
                header("location: http://localhost/shsms/banks.php");
            }
        }
    }
?>