<?php
//     session_start();
//     include('dbconnection.php');
//     $user_id=$_SESSION['userId'];
//     date_default_timezone_set('Asia/Kolkata');
// $success="";
// $error_message="";
// if(!empty($_POST["submit_email"])){
//     $result = mysqli_query($conn,"SELECT*FROM registered_users WHERE email='" . $_POST["email"]." ' ");
//     $count = mysqli_num_rows($result);
//     if($count>0) {
//         //generate OTP
//         $otp = rand(100000,999999);

//         //Send OTP

//         $mail_status = sendOTP($_POST["email"],$otp);

//         if($mail_status==1) {
//             $sql="INSERT INTO `otp_expiry`(`user_id`, `otp`, `is_expired`) VALUES ('','$otp','0')";
//             // $result = mysqli_connect($conn,"INSERT INTO otp_expiry(otp,is_expired,create_at)VALUES (' " . $otp ." ',0, ' " . date("y-m-d H:i:s"). " ')");
//             $result=mysqli_query($conn,$sql);

//             $current_id = mysqli_insert_id($conn);

//             if(!empty($current_id)) {
//                 $success=1;
//             }
//         }
//     }
//     else {
//         $error_message = "Email not exists";
//     }
// }
// if(!empty($_POST["submit_otp"])) {
//     $result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp=' " . $_POST["otp"]
//     . " ' AND is_expired!=1 AND NOW() <=DATE_ADD()create_at,INTERVAL 24 HOUR)");

//     $conn = mysqli_num_rows($result);
//     if(!empty($count)) {
//         $sql="UPDATE otp_expiry SET is_expired=1 WHERE otp = ' " . $_POST["otp"] . " '";
//         $result = mysqli_query($conn,$sql);
//         // mysqli_query($conn,$sql);
//         $success = 2;
//     } else {
//         $success=1;
//         $error_message="Invali OTP!";
//     }
// }
?> 



<?php
session_start();
include('dbconnection.php');
$user_id=$_SESSION['userId'];
$success = "";
$error_message = "";
if(isset($_SESSION['userId'])) {
    $sql="select * from registration where id='$user_id'";
	$result = mysqli_query($conn,$sql);
	$count  = mysqli_num_rows($result);
    $row=$result->fetch_assoc();
	if($count>0) {
		// generate OTP
		$otp = rand(100000,999999);
		// Send OTP
		require_once("otp.php");
		$mail_status = sendOTP($row['email'],$otp);
		
		if($mail_status == 1) {
            $sql="INSERT INTO `otp_expiry`(`user_id`, `otp`, `is_expired`) VALUES ('','$otp','0')";
            $result=mysqli_query($conn,$sql);
			$current_id = mysqli_insert_id($conn);
			if(!empty($current_id)) {
				$success=1;
			}
		}
	} else {
		$error_message = "Email not exists!";
	}
}
if(!empty($_POST["submit_otp"])) {
	$result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='$otp' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 5 Minute)");
	$count  = mysqli_num_rows($result);
	if(!empty($count)) {
        $sql="UPDATE otp_expiry SET is_expired = 1 WHERE otp = '$otp'";
		$result = mysqli_query($conn,$sql);
		$success = 2;	
	} else {
		$success =1;
		$error_message = "Invalid OTP!";
	}	
}
?>



<html>
    <head>
        <title>User Login</title>
        <style>
            body{
                font-family: calibar;
            }
            .tblLogin {
                border: #95bee6 1px solid;
                background: #d1e8ff;
                border-radius:4px;
                max-width:300px;
                padding:20px 30px 20px;
                text-align: center;
            }
            .tableheader{font-size:20px}      
            .tablerow{padding:20px; }  
            .error_message {
                color: #b12d2d;
                background: #ffb5b5;
                border: #c76969 1px solid;
            }
            .message{
                width:100%;
                max-width:300px;
                padding:10px 30px;
                border-radius:4px;
                margin-bottom:5px;
            }
            .login-input{
                border:#ccc 1px solid;
                padding: 10px 20px;
                border-radius:4px;
            }
            .btnSubmit{
                padding: 10px 20px;
            }
            .btnSubmit{
                padding:10px 20px;
                background: #2c7ac5;
                border:#d1e8ff 1px solid;
                color:#fff;
                border-radius:4px;
            }

        </style>
    </head>
<body>
    <?php
        if(!empty($error_message)) {
    ?>
    <div class="message error_message"><?php echo $error_message; ?></div>
    <?php
        }
    ?>

<form name="frmUser" method="post" action="">
	<div class="tblLogin">
		<?php 
			if(empty($success == 1)) { 
		?>
		<div class="tableheader">Enter OTP</div>
		<p style="color:#31ab00;">Check your email for the OTP</p>
			
		<div class="tablerow">
			<input type="text" name="otp" placeholder="One Time Password" class="login-input" required>
		</div>
		<div class="tableheader"><input type="submit" name="submit_otp" value="Submit" class="btnSubmit"></div>
		<?php 
			} else if ($success == 2) {
        ?>
		<p style="color:#31ab00;">Welcome, You have successfully loggedin!</p>
		<?php
            sleep(2);
            if($row['type']=='admin')
            {
                header("location:admindashboard.php");
            }
            else{
                header("location:region.php");
		    }
        }
		?>
	</div>
</form>
</body></html>