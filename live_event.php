<?php
    include('dbconnection.php');
    session_start();
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
    }
    // $sql1="SELECT * FROM `registration` WHERE id=$userID";
    // $query1=$conn->query($sql1);
    // $row1 = $query1->fetch_assoc();
    // $sql="select * from event_registration where status=0";
    $currentDateTime = time();
    $sql="select * from `event_registration` where $currentDateTime < UNIX_TIMESTAMP(CONCAT(end_date, ' ', end_time))";
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
    <title>Live Event</title>
</head>
<body>
  <!-- Navbar part -->
  <div class="navbar">
    <div class="logo_container">
      <!-- <img src="logo.png" alt="LOGO" class="logo"> -->
    </div>
    <div class="profile_container">
        <ul class="login_list">
            <li>
                <img class="profile_link" src="<?php echo $row1['user_pic']?>" alt="Profile Icon">
            </li>
            <li>
              <a class="logout" href="logout.php">Log Out</a>
          </li>
        </ul>
    </div>
  </div>
   

  <div class="region_container">
    <!-- Note Part -->
    <div class="note">
      <h2>Important Note:</h2>
      <p>After casting a vote for an event, individuals are restricted from voting again, as the system only permits a single vote per person.</p>
    </div>
    <?php
        $eventIDArray=array();
        $i=0;
        // while($row = $query->fetch_assoc()){
        //     $eventIDArray[$i]=intval($row['id']);
        while ($row = $query->fetch_assoc()) {
          $startDateTime = strtotime($row['start_date'] . ' ' . $row['start_time']);
          $endDateTime = strtotime($row['end_date'] . ' ' . $row['end_time']);
      
          $currentDateTime = time();
          if($endDateTime > $currentDateTime){
    ?>
    <div class="region_box">
      <div class ="region_box_content"><h2><?php echo $row['event_name']?></h2>
      <p><?php echo $row['event_detail']?></p>
      <p><?php echo $row['start_date'].', '.$row['start_time'].' to '.$row['end_date'].', '.$row['end_time']?></p></div>
      <div class = "region_box_btn"><a href="" onclick="index(<?php echo $i ?>)" class="button">Click Here</a></div>
    </div>
    <?php
        $i++;
        $_SESSION['eventIDArray']=$eventIDArray;
        }
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
    <!-- <input type="hidden" id="index_value" name="index_value" value=""> -->
    <div class="submit">
      <button onclick="back()">Back</button>
      </div> 
  </div>
</body>
</html>
<script type="text/javascript">
  function back(){
    window.location.assign("admindashboard.php");
  }
    function index(value){
    console.log(value);
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'live_eventJs.php',
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
    window.location.assign("event_detail.php");
</script>
// <?php
}
?>