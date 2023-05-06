<?php
$servername="localhost";
$username="root";
$password="";
$database="project";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
    die("Sorry" .mysqli_connect_error());
}
if($_SERVER["REQUEST_METHOD"]=="POST" and isset($_POST['submit']))
{
  
  $event_name = $_POST['name'];
  $purpose = $_POST['purpose'];
  $locate=$_POST['location'];
  $selected=$_POST['eli'];

    if($selected=='pm')
    {
      $sql1="INSERT INTO `event`(`name`, `eligible`, `location`, `purpose`) VALUES ('$event_name','$selected','INDIA','$purpose')";
$result1 = mysqli_query($conn,$sql1);
    }
    else{
      $sql1="INSERT INTO `event`(`name`, `eligible`, `location`, `purpose`) VALUES ('$event_name','$selected','$locate','$purpose')";
$result1 = mysqli_query($conn,$sql1);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="event.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>-->
    <script>
        function dynamicdropdown(listindex)
    {
        switch (listindex)
        {
        case "pm" :
            document.getElementById("location").options[0]=new Option("Select location","");
            document.getElementById("location").options[1]=new Option("INDIA","INDIA");
            document.getElementById("location").remove(30);
            document.getElementById("location").remove(29);
            document.getElementById("location").remove(28);
            document.getElementById("location").remove(27);
            document.getElementById("location").remove(26);
            document.getElementById("location").remove(25);
            document.getElementById("location").remove(24);
            document.getElementById("location").remove(23);
            document.getElementById("location").remove(22);
            document.getElementById("location").remove(21);
            document.getElementById("location").remove(20);
            document.getElementById("location").remove(19);
            document.getElementById("location").remove(18);
            document.getElementById("location").remove(17);
            document.getElementById("location").remove(16);
            document.getElementById("location").remove(15);
            document.getElementById("location").remove(14);
            document.getElementById("location").remove(13);
            document.getElementById("location").remove(12);
            document.getElementById("location").remove(11);
            document.getElementById("location").remove(10);
            document.getElementById("location").remove(9);
            document.getElementById("location").remove(8);
            document.getElementById("location").remove(7);
            document.getElementById("location").remove(6);
            document.getElementById("location").remove(5);
            document.getElementById("location").remove(4);
            document.getElementById("location").remove(3);
            document.getElementById("location").remove(2);
           // document.getElementById("location").options[2]=new Option("DELIVERED","delivered");
            break;
        case "cm" :
            document.getElementById("location").options[0]=new Option("Select location","");
            document.getElementById("location").options[1]=new Option("Andhra Pradesh","AP");
            document.getElementById("location").options[2]=new Option("Arunachal Pradesh","AR");
            document.getElementById("location").options[3]=new Option("Bihar","BR");
            document.getElementById("location").options[4]=new Option("Chhattisgarh","CG");
            document.getElementById("location").options[5]=new Option("Goa","GA");
            document.getElementById("location").options[6]=new Option("Gujarat","GJ");
            document.getElementById("location").options[7]=new Option("Haryana","HR");
            document.getElementById("location").options[8]=new Option("Himachal Pradesh","HP");
            document.getElementById("location").options[9]=new Option("Jammu and Kashmir","JK");
            document.getElementById("location").options[10]=new Option("Jharkhand","JH");
            document.getElementById("location").options[11]=new Option("Karnataka","KA");
            document.getElementById("location").options[12]=new Option("Kerala","KL");
            document.getElementById("location").options[13]=new Option("Madhya Pradesh","MP");
            document.getElementById("location").options[14]=new Option("Maharashtra","MH");
            document.getElementById("location").options[15]=new Option("Manipur","MN");
            document.getElementById("location").options[16]=new Option("Meghalaya","ML");
            document.getElementById("location").options[17]=new Option("Mizoram","MZ");
            document.getElementById("location").options[18]=new Option("Nagaland","NL");
            document.getElementById("location").options[19]=new Option("Punjab","PB");
            document.getElementById("location").options[20]=new Option("Rajasthan","RJ");
            document.getElementById("location").options[21]=new Option("Sikkim","SK");
            document.getElementById("location").options[22]=new Option("Tamil Nadu","TN");
            document.getElementById("location").options[23]=new Option("Tripura","TR");
            document.getElementById("location").options[24]=new Option("Andaman and Nicobar Islands","AN");
            document.getElementById("location").options[25]=new Option("Chandigarh","CH");
            document.getElementById("location").options[26]=new Option("Dadra and Nagar Haveli","DH");
            document.getElementById("location").options[27]=new Option("Daman and Diu","DD");
            document.getElementById("location").options[28]=new Option("Delhi","DL");
            document.getElementById("location").options[29]=new Option("Lakshadweep","LD");
            document.getElementById("location").options[30]=new Option("Pondicherry","PY");

            break;
        }
        return true;
    }
        </script>
    <body>
        <form action="#" method='POST' >
            <div class="Registration_container">
                <h1 class="heading">Event Registration</h1>
                <div class="Event_Details">
                    <h2>Event Details</h2>
                        <div class="box">
                            <h4>Name</h4>
                            <input id="name" name="name" type="text">
                            <h4>Purpose of Event</h4>
                            <textarea id="textarea" name="purpose"></textarea>
                        </div>
                </div>
                <!--<div class="OrganizationDetails">   
                    <h2>Organisation Details</h2>
                     <div class="select">
                        <h4>Types of Organization</h4>
                        <select name="Organization" class="Organization" id="Organization" required>
                            <option value="">Select</option>
                            <option value="Govt">Govt</option>
                            <option value="Company">Company</option>
                        </select></div>
                    <div class="select">
                        <h4>Name</h4>
                        <input class="block" type="text">
                    </div>
                    <div class="select">
                        <h4>Organization's Registration Number</h4>
                        <input class="block"  type="text">
                    </div>
                    <div class="select">
                        <h4>Contact Number</h4>
                         <input class="block" type="text">
                    </div>
                </div>-->
                <div class="EligibityCriteria">
                    <h2>Eligibity Criteria</h2>
                    <div id="Eligibility_criteria">
                        <div class="criteriaa" id="criteria1">
                            <h4>Select the level of voting</h4>

<select name="eli" id="eli" class="Organization" onchange="javascript: dynamicdropdown(this.options[this.selectedIndex].value);">
        <option value="">Select source</option>
        <option value="pm">PM</option>
        <option value="cm">CM</option>

</select>

                       </div>
                     <div class="criteriaa" id="criteria1" >
                            <h4>Location</h4>
                            <script type="text/javascript" language="JavaScript">
        document.write('<select name="location" id="location" class="Organization"><option value="">Select status</option></select>')
        </script>
        <noscript>
        <select id="location" name="location">
            <!--<option value="IND">INDIA</option>-->
        </select>
        </noscript>
                            


                                
                        </div>
                    </div>
                    
                </div>
                <div class="Option Details">
                    <h2>Option Details</h2>
                    <div id="option_details">
                        <div id="option1">
                            <h4 class="optionheading" class="option">Option 1</h4>
                            <div class="option">
                                <h4>Option Name</h4>
                                <input class="textbox" type="text">
                            </div>
                            <div class="option">
                                <h4>Option details</h4>
                                <input class="textbox" type="text">
                            </div>
                        </div>
                        
                    </div>
                    <div class="addmoreicon">
                        <div class="add_more" onclick="add(option_details)">
                            <div class="icon"><ion-icon name="add-circle-outline"></ion-icon></div>
                            Add more
                        </div>
                        <div class="add_more" onclick="remove()">
                            <div class="icon"><ion-icon name="remove-circle-outline"></ion-icon></div>
                            Remove
                        </div>
                    </div>
                </div>
                <div class="timing">
                    <h2>Event Timing</h2>
                    <div class="datetime">
                        <h4>Start Date & Time</h4>
                        <input id="startd" class="date_time" type="date" placeholder="DD-MM-YYYY">
                        <input id="startt" class="date_time" type="time" placeholder="HH-MM">
                    </div>
                    <div class="datetime">
                        <h4>End Date & Time</h4>
                        <input id="starts" class="date_time" type="date" placeholder="DD-MM-YYYY">
                        <input id="starte" class="date_time" type="time" placeholder="HH-MM">
                    </div>
                    <div class="submit">
                    <button type="submit" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
    <script >
        
  
        var i=1;
function addCode(Eligibility_criteria) {
    document.getElementById("Eligibility_criteria").innerHTML+='<div class="criteriaa" id="criteria'+(++i)+'"><h4>Criteria '+(i)+'</h4><input class="criteria" type="text"></div>';

}
function removeCode() {
    var parent=document.getElementById("Eligibility_criteria");
    var cre= 'criteria'+i;
    i--;
    var child=document.getElementById(cre);
    console.log(child);
    parent.removeChild(child);
    console.log(cre);
}

var j=1;
function add() {
    document.getElementById("option_details").innerHTML+='<div id="option'+(++j)+'"><h4 class="optionheading" class="option">Option '+j+'</h4><div class="option"><h4>Option Name</h4><input class="textbox" type="text"></div><div class="option"><h4>Option details</h4><input class="textbox" type="text"></div></div>';

}
function remove() {
    var parent=document.getElementById("option_details");
    var opt= 'option'+j;
    j--;
    var child=document.getElementById(opt);
    console.log(child);
    parent.removeChild(child);
    console.log(opt);
}
    </script>
    </html>