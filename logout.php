<?php
include('dbconnection.php');
session_start();
$userID=$_SESSION['userId'];
mysqli_query($conn, "DELETE FROM otp_expiry WHERE user_id='$userID'");
session_unset();
header("location:login.php");
?>