<?php
    session_start();
    if(isset($_POST['submit']))
    {
        include('dbconnection.php');

        // $userID=$_SESSION['userId'];
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
            $file_file_name=$file_f_aadhar['name'];
            $file_file_path=$file_f_aadhar['tmp_name'];
            $destfile_file="image/".$file_f_aadhar_name;
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
            $file_file_name=$file_f_aadhar['name'];
            $file_file_path=$file_f_aadhar['tmp_name'];
            $destfile_file="image/".$file_f_aadhar_name;
            encryptFile($file_file_path, $destfile_file, $key, $iv);
        }

    }
?>


<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Secret Message</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="secret.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
    <div class="container">
    <h2>Popup Contact Form with Email</h2>
    
    <!-- Trigger/Open The Modal -->
    <button id="mbtn" class="btn btn-primary turned-button">Contact Us</button>
    
    <!-- The Modal -->
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
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>


// $(document).ready(function(){
//         $('#contactFrm').submit(function(e){
//             e.preventDefault();
//             $('.modal-body').css('opacity', '0.5');
//             $('.btn').prop('disabled', true);
            
//             $form = $(this);
//             $.ajax({
//                 type: "POST",
//                 url: 'secretJs.php',
//                 data: 'contact_submit=1&'+$form.serialize(),
//                 dataType: 'json',
//                 success: function(response){
//                     if(response.status == 1){
//                         $('#contactFrm')[0].reset();
//                         $('.response').html(''+response.message+'');
//                     }else{
//                         $('.response').html(''+response.message+'');
//                     }
//                     $('.modal-body').css('opacity', '');
//                     $('.btn').prop('disabled', false);
//                 }
//             });
//         });
//     });
/*
 * Modal popup
 */
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
</script>


    </body>
</html>

