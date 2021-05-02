<?php
require('../../config/config.php');
require('../../config/db.php');
include('../../config/fetch_data.php');

    //Handle Edit form submission
    if (isset($_POST['pid'])) {
        
        $pid = $_POST['pid'];
        $pass = encrypt_decrypt($_POST['editNewPassword'], 'encrypt');

        if ($pid) {
            # code...
            $type = $_SESSION['UserType'];
            
            if($type === 'admin'){
                $query = "UPDATE `admins` SET `Passwords`= '$pass' WHERE ID = $pid";
            }
            else if($type === 'staff'){
                $query = "UPDATE `staff` SET `Passwords`= '$pass' WHERE StaffID = '$pid'";
            }
            else if($type === 'student'){
                $query = "UPDATE `students` SET `Passwords`= '$pass' WHERE StudentID = '$pid'";
            }

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