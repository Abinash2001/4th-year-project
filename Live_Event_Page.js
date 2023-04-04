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

