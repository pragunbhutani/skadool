<?php

$services_json = json_decode(getenv("VCAP_SERVICES"),true);
$mysql_config = $services_json["mysql-5.1"][0]["credentials"];

$username = $mysql_config["username"];
$password = $mysql_config["password"];
$hostname = $mysql_config["hostname"];
$port = $mysql_config["port"];
$db = $mysql_config["name"];

//connection to the database
$conn = mysql_connect("$hostname:$port", $username, $password) 
	or die("Unable to connect to MySQL.");

//select a database to work with
$selected = mysql_select_db($db, $link) 
  or die("Could not select the database.");


?>