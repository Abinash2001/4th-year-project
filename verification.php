<!-- <?php
    // include('dbconnection.php');
    // if(isset($_POST['userId'])) {
    //     $user_id=$_POST['userId'];
    //     $sql="select * from registration where id='$user_id'";
    //     $result = mysqli_query($conn,$sql);
    //     $count  = mysqli_num_rows($result);
    //     $row=$result->fetch_assoc();
    //     if($count==1) {
    //         // generate OTP
    //         $otp = rand(100000,999999);
    //         // Send OTP
    //         require_once("otp.php");
    //         $mail_status = sendOTP($row['email'],$otp);
    //         if($mail_status == 1) {
    //             $sql="INSERT INTO `otp_expiry`(`user_id`, `otp`, `is_expired`) VALUES ('$user_id','$otp','0')";
    //             $result=mysqli_query($conn,$sql);
    //             $current_id = mysqli_insert_id($conn);
    //             if(!empty($current_id)) {
    //                 $success=1;
    //             }
    //         }
    //     } else {
    //         $error_message = "Email not exists!";
    //     }
    // }	
?> -->

<?php
    session_start();
    $emptyArray=$_SESSION['emptyArray'];
    $index=$_POST['data'];
    $_SESSION['id']=$emptyArray[$index];
    // if(isset($_SESSION['eventID']))
    // {
    //     return true;
    // }
    // else{
    //     return false;
    // }
?>


