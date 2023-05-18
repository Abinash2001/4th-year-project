<?php
    session_start();
    include("dbconnection.php");
    $userID=$_SESSION['userId'];
    if(!isset($userID))
    {
        header("location:login.php");
    }
    $sql1="SELECT * FROM `key` WHERE id=1";
    $query1=$conn->query($sql1);
    $row1=$query1->fetch_assoc();
    $private_key=$row1['private_key'];
    $iv_hex=$row1['iv'];
    $iv=hex2bin($iv_hex);
    $key = openssl_random_pseudo_bytes(16);
    $sql="SELECT * FROM `report`";
    $query=$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>
    <!--<link rel="stylesheet" media="screen and (min-width : 1200px)" href="user-short.css">-->
    <link rel="stylesheet" href="user_feedback.css">
</head>
<body>
    <div class="container" id="blur">
    <h2>
        <!--<span class="details">Select</span>
        <span id="filter" class="details">Apply Filter</span>-->
        List Of Report
    </h2>
    <!-- <div id="t"> -->
    <table >
        <thead >
            <tr>
                <th class="table_head">Serial No.</th>
                <th class="table_head">Report</th>
                <!-- <th class="table_head">File</th> -->
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
                $msg_bin=hex2bin($row['msg']);
                openssl_private_decrypt($msg_bin, $msg, $private_key);
            ?>
                <tr >
                
                <td class="table_data"><?php echo $row['id']; ?></td>
                <td class="table_data"><?php echo $msg; ?></td>
                <td class="table_data" type="Date"><?php echo $row['date']; ?></td>
                <td class="table_data">
                <button class="view" onclick="togglePopup(<?php echo $i?>)">Review</button>
                </td>
                <div id="popup<?php echo $i?>" class="popup">
                    <div class="pop" >
                        <p>Review:</p>
                        <div class="complaint"><?php echo $msg?></div>
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
    <button onclick="back()">Back</button>
    </div> 
    
        <script src="user_feedback.js"></script>
</body>
</html>


<script type="text/javascript">
    function back(){
    window.location.assign("admindashboard.php");
  }
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
