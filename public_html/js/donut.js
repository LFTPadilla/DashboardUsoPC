google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);

var values = document.getElementById("bottomCardPieChart");
var test = values.innerText;

var final = test.split(" ");

var used = final[1];
var free = final[2];
console.log(test)
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Memoria RAM', 'Uso'],
    ['Memoria RAM en uso',     used],
    ['Memoria RAM libre',      free]
  ]);

  var options = {
    title: 'Memoria RAM',
    pieHole: 0.4,
  };

  var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
  chart.draw(data, options);
}