<?php
//session_start();

//
//----------------------------------Login Form---------------------------------------------
if (isset($_POST['submit'])) {
	require_once ('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	// Assume invalid values:
	$SID = $message = $TID = $PID = FALSE;

	session_start();
	$PID = $_SESSION['user'];

	if ($trimmed['TID']) {

		$fname =  mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['TID'])[0]);

		$lname = mysqli_real_escape_string($dbConnection, explode(" ", $trimmed['TID'])[1]);

		$SIDquery = $dbConnection->query("Select distinct SID from Student where fname = '$fname' and lname = '$lname';");

		$queryArray = mysqli_fetch_array($SIDquery);

		$SID = $queryArray['SID'];


	}
	if($SID){
		$TIDquery = $dbConnection->query("Select teacher from Class where student = '$SID';");

		$queryArray2 = mysqli_fetch_array($TIDquery);

		$TID = $queryArray2['teacher'];

	}



	if ($trimmed['messageArea']) {
		$message = mysqli_real_escape_string($dbConnection, $trimmed['messageArea']);
	}


	if ($message && $TID && $PID) { // If everything's OK.


		$query = "INSERT INTO Messages (ParID, TID, message) VALUES('$PID','$TID','$message')";

		$bool = true;
		if (!($result = $dbConnection->query($query))) {
			trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
			$bool = false;
			echo "<script type='text/javascript'>alert('nopey');</script>";
		}
		if ($bool) { // If it ran OK.
			$successful = 'Your message was sent.';
			echo "<script type='text/javascript'>alert('$successful');</script>";

			//$dbConnection->close();
			//session_start();
			$userID = $_SESSION['user'];
			require ('parent.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.



		} else { // If it did not run OK.
			$unsuccessful = 'Something went wrong. Please check your input and try again!';
			echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

			//$dbConnection->close();
			//session_start();
			$userID = $_SESSION['user'];
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}




	} else { // If everything wasn't OK.
		echo "<script type='text/javascript'>alert('Something went wrong 2.0!');</script>";
		//session_start();
		$userID = $_SESSION['user'];
		require ('parent.php');
		//ob_end_clean(); // Delete the buffer.
		exit(); // Quit the script.
	}


}
// End of SUBMIT conditional.
?>
