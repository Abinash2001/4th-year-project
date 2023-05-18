<?php
    include('dbconnection.php');
    session_start();
    // $userID=9876543210;
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
    }

    $sql11="select * from `key` where user_id=$userID";
    $query11=$conn->query($sql11);
    $row11=$query11->fetch_assoc();
    $user_private_key=$row11['private_key'];
    $iv_hex11=$row11['iv'];
    $iv11=hex2bin($iv_hex11);
    function decryptFile($sourceFile, $destinationFile, $key, $iv) {
        $cipher = "aes-256-cbc";
        $options = OPENSSL_RAW_DATA;
        $fileContent = file_get_contents($sourceFile);
        $decryptedData = openssl_decrypt($fileContent, $cipher, $key, $options, $iv);
        file_put_contents($destinationFile, $decryptedData);
    }

    function encryptFile($sourceFile, $destinationFile, $key, $iv) {
        $cipher = "aes-256-cbc";
        $options = OPENSSL_RAW_DATA;
        $fileContent = file_get_contents($sourceFile);
        $encryptedData = openssl_encrypt($fileContent, $cipher, $key, $options, $iv);
        file_put_contents($destinationFile, $encryptedData);
    }
    if(isset($_POST['submit']))
    {
        $sql1="SELECT * FROM `key` WHERE id=1";
        $query1=$conn->query($sql1);
        $row1=$query1->fetch_assoc();
        $public_key=$row1['public_key'];
        $iv_hex=$row1['iv'];
        $iv=hex2bin($iv_hex);
        $key = openssl_random_pseudo_bytes(16);


        // $msg=$_POST['message'];
        if(isset($_POST['message']) && isset($_FILES['file'])){
            openssl_public_encrypt($_POST['message'],$msg, $public_key);
            $msg=bin2hex($msg);
            // $file=$_POST['file'];
            $file_file=$_FILES['file'];
            $file_file_name=$file_file['name'];
            $file_file_path=$file_file['tmp_name'];
            $destfile_file="image/".$file_file_name;
            encryptFile($file_file_path, $destfile_file, $key, $iv);
    
            $sql="INSERT INTO `report`(`msg`, `file`) VALUES ('$msg','$destfile_file')";
            mysqli_query($conn,$sql);
        }
        else if($_POST['message']){
            openssl_public_encrypt($_POST['message'],$msg, $public_key);
            $msg=bin2hex($msg);
            $sql="INSERT INTO `report`(`msg`) VALUES ('$msg')";
            mysqli_query($conn,$sql);
        }
        else if($_FILES['file']){
            // openssl_public_encrypt($_POST['message'],$msg, $public_key);
            $file_file=$_FILES['file'];
            $file_file_name=$file_file['name'];
            $file_file_path=$file_file['tmp_name'];
            $destfile_file="image/".$file_file_name;
            encryptFile($file_file_path, $destfile_file, $key, $iv);
            $sql="INSERT INTO `report`( `file`) VALUES ('$destfile_file')";
            mysqli_query($conn,$sql);
        }
    }
    $sql1="SELECT * FROM `registration` WHERE id=$userID";
    $query1=$conn->query($sql1);
    $row1 = $query1->fetch_assoc();
    // $sql="select * from event_registration where status=1";
    $currentDateTime = time();
    $sql="select * from `event_registration` where $currentDateTime > UNIX_TIMESTAMP(CONCAT(end_date, ' ', end_time))";
    $query=$conn->query($sql);
    $encryptedFilePath = $row1['user_pic'];
    $user_pic = "image/user_pic.jpg"; // Specify the destination file path for the decrypted file
    decryptFile($encryptedFilePath, $user_pic, $user_private_key, $iv11);
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
    <link rel="stylesheet" href="secret.css">
    <title>Result</title>
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
                <button id="mbtn" >Contact Us</button>
            </li>
            <li>
                <!-- <img class="profile_link" src="<?php //echo $user_pic?>" alt="Profile"  onclick="toggleMenu()"> -->
                <img class="profile_link" src="<?php echo $row1['user_pic']?>" alt="Profile"  onclick="toggleMenu()">
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
<div id="modalDialog" class="modal">
        <div class="modal-content animate-top">
            <div class="modal-header">
                <h5 class="modal-title">Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="post" id="contactFrm">
            <div class="modal-body">
                <!-- Form submission status -->
                <div class="response"></div>
                
                <div class="form-group">
                    <label>Message:</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Your message here" rows="6"></textarea>
                </div>
                <div class="file">
                    <label>File:</label>
                    <input type="file" name="file" id="file" class="file" >
                </div>
            </div>
            <div class="modal-footer">
                <!-- Submit button -->
                <button type="submit" name="submit" >Submit</button>
            </div>
            </form>
        </div>
    </div>
<div class="region_container">
    <h1 class="heading" >Result</h1>
    <?php
        $eventIDArray=array();
        $i=0;
        while($row = $query->fetch_assoc()){
            $eventIDArray[$i]=intval($row['id']);
            $sql11="select * from vote where user_id=$userID and event_id={$row['id']} ";
                $query11=$conn->query($sql11);
                if(mysqli_num_rows($query11)>0)
                {
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
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
    <div class="submit">
      <button onclick="back()">Back</button>
      </div> 
  </div>
</body>
</html>


<script>
var modal = $('#modalDialog');

// Get the button that opens the modal
var btn = $("#mbtn");

// Get the  element that closes the modal
var span = $(".close");

$(document).ready(function(){
    // When the user clicks the button, open the modal 
    btn.on('click', function() {
        modal.show();
    });
    
    // When the user clicks on  (x), close the modal
    span.on('click', function() {
        modal.hide();
    });
});
    let subMenu = document.getElementById("subMenu");
    
    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>
<script type="text/javascript">
    function back(){
    window.location.assign("region.php");
  }
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