<?php
    if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit']))
    {
        include('dbconnection.php');
        $firstName=$_POST['first_name'];
        $middleName=$_POST['middle_name'];
        $lastName=$_POST['last_name'];
        $gender=$_POST['gender'];
        $dob=$_POST['dob'];
        $age=$_POST['age'];
        $permaHouse=$_POST['perma_house'];
        $permaArea=$_POST['perma_area'];
        $permaCity=$_POST['perma_city'];
        $permaDistrict=$_POST['perma_district'];
        $permaPo=$_POST['perma_po'];
        $permaPs=$_POST['perma_ps'];
        $permaPin=$_POST['perma_pin'];
        $permaCountry=$_POST['perma_country'];
        $currHouse=$_POST['curr_house'];
        $currArea=$_POST['curr_area'];
        $currCity=$_POST['curr_city'];
        $currDistrict=$_POST['curr_district'];
        $currPo=$_POST['curr_po'];
        $currPs=$_POST['curr_ps'];
        $currPin=$_POST['curr_pin'];
        $currCountry=$_POST['curr_country'];
        $aadhar=$_POST['aadhar'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $c_aadhar=$_POST['c_aadhar'];
        $Aphone=$_POST['a_phone'];
        $Aemail=$_POST['a_email'];
        $pass=$_POST['password'];
        $c_pass=$_POST['c_password'];

        $file_f_aadhar=$_FILES['f_aadhar_pic'];
        $file_f_aadhar_name=$file_f_aadhar['name'];
        $file_f_aadhar_path=$file_f_aadhar['tmp_name'];
        $destfile__f_aadhar="upload_image/".$file_f_aadhar_name;
        move_uploaded_file($file_f_aadhar_path,$destfile__f_aadhar);
        
        $file_b_aadhar=$_FILES['b_aadhar_pic'];
        $file_b_aadhar_name=$file_b_aadhar['name'];
        $file_b_aadhar_path=$file_b_aadhar['tmp_name'];
        $destfile__b_aadhar="upload_image/".$file_b_aadhar_name;
        move_uploaded_file($file_b_aadhar_path,$destfile__b_aadhar);
        
        $file_userPic=$_FILES['user_pic'];
        $file_userPic_name=$file_userPic['name'];
        $file_userPic_path=$file_userPic['tmp_name'];
        $destfile__userPic="upload_image/".$file_userPic_name;
        move_uploaded_file($file_userPic_path,$destfile__userPic);


        $sql="INSERT INTO `registration`(`first_name`, `middle_name`, `last_name`, `gender`, `dob`, `age`, `p_house`, `p_area`, `p_city`, `p_district`, `p_po`, `p_ps`, `p_pin`, `p_country`, `c_house`, `c_area`, `c_city`, `c_district`, `c_po`, `c_ps`, `c_pin`, `c_country`, `password`, `c_password`, `aadhar`, `c_aadhar`, `phone`, `a_phone`, `email`, `a_email`, `f_aadhar_p`, `b_aadhar_p`, `user_pic`) VALUES ('$firstName','$middleName','$lastName','$gender','$dob','$age','$permaHouse','$permaArea','$permaCity','$permaDistrict','$permaPo','$permaPs','$permaPin','$permaCountry','$currHouse','$currArea','$currCity','$currDistrict','$currPo','$currPs','$currPin','$currCountry','$pass','$c_pass','$aadhar','$c_aadhar','$phone','$Aphone','$email','$Aemail','$destfile__f_aadhar','$destfile__b_aadhar','$destfile__userPic')";
        $result=mysqli_query($conn,$sql);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="registration.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <title class="title">Register</title><!--Change the text to "Register"-->
</head>

<body>
    <form action="#" method='POST' enctype="multipart/form-data">
        <div class="container">
            <h1 class="heading">E-Registration</h1>
            <h2>Aplicant's Details</h2>
            <div class="application_details">
                <div class="box">
                    <h4>Name</h4>
                    <div class="name_details boxes">
                        <input type="text" name="first_name" placeholder="First Name*" required />
                        <input type="text" name="middle_name" placeholder="Middle Name*" />
                        <input type="text" name="last_name" placeholder="Last Name*" required />
                        <select name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>             
                    </div>
                </div>
                <div class="box">
                    <h4>Date of Birth</h4>
                    <div class="dob_details boxes">
                        <input type="date" class="dob" name="dob" placeholder="Day*" required />
                    </div>
                </div>
                <div class="box">
                    <h4>Age</h4>
                    <div class="age_box boxes">
                        <input type="text" readonly class="age" onmousemove="findAge()" name="age" placeholder="Age*" required />
                    </div>
                </div>
            </div>

            <h2>Aplicant's Address</h2>
            <div class="box">
                <h4>Permanent Address</h4>
                <div class="perma_address boxes">
                    <input type="text" class="perma_house" name="perma_house" placeholder="House no.* " required />
                    <input type="text" class="perma_area" name="perma_area" placeholder="Street/Area/Locality*" required />
                    <input type="text" class="perma_city" name="perma_city" placeholder="City*" required />
                    <input type="text" class="perma_district" name="perma_district" placeholder="District*" required />
                    <input type="text" class="perma_po" name="perma_po" placeholder="Post Office*" required />
                    <input type="text" class="perma_ps" name="perma_ps" placeholder="Police Station*" required />
                    <input type="text" class="perma_pin" name="perma_pin" placeholder="Pin Code*" required />
                    <input type="text" class="perma_country" name="perma_country" placeholder="Country*" required />
                </div>
            </div>
            <div class="checkbox_div">
                <input type="checkbox" class="checkbox" id="chk" onclick="address_function()" name="checkbox">
                <label for="Address">Current Address same as Permanent Address</label>
            </div>
            
            <div class="box">
                <div class="curr_address boxes">
                    <input type="text" class="curr_house" name="curr_house" placeholder="House no.*" required />
                    <input type="text" class="curr_area" name="curr_area" placeholder="Street/Area/Locality*" required />
                    <input type="text" class="curr_city" name="curr_city" placeholder="City*" required />
                    <input type="text" class="curr_district" name="curr_district" placeholder="District*" required />
                    <input type="text" class="curr_po" name="curr_po" placeholder="Post Office*" required />
                    <input type="text" class="curr_ps" name="curr_ps"placeholder="Police Station*" required />
                    <input type="text" class="curr_pin" name="curr_pin" placeholder="Pin Code*" required />
                    <input type="text" class="curr_country" name="curr_country" placeholder="Country*" required />
                </div>
            </div>


            <h2>Details of voter’s photo identity card</h2>
            <div class="box">
            <div class="voter_details boxes">
                <div class="boxes_1">
                    <input type="text" name="aadhar" placeholder="Aadhar no.* " required />
                    <input type="text" name="phone" placeholder="Phone No.*" required />
                    <input type="email" name="email" placeholder="Email*" required />
                </div>
                <div class="boxes_1">
                    <input type="text" name="c_aadhar" placeholder="Confirm Aadhar No.*" required />
                    <input type="text" name="a_phone" placeholder="Alternate Phone No.*" required />
                    <input type="email" name="a_email" placeholder="Alternate email*" required />
                </div>
            </div>
            </div>
            <h2>Create Password</h2>
            <div class="box">
                <div class="boxes_2" >
                    <input type="password" id="password" name="password" placeholder="Password*" required >
                    <p id="strength_message"></p>
                </div>
                <div class="boxes_2" >
                    <input type="password" id="cpassword" name="c_password" placeholder="Confirm Password*" required >
                    <p id="message"></p>
                </div>
                <!-- <p>abinash</p> -->
            </div>
            <h2>Upload Documents</h2>
            <div class="upload">
                <div class="upload_area upload_area_1">
                    <!-- preview box -->
                    <div class="preview">
                        <img src="" alt="" class="file_preview a_f_img">
                    </div>
                    <label for="a_f_img">Aadhar Front Image</label>
                    <input type="file" id="a_f_img" name="f_aadhar_pic" accept="image/*"onchange="showPreview1(event)">
                </div>
                <div class="upload_area upload_area_2">
                    <!-- preview box -->
                    <div class="preview">
                        <img src="" alt="" class="file_preview a_b_img">
                    </div>
                    <label for="a_b_img">Aadhar Back Image</label>
                    <input type="file" id="a_b_img" name="b_aadhar_pic" accept="image/*" onchange="showPreview2(event)">
                </div>
                <div class="upload_area upload_area_3">
                    <!-- preview box -->
                    <div class="preview">
                        <img src="" alt="" class="file_preview voter_img">
                    </div>
                    <label for="voter_img">Voter’s Photo</label>
                    <input type="file" id="voter_img" name="user_pic" accept="image/*" onchange="showPreview3(event)">
                </div>
            </div>
            
            <div class="submit">
            <button type="submit" name="submit">Submit</button>
            </div>
        </div>
        
    </form>
</body>
<script src="registration.js"></script>
</html>