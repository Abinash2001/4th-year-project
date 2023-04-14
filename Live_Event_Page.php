<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Live_Event_Page.css">
  <title>Live_Event_page</title>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
      <div class="voters_number">100</div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>100%</p>
    </div>
  </div>
  <div class="voters_box">
    <div class="voters_section">
      <div class="voters_label">Vote Casted</div>
      <div class="voters_number">80</div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>80%</p>
    </div>
  </div>
  <div class="voters_box">
    <div class="voters_section">
      <div class="voters_label">Remaining Voters</div>
      <div class="voters_number">20</div>
    </div>
    <div class="percent">
      <p><ion-icon name="pulse-outline"></ion-icon>20%</p>
    </div>
  </div>

  <div class="Analytics">
    <h2 class="section_heading">Analytics</h2>
      <div class="underline"></div>
  </div>
  <div class="circle">
        <div class="container_1">  
          <div class="circular-progress">
            <div class="value-container">60%</div>
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
<!-- <script src="Live_Event_Page.js"></script> -->


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
          <th>Joining_Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>001</td>
          <td>Souvik Kundu</td>
          <td>New User</td>

        </tr>
        <tr>
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
        </tr>
      </tbody>
    </table>
  </div>
  
  
  
</div>   
</div>
</body>
</html>



<script>
 
let progressBar = document.querySelector(".circular-progress");
let valueContainer = document.querySelector(".value-container");

let progressValue = 0;
let progressEndValue = 100;
let speed = 50;

let progress = setInterval(() => {
  progressValue++;
  valueContainer.textContent = `${progressValue}%`;
  progressBar.style.background = `conic-gradient(
      #4d5bf9 ${progressValue * 3.6}deg,
      #cadcff ${progressValue * 3.6}deg
  )`;
  if (progressValue == progressEndValue) {
    clearInterval(progress);
  }
}, speed);






google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Vote Percentage');

      data.addRows([        
        ['18-25', 10],
        ['26-35', 20],
        ['36-45', 30],
        ['46-55', 40],
        ['56-65', 50]
      ]);

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

  data.addRows([
    [new Date(2023, 3, 2, 08, 0), 10, 20],
    [new Date(2023, 3, 2, 10, 0), 22, 23],
    [new Date(2023, 3, 2, 12, 0), 55, 25],
    [new Date(2023, 3, 2, 14, 0), 20, 30],
    [new Date(2023, 3, 2, 16, 0), 22, 42],
    [new Date(2023, 3, 2, 18, 0), 25, 35],
    [new Date(2023, 3, 2, 20, 0), 30, 11]
  ]);

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
}


</script>






<!-- <script type="text/javascript">
    
  // $(document).ready( function(){
    let progressBar = document.querySelector(".circular-progress");
    let valueContainer = document.querySelector(".value-container");
    $.ajax({
        url: 'circle.php',
        type: 'POST',
        data:{ progressBar:progressBar, valueContainer:valueContainer
        },
        success: function(response) {
            console.log(response);
            $(".container_1").html(response);
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    }); 
// });




/*
<script>
  let progressBar = document.querySelector(".circular-progress");
let valueContainer = document.querySelector(".value-container");

let progressValue = 0;
let progressEndValue = 100;
let speed = 50;

let progress = setInterval(() => {
  progressValue++;
  valueContainer.textContent = `${progressValue}%`;
  progressBar.style.background = `conic-gradient(
      #4d5bf9 ${progressValue * 3.6}deg,
      #cadcff ${progressValue * 3.6}deg
  )`;
  if (progressValue == progressEndValue) {
    clearInterval(progress);
  }
}, speed);






google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Vote Percentage');

      data.addRows([        
        ['18-25', 10],
        ['26-35', 20],
        ['36-45', 30],
        ['46-55', 40],
        ['56-65', 50]
      ]);

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

  data.addRows([
    [new Date(2023, 3, 2, 08, 0), 10, 20],
    [new Date(2023, 3, 2, 10, 0), 22, 23],
    [new Date(2023, 3, 2, 12, 0), 55, 25],
    [new Date(2023, 3, 2, 14, 0), 20, 30],
    [new Date(2023, 3, 2, 16, 0), 22, 42],
    [new Date(2023, 3, 2, 18, 0), 25, 35],
    [new Date(2023, 3, 2, 20, 0), 30, 11]
  ]);

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
}

</script>
  -->