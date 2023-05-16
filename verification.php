<?php
    session_start();
    $emptyArray=$_SESSION['emptyArray'];
    $index=$_POST['data'];
    $_SESSION['id']=$emptyArray[$index];
?>


