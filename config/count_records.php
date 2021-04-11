<?php
function countrecords($table){
  include("config/db.php");
/*$recordcount=sqlValue("SELECT COUNT(*) FROM $table");*/
$query="SELECT COUNT(*) FROM $table";
$result = mysqli_query($conn, $query);
$resultArray = mysqli_fetch_array($result);
$answer = $resultArray[0];
echo $answer;
}

?>
