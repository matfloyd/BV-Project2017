<?php

if (isset($_POST['submit'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	//gmt = gross motor time, ct = circle time,fma = fine motor activity, nt = nap time
	//mas = meal and snacks, bt = bottle notes, dfl = daily feeding log

	$SID = $PID = $today = $food = $phone = $fname = $lname = $notes = $meds = $medNotes = FALSE;
			session_start();
	$PID = $_SESSION['user'];
	date_default_timezone_set('UTC');
	$today = date('Y-m-d');
			
			if ($trimmed['name']) {

		$fname =  mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['name'])[0]);

		$lname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['name'])[1]);
		
		$SIDquery = $dbConnection->query("Select distinct SID from Student where fname = '$fname' and lname = '$lname';");
		
		$queryArray = mysqli_fetch_array($SIDquery);
		
		$SID = $queryArray['SID'];
		}
			
			if ($trimmed['phoneNum']) {
		
		$phone = mysqli_real_escape_string($dbConnection, $trimmed['phoneNum']);
		}
		
			if ($trimmed['food']) {

		$food = mysqli_real_escape_string($dbConnection, $trimmed['food']);
		}
		
			if ($trimmed['meds']) {

		$meds = mysqli_real_escape_string($dbConnection, $trimmed['meds']);
		}
		
		
			if ($trimmed['medicine']) {

		$medNotes = mysqli_real_escape_string($dbConnection, $trimmed['medicine']);
		}
		
			if ($trimmed['notes']) {

		$notes = mysqli_real_escape_string($dbConnection, $trimmed['notes']);
		}

		if ($SID && $PID && $food && $phone && $notes && $meds) { // If everything's OK.
			switch($meds){
				case "YesMeds":
					$meds = 1;
					
					break;
				case "NoMeds":
					$meds = 0;
					break;
			}
			$parentFormQuery = "INSERT INTO PForm (parent, child, altContact, food, medicine, notes) VALUES('$PID','$SID','$phone','$food',$meds,'$notes')";
		
			$bool = true;
			$successful = 'Student Created Successfully!';
			if (!($result = $dbConnection->query($parentFormQuery))) {
				trigger_error("Query: $parentFormQuery\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			
				if ($bool) { // If it ran OK.
						
					if ($meds){
						$medicineQuery = "INSERT INTO Medicine VALUES('$SID','$today','$medNotes')";
						$dbConnection->query($medicineQuery);
						echo "<script type='text/javascript'>alert('Parent form sent! Medicine has been logged');</script>";
						//$dbConnection->close();
						//session_start();
						echo($_SESSION['user']);
						$userID = $_SESSION['user'];
						require ('parent.php');
						//ob_end_clean(); // Delete the buffer.
						exit(); // Quit the script.
						}
						
					if (!$meds){
						echo "<script type='text/javascript'>alert('Parent form sent! No medicine was logged');</script>";
						//$dbConnection->close();
						//session_start();
						echo($_SESSION['user']);
						$userID = $_SESSION['user'];
						require ('parent.php');
						//ob_end_clean(); // Delete the buffer.
						exit(); // Quit the script.
						}
				}
				else { // If everything wasn't OK.
					echo "<script type='text/javascript'>alert('Not Sent to Database');</script>";
					//$dbConnection->close();
					//session_start();
					echo($_SESSION['user']);
					$userID = $_SESSION['user'];
					require ('parent.php');
					//ob_end_clean(); // Delete the buffer.
					exit(); // Quit the script.
		}
	}
}


		
		
		
		
		
		
		
		
		
		
		
?>