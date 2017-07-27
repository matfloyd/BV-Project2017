<?php

//This is the form handling file for the delete tab.
// If the submit button is set in the delete/remove tab then the the fields are trimmed and stored to an array.
//This form only require the user id to remove but there will be a confirmation to display the entity's identity
// and be sure they are the correct object to remove. If all is correct the admin can delete the user from the table
// along with any information that exists in the related tables. currently using multiple queries but will integrate
// cascade deletion in the future

if (isset($_POST['submit'])) {


	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	if($trimmed['entity']=='Student'){
		// Assume invalid values:
		$table = $ID = FALSE;

		if ($trimmed['entity']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
		}

		if ($trimmed['removeID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['removeID']);


		}



		if ($table && $ID) { // If everything's OK.
			//will add an alert box to this part of the code to confirm that the admin is sure they want
			//to  delete the specific user from the system. a confirmation will procede to the following code and a cancel will
			// redirect to the admin page


			$deleteClassSID = "DELETE FROM Class WHERE student = '$ID'";
			$StudentDeletequery = "DELETE FROM $table WHERE SID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($deleteClassSID))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($StudentDeletequery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Student Successfully Deleted.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']=='Parent'){
		// Assume invalid values:
		$table = $ID = FALSE;

		if ($trimmed['entity']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
		}

		if ($trimmed['removeID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['removeID']);


		}



		if ($table && $ID) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$deleteMessageParID = "DELETE FROM Messages WHERE ParID = '$ID'";
			$deleteStudentParID = "DELETE FROM Student WHERE ParID = '$ID'";
			$ParentDeletequery = "DELETE FROM $table WHERE ParID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($deleteMessageParID))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($deleteStudentParID ))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($ParentDeletequery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Parent Successfully Deleted.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']=='Teacher'){
		// Assume invalid values:
		$table = $ID = FALSE;

		if ($trimmed['entity']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
		}

		if ($trimmed['removeID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['removeID']);


		}



		if ($table && $ID) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$deleteMessageTID = "DELETE FROM Messages WHERE TID = '$ID'";
			$deleteClassTID = "DELETE FROM Class WHERE teacher = '$ID'";
			$TeacherDeletequery = "DELETE FROM $table WHERE TID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($deleteMessageTID))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($deleteClassTID ))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($TeacherDeletequery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}

			if ($bool) { // If it ran OK.
				$successful = 'Teacher Successfully Deleted.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}

	if($trimmed['entity']=='Admin'){
		// Assume invalid values:
		$table = $ID = FALSE;

		if ($trimmed['entity']) {

			$table = mysqli_real_escape_string($dbConnection, $trimmed['entity']);
		}

		if ($trimmed['removeID']) {
			$ID = mysqli_real_escape_string($dbConnection, $trimmed['removeID']);


		}



		if ($table && $ID) { // If everything's OK.
			//echo "<script type='text/javascript'>alert('INSERT INTO $table VALUES($SID,$fname,$lname,$bdate, $program, $PID)');</script>";


			$deleteAnnounceAID = "DELETE FROM Announcements WHERE creator = '$ID'";
			$AdminDeletequery = "DELETE FROM $table WHERE AID = '$ID'";


			$bool = true;
			if (!($result = $dbConnection->query($deleteAnnounceAID))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}
			if (!($result = $dbConnection->query($AdminDeletequery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$bool = false;
			}


			if ($bool) { // If it ran OK.
				$successful = 'Admin Successfully Deleted.';
				echo "<script type='text/javascript'>alert('$successful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.



			} else { // If it did not run OK.
				$unsuccessful = 'Something went wrong. Please check your input and try again!';
				echo "<script type='text/javascript'>alert('$unsuccessful');</script>";

				$dbConnection->close();
				session_start();
				require ('admin.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}


		}
		else { // If everything wasn't OK.
			echo "<script type='text/javascript'>alert('All fields are required!');</script>";
			session_start();
			require ('admin.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}
	}
	$dbConnection->close();

} // End of SUBMIT conditional.
?>