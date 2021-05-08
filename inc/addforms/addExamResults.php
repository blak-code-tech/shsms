<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['RegNo'])){
    
    $id = $_POST['RegNo'];
    $category = $_POST['Category'];
    $score = $_POST['Score'];
    $subject = $_POST['Subject'];
    $grade = $_POST['Grade'];
    $date = date("Y-m-d");
    $gradedBy = $_SESSION['fname'].' '. $_SESSION['lname'].'('.$_SESSION['UserType'].')';

    $query="SELECT * FROM `students` WHERE StudentID = '$id'";

    $checkStudent = mysqli_query($conn, $query);

    if (!$checkStudent) {
        die('Query failed: '.mysqli_error($conn));
        echo 'Query failed: '.mysqli_error($conn);
   }else{
        
        $row = mysqli_fetch_array($checkStudent);

        $form = $row['ClassID'];

        $query="SELECT * FROM `exams` WHERE StudentID = '$id'AND ExamCategory = $category AND Class = $form;";

        $validate = mysqli_query($conn, $query);

        if(!$validate){
            die('Query failed: '.mysqli_error($conn));
            echo 'Query failed: '.mysqli_error($conn);
        }
        else{
            $rowcount = mysqli_num_rows($validate);

            if($rowcount >= 1){
                echo 'Only a result is allowed for every class in every term.';
            }
            else{

                $query = "INSERT INTO `exams`(`StudentID`,`ExamCategory`,`Score`,`Class`,`Subject`,`Grade`,`DOG`,`GradedBy`) 
                VALUES ('$id',$category,$score,$form,$subject,'$grade','$date','$gradedBy')";

                $check = mysqli_query($conn, $query);

                if (!$check) {
                    die('Query failed: '.mysqli_error($conn));
                    echo 'Query failed yim: '.mysqli_error($conn);
                }else{
                    echo "OK.";
                }
            }
        }
   }
    
}
?>