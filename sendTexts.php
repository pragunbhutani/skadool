<?php

require 'plivo.php';
require_once 'includes.php';

$auth_id = "MAYTM5N2RLOWU1NDMWMW";
$auth_token = "MmY4MjIwNTk4ZDA2ODZlNTY2MGJjNDNmZDI5ODlm";

$dialer = new RestAPI($auth_id, $auth_token);

$getContact = mysql_query("SELECT * FROM visits WHERE status = 'Unscheduled'");

$numTexts = intval($_GET["countTexts"]);

for($count=0; $count<$numTexts; $count++)	{
	$contact = mysql_fetch_assoc($getContact)
	$visitID = $contact["visitID"];
	$number = $contact["contactNumber"];
	$name = $contact["contactName"];
	$status = $contact["status"];

	$params = array(
		'src' => '18453679136',
		'dst' => $number,
		'text' => 'Hi ' . $name . ', are you available to receive your delivery today? Reply with Y or N.',
		'type' => 'sms',
	);

	$response = $dialer->send_message($params);
	echo $response . "<br />";

	$updateStatus = "UPDATE visits SET status='Pending Reply' where visitID='" . $visitID . "'";

	mysql_query($updateStatus, $conn);

}

	echo '<a href="index.php">Return to homepage.</a>'

?>