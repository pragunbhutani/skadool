<?php

require 'plivo.php';
require_once 'includes.php';

$auth_id = "MAZWU0NZQ2ODLKNJMZMM";
$auth_token = "Y2ZhYmVhNGI1MGU2NzYxMDQ1ZDRjM2U2MWJlM2Ey";

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
		'src' => '1202XXXXXX',
		'dst' => $number,
		'text' => 'Hi ' . $name . ', please send in a response.',
		'type' => 'sms',
	);

	$response = $dialer->send_message($params);
	echo $response . "<br />";

	$updateStatus = "UPDATE visits SET status='Pending Reply' where visitID='" . $visitID . "'";

	mysql_query($updateStatus);

}

	echo '<a href="index.php">Return to homepage.</a>'

?>