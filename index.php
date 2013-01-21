<?php

require_once 'includes.php';

?>

<!DOCTYPE html>

<html>

<head>

	<title>Skadool</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

</head>

<body>

<div class="container">

	<div class="page-header">
		<h1>Skadool <small>Flexible scheduling powered by plivo.</small></h1>
	</div>	

	<?php

	echo '<h3>List of Visits</h3>';

	$result = mysql_query('SELECT * FROM visits');

	if(mysql_num_rows($result))	{
		echo '<table cellpadding="10" cellspacing="10" class="table table-hover">';
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

		<div class="span4 offset4">

			<form name="input" action="sendTexts.php" method="get">
				<div class="input-append">
					<input class="span3" id="appendedInputButton" type="text" name="countTexts" placeholder="Number of clients to text" />
  					<button class="btn btn-primary" type="submit">Go!</button>
				</div>		
			</form>

		</div>

	<?php

	}

	else 	{
		echo '<p class="lead">No visits in record.</p>';
	}

	?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

</div>

</body>

</html>