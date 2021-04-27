<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['SubjectName'])){

    $sname = $_POST['SubjectName'];

    $query = "INSERT INTO `subjects`(`Name`) VALUES ('$sname')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn)); 
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
        //header("location: http://localhost/shsms/subjects.php");
    }
}
?>