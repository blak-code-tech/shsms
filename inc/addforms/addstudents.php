<?php
require('../../config/config.php');
require('../../config/db.php');

if(isset($_POST['StudentID'])){

    //Students Info
    $studentID = $_POST['StudentID'];
    $fname = $_POST['FirstName'];
    $fname = trim($fname);
    $fname = ucwords($fname);
    
    $lname = $_POST['LastName'];
    $lname = trim($lname);
    $lname = ucwords($lname);
    $dob = $_POST['DOB'];
    $gender = $_POST['Gender'];
    $classID = $_POST["Class"];
    $hostelID = $_POST['Hostel'];
    //$parentID = $_POST['Guardian'];
     
    //Parent's Info
    $parentFirstName = $_POST['ParentsFirstName'];
    $parentFirstName = trim($parentFirstName);
    $parentFirstName = ucwords($parentFirstName);
    $parentLastName = $_POST['ParentsLastName'];
    $parentLastName = trim($parentLastName);
    $parentLastName = ucwords($parentLastName);
    $parentPhone = $_POST['ParentsPhone'];
    $parentAddress = $_POST['ParentsAddress'];
    $parentEmail = $_POST['ParentsEmail'];

    $query = "INSERT INTO `parents`(`FirstName`,`LastName`, `Phone`, `HomeAddress`, `Email`) 
    VALUES ('$parentFirstName','$parentLastName','$parentPhone','$parentAddress','$parentEmail')";
    $checkParentQuery = mysqli_query($conn, $query);
    
    if (!$checkParentQuery) {
        die('Query failed: '.mysqli_error($conn));   
    }else{
        $query = "select ID from parents where Phone = '$parentPhone' and FirstName = '$parentFirstName'";
        $checkResult = mysqli_query($conn, $query);
        if (!$checkResult) {
            die('Query failed: '.mysqli_error($conn));   
        }else{
            $row = mysqli_fetch_row($checkResult);
            var_dump($row);
            $parentID = $row[0];
            $query = "INSERT INTO `students`( `StudentID`,`FirstName`, `LastName`, `Gender`, `DOB`, `HostelID`, `ClassID`,`ParentID`) 
            VALUES ('$studentID','$fname','$lname','$gender','$dob',$hostelID,$classID,$parentID)";
            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));
                echo 'Query failed'.mysqli_error($conn);
            }else{
                echo "OK."; 
            }
        }
        
    }
}

function getID($table,$data){
    require('../../config/db.php');

    $query="SELECT ID FROM $table WHERE Name = $data";

    $query_results = mysqli_query($conn, $query);
    if (!$query_results) {
            # code...
            die('Query failed: '.mysqli_error($conn));
    }else{
            $row = mysqli_fetch_array($query_results);
            $id = $row['ID'];
            echo $query_results;
    }
}
?>