<?php

require_once 'includes.php';

$insert = "INSERT INTO `visits` (`visitID`, `contactName`, `contactNumber`, `status`) VALUES (NULL, '" . $_GET['name'] . "', '" . $_GET['number'] . "', 'Unscheduled')";

mysql_query($insert, $conn) or die("Could not insert values into the table. " . mysql_error());

?>
