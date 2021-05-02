<?php
require('../../config/config.php');
require('../../config/db.php');
require('../../config/fetch_data.php');

if(isset($_POST['StaffID'])){

    $id = $_POST['StaffID'];
    $fname = $_POST['FirstName'];
    $lname = $_POST['LastName'];
    $dob = $_POST['DOB'];
    $gender = $_POST['Gender'];
    $email = generateEmail($fname,$lname,$conn,'staff');
    $phone = $_POST['Phone'];
    $position = $_POST['Position'];
    $pass = encrypt_decrypt('pass', 'encrypt');
    
    $query = "INSERT INTO `staff`(`StaffID`,`FirstName`, `LastName`,`Position`, `Gender`, `DOB`, `Email`, `Phone`, `Passwords`) 
    VALUES ('$id','$fname','$lname',$position,'$gender','$dob','$email','$phone','$pass')";
    
    $check = mysqli_query($conn, $query);

    if (!$check) {
        die('Query failed'.mysqli_error($conn));
        echo 'Query failed'.mysqli_error($conn);
    }else{
        echo '{'.$email.'}'.'OK.';
    }
}
?>