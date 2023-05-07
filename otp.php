<?php
    session_start();
    include('dbconnection.php');
    if(isset($_SESSION['userId'])){
        $user_id=$_SESSION['userId'];
        $sql="select * from registration where id='$user_id'";
        $result = mysqli_query($conn,$sql);
        $count  = mysqli_num_rows($result);
        $row=$result->fetch_assoc();
        if($count==1) {
            // generate OTP
            $otp = rand(100000,999999);
        } else {
            $error_message = "Email not exists!";
        }
        include('smtp/PHPMailerAutoload.php');

        $message_body = "One Time Password for PHP login authentication is:<br/><br/>".
        $otp;
        $mail = new PHPMailer();
        // $mail->SMTPDebug  = 3;
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "d7482935@gmail.com";
        $mail->Password = "kjtyevnhutpsfthw";
        $mail->SetFrom("d7482935@gmail.com");
        $mail->isHTML(true);
        $mail->Subject = "OTP to Login";
        $mail->MsgHTML ($message_body);
        $mail->Body =$otp;
        $mail->AddAddress($row['email']);
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        $result=$mail->send();
        if (!$result) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else {
            $sql="INSERT INTO `otp_expiry`(`user_id`, `otp`, `is_expired`) VALUES ('$user_id','$otp','0')";
            $result=mysqli_query($conn,$sql);
            header('location:mail.php');
        }
    }
?>