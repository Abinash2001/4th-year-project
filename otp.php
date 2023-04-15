<?php

    function sendOTP($email, $otp) {
        require('phpmailer/class.phpmailer.php'); 
        require('phpmailer/class.smtp.php');


        $message_body = "One Time Password for PHP login authentication is:<br/><br/>".
        $otp:
        $mail = new PHPMailer();
        $mail->AddReplyTo('tutorialspoint2016@gmail.com', 'Technical Suneja');
                            $mail->SetFrom('tutorialspoint2016@gmail.com','Technical Suneja');
                            $mail->AddAddress ($email);
                            $mail->Subject- "OTP to Login";
                            $mail->MsgHTML ($message_body);
                            $result=$mail->send();
                            if (!$result) {
                                echo "Mailer Error: " $mail->ErrorInfo;
                            }else {
                                return $result;
                            }
        }
?>