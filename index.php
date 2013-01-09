<?php

require_once 'includes.php';

?>

<html>

<?php

echo '<h3>List of Visits</h3>';

$result = mysql_query('SELECT * FROM visits');

if(mysql_num_rows($result))	{
	echo '<table cellpadding="10" cellspacing="10" class="db-table">';
	echo '<tr><th>Visit ID</th><th>Contact Name</th><th>Contact Number</th><th>Status</th></tr>';

	while($row = mysql_fetch_row($result))	{
		echo '<tr>';

		foreach($row as $cell)	{
			echo '<td>' . $cell . '</td>';
		}

		echo '</tr>';

	}

	echo '</table><br />';

	?>

	<form name="input" action="sendText.php" method="get">
		Number of clients to text : <input type="text" name="countTexts" />
		<input type="submit" value="Submit" />
	</form>

<?php

}

else 	{
	echo '<p>No visits in record.</p>';
}

?>


</html>