<?php
    session_start();
    include("dbconnection.php");
    $sql="SELECT * FROM `feedback`";
    $query=$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Approval</title>
    <!--<link rel="stylesheet" media="screen and (min-width : 1200px)" href="user-short.css">-->
    <link rel="stylesheet" href="user_feedback.css">
</head>
<body>
    <div class="container" id="blur">
    <h2>
        <!--<span class="details">Select</span>
        <span id="filter" class="details">Apply Filter</span>-->
        LIST OF FEEDBACK GIVEN
    </h2>
    <!-- <div id="t"> -->
    <table >
        <thead >
            <tr>
                <th class="table_head">Serial No.</th>
                <th class="table_head">Event Id</th>
                <th class="table_head">Review</th>
                <th class="table_head">Date</th>
                <th class="table_head">View</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $emptyArray =array();
            $i=0;
            while ($row=$query->fetch_assoc())
            {
                $emptyArray[$i]=intval($row['id']);
            ?>
                <tr >
                
                <td class="table_data"><?php echo $row['id']; ?></td>
                <td class="table_data"><?php echo $row['event_id']; ?></td>
                <td class="table_data"><?php echo $row['comment']; ?></td>
                <td class="table_data" type="Date"><?php echo $row['date']; ?></td>
                <td class="table_data">
                <button class="view" onclick="togglePopup(<?php echo $i?>)">Review</button>
                </td>
                <div id="popup<?php echo $i?>" class="popup">
                    <div class="pop" >
                        <p>Review:</p>
                        <div class="complaint"><?php echo $row['comment']?></div>
                    </div>
                    <button id="close" onclick="closePopUp(<?php echo $i?>)">Close</button>
                </div>
            </tr>
            <?php
            $i++;
            }
            $_SESSION['feedbackIdArray']=$emptyArray;
            ?>
        </tbody>
    </table>
    
    <div class="submit">
        <button onclick="history.back()">Back</button>
    </div> 
    
        <script src="user_feedback.js"></script>
</body>
</html>


<script type="text/javascript">
    function index(value){
    console.log(value);
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'user_feedbackJs.php',
        type: 'POST',
        data:{
            data:value,
        }
    });
}
</script>