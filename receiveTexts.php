<?php
require_once "plivo.php";
require "includes.php";

$to = $_REQUEST['To'];
$from = $_REQUEST['From'];
$text = $_REQUEST['Text'];
$msg_id = $_REQUEST['MessageUUID'];

if($text=='y' or $text=='Y')
	$updateAfterReply = "UPDATE visits SET status='Scheduled' WHERE contactNumber='" . $from . "'";
else
	$updateAfterReply = "UPDATE visits SET status='Unscheduled' WHERE contactNumber='" . $from . "'";

mysql_query($updateAfterReply, $conn);

?>