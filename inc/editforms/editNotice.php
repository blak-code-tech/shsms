<?php
require('../../config/config.php');
require('../../config/db.php');

    //Handle Edit form submission
    if (isset($_POST['editSubmit'])) {
        
        var_dump($_POST);
        $eid = $_POST['eid'];
        $name = $_POST['editNoticeName'];
        $name = trim($name);
        $name = ucwords($name);
        $date = $_POST['editNoticeDate'];
        $details = $_POST['editNoticeDetails'];
        $details = trim($details);
        $details = ucwords($details);
        $postBy = '('.$_SESSION['UserType'].') '.$_SESSION['fname'].' '.$_SESSION['lname'];

        if ($eid) {
            # code...
            $query = "UPDATE `notices` SET `Name`= '$name', `Date` = '$date',
            `Description` = '$details', `Posted_By`= '$postBy' WHERE ID = '$eid'";

            $check = mysqli_query($conn, $query);

            if (!$check) {
                die('Query failed'.mysqli_error($conn));   
            }else{
                $msg = "Record updated successfully..";
                $msgClass = "alert-success";
                echo "all good";
                header("location: http://localhost/shsms/notices.php");
            }
        }
    }
?>