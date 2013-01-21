<?php

	require "includes.php";

	$query = "ALTER TABLE visits ADD updateTime BIGINT";

	mysql_query($query, $conn) or die('Could not alter table : ' . mysql_error());

?>
