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
    <link rel="stylesheet" href="report_issue.css">
</head>
<body>
    <div class="container" id="blur">
    <h2>
        <!--<span class="details">Select</span>
        <span id="filter" class="details">Apply Filter</span>-->
        LIST OF FEEDBACK GIVEN
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
            while ($row=$query->fetch_assoc())
            {
            ?>
            
                <tr >
                
                <td class="table-data"><?php echo $row['id']; ?></td>
                <td class="table-data"><?php echo $row['event_id']; ?></td>
                <td class="table-data"><?php echo $row['comment']; ?></td>
                <td class="table-data table-data2" type="Date"><?php echo $row['date']; ?></td>
                <td class="table-data1 table-data"><button class="view"onclick="togglePopup('<?php echo $node;?>');">Review</button></td> 
                <div id="popup">
                    <div class="popup" >
                        <p>Review:</p>
                        <div class="complaint"></div>
                    </div>
                    <button id="close" onclick="closePopUp()">Close</button>
                </div>
            </tr>
            <?php
            }
            ?>
            
            
        </tbody>
    </table>
    
        </div>
       
    </div>
    
        <script src="report_issue.js"></script>
</body>
</html>