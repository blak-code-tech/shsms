<?php 
   

function getrecentfees($table){
	include("config/db.php");
 $sql="SELECT * FROM $table ORDER BY id DESC LIMIT 10";
    if ($result=mysqli_query($conn,$sql))
      {
      // Return the number of rows in result set
      $rowcount=mysqli_num_rows($result);
     if ($rowcount==0) {
     	# code...
     	echo "No Recent Fees";
     }
     foreach ($result as $recentfees => $feesdetails) {
        $StudentID=$feesdetails['Student'];
        $BalanceID=$feesdetails['Balance'];
        $getfullname=sqlValue("SELECT FullName FROM students WHERE id='$StudentID'");
        $getbalance=sqlValue("SELECT Balance FROM students WHERE id='$BalanceID'");
     	# code...
     	echo '<tr>
        <td>'.$feesdetails['id'].'</td>
        <td>'.$getfullname.'</td>
        <td>'.$feesdetails['PaidAmount'].'</td>
        <td>'.$getbalance.'</td></tr>';
 }
      }
    mysqli_close($conn);

}


function getitems($table){
   require('config/db.php');

   $query="SELECT * FROM $table";
   $result = mysqli_query($conn, $query);
   if($result){
       if($table === "positions"){
            while ($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row["ID"].'">'.$row["Position"].'</option>';
            }
       }
       else if($table === "examcategory"){
            while ($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row["ID"].'">'.$row["Term"].' ('.$row["Section"].')'.'</option>';
            }
       }
       else{
            while ($row = mysqli_fetch_assoc($result)){
                echo '<option value="'.$row["ID"].'">'.$row["Name"].'</option>';
            }
       }
   }
   else{
       echo 'failed to connect';
   }
   
   mysqli_close($conn);
}

function getstudentregs(){
   require('config/db.php');

   $query="SELECT StudentID FROM students";
   $result = mysqli_query($conn, $query);
   if($result){
       while ($row = mysqli_fetch_array($result)){
           echo '<option class="p-2" value"'.$row["StudentID"].'">'.$row["StudentID"].'</option>';
       }
   }
   else{
        die('Query failed: '.mysqli_error($conn));
        echo 'Query failed: '.mysqli_error($conn);
   }
   
   mysqli_close($conn);
}

function getitem($table,$id){
   require('config/db.php');

   $query="SELECT * FROM $table WHERE ID = $id";
   
   $check = mysqli_query($conn, $query);
   if (!$check) {
        die('Query failed: '.mysqli_error($conn));
        echo 'Query failed: '.mysqli_error($conn);
   }else{
        
        $row = mysqli_fetch_array($check);
        if($table == 'examcategory'){
            echo $row["Term"].' ('.$row["Section"].')';
        }
        else if($table == 'positions'){
            return $row["Position"];
        }
        else if($table == 'subjects'){
            return $row["Name"];
        }
        else{
            $fname = $row['FirstName'];
            echo $fname;
        }
   }
   
   mysqli_close($conn);
}

function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

#this function will generate registration no.
function generateRegNo(){
      $rand = rand(1000000000,9999999999);
      $regNo = 'REG'.$rand;
      echo $regNo;
}

#this function will generate registration no.
function generateStaffId(){
      $rand = rand(1000,9999);
      $regNo = 'stf'.$rand;
      echo $regNo;
}

function generateEmail($firstname, $lastname, $conn, $type){

    if($type === 'staff'){
        $query="SELECT Email FROM staff";
    }
    else{
        $query="SELECT Email FROM students";
    }
    
    $results = mysqli_query($conn, $query);

    if (!$results) {
        die('Query failed: '.mysqli_error($conn));
        return 'Query failed: '.mysqli_error($conn);
    }else{
        $firstname = strtolower($firstname);
        $firstname = str_replace(' ', '', $firstname);
        $lastname = strtolower($lastname);
        $lastname = str_replace(' ', '', $lastname);
        if($type === 'staff'){
            $suffix = '@edukate.edu';
        }
        else{
            $suffix = '@st.edukate.edu';
        }
        $prefix = $lastname.$firstname;
        $email = $prefix.$suffix;
        $isEqual = false;
        while ($row = mysqli_fetch_array($results)){
            if($email === $row['Email']){
                $isEqual = true;
                break;
            }
        }
        
        if($isEqual){
            $rand = rand(1000,9999);
            $prefix .= $rand;
            $email = $prefix.$suffix;
            return $email;
        }
        else{
            return $email;
        }
    }

}

?>