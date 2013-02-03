<?php

require_once 'includes.php';

?>

<!DOCTYPE html>

<html>

<head>

	<title>Skadool</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<style>
		.table tr {
			transition: all 0.4s ease-in-out;
			-webkit-transition: all 0.4s ease-in-out;
			-moz-transition: all 0.4s ease-in-out;
		}
	</style>

</head>

<body>

<div class="container">

	<div class="page-header">
		<h1>Skadool <small>Flexible scheduling powered by plivo.</small></h1>
	</div>	

	<?php

	echo '<h3>List of Visits</h3>';

	$result = mysql_query('SELECT visitID, contactName, contactNumber, status FROM visits');

	if(mysql_num_rows($result))	{
		echo '<table cellpadding="10" cellspacing="10" class="table table-hover">';
		echo '<tr><th>Visit ID</th><th>Contact Name</th><th>Contact Number</th><th>Status</th></tr>';

		while($row = mysql_fetch_row($result))	{
			echo '<tr data-visitid="' . $row[0] . '">';

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
	<script>
		var serverTime = <?php echo time(); ?>;

		function getUpdates() {
			console.log(window.serverTime);
			$.ajax({
				url: 'ajaxUpdates.php?serverTime=' + window.serverTime,
				success: function(data) {
					data = JSON.parse(data);
					for (entry in data.body.updatedData) {
						var $tr = $("tr[data-visitid=" + data.body.updatedData[entry].visitID + "]");
                        if ($tr.length > 0) {
                            $("td:nth-child(4)", $tr).html(data.body.updatedData[entry].status);
                        } else {
                            $tr = $('<tr data-visitid="' + data.body.updatedData[entry].visitID + '"><td>' + data.body.updatedData[entry].visitID + '</td><td>' + data.body.updatedData[entry].contactName + '</td><td>' + data.body.updatedData[entry].contactNumber + '</td><td>' + data.body.updatedData[entry].status + '</td></tr>');
                            $('table').append($tr);
                        }
                        $tr.css('background', 'rgb(101, 190, 101)')
						window.setTimeout(function($tr) {
						   $tr.css({background: ''});
						}, 3000, $tr);
					}

					window.serverTime = data.body.serverTime;
				},
			});
		}

		window.setInterval(getUpdates, 5000);
	</script>

</div>

</body>

</html>
