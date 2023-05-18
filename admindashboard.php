<?php
    session_start();
    include('dbconnection.php');
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
    }
    // $userID=9876543210;
    $sql1="SELECT * FROM `registration` WHERE id=$userID";
    $query1=$conn->query($sql1);
    $row1  = $query1->fetch_assoc();
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
                    <!-- <img class="profile_link" src="image/new_pic1.jpg" alt="Profile Icon"> -->
                    <img class="profile_link" src="<?php echo $row1['user_pic']?>" alt="Profile Icon">
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
