<?php
include("dbconnection.php");
// session_start();
// $userID=$_SESSION['userId'];
$sql="select * from candidate_details";
$query=$conn->query($sql);
$userId=123456789126;
$eventId=123456789123;
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
                <!-- <img src="vote.png"> -->
                <p>Click To the ‘vote’ button below and let win to your desirable candidate</p>
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
                            <p class="candi_detail" ><?php echo $row['candi_detail'] ?></p>
                        </div>
                    </div>
                    <div class = "region_box_btn"><a href="" onclick="voting(<?php echo $i?>)" class="button" id="<?php echo $i?>" >Vote</a></div>
                </div>
                <?php
                $i++;
                }
                $json = json_encode($emptyArray);
                // echo $emptyArray[1];
                // var_dump($emptyArray);
                // var_dump($json);
                ?>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    
    function voting(datavalue){
    console.log(datavalue);
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'votingJS.php',
        type: 'POST',
        data:{json:<?php echo $json?>,
            data:datavalue,
            userid:<?php echo $userId ?>,
            eventid:<?php echo $eventId ?>
        },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
}









// $(document).ready(function(){
// $('.button').click(async function(){
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//       if (this.readyState == 4 && this.status == 200) {
//         console.log("True");
//       }
//       else{
//         console.log("false");
//       }
//     };
//     var Status = $(this).val();
//     console.log(datavalue);
//     alert("ok");
//     $.ajax({
//         url:'votingJS.php',
//         method:'POST',
//         data:{json:<?php //echo $json?>,
//             data:datavalue,
//             userid:<?php //echo $userId ?>,
//             eventid:<?php //echo $eventId ?>
//         },
//         success:function(result){
//            console.log(result) ;
//         },
//         error:function(result){
//            console.log('chourasia') ;
//         }
//     });
//     alert("90");
// });
// });

    
    // $(document).ready(function(){
    // function voting(datavalue){
    //     console.log(datavalue);
    //     // alert("ok");
    //     <?php 
    //         $index="datavalue";
    //         echo $index;
    //     ?>
        // $.ajax({
        //     url:'votingJS.php',
        //     method:'POST',
        //     data:{json:<?php //$json?>,
        //         data:datavalue,
        //         userid:<?php //echo $userId ?>,
        //         eventid:<?php //echo $eventId ?>
        //     },
        //     success:function(result){
        //        console.log(result) ;
        //     },
        //     error:function(result){
        //        console.log('chourasia') ;
        //     }
        // });
        // alert("90");
    // };
    // });


    // $(document).ready(function(){
    //     // function voting(datavalue){
    //         $.ajax({
    //             url:'votingJS.php',
    //             method:'POST',
    //             data:{//candpost:datavalue,
    //             userid:<?php //echo $userId?>,
    //             eventid:<?php //echo $eventId?>
    //         }
    //         });
    //     // }
    // });
</script>