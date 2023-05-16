<?php
    session_start();
    $eventIDArray=$_SESSION['eventIDArray'];
    $index=$_POST['data'];
    $_SESSION['eventID']=$eventIDArray[$index];
    // if(isset($_SESSION['eventID']))
    // {
    //     return true;
    // }
    // else{
    //     return false;
    // }
?>