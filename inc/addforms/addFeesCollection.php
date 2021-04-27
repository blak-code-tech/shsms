<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['RegNo'])){

    $regNo = $_POST['RegNo'];
    $paidAmount = $_POST['PaidAmount'];
    $balance = $_POST['Balance'];
    $arrears = $_POST['Arrears'];
    $remarks = $_POST['Remarks'];
    $date = date("Y-m-d");
     
    $query = "INSERT INTO `feescollection`(`Student`,`PaidAmount`, `Balance`, `Arrears`, `Remarks`, `Date`) 
    VALUES ('$regNo','$paidAmount','$balance','$arrears','$remarks','$date')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>