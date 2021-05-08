<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['CourseName'])){

    $sname = $_POST['CourseName'];

    $query = "INSERT INTO `courses`(`Name`) VALUES ('$sname')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn)); 
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>