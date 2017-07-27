<?php
if (isset($_POST['RequestReport'])) {
	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);
	
	?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8">



<link rel="stylesheet" type="text/css" href="css/table.css">
</head>
	<body>
		<?php
		$queryReport = mysqli_query($dbConnection, "Select * FROM TForm;");
		while($row = mysqli_fetch_array($queryReport)) {
		?>
		<?php
		$queryReport1 = mysqli_query($dbConnection, "Select teacher, child, date, mood FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport1)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>Teacher</td>
							<td>Child</td>
							<td>Date</td>
							<td>Mood</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>	
				<br>				
		<?php
		$queryReport2 = mysqli_query($dbConnection, "Select grossMotor, activities, circleTime, fineMotor FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport2)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>Gross Motor</td>
							<td>Activities</td>
							<td>Circle Time</td>
							<td>Fine Motor</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>
				<br>
		<?php
		$queryReport3 = mysqli_query($dbConnection, "Select timeSlept, qualitySlept, artComm, enjoyedComm, specialComm, otherComm FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport3)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>Time Slept</td>
							<td>Sleep Quality</td>
							<td>Art</td>
							<td>Special</td>
							<td>Other Special</td>
							<td>Comments</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>
				<br>
		<?php
		$queryReport4 = mysqli_query($dbConnection, "Select snackAM, breakfast, lunch, snackPM, bottleNotes, feedingLOG FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport4)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>AM Snack</td>
							<td>Breakfast</td>
							<td>Lunch</td>
							<td>PM Snack</td>
							<td>Bottle Notes</td>
							<td>Feeding</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>
				<br>
		<?php
		$queryReport5 = mysqli_query($dbConnection, "Select restroomComm, medicine, mood FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport5)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>Restroom</td>
							<td>Medicine</td>
							<td>Mood</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>
				<br>
		<?php
		$queryReport6 = mysqli_query($dbConnection, "Select physThrpTime, occThrpTime, spchThrpTime, therapyNotes, therpName, IEP FROM TForm;");
		$row = mysqli_fetch_assoc($queryReport6)
		?>
				<table style="background-color:white;" >
					<thead>
						<tr>
							<td>Physical Therapy Time</td>
							<td>Occupational Therapy Time</td>
							<td>Speech Therapy Time</td>
							<td>Therapy Notes</td>
							<td>Therapy Name</td>
							<td>IEP</td>
						</tr>
					</thead>
					<tbody>
					<?php
						echo "<tr>";
						foreach ($row as $value)
						{
						echo "<td>".$value."</td>";
						}
						echo "</tr>";
						
						
						?>
					</tbody>
				</table>

					<p> End of this day </p>
				<br>
				<?php
				
		}
				?>
	</body>
</html>
		
		

		<?php
}	
		//include ('footer.php');

	?>