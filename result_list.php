<?php
    include('dbconnection.php');
    session_start();
    $userID=9876543210;
    // if(!isset($userID))
    // {
    //     header("location:login.php");
    // }
    $sql1="SELECT * FROM `registration` WHERE id=$userID";
    $query1=$conn->query($sql1);
    $row1 = $query1->fetch_assoc();
    $sql="select * from event_registration where status=1";
    $query=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="region.css">
    <link rel="stylesheet" href="Profile.css">
    <title>Region_page</title>
</head>
<body>
    <!-- Navbar part -->
    <div class="navbar">
    <div class="logo_container">
      <img src="image/logo2.png" alt="LOGO" class="logo">
    </div>
    <div class="profile_container">
        <ul class="login_list">
            <li>
                <ion-icon class="icons" name="person-circle-outline"></ion-icon>
            </li>
            <li>
                <img class="profile_link" src="<?php echo $row1['user_pic']?>" alt="Profile Icon"  onclick="toggleMenu()">
            </li>
            <!-- <li>
              <a class="logout" href="logout.php">Log Out</a>
          </li> -->
        </ul>
        <div class="sub-menu-wrap" id="subMenu">
            <div class="sub-menu">
              <div class="user-info">
                    <img src="<?php echo $row1['user_pic']?>">
                    <h3><?php echo $row1['first_name']." ".$row1['middle_name']." ".$row1['last_name']?></h3>
                </div>
                <hr>
                <a href="region.php" class="sub-menu-link">
                    <ion-icon class="icons" name="podium-outline"></ion-icon>
                    <p>Region</p>
                    <span></span>
                </a>
                <a class="sub-menu-link" href="logout.php">
                    <ion-icon class="icons" name="log-out-outline"></ion-icon>
                    <p>Logout</p>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</div>
   

  <div class="region_container">
    <?php
        $eventIDArray=array();
        $i=0;
        while($row = $query->fetch_assoc()){
            $eventIDArray[$i]=intval($row['id']);
    ?>
    <div class="region_box">
      <div class ="region_box_content"><h2><?php echo $row['event_name']?></h2>
      <p><?php echo $row['event_detail']?></p>
      <p><?php echo $row['start_date'].', '.$row['start_time'].' to '.$row['end_date'].', '.$row['end_time']?></p></div>
      <div class = "region_box_btn"><a href="" onclick="index(<?php echo $i ?>)" class="button">View Result</a></div>
    </div>
    <?php
        $i++;
        $_SESSION['eventIDArray']=$eventIDArray;
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
    <input type="hidden" id="index_value" name="index_value" value="">
  </div>
</body>
</html>
<script>

    let subMenu = document.getElementById("subMenu");
    
    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>
<script type="text/javascript">
    function index(value){
    console.log(value);
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'regionJs.php',
        type: 'POST',
        data:{
            data:value,
        }
    });
}
</script>
<?php
if(isset($_SESSION['eventID']))
{
?>
<script>
    window.location.assign("result.php");
</script>
// <?php
}
?>