<?php

require_once 'includes.php';

$sql = "CREATE TABLE visits 
(
visitID int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(contactID),
contactName varchar(40),
contactNumber varchar(20),
status varchar(20) DEFAULT 'Uscheduled',
)";

mysql_query($sql, $conn) or die("Could not create table Visits.");


?>