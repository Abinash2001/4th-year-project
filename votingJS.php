<?php
echo "<script>alert('bskd');</script>";
include('dbconnection.php');
$json=$_POST['json'];
if (is_array($json)) {
    $array = $json;
} else {
    $array = json_decode($json, true);
}
$index=$_POST['data'];
$candID=$array[$index];
$userId=$_POST['userid'];
$eventId=$_POST['eventid'];
$sql="INSERT INTO `vote`(`user_id`, `candi_id`, `event_id`) VALUES ('$userId','$candID','$eventId')";
mysqli_query($conn,$sql);
// header("location:region.php");
?>