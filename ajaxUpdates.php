<?php

require "includes.php";

$serverTime = $_GET['serverTime'];

$sql = "SELECT visitID, contactName, contactNumber, status FROM visits WHERE updateTime > " . $serverTime;
$result = mysql_query($sql, $conn);

$response = Array(
	"body" => Array (
		"serverTime" => time(),
		"updatedData" => array(),
	),
);
while ($row = mysql_fetch_row($result)) {
	
	array_push($response['body']['updatedData'], array(
		"visitID" => $row[0],
		"contactName" => $row[1],
		"contactNumber" => $row[2],
		"status" => $row[3],
	));
};

echo json_encode($response);

?>
