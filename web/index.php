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


# Instantiate the Mailgun client.
$mgClient = new Mailgun('key-c48a6be15dee42e854dc57bcf7c05ca4');
$domain = "https://api.mailgun.net/v3/mg.bnegross.com";

$stmt = $db->query('SELECT * FROM mailtest limit 5');
$row_count = $stmt->rowCount();
echo $row_count.' rows selected<hr>';

foreach($db->query('SELECT * FROM mailtest limit 5') as $row) {
    echo $row['name'].'<br>';
    if (send_email($row['name'],$row['email'])) {
    	echo 'email sent to ' . $row['name'] .' at ' . $row['email'] . '<hr>';
    }
    
}

function send_email($name, $email) 
{
	global $mgClient, $domain;
	result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Dinner Bot <db@mg.bnegross.com>',
                        'to'      => $name . "<" . $email . ">",
                        'subject' => 'Hello again ' . $name,
                        'text'    => 'Congratulations ' . $name . ', You are great'));
    return true;
}

?>
