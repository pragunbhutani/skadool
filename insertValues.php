<?php

require_once 'includes.php';

$insert = "INSERT INTO `visits` (`visitID`, `contactName`, `contactNumber`, `status`) VALUES (NULL, 'Skype', '16617480240', 'Unscheduled')";

mysql_query($insert, $conn) or die("Could not insert values into the table. " . mysql_error());

?>