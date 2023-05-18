<?php
    // $userID=$_SESSION['userId'];
    // if(!isset($userID))
    // {
    //     header("location:login.php");
    // }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include('dbconnection.php');
        $name=$_POST['name'];
        $pur_event=$_POST['pur_event'];
        // $organization=$_POST['Organization'];
        // $organ_name=$_POST['organ_name'];
        // $registration=$_POST['registration'];
        // $phone=$_POST['phone'];
        // $selected=$_POST['eli'];
        // $locate=$_POST['location'];
        $start_date=$_POST['start_date'];
        $start_time=$_POST['start_time'];
        $end_date=$_POST['end_date'];
        $end_time=$_POST['end_time'];
        $sql="INSERT INTO `event_registration`(`event_name`, `event_detail`,`start_date`, `start_time`, `end_date`, `end_time`) VALUES ('$name', '$pur_event','$start_date', '$start_time', '$end_date', '$end_time')";
        mysqli_query($conn,$sql);


        $sql="SELECT MAX(id) AS max_value FROM `event_registration`";

        $query=$conn->query($sql);
        $row=$query->fetch_assoc();
        $max_value = $row['max_value'];
        $option_name=$_POST['option_name'];
        // $option_detail=$_POST['option_detail'];
        
        foreach($option_name as $i=>$names)
        {
            $o_name=$names;
            // $o_detail=$option_detail[$i];
            $sql = "INSERT INTO `candidate_details`(`candi_name`,`event_id`) VALUES ('$o_name','$max_value')";
            mysqli_query($conn,$sql);
        }
        
        header('location:admindashboard.php');
        
        // echo "The maximum value is: " . $max_value;
        // $result = mysqli_query($conn, $sql);
        // $row = mysqli_fetch_assoc($result);
        // $demo="SELECT * FROM `event_registration` WHERE `id` = '$query'";
        // echo "$demo";
        // echo $query;
        // print($query);
        // $query=123456789166;
        // $number = count($_POST["option_name"]);

        // $i=0;
        // foreach($option_name as $key)
        // {
        //     if($key!='')
        //     {
        //         $sql = "INSERT INTO `candidate_details`(`candi_name`,`candi_detail`,`event_id`) VALUES ('$key','".$option_detail[$i]."','$query')";
        //         $i++;
        //         mysqli_query($conn,$sql);
        //     }
        // }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="event_registration.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Event Registration</title>
    <body>
        <form action="" method='POST'>
            <div class="Registration_container">
                <h1 class="heading">Event Registration</h1>
                <div class="Event_Details">
                    <h2>Event Details</h2>
                        <div class="box">
                            <h4>Name</h4>
                            <input id="name" name="name" type="text">
                            <h4>Issue of Event</h4>
                            <textarea id="textarea" name="pur_event" ></textarea>
                        </div>
                </div>
                <div class="Option Details">
                    <h2>Options</h2>
                    <div id="option_details">
                        <div id="option1">
                            <div class="option">
                                <h4>Option 1</h4>
                                <input class="textbox" name="option_name[]" type="text">
                            </div>
                        </div>
                        <div id="option1">
                            <div class="option">
                                <h4>Option 2</h4>
                                <input class="textbox" name="option_name[]" type="text">
                            </div>
                        </div>
                        
                    </div>
                    <div class="addmoreicon">
                        <div class="add_more" id="add">
                            <div class="icon"><ion-icon name="add-circle-outline"></ion-icon></div>
                            Add more
                        </div>
                        <div class="add_more" id="remove">
                            <div class="icon"><ion-icon name="remove-circle-outline"></ion-icon></div>
                            Remove
                        </div>
                    </div>
                </div>
                <div class="timing">
                    <h2>Event Timing</h2>
                    <div class="datetime">
                        <h4>Start Date & Time</h4>
                        <input class="date_time" name="start_date" type="date" placeholder="DD-MM-YYYY">
                        <input class="date_time" name="start_time" type="time" placeholder="HH-MM">
                    </div>
                    <div class="datetime">
                        <h4>End Date & Time</h4>
                        <input class="date_time" name="end_date" type="date" placeholder="DD-MM-YYYY">
                        <input class="date_time" name="end_time" type="time" placeholder="HH-MM">
                    </div>
                    <div class="submit">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <!-- <script src="event_registration.js"></script> -->
    <script>
        $(document).ready(function(){
        var j=2;
        $('#add').click(function(){
        $('#option_details').append('<div id="option'+(++j)+'"><div class="option"><h4>Option '+j+'</h4><input class="textbox" name="option_name[]" type="text"></div></div>');
        });
            
        $('#remove').click(function(){
            if(j==1){
                alert("You have to add atleast 2 Option !!");
            }
            else{
                var parent=document.getElementById("option_details");
                var opt= 'option'+j;
                j--;
                var child=document.getElementById(opt);
                parent.removeChild(child);
            }
        });
        });
    </script>
</html>