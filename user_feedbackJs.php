<?php
    session_start();
    $feedbackIDArray=$_SESSION['feedbackIDArray'];
    $index=$_POST['data'];
    $_SESSION['feedbackID']=$feedbackIDArray[$index];
    // if(isset($_SESSION['eventID']))
    // {
    //     return true;
    // }
    // else{
    //     return false;
    // }
?>