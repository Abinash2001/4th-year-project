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
                    $sql2 = "SELECT COUNT({$row['id']}) AS vote_count FROM vote WHERE event_id = $eventId AND candi_id = {$row['id']}";
                    $query2 = $conn->query($sql2);
                    $voteCountRow = $query2->fetch_assoc();
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
                    <div class = "region_box_btn"><p class="button"><?php echo $voteCountRow["vote_count"]?></p></div>
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
            <div class="submit">
                <button onclick="back()">Back</button>
            </div> 
        </div>
    </body>
</html>
<script type="text/javascript">
    function back(){
        <?php
            unset($_SESSION["eventID"]);
            // header('location:live_event.php');  
        ?>
        window.location.assign("result_list.php");
    }
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












<!-- <?php
// session_start();
// include("dbconnection.php");  

// // Fetch candidate names from the "candidate" table
// $candidateSql = "SELECT * FROM candidate_details";
// $candidateQuery = $conn->query($candidateSql);

// // Fetch vote counts from the "vote" table
// $voteSql = "SELECT * FROM vote";
// $voteQuery = $conn->query($voteSql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Result.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
    <body>
        <form>
            <div class="container">
                <h1 class="result_heading">Voting Result</h1>
                <div class="question"><p class="ques">hjkdhjkcjklsdjfklsdkjfsdhvdcjhdjcnksdjbcdcvbsdbndjk</p></div>
                <div class="Result_Container">
                <?php
                // $count = 0;
                // while ($candidateRow = $candidateQuery->fetch_assoc()) {
                //     $candidateName = $candidateRow['candi_name'];


                    //Find the corresponding vote count for the candidate
                    // $voteSql = "SELECT COUNT(*) as vote_count FROM vote WHERE candi_id = " . $candidateRow['id'];
                    // $voteResult = $conn->query($voteSql);
                    // $voteRow = $voteResult->fetch_assoc();
                    // $voteCount = $voteRow['vote_count'];
                    
                ?>
                    <div class="result_box" id="box1">
                        <h4 class="candi"><?php //echo $candidateName; ?></h4>
                        <p class="count"><?php //echo $voteCount; ?></p>
                    </div>
                    <?php
                        // $count++;
                        // if ($count % 2 == 0) {
                        //     echo '<div style="width: 100%; box-sizing: border-box;"></div>'; // Add an empty div to start a new row
                        // }
                    // }
                    ?>
                </div>
            </div>
        </form>
    </body>
</html> -->