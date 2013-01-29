<?php

	require_once "includes.php";

	switch($_GET['method'])	{

		case 'create' :

			$query = "INSERT INTO `visits` (
						`visitID`, `contactName`, `contactNumber`, `status`, 'updateTime'
					) VALUES (
						NULL, '" . mysql_real_escape_string($_GET['name']) . "', '" . mysql_real_escape_string($_GET['number']) . "', 'Unscheduled', '" . time() . "
					')"
				;

			mysql_query($query) or die('Error while inserting new row : ' . mysql_error());

			$query = "SELECT * FROM visits ORDER BY visitID DESC LIMIT 1";

			$go = mysql_query($query) or die('Unable to retrieve data : ' . mysql_error());

			$fetch = mysql_fetch_row($go);

			$return = Array($fetch[0], $fetch[1], $fetch[2], $fetch[3]);

			$results = Array(
					'body' => Array(
						'id' => $return[0],
						'name' => $return[1],
						'number' => $return[2],
						'status' => $return[3],
					)
				);

		break;

		case 'update' : 

			$query = "UPDATE visits SET status='" . mysql_real_escape_string($_GET['status']) . "', updateTime='" . time() . "' WHERE contactNumber='" . mysql_real_escape_string($_GET['number']) . "'";

			mysql_query($query) or die('Error while updating row : ' . mysql_error());

			$query = "SELECT visitID, contactName, status from visits WHERE contactNumber='" . mysql_real_escape_string($_GET['number']) . "'";

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

		case 'delete' :

			$query = "DELETE FROM visits WHERE visitID='" . mysql_real_escape_string($_GET['id']) . "'";

			mysql_query($query) or die('Could not delete row : ' . mysql_error());

			$results = Array(
					'body' => Array(
						'id' => $_GET['id']
					)
				);

		break;



	}


	switch($_GET['format'])	{


		case 'json'	:

			/* Setting up JSON headers */
			@header ("content-type: text/json charset=utf-8");

			/* Printing the JSON Object */
			echo json_encode($results);

		break;


		case 'xml' :

			/* Setting XML header */
			@header ("content-type: text/xml charset=utf-8");

			/* Initializing the XML Object */
			$xml = new XmlWriter();
			$xml->openMemory();
			$xml->startDocument('1.0', 'UTF-8');
			$xml->startElement('callback');
			$xml->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
			$xml->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');

			/* Function that converts each array element to an XML node */
			function write(XMLWriter $xml, $data){
				foreach($data as $key => $value){
					if(is_array($value)){
						$xml->startElement($key);
							write($xml, $value);
							$xml->endElement();
							continue;
					}
			
					$xml->writeElement($key, $value);
				}
			}

			/* Calls previously declared function, passing our results array as parameter */
			write($xml, $results);

			/* Closing last XML node */
			$xml->endElement();

			/* Printing the XML */
			echo $xml->outputMemory(true);

		break;

		case 'php' :

			/* Setting up PHP headers */
			header ("content-type: text/php charset=utf-8");

			/* Printing the PHP serialized Object*/
			echo serialize($results);

		break;

	}

?>
