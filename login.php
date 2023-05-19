<!-- <?php
// if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login']))
// {
//     session_start();
//     include('dbconnection.php');
//     $userId=$_POST["user_id"];
//     $pass=$_POST["password"];
//     $sql1="select * from `key` where user_id=$userId";
//     $query1=mysqli_query($conn,$sql1);
//     $row1=$query1->fetch_assoc();
//     $public_key=$row1['public_key'];
//     openssl_public_encrypt($pass, $password, $public_key);
//     $sql="Select * from `user_details` where `id`='$userId' && `status`='active'";
//     $result=mysqli_query($conn,$sql);
//     $num=mysqli_num_rows($result);
//     if($num==1)
//     {
//         $row=$result->fetch_assoc();
//         $pass=$row['password'];
//         $pass=bin2hex($pass);
//         // $password=hex2bin($password);
//         if($password==$pass)
//         {
//             $sql="Select * from `user_details` where `id`='$userId' && `password`='$password'";
//             $result=mysqli_query($conn,$sql);
//             $num=mysqli_num_rows($result);
//             if($num==1)
//             {  
//                 $_SESSION['userId']=$userId;
//                 header("location:otp.php");
//             }
//         }
//         else{
//             echo '<script>alert("Wrong user Id or Password ! Please check and try again.")</script>';
//         }
//     }
//     else{
//         echo '<script>alert("Wait until your Profile is verified.")</script>';
//     }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script>
        window.history.forward();
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log In</title>
</head>
<body>
    <form class="login_form" action="#" method="post">
        <div class="login_container">
            <h1 class="login_heading">Login</h1>
            <div class="input_area">
                <input type="text" name="user_id" id="user_id" placeholder="User Id *" required autocomplete="off">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="forget">
                <a href="">Forget Password ?</a>
            </div>
            <div class="btn_section">
                <button type="submit" name="login" class="btn">Log In</button>
            </div>
            <div class="sigup">
                New Mebmer ? 
                <a href="registration.php">Sign Up Here</a>
            </div>
        </div>
    </form>
</body>
</html> -->


<?php
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login']))
{
    session_start();
    include('dbconnection.php');
    $userId=$_POST["user_id"];
    $pass=$_POST["password"];

    
    $sql="Select * from `registration` where `id`='$userId'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1){
        
        $sql1="select * from `key` where user_id=$userId";
        $query1=$conn->query($sql1);
        $row1=$query1->fetch_assoc();
        $key_hex=$row1['keys'];
        $key=hex2bin($key_hex);
        $iv_hex=$row1['iv'];
        $iv=hex2bin($iv_hex);
        
        $row=$result->fetch_assoc();
        $passw=$row['password'];
        $passw=hex2bin($passw);
        $password = openssl_decrypt($passw, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
        $num=mysqli_num_rows($result);
    
        $sql1="Select * from `registration` where `id`='$userId' && `status`='active'";
        $result1=mysqli_query($conn,$sql1);
        $num=mysqli_num_rows($result1);
        if($num==1)
        {
            if($pass==$password)
            {  
        
                $_SESSION['userId']=$userId;
                header("location:otp.php");
            }
            else{
                echo '<script>alert("Wrong user Id or Password ! Please check and try again.")</script>';
            }
        }
        else{
            echo '<script>alert("Wait until your Profile is verified.")</script>';
        }
    }
    else{
        echo '<script>alert("Wrong user Id or Password ! Please check and try again.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log In</title>
</head>
<body>
    <form class="login_form" action="#" method="post">
        <div class="login_container">
            <h1 class="login_heading">Login</h1>
            <div class="input_area">
                <input type="text" name="user_id" id="user_id" placeholder="User Id *" required autocomplete="off">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="forget">
                <a href="">Forget Password ?</a>
            </div>
            <div class="btn_section">
                <button type="submit" name="login" class="btn">Log In</button>
            </div>
            <div class="sigup">
                Don't have an account? 
                <a href="registration.php">Sign Up Here</a>
            </div>
        </div>
    </form>
</body>
</html>