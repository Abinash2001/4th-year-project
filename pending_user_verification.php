<?php
session_start();
include("dbconnection.php");
$sql="select * from user_details where type='user' and status='pending'";
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
    <!-- <div id="t"> -->
    <table >
        <thead >
            <tr>
                <th class="table_head">User Name</th>
                <th class="table_head">Aadhar</th>
                <th class="table_head">Phone</th>
                <th class="table_head">Date</th>
                <th class="table_head">Status</th>
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
                    <td class="table_data"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>
                    <td class="table_data"><?php echo $row['aadhar']; ?></td>
                    <td class="table_data"><?php echo $row['phone']; ?></td>
                    <td class="table_data" type="Date"><?php echo $row['apply_date'];?></td>
                    <!-- <td class="table_data1"><button class="approv"><?php echo $row['status'];?></button></td> -->
                    <td class="table_data"><a href="" onclick="index(<?php echo $i ?>)" class="approv"><?php echo $row['status'];?></a></td>
                </tr>
                <?php
        $i++;
    }
    $_SESSION['emptyArray']=$emptyArray;
    // $jsonArray = json_encode($eventIDArray);
    ?>
        </tbody>
    </table>
    <div class="submit">
        <button onclick="history.back()">Back</button>
    </div> 
</body>
</html>

<script type="text/javascript">
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
</script>
<?php
if(isset($_SESSION['id']))
{
?>
<script>
    window.location.assign("user_detail.php");
</script>
 <?php
}
?>