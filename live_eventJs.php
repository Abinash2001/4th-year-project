<?php
    session_start();
    $eventIDArray=$_SESSION['eventIDArray'];
    $index=$_POST['data'];
    $_SESSION['eventID']=$eventIDArray[$index];
?>