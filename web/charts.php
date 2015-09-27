<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'Ex', 'Ag', 'Ne', 'Op'],
<?php



?>
          
          ['',   80,  167,      120, 40],
          ['',   79,  136,      130, 90],
          ['',   78,  184,      50, 100],
          ['',   72,  278,      230, 0],
          ['',   81,  200,      210, 60],
          ['',   72,  170,      100, 70],
          ['',   68,  477,      80, 40],
        ]);

        var options = {
          colorAxis: {colors: ['yellow', 'red']}
        };

        var chart = new google.visualization.BubbleChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>