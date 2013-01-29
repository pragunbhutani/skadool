<?php
require_once "plivo.php";
require "includes.php";

$to = $_REQUEST['To'];
$from = $_REQUEST['From'];
$text = $_REQUEST['Text'];
$msg_id = $_REQUEST['MessageUUID'];

if($text=='y' or $text=='Y')
	$updateAfterReply = "UPDATE visits SET status='Scheduled', updateTime=`" . time() . "` WHERE contactNumber='" . $from . "'";
else
	$updateAfterReply = "UPDATE visits SET status='Unscheduled', updateTime=`" . time() . "` WHERE contactNumber='" . $from . "'";

mysql_query($updateAfterReply, $conn) or die('Could not update table : ' . mysql_error());

?>