<?php

	require_once "includes.php"

	$query = "ALTER TABLE visits ADD updateTime BIGINT";

	mysql_query($query) or die('Could not alter table : ' . mysql_error());

?>
