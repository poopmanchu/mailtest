<?php

require('../vendor/autoload.php');
use Mailgun\Mailgun;

#$foo = $bar ?: $baz;

if (getenv("CLEARDB_DATABASE_URL") != "") {
	echo "heroku!<hr>";
	$url = parse_url(getenv("CLEARDB_DATABASE_URL")); // heroku database url
	echo getenv("CLEARDB_DATABASE_URL") . "<br>";
	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$dbname = substr($url["path"], 1);
	$db = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . 'charset=utf8', $username, $password);
	#$db = new PDO('mysql:host=us-cdbr-iron-east-02.cleardb.net;dbname=heroku_520ba2224f276e6;charset=utf8', 'b60f97485912f4', '5fd0cb8e');

} else {
	echo "local!<hr>";
	$db = new PDO('mysql:host=localhost;dbname=brgross;charset=utf8', 'root', 'root');
	/*
	$envtest = "mysql://b60f97485912f4:5fd0cb8e@us-cdbr-iron-east-02.cleardb.net/heroku_520ba2224f276e6?reconnect=true";
	$url = parse_url($envtest); // heroku database url
	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$dbname = substr($url["path"], 1);
	echo $server . "<br>" . $username . "<br>" . $password . "<br>" . $dbname . "<br>"; */
	
}



# Instantiate the Mailgun client.
$mgClient = new Mailgun('key-c48a6be15dee42e854dc57bcf7c05ca4');
$domain = "sandbox12a6e644e12a43d4bd6bc11a3f899787.mailgun.org";

/*

# Connect to the local database

#$db = new PDO('mysql:host=localhost;dbname=brgross;charset=utf8', 'root', 'root');

# Connect to the remote database

# $url = parse_url(getenv("CLEARDB_DATABASE_URL")); // heroku database url

$url = parse_url('mysql://b60f97485912f4:5fd0cb8e@us-cdbr-iron-east-02.cleardb.net/heroku_520ba2224f276e6?reconnect=true');

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

#$db = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . 'charset=utf8', $username, $password);
$db = new PDO('mysql:host=us-cdbr-iron-east-02.cleardb.net;dbname=heroku_520ba2224f276e6;charset=utf8', 'b60f97485912f4', '5fd0cb8e');
*/


$stmt = $db->query('SELECT * FROM mailtest');
$row_count = $stmt->rowCount();
echo $row_count.' rows selected<hr>';

foreach($db->query('SELECT * FROM mailtest') as $row) {
    echo $row['name'].'<br>';
    /*if (send_email($row['name'],$row['email'])) {
    	echo 'email sent to ' . $row['name'] .' at ' . $row['email'] . '<hr>';
    }*/
    
}

function send_email($name, $email) 
{
	global $mgClient, $domain;
	$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox12a6e644e12a43d4bd6bc11a3f899787.mailgun.org>',
                        'to'      => $name . "<" . $email . ">",
                        'subject' => 'Hello again ' . $name,
                        'text'    => 'Congratulations ' . $name . ', You are truly awesome!'));
    return true;
}



# Make the call to the client.
/*$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox12a6e644e12a43d4bd6bc11a3f899787.mailgun.org>',
                        'to'      => 'Ben Gross <brgross@gmail.com>',
                        'subject' => 'Hello again Ben Gross',
                        'text'    => 'Congratulations Ben Gross, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));
    
echo "mail test go!";
*/

?>
