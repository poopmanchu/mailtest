<?php

require('../vendor/autoload.php');
use Mailgun\Mailgun;

# determine environment and connect to right database accordingly

if (getenv("CLEARDB_DATABASE_URL") != "") {
	echo "heroku!!<hr>";
	$url = parse_url(getenv("CLEARDB_DATABASE_URL")); // heroku database url
	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$dbname = substr($url["path"], 1);
	$db = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
} else {
	echo "local!<hr>";
	$db = new PDO('mysql:host=localhost;dbname=brgross;charset=utf8', 'root', 'root');
}

?>

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

foreach($db->query('SELECT * FROM mailtest LIMIT 9') as $row) {
    echo '[\'' . $row['name'] . '\',' . $row['ex'] . "," . $row['ag'] . "," . $row['ne'] . "," . $row['op'] . "],";
    
}

?>
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