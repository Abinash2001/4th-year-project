<?php
    function sendOTP($email, $otp) {
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
        $mail->Subject = "OTP to Login";
        $mail->MsgHTML ($message_body);
        $mail->Body =$otp;
        $mail->AddAddress($email);
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
            return $result;
        }
        // if(!$mail->Send()){
        //     echo $mail->ErrorInfo;
        // }else{
        //     return 'Sent';
        // }






    //     // $mail->AddReplyTo('namanch2001@gmail.com', 'abiansh Kumar Chourasia');
    //     // $mail->SetFrom('namanch2001@gmail.com','abiansh Kumar Chourasia',0);
    //     // $mail->AddAddress ($email);
    //     // $mail->Subject= "OTP to Login";
    //     // $mail->MsgHTML ($message_body);
        
    //     $mail->isSMTP();                                         
    //     $mail->Host       = 'smtp.example.com';                     
    //     $mail->SMTPAuth   = true;                                   
    //     $mail->Username   = 'd7482935@gmail.com';                     
    //     $mail->Password   = 'lqbezwcpisujmtmd';                              
    //     $mail->SMTPSecure = 'ssl';    
    //     $mail->Port       = 25;
        
    //     $mail->SetFrom('d7482935@gmail.com','Hacker Devil');
    //     $mail->AddAddress ($email);
    //     $mail->isHTML(true);                                  //Set email format to HTML
    //     $mail->Subject= "OTP to Login";
    //     $mail->MsgHTML ($message_body);

    // // $mail->Subject = 'Here is the subject';
    // // $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    // // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //     $result=$mail->send();
    //     if (!$result) {
    //         echo "Mailer Error: " . $mail->ErrorInfo;
    //     }else {
    //         return $result;
    //     }
    }
?>