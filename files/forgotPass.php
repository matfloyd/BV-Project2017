<?php
// the forgot pass file is trigger by valid input into the retrieve pass form. This will search for the user id in the table they selected and
//if they exist will reset the password randomly providing a temporary password and email the user, instructing them to reset thier password immeadiately.


if (isset($_POST['submit'])) {

	require_once('mysqli_connect.php');
	// Trim all the incoming data:
	//array_map() returns an array containing all the elements of an
	//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

	$column = $table = $uid = false;

	if ($trimmed['login']) {

		$table = mysqli_real_escape_string($dbConnection, $trimmed['login']);
	}
	if ($trimmed['userID']) {

		$uid = mysqli_real_escape_string($dbConnection, $trimmed['userID']);
	}



	if ($table && $uid) {

		switch ($table) {
			case "Parent":
				$column = "ParID";
				break;
			case "Teacher":
				$column = "TID";
				break;
			case "Admin":
				$column = "AID";
				break;
		}

		$query_user = "SELECT $column from $table WHERE $column = '$uid'";

		$bool = true;

		if (!($result = $dbConnection->query($query_user))) {
			trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
			$bool = false;
			//$dbConnection->close();
			require('retrievePass.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.
		}

		if ($bool) { // If everything's OK.
			$password = "resetPassword"; //Make a random generator
			$salt1 = "qm&h*";
			$salt2 = "pg!@";
			$password_token = hash('ripemd128', "$salt1$password$salt2");
			// Make the query.
			$resetQuery = "UPDATE $table SET password = '$password_token' WHERE $column = '$uid'";//Limit the change to one row only
			if (!($result = $dbConnection->query($resetQuery))) {
				trigger_error("Query: $query_insert\n<br />MySQL Error: " . $dbConnection->error);
				$resetFail = 'Could not Reset Password.';
				echo "<script type='text/javascript'>alert('$resetFail');</script>";

				//$dbConnection->close();

				require('index.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.
			}

			if ($dbConnection->affected_rows == 1) {//query ran ok
				$resetSuccess = "Your temporary password is $password.";
				echo "<script type='text/javascript'>alert('$resetSuccess');</script>";

				//this will eventually

				require('index.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.

			}else {//failed validation
				$validateFail1 = "User Id Not found.";
				echo "<script type='text/javascript'>alert('$validateFail1');</script>";

				//$dbConnection->close();

				require('retrievePass.php');
				//ob_end_clean(); // Delete the buffer.
				exit(); // Quit the script.


			}

		} else {//failed validation
			$validateFail2 = "Something went wrong.(error2) Please check your input and try again.";
			echo "<script type='text/javascript'>alert('$validateFail2');</script>";

			//$dbConnection->close();

			require('retrievePass.php');
			//ob_end_clean(); // Delete the buffer.
			exit(); // Quit the script.


		}
	} else {//no id entered
		$emptyID = 'Must provide the user ID.';
		echo "<script type='text/javascript'>alert('$emptyID');</script>";

		//$dbConnection->close();

		require('retrievePass.php');
		//ob_end_clean(); // Delete the buffer.
		exit(); // Quit the script.
	}



}
?>