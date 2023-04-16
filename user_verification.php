<?php
include("dbconnection.php");
$sql="select * from registration where type='user' and status='pending'";
$query=$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            while ($row=$query->fetch_assoc())
            {
            ?>
                <tr>
                    <td class="table_data"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];?></td>
                    <td class="table_data"><?php echo $row['aadhar']; ?></td>
                    <td class="table_data"><?php echo $row['phone']; ?></td>
                    <td class="table_data2" type="Date"><?php echo $row['apply_date'];?></td>
                    <td class="table_data1"><button class="approv"><?php echo $row['status'];?></button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>