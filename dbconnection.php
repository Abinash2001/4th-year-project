<?php
// Connection the db
$server="localhost";
$username="root";
$password="";
$db="user_details";

// create the connection
$conn=mysqli_connect($server,$username,$password,$db);
if(!$conn)
{
    die("fails to connet");
}
?>