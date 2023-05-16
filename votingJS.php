<?php
include('dbconnection.php');
session_start();
// $json=$_POST['json'];
// if (is_array($json)) {
//     $array = $json;
// } else {
//     $array = json_decode($json, true);
// }
$condidateIdArray=$_SESSION['condidateIdArray'];
$index=$_POST['data'];
$candID=$condidateIdArray[$index];
$userId=$_SESSION['userId'];
$eventId=$_SESSION['eventID'];
$sql="INSERT INTO `vote`(`user_id`, `candi_id`, `event_id`) VALUES ('$userId','$candID','$eventId')";
mysqli_query($conn,$sql);
// unset($_SESSION["eventID"]);
// header("location:region.php");
?>