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
/*else
{
    echo '<div> Successfull</div>';
}*/
$event=1;
$sql1="SELECT count(*) FROM `vote` where `eventid`=$event";
$result1 = mysqli_query($conn,$sql1);
//$num = mysqli_num_rows($result);
//if($num>0)
//{
$row1=mysqli_fetch_assoc($result1);
$sql2="SELECT count(*) FROM `user`";
$result2 = mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$div=array(17,25,35,45,55,65);
$age=array('18-25'=>10,'26-35'=>20,'36-45'=>30,'46-55'=>20,'56-65'=>70);
$x=array_keys($age);
for($i=0;$i<5;$i++)
{$n=$i+1;
  $sql3="SELECT count(vote.userid) FROM vote,user where vote.userid=user.USER_ID AND user.age> $div[$i] and user.age<= $div[$n] ";
$result3 = mysqli_query($conn,$sql3);
$row3=mysqli_fetch_assoc($result3);
$age[$x[$i]]=intval(($row3['count(vote.userid)']/$row1['count(*)'])*100);
}
$sql4="SELECT * FROM `event` where eventid=$event ";
$result4 = mysqli_query($conn,$sql4);
$row4=mysqli_fetch_assoc($result4);
$startTime=$row4['start'];
$stop=$row4['end'];
/*$time = $startTime;

while($time < $stop)
{
     if( ($break_starts !== null) && ($time + 60 <= $break_starts) )
     {
         $intervals[] = array( 'starts' => $time, 'ends' => ($time += 60) );
     }
     else if( $break_starts !== null ) 
     {
         $time = $break_ends;
     }
     else if( $time + 60 <= $stop )
     {
         $intervals[] = array( 'starts' => $time, 'ends' => ($time += 60) );
     }
 }*/
$arr=array();
$from_time = strtotime($startTime); 
$to_time = strtotime($stop); 
$diff = round(abs($from_time - $to_time) / 60,2). " minutes";
$diff=intval($diff);
$minutes_to_add = $diff/6;

$time = new DateTime($startTime);

$x=100;
for($i=1;$i<=6;$i++)
{
  $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
  $stamp = $time->format('Y-m-d H:i:s');
  array_push($arr,array($stamp,$x,120-$x));
  $x=$x-10;
}

for($i=0;$i<5;$i++)
{
  $d=$arr[$i][0];
  $e=$arr[$i+1][0];
  $f="FEMALE";
  $sql5="SELECT count(vote.userid) FROM vote,user where vote.userid=user.USER_ID and vote.date<= '$e' and vote.date> '$d' AND vote.eventid= $event and user.GENDER= '$f' ";
$result5 = mysqli_query($conn,$sql5);
$row5=mysqli_fetch_assoc($result5);
$arr[$i][2]=intval($row5['count(vote.userid)']);
$f="MALE";
  $sql5="SELECT count(vote.userid) FROM vote,user where vote.userid=user.USER_ID and vote.date<= '$e' and vote.date> '$d' AND vote.eventid= $event and user.GENDER= '$f' ";
$result5 = mysqli_query($conn,$sql5);
$row5=mysqli_fetch_assoc($result5);
$arr[$i][1]=intval($row5['count(vote.userid)']);
}
$d=$arr[5][0];
  $f="FEMALE";
  $sql5="SELECT count(vote.userid) FROM vote,user where vote.userid=user.USER_ID and vote.date> '$d' AND vote.eventid= $event and user.GENDER= '$f' ";
$result5 = mysqli_query($conn,$sql5);
$row5=mysqli_fetch_assoc($result5);
$arr[5][2]=intval($row5['count(vote.userid)']);
$f="MALE";
  $sql5="SELECT count(vote.userid) FROM vote,user where vote.userid=user.USER_ID and vote.date> '$d' AND vote.eventid= $event and user.GENDER= '$f' ";
$result5 = mysqli_query($conn,$sql5);
$row5=mysqli_fetch_assoc($result5);
$arr[5][1]=intval($row5['count(vote.userid)']);
$sql5="SELECT * FROM vote,candidate where vote.candidateid=candidate.id and vote.eventid= $event ";
$result5 = mysqli_query($conn,$sql5);
//$row5=mysqli_fetch_assoc($result5);
$num = mysqli_num_rows($result5);
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="live_event.css">
  <title>Live_Event_page</title>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<!-- Navbar part -->
<div class="navbar">
  <div class="logo-container">
    <img src="logo.png" alt="LOGO" class="logo">
  </div>
  <div class="nav-container">
    <ul class="nav-items">
      <li><a href="#">Home</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Help</a></li>
    </ul>
  </div>
  <div class="profile-container">
    <a href="#" class="profile-link"><img src="profile-icon.png" alt="Profile Icon"></a>
  </div>
</div>

