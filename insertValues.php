<?php

require_once 'includes.php';

$insert = "INSERT INTO `visits` (`visitID`, `contactName`, `contactNumber`, `status`) VALUES (NULL, 'Pragun', '18452170552', 'Unscheduled'), (NULL, 'Ankur', '18452170552', 'Unscheduled')";

mysql_query($insert, $conn) or die("Could not insert values into the table. " . mysql_error());

?>