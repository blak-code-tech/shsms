<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $paidAmount = $_POST['editPaidAmount'];
        $balance = $_POST['editBalance'];
        $arrears = $_POST['editArrears'];
        $remarks = $_POST['editRemarks'];

        if ($eid) {
            # code...
            $query = "UPDATE `feescollection` SET `PaidAmount`= '$paidAmount', `Balance` = '$balance',
            `Arrears` = '$arrears', `Remarks` = '$remarks' WHERE ID = '$eid'";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));   
            }else{
                $msg = "Record updated successfully..";
                $msgClass = "alert-success";
                echo "all good";
                header("location: http://localhost/shsms/feescollection.php");
            }
        }
    }
?>