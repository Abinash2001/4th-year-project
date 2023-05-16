<?php
// Connection the db
$server="localhost";
$username="root";
$password="";
$db="ovs";

// create the connection
$conn=mysqli_connect($server,$username,$password,$db);
if(!$conn)
{
    die("fails to connet");
}
?>