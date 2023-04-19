<?php
  include 'config.php';
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $message = $_POST['message'];
  $sql = "INSERT INTO feedback_form (message) VALUES ('$message')";
  mysqli_query($conn, $sql);
}
if(isset($_POST["skip"])){
    header('location:login.html');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback_Page</title>
    <link rel="stylesheet" href="feedback.css">
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    

</head>
<body>
<form method="POST" action="#">
    <div class="container">
        <div class="box">
            <h3>Enter Your Feedback</h3>
        <div class="rating_box">
            <div class="emoji">
                <div id="emoji">
                <img src="Feedback_images/poor.png" alt="poor">
                <img src="Feedback_images/bad.png" alt="bad">
                <img src="Feedback_images/okay.png" alt="okay">
                <img src="Feedback_images/good.png" alt="good">
                <img src="Feedback_images/excellent.png" alt="excellent">
                </div>
            </div>
            <div class="rating">
                <i class="fas fa-star" value="0"></i>
                <i class="fas fa-star" value="1"></i>
                <i class="fas fa-star" value="2"></i>
                <i class="fas fa-star" value="3"></i>
                <i class="fas fa-star" value="4"></i>
            </div>
        </div>
            <div class="message-box">
                <textarea id="msg" name="message" cols="30" rows="10" placeholder="Message"></textarea>
            </div>

            <div class="btn_box">
            <button type="submit" name="submit" class="btn">Submit</button>
            <button type="skip" name="skip" class="btn">Skip</button>
           </div>
        </div>
    </div>
</form>

    <script src="feedback.js"></script>
</body>
</html>