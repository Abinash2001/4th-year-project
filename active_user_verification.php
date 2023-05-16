<?php
session_start();
include("dbconnection.php");
$sql="select * from registration where type='user' and status='active'";
$query=$conn->query($sql);
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
                <th class="table_head">User Name</th>
                <th class="table_head">Aadhar</th>
                <th class="table_head">Phone</th>
                <th class="table_head">Date</th>
                <th class="table_head">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $emptyArray=array();
        $i=0;
        while($row = $query->fetch_assoc()){
            $sql1="select * from `key` where user_id={$row['id']}";
            $query1=$conn->query($sql1);
            $row1=$query1->fetch_assoc();
            $private_key=$row1['private_key'];
            $aadharBin=hex2bin($row['aadhar']);
            openssl_private_decrypt($aadharBin, $aadhar, $private_key);

            $emptyArray[$i]=intval($row['id']);
    ?>
                <tr>
                    <td class="table_data"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>
                    <td class="table_data"><?php echo $aadhar; ?></td>
                    <td class="table_data"><?php echo $row['phone']; ?></td>
                    <td class="table_data" type="Date"><?php echo $row['apply_date'];?></td>
                    <!-- <td class="table_data1"><button class="approv"><?php echo $row['status'];?></button></td> -->
                    <td class="table_data"><a href="" onclick="index(<?php echo $i ?>)" class="approv"><?php echo $row['status'];?></a></td>
                </tr>
                <?php
        $i++;
        $_SESSION['emptyArray']=$emptyArray;
    }
    // $jsonArray = json_encode($eventIDArray);
    ?>
        </tbody>
    </table>
    <div class="submit">
        <button onclick="back()">Back</button>
        <!-- <a href="javascript: history.go(-1)">Go Back</a> -->
    </div> 
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