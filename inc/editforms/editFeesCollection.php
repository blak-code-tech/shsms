<?php
require('../../config/config.php');
require('../../config/db.php');


    if (isset($_POST['eid'])) {
        
        $eid = $_POST['eid'];
        $paidAmount = $_POST['editPaidAmount'];
        $balance = $_POST['editBalance'];
        $arrears = $_POST['editArrears'];
        $remarks = $_POST['editRemarks'];

        if ($eid) {
            # code...
            $query = "UPDATE `feescollection` SET `PaidAmount`= '$paidAmount', `Balance` = '$balance',
            `Arrears` = '$arrears', `Remarks` = '$remarks' WHERE ID = $eid";

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