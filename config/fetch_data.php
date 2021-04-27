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
            echo '<option class="p-2" value="'.$row["ID"].'">'.$row["Position"].'</option>';
        }
       }
       while ($row = mysqli_fetch_assoc($result)){
           echo '<option class="p-2" value="'.$row["ID"].'">'.$row["Name"].'</option>';
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
       echo 'failed to connect';
   }
   
   mysqli_close($conn);
}

function getitem($table,$id){
   require('config/db.php');

   $query="SELECT * FROM $table WHERE ID = $id";
   $check_edit = mysqli_query($conn, $query);
   if (!$check_edit) {
         # code...
         die("Cannot connect");
   }else{
         $row = mysqli_fetch_array($check_edit);
         $fname = $row['FirstName'];
         echo $fname;
   }
   
   mysqli_close($conn);
}

#this function will generate registration no.
function generateRegNo(){
      $rand = rand(1000000000,9999999999);
      $regNo = 'Reg'.$rand;
      echo $regNo;
}

#this function will generate registration no.
function generateStaffId(){
      $rand = rand(1000,9999);
      $regNo = 'stf'.$rand;
      echo $regNo;
}

function generateEmail($table,$email){
    require('config/db.php');
    $query="SELECT * FROM $table WHERE Email = $email";
   $check_edit = mysqli_query($conn, $query);
   if (!$check_edit) {
         # code...
         die("Cannot connect");
   }else{
         $row = mysqli_fetch_array($check_edit);
         $fname = $row['FirstName'];
         echo $fname;
   }
    $rand = rand(1000,9999);
    $regNo = 'stf'.$rand;
    echo $regNo;
}

function updaterecord($table, $id){
   
}


/*
if(isset($_REQUEST["eid"])){
   include("config.php");
   include("db.php");
   $id = $_REQUEST["eid"];
  if ($id != 0) {
       $query = ("SELECT * FROM students WHERE ID=$id");
       $check_edit = mysqli_query($conn, $query);

       if (!$check_edit) {
           die("Cannot connect");
       }else{
         $myObj = [];
         $row = mysqli_fetch_array($check_edit);
         $myObj[] = $row['ID'];
         $myObj[] = $row['FirstName'];
         $myObj[] = $row['LastName'];
         $myObj[] = $row['Gender'];
         $myObj[] = $row['DOB'];
         $myObj[] = $row['RegNo'];
         $myObj[] = $row['Hostel'];
         $myObj[] = $row['Class'];
         $myObj[] = $row['TotalFees'];
         $myObj[] = $row['AdvanceFees'];
         $myObj[] = $row['Balance'];
         $myObj[] = $row['Guardian'];

           $myJSON = json_encode($myObj);

           echo $myJSON;
       }
   }
}*/
?>