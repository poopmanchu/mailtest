<?php

require('../vendor/autoload.php');
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-c48a6be15dee42e854dc57bcf7c05ca4');
$domain = "sandbox12a6e644e12a43d4bd6bc11a3f899787.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox12a6e644e12a43d4bd6bc11a3f899787.mailgun.org>',
                        'to'      => 'Ben Gross <brgross@gmail.com>',
                        'subject' => 'Hello again Ben Gross',
                        'text'    => 'Congratulations Ben Gross, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));
    
echo "mail test go!";

?>
