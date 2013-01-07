<?php

require 'plivo.php';
require_once 'includes.php';

$auth_id = "MAZWU0NZQ2ODLKNJMZMM";
$auth_token = "Y2ZhYmVhNGI1MGU2NzYxMDQ1ZDRjM2U2MWJlM2Ey";

$dialer = new RestAPI($auth_id, $auth_token);

$getContact = mysql_query("SELECT * FROM contacts");

while($contact = mysql_fetch_assoc($getContact))	{
	$id = $contact["id"];
	$number = $contact["number"];
	$name = $contact["name"];
	$status = $contact["status"];

	$params = array(
		'src' => '1202XXXXXX',
		'dst' => $number,
		'text' => 'Hi ' . $name . ', please send in a response.',
		'type' => 'sms',
	);

	// $response = $dialer->send_message($params);
	// echo $response . "<br />";

	echo $id . ", " . $number . ", " . $name . ", " . $status . "<br />";

}


?>