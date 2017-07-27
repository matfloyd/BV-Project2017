<?php
//This is the form handling file for the reset password tab in the index
//The user must provide current, valid id and password and enter new password and confirm
//password before submitting. if all input is correct the users password will be reset.


if (isset($_POST['submit'])) {
	require_once ('mysqli_connect.php');
// Trim all the incoming data:
//array_map() returns an array containing all the elements of an
//array, $_POST, after applying the callback function (trim) to each one
	$trimmed = array_map('trim', $_POST);

// Assume invalid values:
	$table = $userID = $CurrPassword = $NewPassword = $ConfPassword = $NewPassword_token = FALSE;

	if ($trimmed['changeP']) {
		$table = mysqli_real_escape_string($dbConnection, $trimmed['changeP']);
	}
	if ($trimmed['uID']) {
		$userID = mysqli_real_escape_string($dbConnection, $trimmed['uID']);
	}
	if ($trimmed['uPass']) {

		$CurrPassword = mysqli_real_escape_string($dbConnection, $trimmed['uPass']);
	}
	if ($trimmed['newPass']) {
		$NewPassword = mysqli_real_escape_string($dbConnection, $trimmed['newPass']);
	}
	if ($trimmed['confirmPass']) {
		$ConfPassword = mysqli_real_escape_string($dbConnection, $trimmed['confirmPass']);
	}
	If($NewPassword == $ConfPassword){
		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$NewPassword_token = hash('ripemd128', "$salt1$NewPassword$salt2");

	}

	if ($table && $userID && $CurrPassword && $NewPassword_token) { // If everything's OK.


		$salt1 = "qm&h*";
		$salt2 = "pg!@";
		$password_token = hash('ripemd128', "$salt1$CurrPassword$salt2");
// Query the database:
		switch ($table) {
		case "Parent":
		$id = "ParID";
		break;
		case "Teacher":
		$id = "TID";
		break;
		case "Admin":
		$id = "AID";
		break;
		}


		$query = "SELECT $id FROM $table WHERE $id = '$userID' AND password = '$password_token';";

		if ( !( $result = $dbConnection->query($query))) {
		trigger_error("Query: $query\n<br />MySQL Error: " . $dbConnection->error);
			$notFound = "Either the user ID and password entered do not match those on file or you have no account yet.\\nTry again.";
			echo "<script type='text/javascript'>alert('$notFound');</script>";
			require ('index.php');
			exit();
		}

		if ($result->num_rows == 1) { // A match was made.

			$changeQuery = "UPDATE $table SET password = '$NewPassword_token' WHERE $id = '$userID';";
			if ( !( $result = $dbConnection->query($changeQuery))) {
				trigger_error("Query: $query\n<br />MySQL Error: " . $dbConnection->error);
				$notFound = "Password could not be reset.";
				echo "<script type='text/javascript'>alert('$notFound');</script>";
				require ('index.php');
				exit();
			}else { // A match was made.

				$passChanged = "Password was successfully reset.";
				echo "<script type='text/javascript'>alert('$passChanged');</script>";
				require ('index.php');
				exit();



			}
		}
	} else { // If everything wasn't OK.
		echo "<script type='text/javascript'>alert('be sure that all fields are complete and the New passwords match!');</script>";
		require ('index.php');
		exit();
	}

$dbConnection->close();

} // End of SUBMIT conditional.
?>


