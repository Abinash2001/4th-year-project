<?php
session_start();
include("dbconnection.php");
$sql="SELECT * FROM `feedback`";
$query=$conn->query($sql);
$count  = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>User Approval</title>
    <!--<link rel="stylesheet" media="screen and (min-width : 1200px)" href="user-short.css">-->
    <link rel="stylesheet" href="user_verification.css">
</head>
<body>
    <h2>
        <!--<span class="details">Select</span>
        <span id="filter" class="details">Apply Filter</span>-->
        LIST OF REGISTERED USERS
    </h2>
    <div id="t">
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
        $eventIDArray=array();
        $i=0;
        while($row = $query->fetch_assoc()){
            $emptyArray[$i]=intval($row['id']);
    ?>
                <tr>
                    <td class="table_data"><?php echo $row['id']; ?></td>
                    <td class="table_data"><?php echo $row['event_id']; ?></td>
                    <td class="table_data"><?php echo $row['comment']; ?></td>
                    <td class="table_data2" type="Date"><?php echo $row['date']; ?></td>
                    <!-- <td class="table_data1"><button class="approv">View</button></td> -->
                    <td class="table_data1"><a href="" class="not-approv" onclick="togglePopup('<?php echo $node;?>');" class="approv">View</a></td>
                    <!-- <td class="table-data1 table-data"><button class="not-approv"onclick="togglePopup('<?php echo $node;?>');">Details</button></td> -->
                </tr>
                <!-- <tr>
                    <td class="table-data"><?php echo $row['id']; ?></td>
                    <td class="table-data"><?php echo $row['event_id']; ?></td>
                    <td class="table-data"><?php echo $row['comment']; ?></td>
                    <td class="table-data table-data2" type="Date"><?php echo $row['date']; ?></td>
                     <td class="table_data1"><button class="approv"><?php //echo $row['status'];?></button></td> -->
                    <!-- <td class="table_data1"><a href="" onclick="index(<?php echo $i ?>)" class="approv"><?php echo $row['status'];?></a></td> -->
                    <!-- <td class="table-data1 table-data"><button class="view"onclick="togglePopup('<?php echo $node;?>');">Review</button></td>-->
                    <!-- <div id="popup">
                    <div class="popup" >
                        <p>Review:</p>
                        <div class="complaint"></div>
                    </div>
                    <button id="close" onclick="closePopUp()">Close</button>
                    </div> 
                </tr> -->
                <?php
        $i++;
        $_SESSION['emptyArray']=$emptyArray;
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
        </tbody>
    </table>
    <div class="submit">
        <button onclick="history.back()">Back</button>
    </div> 
</body>
</html>

<!-- <script type="text/javascript">
    function index(value){
    console.log(value);
    // Make an AJAX request to the PHP script
    $.ajax({
        url: 'verification.php',
        type: 'POST',
        data:{
            data:value,
        }
    });
}
</script> -->
<?php
// if(isset($_SESSION['id']))
// {
?>
<script>
    function togglePopup(){
    var blur=document.getElementById('blur');
    blur.classList.add('active');
    var popup=document.getElementById('popup');
    popup.classList.add('active');
    }
    function closePopUp(){
        var blur=document.getElementById('blur');
        blur.classList.remove('active');
        var popup=document.getElementById('popup');
        popup.classList.remove('active');
    }
</script>
 <?php
// }
?>