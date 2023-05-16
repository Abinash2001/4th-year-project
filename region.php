<?php
    include('dbconnection.php');
    session_start();

    // $userID=123456789133;
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
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

        function encryptFile($sourceFile, $destinationFile, $key, $iv) {
            $cipher = "aes-256-cbc";
            $options = OPENSSL_RAW_DATA;
            $fileContent = file_get_contents($sourceFile);
            $encryptedData = openssl_encrypt($fileContent, $cipher, $key, $options, $iv);
            file_put_contents($destinationFile, $encryptedData);
        }

        // $msg=$_POST['message'];
        if(isset($_POST['message']) && isset($_POST['file'])){
            openssl_public_encrypt($_POST['message'],$msg, $public_key);
    
            // $file=$_POST['file'];
            $file_file=$_FILES['file'];
            $file_file_name=$file_file['name'];
            $file_file_path=$file_file['tmp_name'];
            $destfile_file="image/".$file_file_name;
            encryptFile($file_file_path, $destfile_file, $key, $iv);
    
            $sql="INSERT INTO `secret_msg`(`msg`, `file`,) VALUES ('$msg','$destfile_file')";
            mysqli_query($conn,$sql);
        }
        else if($_POST['message']){
            openssl_public_encrypt($_POST['message'],$msg, $public_key);
        }
        else if($_POST['file']){
            openssl_public_encrypt($_POST['message'],$msg, $public_key);
            $file_file=$_FILES['file'];
            $file_file_name=$file_file['name'];
            $file_file_path=$file_file['tmp_name'];
            $destfile_file="image/".$file_file_name;
            encryptFile($file_file_path, $destfile_file, $key, $iv);
        }
    }

    $sql1="SELECT * FROM `registration` WHERE id=$userID";
    $query1=$conn->query($sql1);
    $row1 = $query1->fetch_assoc();
    $sql="select * from event_registration where status=0";
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
    <link rel="stylesheet" href="secret.css">
    <!-- <script src="Profile.js"></script> -->
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
                <button id="mbtn" >Contact Us</button>
            </li>
            <li>
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
                <a href="result_list.php" class="sub-menu-link">
                    <!-- <img src="vote.png"> -->
                    <ion-icon class="icons" name="podium-outline"></ion-icon>
                    <p>Result</p>
                    <span></span>
                </a>
                <a class="sub-menu-link" href="logout.php">
                <!-- <a href="#" class="sub-menu-link"> -->
                    <!-- <img src="vote.png"> -->
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
    <!-- Note Part -->
    <div class="note">
      <h2>Important Note:</h2>
      <p>After casting a vote for an event, individuals are restricted from voting again, as the system only permits a single vote per person.</p>
    </div>
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
      <div class = "region_box_btn"><a href="" onclick="index(<?php echo $i ?>)" class="button">Click Here</a></div>
    </div>
    <?php
        $i++;
        $_SESSION['eventIDArray']=$eventIDArray;
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
    <input type="hidden" id="index_value" name="index_value" value="">
  </div>
   <!--------------------
        Footer Section
    ---------------------->
    <footer class="section footer">
        <div class="footer_section container grid grid_three_column">
            <div class="section_footer_about">
                <h3>About</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi nulla voluptatibus esse, cupiditate itaque est reprehenderit dolore quas earum quibusdam eaque eum nemo necessitatibus, animi dolores magnam id. Vitae.</p>
            </div>
            <div class="section_footer_service">
                <h3>Services</h3>
                <ul>
                    <li>
                        <a href="">Gov</a>
                    </li>
                    <li>
                        <a href="">private</a>
                    </li>
                    <li>
                        <a href="">organiger</a>
                    </li>
                </ul>
            </div>
            <div class="section_footer_help">
                <h3>Help</h3>
                <address>
                    <div>
                        <p>
                            <span><ion-icon name="location-outline"></ion-icon></span>
                            Kolkata, India
                        </p>
                    </div>
                    <div>
                        <p>
                            <span><ion-icon name="call-outline"></ion-icon></span>
                            <a href="">+91 8013070719</a>
                        </p>
                    </div>
                    <div>
                        <p>
                            <span><ion-icon name="mail-unread-outline"></ion-icon></span>
                            <a href="">abinashch200@gmail.com</a>
                        </p>
                    </div>
                </address>
            </div>
        </div>
        <div class="container">
            <div class="footer_social_media">
                <a href="">
                    <ion-icon class="icons" name="logo-whatsapp"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-youtube"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-linkedin"></ion-icon>
                </a>
                <a href="">
                    <ion-icon class="icons" name="logo-facebook"></ion-icon>
                </a>
            </div>
            <div class="footer_credits">
                <p>Copyrright© 2023 All rigths reverved</p>
            </div>
        </div>
    </footer>
</body>
</html>
<script>
    // Get the modal
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

// When the user clicks anywhere outside of the modal, close it
$('body').bind('click', function(e){
    if($(e.target).hasClass("modal")){
        modal.hide();
    }
});

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
    window.location.assign("voting.php");
</script>
 <?php
}
?>