<?php
session_start();
include("dbconnection.php");
$userId=$_SESSION['id'];
$sql1="select * from `key` where user_id=$userId";
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

$sql="select * from registration where id=$userId";
$query=$conn->query($sql);
$row1 = $query->fetch_assoc();

    if(isset($_POST['approve']) && $row1['status']!='active')
    {
        $sql="UPDATE registration SET `status` ='active' WHERE id = '$userId'";
        $result = mysqli_query($conn,$sql);
        unset($_SESSION["id"]);
        header('location:pending_user_verification.php');
    }
    else if(isset($_POST['reject']))
    {
        $sql="DELETE from `key` WHERE user_id  = '$userId'";
        $result = mysqli_query($conn,$sql);
        $sql="DELETE from registration WHERE id = '$userId'";
        $result = mysqli_query($conn,$sql);
        unset($_SESSION["id"]);
        header('location:pending_user_verification.php');
    }
    else if(isset($_POST['back']))
    {
        unset($_SESSION["id"]);
        header('location:active_user_verification.php');
    }
    $sql="select * from registration where type='user'&& id='$userId'";
    $query=$conn->query($sql);
    $row = $query->fetch_assoc();
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="user_detail.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <title class="title">User Details</title>
</head>

<body>
    <form action="" method='POST'>
        <div class="container">
            <h1 class="heading">E-Registration</h1>
            <h2>Aplicant's Details</h2>
            <div class="application_details">
                <div class="box">
                    <h4>Name</h4>
                    <div class="name_details boxes">
                        <div class="label">
                            <label for="">First</label>
                            <input readonly type="text" name="first_name" value="<?php echo $row['first_name']?>"/>
                        </div>
                        <div class="label">
                            <label for="">Middle</label>
                            <input readonly type="text" name="middle_name" value="<?php echo $row['middle_name']?>" />
                        </div>
                        <div class="label">
                            <label for="">Last</label>
                            <input readonly type="text" name="last_name" value="<?php echo $row['last_name']?>"/>
                        </div>
                        <div class="label">
                            <label for="">Gender</label>
                            <input readonly type="text" name="gender" value="<?php echo $row['gender']?>" />
                        </div>
                    </div>
                </div>
                <div class="box">
                    <h4>Date of Birth</h4>
                    <div class="dob_details boxes">
                    <div class="label">
                            <label for="">DOB</label>
                            <input readonly type="date" class="dob" name="dob" value="<?php echo $row['dob']?>"/>
                    </div>
                    </div>
                </div>
                <div class="box">
                    <h4>Age</h4>
                    <div class="age_box boxes">
                    <div class="label">
                            <label for="">Age</label>
                            <input readonly type="text" readonly class="age" name="age" value="<?php echo $row['age']?>" />
                    </div>
                    </div>
                </div>
            </div>
            <h2>Applicant's Address</h2>
            <div class="box">
                <h4>Permanent Address</h4>
                <div class="perma_address boxes">
                    <div class="label">
                        <label for="">House No.</label>
                        <input readonly type="text" class="perma_house" name="perma_house" value="<?php echo $row['p_house']?>"/>
                    </div>                    
                    <div class="label">
                        <label for="">Street</label>
                        <input readonly type="text" class="perma_area" name="perma_area" value="<?php echo $row['p_area']?>"/>
                    </div>
                    <div class="label">
                        <label for="">City</label>
                        <input readonly type="text" class="perma_city" name="perma_city" value="<?php echo $row['p_city']?>"/>
                    </div>
                    <div class="label">
                        <label for="">District</label>
                        <input readonly type="text" class="perma_district" name="perma_district" value="<?php echo $row['p_district']?>"/>
                    </div>
                    <div class="label">
                        <label for="">Post Office</label>
                        <input readonly type="text" class="perma_po" name="perma_po" value="<?php echo $row['p_po']?>"/>
                    </div>
                    <div class="label">
                        <label for="">Police Station</label>
                        <input readonly type="text" class="perma_ps" name="perma_ps" value="<?php echo $row['p_ps']?>"/>
                    </div>
                    <div class="label">
                        <label for="">Pin</label>
                        <input readonly type="text" class="perma_pin" name="perma_pin" value="<?php echo $row['p_pin']?>"/>
                    </div>
                <div class="label">
                            <label for="">Country</label>
                            <input readonly type="text" class="perma_country" name="perma_country" value="<?php echo $row['p_country']?>"/>
                    </div>
                </div>
            </div>
            <div class="box">
                <h4>Current Address</h4>
                <div class="curr_address boxes">
                    <div class="label">
                            <label for="">House No.</label>
                            <input readonly type="text" class="curr_house" name="curr_house" value="<?php echo $row['c_house']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Street</label>
                            <input readonly type="text" class="curr_area" name="curr_area" value="<?php echo $row['c_area']?>"/>
                    </div>
                    <div class="label">
                            <label for="">City</label>
                            <input readonly type="text" class="curr_city" name="curr_city" value="<?php echo $row['c_city']?>"/>
                    </div>
                    <div class="label">
                            <label for="">District</label>
                            <input readonly type="text" class="curr_district" name="curr_district" value="<?php echo $row['c_district']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Post Office</label>
                            <input readonly type="text" class="curr_po" name="curr_po" value="<?php echo $row['c_po']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Police Station</label>
                            <input readonly type="text" class="curr_ps" name="curr_ps" value="<?php echo $row['c_ps']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Pin</label>
                            <input readonly type="text" class="curr_pin" name="curr_pin" value="<?php echo $row['c_pin']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Country</label>
                            <input readonly type="text" class="curr_country" name="curr_country" value="<?php echo $row['c_country']?>"/>
                    </div>
                </div>
            </div>
            <?php
                $aadh=hex2bin($row['aadhar']);
                $aadhar = openssl_decrypt($aadh, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);
            ?>
            <h2>Details of voter’s photo identity card</h2>
            <div class="box">
            <div class="voter_details boxes">
                <div class="boxes_1">
                    <div class="label">
                            <label for="">Aadhar</label>
                            <input readonly type="text" name="aadhar" value="<?php echo $aadhar?>"/>
                    </div>
                    <div class="label">
                            <label for="">Phone</label>
                            <input readonly type="text" name="phone" value="<?php echo $row['phone']?>"/>
                    </div>
                    <div class="label">
                            <label for="">Email</label>
                            <input readonly type="email" name="email" value="<?php echo $row['email']?>"/>
                    </div>
                </div>
            </div>
            </div>
            <h2>Upload Documents</h2>
            <div class="upload">
                <div class="upload_area upload_area_1">
                    <?php
                    $encryptedFilePath = $row['f_aadhar_p'];
                    $f_aadhar_p = "image/upload/f_aadhar_p.jpg"; // Specify the destination file path for the decrypted file
                    decryptFile($encryptedFilePath, $f_aadhar_p, $key, $iv);
                    ?>
                    <div class="preview">
                        <img src="<?php  echo $f_aadhar_p;?>" alt="" class="file_preview a_f_img">
                    </div>
                    <label for="a_f_img">Aadhar Front Image</label>
                </div>
                <?php
                    $encryptedFilePath = $row['b_aadhar_p'];
                    $b_aadhar_p = "image/upload/b_aadhar_p.jpg"; // Specify the destination file path for the decrypted file
                    decryptFile($encryptedFilePath, $b_aadhar_p, $key, $iv);
                ?>
                <div class="upload_area upload_area_2">
                    <div class="preview">
                        <img src="<?php echo $b_aadhar_p;?>" alt="" class="file_preview a_b_img">
                    </div>
                    <label for="a_b_img">Aadhar Back Image</label>
                </div>
                <?php
                    $encryptedFilePath = $row['user_pic'];
                    $user_pic = "image/upload/user_pic.jpg"; // Specify the destination file path for the decrypted file
                    decryptFile($encryptedFilePath, $user_pic, $key, $iv);
                ?>
                <div class="upload_area upload_area_3">
                    <div class="preview">
                        <img src="<?php echo $user_pic;?>" alt="" class="file_preview voter_img">
                    </div>
                    <label for="voter_img">Voter’s Photo</label>
                </div>
            </div>
            <div class="submit">
            <?php
            if($row1['status']=='active')
            {
            ?> 
                <button type="submit" name="back">Back</button>
            <?php
            }
            else{
            ?>
            <button type="submit" name="approve">Approve</button>
            <button type="submit" name="reject">Reject</button>
            <?php
            }
            ?>
            </div> 
        </div>
        
    </form>
</body>
<script src="registration.js"></script>
</html>