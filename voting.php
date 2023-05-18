<?php
include("dbconnection.php");
session_start();
$userID=$_SESSION['userId'];
$eventId= $_SESSION['eventID'];
if(!isset($_SESSION["eventID"]))
    {
        header("location:region.php");
    }
if(!isset($userID))
{
    header("location:logout.php");
}
$sql="select * from candidate_details where event_id=$eventId";
$query=$conn->query($sql);
$sql1="select * from event_registration where id=$eventId";
$query1=$conn->query($sql1);
$row1=$query1->fetch_assoc()
// $userId=123456789126;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="voting.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
    <body>
        <div class="voting_container">
            <div class="voting_note">
                <img src="image/vote.png">
                <p><?php echo $row1['event_detail']?></p>
            </div>
            <div class="Voting_area">
                <?php 
                $emptyArray =array();
                $i=0;
                while($row=$query->fetch_assoc())
                {
                    $emptyArray[$i]=intval($row['id']);
                    // $emptyArray[$i]=$row['id'];
                ?>
                <div class="candidate_vote">
                    <div class="pic_text">
                        <!-- <img src="orange.jpg"> -->
                        <div class="details" >
                            <h2 class="candi_name" ><?php echo $row['candi_name'] ?></h2>
                            <!-- <p class="candi_detail" ><?php echo $row['candi_detail'] ?></p> -->
                        </div>
                    </div>
                    <div class = "region_box_btn"><a href="" onclick="voting(<?php echo $i?>)" class="button" id="<?php echo $i?>" >Vote</a></div>
                </div>
                <?php
                $i++;
                }
                $_SESSION['condidateIdArray']=$emptyArray;
                // $json = json_encode($emptyArray);
                // echo $emptyArray[1];
                // var_dump($emptyArray);
                // var_dump($json);
                ?>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    
    function voting(index){
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'votingJS.php',
        type: 'POST',
        data:{
            data:index
        },
        success: function() {
           // redirect to another page
           window.location = "feedback.php";
        },
        error: function() {
           alert('Error occurred');
        }
    });
}
</script>
