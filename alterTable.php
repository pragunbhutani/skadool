<?php

	require_once "includes.php"

	$query = "ALTER TABLE visits ADD updateTime DATETIME NULL";

	mysql_query($query) or die('Could not alter table : ' . mysql_error());

?>