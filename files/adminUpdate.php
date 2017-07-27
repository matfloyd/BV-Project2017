<?php

//this is the form handling file for the update tab
//the goal of this file is to take any info provided and update only the specific info
//all fields can be filled or only one field can be filled but at least some field must be filled
//in order to execute an update. it is responsive like the create page but with less conent because not all fields
//can be altered. depending on the query ran, a success message will be given to confirm the update was successful.


if (isset($_POST['submit'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	if($trimmed['update']=='Student'){
		// Assume invalid values:
		$table = $ID = $lname = $program = FALSE;

		if ($trimmed['update']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['update']);
		}

		if ($trimmed['ID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['ID']);


		}
		if ($trimmed['slname']) {
			$lname = mysqli_real_escape_string($dbConnection, $trimmed['slname']);


		}
		if ($trimmed['program2']) {
			$program = mysqli_real_escape_string($dbConnection, $trimmed['program2']);
			switch($program){
				case "Early Head Start":
					$program = 1;
					break;
				case "Keys for Kids":
					$program = 2;
					break;
				case "Child Care":
					$program = 3;
					break;
			}

		}

		if ($table && $ID && $lname && $program) { // If everything's OK.
			echo "<script type='text/javascript'>alert('$program');</script>";


			$updateS1 = "UPDATE $table SET lname = '$lname' WHERE SID = '$ID'";
			$updateS2 = "UPDATE $table SET progID = $program WHERE SID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateS1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateS2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Student fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}elseif($table && $ID && $program ) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateS2 = "UPDATE $table SET progID = $program WHERE SID = '$ID'";



			$bool = true;
			if (!($result = $dbConnection->query($updateS2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Student program Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}else{ // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateS1 = "UPDATE $table SET lname = '$lname' WHERE SID = '$ID'";



			$bool = true;
			if (!($result = $dbConnection->query($updateS1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Student fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}

	}

	if($trimmed['update']=='Parent'){
		// Assume invalid values:
		$table = $ID = $lname = $email = $phone = FALSE;

		if ($trimmed['update']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['update']);
		}

		if ($trimmed['ID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['ID']);


		}
		if ($trimmed['plname']) {
			$lname = mysqli_real_escape_string($dbConnection, $trimmed['plname']);


		}
		if ($trimmed['email']) {
			$email = mysqli_real_escape_string($dbConnection, $trimmed['email']);


		}
		if ($trimmed['phone']) {
			$phone = mysqli_real_escape_string($dbConnection, $trimmed['phone']);


		}
		if ($table && $ID && $lname && $email && $phone) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateP1 = "UPDATE $table SET lname = '$lname' WHERE ParID = '$ID'";
			$updateP2 = "UPDATE $table SET email = '$email' WHERE ParID = '$ID'";
			$updateP3 = "UPDATE $table SET phone = '$phone' WHERE ParID = '$ID'";

			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP3))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if ($bool) { // If it ran OK.
				$successful = 'Parent fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}elseif($table && $ID && $lname && $email ){
			$updateP1 = "UPDATE $table SET lname = '$lname' WHERE ParID = '$ID'";
			$updateP2 = "UPDATE $table SET email = '$email' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($table && $ID && $email && $phone){
			$updateP1 = "UPDATE $table SET email = '$email' WHERE ParID = '$ID'";
			$updateP2 = "UPDATE $table SET phone = '$phone' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($table && $ID && $lname && $phone){
			$updateP1 = "UPDATE $table SET lname = '$lname' WHERE ParID = '$ID'";
			$updateP2 = "UPDATE $table SET phone = '$phone' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateP2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($table && $ID && $lname){
			$updateP1 = "UPDATE $table SET lname = '$lname' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent name Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}elseif($table && $ID && $email){
			$updateP1 = "UPDATE $table SET email = '$email' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent email Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}else{//phone only
			$updateP1 = "UPDATE $table SET phone = '$phone' WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateP1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent phone Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}
		}

	}

	if($trimmed['update']=='Teacher'){
		// Assume invalid values:
		$table = $ID = $lname = $program = FALSE;

		if ($trimmed['update']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['update']);
		}

		if ($trimmed['ID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['ID']);


		}
		if ($trimmed['tlname']) {
			$lname = mysqli_real_escape_string($dbConnection, $trimmed['tlname']);


		}
		if ($trimmed['program']) {
			$program = mysqli_real_escape_string($dbConnection, $trimmed['program']);


		}

		if ($table && $ID && $lname && $program) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateT1 = "UPDATE $table SET lname = '$lname' WHERE TID = '$ID'";
			$updateT2 = "UPDATE $table SET progID = $program WHERE TID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($updateT1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($updateT2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Teacher fields Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}elseif($table && $ID && $lname ) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateT1 = "UPDATE $table SET progID = $lname WHERE TID = '$ID'";



			$bool = true;
			if (!($result = $dbConnection->query($updateT1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Teacher name Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}else{ // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateT2 = "UPDATE $table SET progID = $program WHERE TID = '$ID'";



			$bool = true;
			if (!($result = $dbConnection->query($updateT2))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Teacher program Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}

	}

	if($trimmed['update']=='Admin'){
		// Assume invalid values:
		$table = $ID = $lname = FALSE;

		if ($trimmed['update']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['update']);
		}

		if ($trimmed['ID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['ID']);


		}
		if ($trimmed['alname']) {
			$lname = mysqli_real_escape_string($dbConnection, $trimmed['alname']);


		}


		if ($table && $ID && $lname ) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$updateA1 = "UPDATE $table SET lname = '$lname' WHERE AID = '$ID'";



			$bool = true;
			if (!($result = $dbConnection->query($updateA1))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Admin name Updated Successfully.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				//$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}


	}
	$dbConnection->close();

} // End of SUBMIT conditional.
?>