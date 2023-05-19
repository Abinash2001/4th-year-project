<?php
    session_start();
    include('dbconnection.php');
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
    }

    $sql1="select * from `key` where user_id=$userID";
    $query1=$conn->query($sql1);
    $row1=$query1->fetch_assoc();
    $key_hex=$row1['keys'];
    $key=hex2bin($key_hex);
    $iv_hex=$row1['iv'];
    $iv=hex2bin($iv_hex);
    function decryptFile($sourceFile, $destinationFile, $key, $iv) {
        $cipher = "aes-256-cbc";
        $options = OPENSSL_RAW_DATA;
        $fileContent = file_get_contents($sourceFile);
        $decryptedData = openssl_decrypt($fileContent, $cipher, $key, $options, $iv);
        file_put_contents($destinationFile, $decryptedData);
    }
    $sql1="SELECT * FROM `registration` WHERE id=$userID";
    $query1=$conn->query($sql1);
    $row1  = $query1->fetch_assoc();
    $encryptedFilePath = $row1['user_pic'];
    $user_pic = "image/upload/user_pic.jpg"; // Specify the destination file path for the decrypted file
    decryptFile($encryptedFilePath, $user_pic, $key, $iv);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admindashboard.css">
    <title>Admin</title>
</head>
<body>
    <div class="navbar">
        <div class="logo_container">
          <img src="image/logo2.png" alt="LOGO" class="logo">
        </div>
        <div class="profile_container">
            <ul class="login_list">
                <li>
                    <img class="profile_link" src="<?php echo $user_pic?>" alt="Profile Icon">
                </li>
                <li>
                  <a class="logout" href="logout.php">Log Out</a>
              </li>
            </ul>
        </div>
    </div>
    <div class="admin_container">
        <div class="box">
            <h2>Event Details</h2>
            <div class="admin_box">
                <div class="admin_boxs">
                    <a href="live_event.php">Live Events</a>
                </div>
                <div class="admin_boxs">
                    <a href="previous_event.php">Previous Events</a>
                </div>
                <div class="admin_boxs">
                    <a href="event_registration.php">New Event Registration</a>
                </div>
            </div>
        </div>
        <!-- <div class="box">
            <h2>Organizer Vote Details</h2>
            <div class="admin_box">
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
            </div>
        </div>
        <div class="box">
            <h2>Goverment Vote Details</h2>
            <div class="admin_box">
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
                <div class="admin_boxs">
                    <a href="">Total Live Votes<span>100</span></a>
                </div>
            </div>
        </div> -->
        <div class="box">
            <h2>User Details</h2>
            <div class="admin_box">
                <div class="admin_boxs">
                    <a href="active_user_verification.php">Active User's Verification</a>
                </div>
                <div class="admin_boxs">
                    <a href="pending_user_verification.php">Pending User's Verification</a>
                </div>
                <div class="admin_boxs">
                    <a href="user_feedback.php">User's Feedback</a>
                </div>
                
            </div>
        </div>
        <div class="box">
            <h2>Issue Report Details</h2>
            <div class="admin_box"> 
                <div class="admin_boxs">
                    <a href="report_issue.php">Report</a>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
