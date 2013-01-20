<?php

	require_once "includes.php";

	switch($_GET['method'])	{

		case 'create' :

			$query = "INSERT INTO `visits` (
						`visitID`, `contactName`, `contactNumber`, `status`
					) VALUES (
						NULL, '" . mysql_real_escape_string($_GET['name']) . "', '" . mysql_real_escape_string($_GET['number']) . "', 'Unscheduled'
					)"
				;

			mysql_query($query) or die('Error while inserting new row : ' . mysql_error());

			$return = mysqli_insert_id($query);

			$results = Array(
					'body' => Array(
						'id' => $return
					)
				);

		break;

		case 'update' : 

			$query = "UPDATE visits SET status='" . mysql_real_escape_string($_GET['status']) . "' WHERE contactNumber='" . mysql_real_escape_string($_GET['number']) . "'";

			mysql_query($query) or die('Error while updating row : ' . mysql_error());

			$query = "SELECT status from visits WHERE contactNumber='" . mysql_real_escape_string($_GET['number']) . "'";

			$go = mysql_query($query) or die('Unable to retrieve data : ' . mysql_error());

			$fetch = mysql_fetch_row($go);

			$return = $fetch[0];

			$results = Array(
					'body' => Array(
						'status' => $return
					)
				);

		break;

		case 'get' :

			$query = "SELECT visitID, contactName, status FROM visits WHERE contactNumber='" . mysql_real_escape_string($_GET['number']) . "'";

			$go = mysql_query($query) or die('Unable to retrieve data : ' . mysql_error());

			$fetch = mysql_fetch_row($go);

			$return = Array($fetch[0], $fetch[1], $fetch[2]);

			$results = Array(
					'body' => Array(
						'id' => $return[0],
						'name' => $return[1],
						'status' => $return[2]
					)
				);

		break;

	}

	/* Setting up JSON headers */
	@header ("content-type: text/json charset=utf-8");

	/* Printing the JSON Object */
	echo json_encode($results);


?>