<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['ClassName'])){
    
    $cname = $_POST['ClassName'];
     
    $query = "INSERT INTO `classes`(`Name`) VALUES ('$cname')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>