<?php

require_once 'includes.php';

$update = "UPDATE visits SET contactNumber = '18565751196' WHERE visitID = 2";

mysql_query($update, $conn) or die(mysql_error());

?>