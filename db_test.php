<?php

require_once "includes.php";

$query = "SELECT * FROM visits";
$result = mysql_query($query);

while($row = mysql_fetch_row($result)) {
    print_r($row);
    print "<br><br>";
}

?>
