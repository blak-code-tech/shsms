<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['RegNo'])){
    
    $id = $_POST['RegNo'];
    $category = $_POST['Category'];
    $score = $_POST['Score'];
    $grade = $_POST['Grade'];
    $date = date("Y-m-d");
    $gradedBy = $_SESSION['fname'].' '. $_SESSION['lname'].'('.$_SESSION['UserType'].')';
    
    $query = "INSERT INTO `exams`(`StudentID`,`ExamCategory`,`Score`,`Grade`,`DOG`,`GradedBy`) 
    VALUES ('$id',$category,$score,'$grade','$date','$gradedBy')";
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed: '.mysqli_error($conn));
        echo 'Query failed: '.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>