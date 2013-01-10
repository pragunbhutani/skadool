<?php

require_once 'includes.php';

$insert = "INSERT INTO `visits` (`visitID`, `contactName`, `contactNumber`, `status`) VALUES (NULL, 'Pragun', '9582033800', 'Unscheduled'), (NULL, 'Ankur', '9898989898', 'Unscheduled')";

mysql_query($insert, $conn) or die("Could not insert values into the table.");

?>