<div class="container">
<!-- left section overview & Analytics -->
<div class="left_container">
  <h2 class="section_heading">Overview</h2>
  <div class="underline"></div>

  <div class="voters_box">
    <div class="voters_section">
      <div class="voters_label">Total Voters</div>
      <div class="voters_number"><?php echo $row2['count(*)'] ?></div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>100%</p>
    </div>
  </div>
  <div class="voters_box">
    <div class="voters_section">
      <div class="voters_label">Vote Casted</div>
      <div class="voters_number"><?php echo $row1['count(*)'] ?></div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>
      <?php 
      if($row1['count(*)']==0 ||$row2['count(*)']==0)
      {
        $r=0;
        echo '0%';
      }
        else 
        {
          $r=(($row1['count(*)']/$row2['count(*)'])*100);
          echo  $r.'%';
        }?></p>
    </div>
  </div>
  <div class="voters_box">
    <div class="voters_section">
      <div class="voters_label">Remaining Voters</div>
      <div class="voters_number"><?php echo $row2['count(*)']-$row1['count(*)'] ?></div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>
      <?php 
      if($row2['count(*)']-$row1['count(*)']==0 ||$row2['count(*)']==0 )
      {
        echo '0%';
      }
        else 
        {
          $p=((($row2['count(*)']-$row1['count(*)'])/$row2['count(*)'])*100);
          echo  $p.'%';
        }?>
    </p>
    </div>
  </div>

  <div class="Analytics">
    <h2 class="section_heading">Analytics</h2>
      <div class="underline"></div>
  </div>
  <div class="circle">
        <div class="container_1">  
          <div class="circular-progress">
            <div class="value-container"><?php echo (($row1['count(*)']/$row2['count(*)'])*100).'%'?></div>
          </div>
       </div>
      <div class="ratio-box">
        <div class="ratio-item">
          <div class="ratio-color blue"></div>
          <div class="ratio-text">Vote Casted</div>
      </div>
      <div class="ratio-item">
        <div class="ratio-color white"></div>
        <div class="ratio-text">Remaining Voters</div>
      </div>
    </div>
  </div>
</div>
<!--<script src="live_event.js"></script>-->
<script >var $var_arr=<?php echo json_encode($age); ?>;
const Entries=Object.entries($var_arr); 
var $a=<?php echo json_encode($arr);
?>;
console.log($a);
//const j=Object.entries($a);
//console.log(k);</script>

<!-- Right section overview & Analytics -->
<div class="right_container">
  <div id="bar_chart_div"></div>
  <div id="line_chart_div"></div>
  <div class="Recent_Activity">
    <h2 class="section_heading">Candidate Details</h2>
      <div class="underline underline_1"></div>
  </div>
  
  <div class="table-container">
    <table class="format-table">
      <thead>
        <tr>
          <th>Candiate_ID</th>
          <th>Canditate_Name</th>
          <!--<th>Candidate_Details</th>-->
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        while($row5=mysqli_fetch_assoc($result5))
        {
          ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $row5['name'] ?></td>
          <!--<td><?php 
          $s=$row5['id'];
          $sql6="SELECT * FROM vote,candidate where vote.candidateid=$s and vote.eventid= $event ";
          $result6 = mysqli_query($conn,$sql6);
          $row6=mysqli_fetch_assoc($result6);
          echo $row6['details'];
          ?></td>-->

        </tr>
        <?php $i++;}?>
        <!--<tr>
          <td>002</td>
          <td>Abinash Kumar Chourasia</td>
          <td>Old User</td>
        </tr>
        <tr>
          <td>003</td>
          <td>Shital Jaiswara</td>
          <td>New User</td>
        </tr>
        <tr>
          <td>004</td>
          <td>Prithiba Banerjee</td>
          <td>Old User</td>
        </tr>
        <tr>
          <td>005</td>
          <td>Mahendra Singh Dhoni</td>
          <td>New User</td>
        </tr>-->
      </tbody>
    </table>
  </div>
  
  
  
</div>   
</div>
<script>
let progressBar = document.querySelector(".circular-progress");
let valueContainer = document.querySelector(".value-container");

let progressValue = 0;
let progressEndValue =<?php echo $r; ?>;
let speed = 50;

let progress = setInterval(() => {
  if (progressValue == progressEndValue) {
    clearInterval(progress);
  }
  
  valueContainer.textContent = `${progressValue}%`;
  progressBar.style.background = `conic-gradient(
      #4d5bf9 ${progressValue * 3.6}deg,
      #cadcff ${progressValue * 3.6}deg
  )`;
  progressValue++;
  
}, speed);






google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Vote Percentage');
      //console.log(Entries);
       data.addRows(Entries);
      /*data.addRows([        
        ['18-25', 10],
        ['26-35', 20],
        ['36-45', 30],
        ['46-55', 40],
        ['56-65', 50]
      ]);*/


      var options = {
        title: 'Vote Percentage by Age',
        hAxis: {
          title: 'Age'
        },
        vAxis: {
          title: 'Vote Percentage'
        },
        legend: {position: 'none'}
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('bar_chart_div'));

      chart.draw(data, options);
}



















google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawLogScales);

function drawLogScales() {
  var data = new google.visualization.DataTable();
  data.addColumn('datetime', 'Time of Day');
  data.addColumn('number', 'Men');
  data.addColumn('number', 'Women');
  const k=[];
  for(let l=0;l<6;l++)
  {
      k.push([new Date($a[l][0]),$a[l][1],$a[l][2]]);
  }
data.addRows(k);
 /* data.addRows([
    [new Date(2023, 3, 2, 08, 0), 10, 20],
    [new Date(2023, 3, 2, 10, 0), 22, 23],
    [new Date(2023, 3, 2, 12, 0), 55, 25],
    [new Date(2023, 3, 2, 14, 0), 20, 30],
    [new Date(2023, 3, 2, 16, 0), 22, 42],
    [new Date(2023, 3, 2, 18, 0), 25, 35],
    [new Date(2023, 3, 2, 20, 0), 30, 11]
  ]);*/

  var options = {
    hAxis: {
      title: 'Time of Day',
      logScale: false
    },
    vAxis: {
      title: 'Ratio',
      logScale: false
    },
    colors: ['#1f77b4', '#ff7f0e'],
    chartArea: {
      width: '75%'
    }
  };

  var chart = new google.visualization.LineChart(document.getElementById('line_chart_div'));
  chart.draw(data, options);
}</script>
</body>
</html>