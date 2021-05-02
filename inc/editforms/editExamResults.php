<?php
require('../../config/config.php');
require('../../config/db.php');

//Handle Edit form submission
if (isset($_POST['eid'])) {
    
    $eid = $_POST['eid'];
    $category = $_POST['editCategory'];
    $score = $_POST['editScore'];
    $grade = $_POST['editGrade'];
    $date = date("Y-m-d");
    $gradedBy = $_SESSION['fname'].' '. $_SESSION['lname'].'('.$_SESSION['UserType'].')';
    
    $query = "UPDATE `exams` SET `ExamCategory`= '$category', `Score` = $score,
     `Grade` = '$grade', `DOG` = '$date', `GradedBy` = '$gradedBy'  WHERE ID = $eid";

    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo "OK.";
    }
}
?>