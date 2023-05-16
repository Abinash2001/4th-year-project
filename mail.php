<?php
$error_message = "";


session_start();
if(empty($_SESSION['userId']))
{
  header('location:login.php');
}
$userId=$_SESSION['userId'];
include('dbconnection.php');
if(!empty($_POST["submit_otp"])) {
    $otp=$_POST['otp'];
	$result = mysqli_query($conn,"SELECT * FROM otp_expiry WHERE otp='$otp' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 5 Minute)");
	$count  = mysqli_num_rows($result);
	if(!empty($count)) {
        $sql="UPDATE otp_expiry SET is_expired = 1 WHERE otp = '$otp'";
		$result = mysqli_query($conn,$sql);
        $sql="select * from registration where id='$userId'";
        $query=$conn->query($sql);
        $row = $query->fetch_assoc();
        if($row['type']=='admin')
            {
                header("location:admindashboard.php");
            }
            else{
                header("location:region.php");
		    }
	} else {
		$error_message = "Invalid OTP!";
	}	
}
?>

<html>
    <head>
    <script>
        window.history.forward();
</script>
        <title>User Login</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                font-family: calibar;
            }
            /* html{
                font-size: 62.5%;
            } */
            .mail_container{
                display: flex;
                flex-direction: column;
                height: 100vh;
                justify-content: center;
                align-items: center;
            }
            .tblLogin {
                background: #d1e8ff;
                border-radius: 4px;
                /* max-width: 356px; */
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 400px;
                height: 300px;
                padding: 20px 30px 20px;
                text-align: center;
                border: #95bee6 1px solid;
            }
            .tableheader{font-size:20px;
            margin: 2rem;
            }      
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
                width: 285px;
                text-align: center;
            }
            .submit{
                margin: 1rem;
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
    <div class="mail_container" >
        <?php
            if(!empty($error_message)) {
        ?>
        <div class="message error_message"><?php echo $error_message; ?></div>
        <?php
            }
        ?>
    
        <form name="frmUser" method="post" action="">
            <div class="tblLogin">
                <div class="tableheader">Enter OTP</div>
                <p style="color:#31ab00;">Check your email for the OTP</p>
                <div class="tablerow">
                    <input type="text" name="otp" placeholder="One Time Password" class="login-input" required>
                </div>
                <div class="submit"><input type="submit" name="submit_otp" value="Submit" class="btnSubmit"></div>
            </div>
        </form>
    </div>
</body>
</html>